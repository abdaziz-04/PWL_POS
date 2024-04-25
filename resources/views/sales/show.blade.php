@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(!$penjualan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
        </div>
        @else
        <table class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>ID Penjualan</th>
                <td>{{ $penjualan->penjualan_id }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $penjualan->user->username }}</td>
            </tr>
            <tr>
                <th>Pembeli</th>
                <td>{{ $penjualan->pembeli }}</td>
            </tr>
            <tr>
                <th>Kode Penjualan</th>
                <td>{{ $penjualan->penjualan_kode }}</td>
            </tr>
            <tr>
                <th>Tanggal Penjualan</th>
                <td>{{ $penjualan->penjualan_tanggal }}</td>
            </tr>
            <tr>
                <th colspan="2">Detail Transaksi Penjualan</th>
            </tr>
            <tr>
                <th>ID Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            @foreach($detailTransaksi as $detail)
            <tr>
                <td>{{ $detail->barang_id }}</td>
                <td>{{ $detail->harga }}</td>
                <td>{{ $detail->jumlah }}</td>
            </tr>
            @endforeach
        </table>
        @endif
        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
