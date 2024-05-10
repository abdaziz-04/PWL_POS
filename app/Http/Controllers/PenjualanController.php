<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\TransaksiPenjualanModel;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\DetailTransaksiPenjualanModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan']
        ];
        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem'
        ];
        $activeMenu = 'penjualan';

        $user = UserModel::all();
        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualans = TransaksiPenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')->with('user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }
        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/sales/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/sales/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/sales/' . $penjualan->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah transaksi penjualan baru'
        ];
        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';
        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'penjualan_tanggal' => Carbon::createFromFormat('Y-m-d\TH:i', $request->penjualan_tanggal)->format('Y-m-d H:i:s')
        ]);

        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:50',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date_format:Y-m-d H:i:s',
            'barang_id' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer'
        ]);

        $transaksiPenjualan = TransaksiPenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        $penjualanId = $transaksiPenjualan->penjualan_id;

        DetailTransaksiPenjualanModel::create([
            'penjualan_id' => $penjualanId,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/sales')->with('success', 'Data penjualan berhasil disimpan');
    }


    public function show(String $id)
    {
        $penjualan = TransaksiPenjualanModel::find($id);
        $detailTransaksi = DetailTransaksiPenjualanModel::where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Penjualan',
            'list'  => ['Home', 'Transaksi Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('transaksi.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'penjualan' => $penjualan,
            'detailTransaksi' => $detailTransaksi,
            'activeMenu' => $activeMenu
        ]);
    }


    public function edit($id)
    {
        $penjualan = TransaksiPenjualanModel::find($id);
        $detailPenjualan = DetailTransaksiPenjualanModel::where('penjualan_id', $id)->first();
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Transaksi Penjualan',
            'list'  => ['Home', 'Transaksi Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('transaksi.edit', [
            'penjualan' => $penjualan,
            'detailPenjualan' => $detailPenjualan,
            'user' => $user,
            'barang' => $barang,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:255|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date_format:Y-m-d\TH:i',
            'barang_id' => 'required|integer',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer'
        ]);

        $penjualan = TransaksiPenjualanModel::find($id);
        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        $penjualan->user_id = $request->user_id;
        $penjualan->pembeli = $request->pembeli;
        $penjualan->penjualan_kode = $request->penjualan_kode;
        $penjualan->penjualan_tanggal = $request->penjualan_tanggal;
        $penjualan->save();

        $detailPenjualan = DetailTransaksiPenjualanModel::where('penjualan_id', $id)->first();
        $detailPenjualan->barang_id = $request->barang_id;
        $detailPenjualan->harga = $request->harga;
        $detailPenjualan->jumlah = $request->jumlah;
        $detailPenjualan->save();

        return redirect('/sales')->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $penjualan = TransaksiPenjualanModel::find($id);
        if (!$penjualan) {
            return redirect('/sales')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            DetailTransaksiPenjualanModel::where('penjualan_id', $id)->delete();
            $penjualan->delete();

            return redirect('/sales')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/sales')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }
}
