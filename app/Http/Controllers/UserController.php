<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        // Tambah data user dengan Elouqent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];
        // UserModel::insert($data);

        // // Tambah data part 2
        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data);


        // ! JOBSHEET 4
        // Insert data
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];
        // Insert data part 2
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager ',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // Coba akses userModel
        // $user = userModel::all(); // Mengambil semua data dari m_user

        // Find(1)
        // $user = UserModel::find(1);

        // first
        // $user = UserModel::where('level_id', 1)->first;

        // firstWhere
        // $user = UserModel::firstwhere('level_id', 1);

        // findOr
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);
        // });

        // FindOrFail
        // $user = UserModel::findOrFail(1);

        // FirstOrFail
        // $user = UserModel::where('username', 'manager9')->firstOrFail();

        // Count
        // $user = UserModel::where('level_id', 2)->count();

        // * Retreiving or Creating Models
        // FirstOrCreate
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );

        // $user->username = 'manager56';

        // $user->isDirty(); // True
        // $user->isDirty('username'); // True
        // $user->isDirty('nama'); // False
        // $user->isDirty('nama', 'username'); // True

        // $user->isClean(); // False
        // $user->isClean('username'); // False
        // $user->isClean('nama'); // true
        // $user->isClean('nama', 'username'); // False

        // $user->save();

        // $user->isDirty(); // False
        // $user->isClean(); // True
        // dd($user->isDirty());

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager11',
        //         'nama' => 'Manager11',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        // );

        // $user->username = 'manager12';

        // $user->save();

        // $user->wasChanged(); // True
        // $user->wasChanged('username'); // True
        // $user->wasChanged(['nama', 'level_id']); // True
        // $user->wasChanged('nama'); // False
        // $user->wasChanged(['nama', 'username']); // True
        // dd($user->wasChanged(['nama', 'username']));

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        //return view('user', ['data' => $user]); // Tampilkan semua data ke view

        // Relations
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);
        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    public function formUser()
    {
        return view('user.formUser');
    }
    public function formLevel()
    {
        return view('user.formLevel');
    }
}
