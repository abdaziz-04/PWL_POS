<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use DataTables;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{

    public function tesDB()
    {
    try {
        // Coba panggil data dari tabel level menggunakan model LevelModel
        $kategori = kategori::all();

        // Jika berhasil dipanggil, tampilkan data
        foreach ($kategori as $kategori) {
            echo "ID: " . $kategori->kategori_id . ", Kode Kategori: " . $kategori->kategori_kode . ", Nama Kategori: " . $kategori->kategori_nama . "<br>";
        }

        // Jika berhasil, kembalikan pesan sukses
        return "Database berhasil dipanggil!";
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, tangkap dan tampilkan pesan kesalahan
        return "Terjadi kesalahan: " . $e->getMessage();
    }
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Kategori Barang',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Kategori Barang'
        ];

        $activeMenu = 'kategori'; // Set menu yang sedang aktif

        $kategori = KategoriModel::all();     // Ambil data level untuk filter level
        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
        {
            $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama', 'image');

            if ($request->kategori_id) {
                $kategori->where('kategori_id', $request->kategori_id);
            }
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('aksi', function ($kategori) {
                    $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">' . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        $page = (object) [
            'title' => 'tambah kategori baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'kategori';
        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'bail|required|unique:m_kategori|max:255',
            'kategori_nama' => 'bail|required|max:255',
            'image' => 'required|image'

        ]);
        if ($request->file('image')->isValid()) {

            $filename = $request->username . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $imagePath = $request->file('image')->storeAs('public/gambar/kategori/', $filename);

            KategoriModel::create([
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama,
            ]);

            return redirect('/kategori')->with('success', 'Data user berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'File upload error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail kategori',
            'list' => ['Home', 'kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'

        ];

        $activeMenu = 'Kategori'; ///set menu yang aktif
        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'bail|required|max:255',
            'kategori_nama' => 'bail|required|unique:m_kategori|max:255',
        ]);

        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama = $request->kategori_nama;

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Simpan gambar baru
            $filename = $request->barang_kode . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public/gambar/kategori', $filename);

            // Hapus gambar lama jika ada
            if ($kategori->image) {
                Storage::delete('public/gambar/kategori' . $kategori->image);
            }

            // Simpan nama file gambar baru di database
            $kategori->image = $filename;
        }
        $kategori->save();

        return redirect('/kategori')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);

        if (!$check) {      //untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/kategori')->with('error', 'Data tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);   //Hapus data level
            // Hapus gambar
            if ($check->image) {
                Storage::delete('public/gambar/kategori/' . $check->image);
            }
            return redirect('/kategori')->with('seccess', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/kategori')->with('error', 'Data gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}
