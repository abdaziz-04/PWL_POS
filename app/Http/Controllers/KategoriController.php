<?php

namespace App\Http\Controllers;

use DataTables;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // Menambah data ke tabel m_kategori
    public function index(KategoriDataTable $dataTable)
    {
        // Praktikum 1 - Insert Data
        // $data = [
        //     'kategori_kode' => 'KTG006',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];
        // db::table('m_kategori')->insert($data);
        // return 'Data berhasil ditambahkan';

        // Praktikum 2 - Update Data
        // $row = DB::table('m_kategori')->where('kategori_kode', 'KTG006')->update(['kategori_nama' => 'camilan', 'updated_at' => now()]);
        // return 'Update berhasil, jumlah data yang di update' . $row . ' baris';

        // Praktikum 3 - Delete Data
        // $row = DB::table('m_kategori')->where('kategori_kode', 'KTG006')->delete();

        // Tampil data di tabel
        // $data = DB::table('m_kategori')->get();
        // return view('kategori.kategori', ['data' => $data]);

        // !Jobsheet 5
        return $dataTable->render('kategori.index');
    }
    public function create()
    {
        return view('kategori.create');
    }
    public function store(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }
}
