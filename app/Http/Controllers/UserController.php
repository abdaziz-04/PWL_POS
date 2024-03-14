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

        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
        );
        $user->save();

        return view('user', ['data' => $user]); // Tampilkan semua data ke view
    }
}
