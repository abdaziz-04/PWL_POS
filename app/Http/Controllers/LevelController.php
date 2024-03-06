<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // Praktikum 1 - insert data
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values (?,?,?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // Praktikum 2 - Update data
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['customer', 'CUS']);
        // return 'update data berhasil. jumlah data yang di update: ' . $row . ' baris';

        // Praktikum 3 - Hapus data
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil, jumlah data yang dihapus: ' . $row . 'baris';

        // Praktikum 4 - Tampilkan data di tabel
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}
