<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function db_test(Request $request)
{
    // Select only necessary columns
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

    // Filter data user based on level_id
    if ($request->level_id) {
        $users->where('level_id', $request->level_id);
    }

    return $users->get(); // Return the result directly
}


    // Tampil halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // Set menu yang sedang aktif

        $level = LevelModel::all();     // Ambil data level untuk filter level
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id', 'image')->with('level');

        //Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }


    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
            'image' => 'required|image',
        ]);

            $filename = $request->username . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $imagePath = $request->file('image')->storeAs('public/gambar/user/', $filename);

            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'level_id' => $request->level_id,
                'image' => $filename,
            ]);

            return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail User'
        ];

        $activeMenu = 'user';

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer',
            'image' => 'nullable|image', // validasi gambar
        ]);

        // Dapatkan data pengguna yang ada
        $user = UserModel::find($id);

        // Jika data pengguna tidak ditemukan, kembalikan respons yang sesuai
        if (!$user) {
            return redirect()->back()->with('error', 'Data user tidak ditemukan');
        }

        // Update data pengguna yang ada
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;

        // Periksa apakah ada kata sandi baru yang diberikan
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Simpan gambar baru
            $filename = $request->username . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public/gambar/user/', $filename);

            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('public/gambar/user/' . $user->image);
            }

            // Simpan nama file gambar baru di database
            $user->image = $filename;
        }

        // Simpan perubahan pada data pengguna
        $user->save();

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);
            // Hapus gambar
            if ($check->image) {
                Storage::delete('public/gambar/user' . $check->image);
            }
            // Hapus data
            return redirect('/user')->with('success', 'Data user berhasil dihapus');

        } catch (\illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error' . 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
