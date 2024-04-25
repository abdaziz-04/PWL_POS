@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan') }}">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('penjualan') }}">
                @csrf
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Pilih User</option>
                        @foreach($user as $usr)
                            <option value="{{ $usr->user_id }}">{{ $usr->username }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pembeli">Pembeli</label>
                    <input type="text" class="form-control" id="pembeli" name="pembeli" required>
                </div>
                <div class="form-group">
                    <label for="penjualan_kode">Kode Penjualan</label>
                    <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" required>
                </div>
                <div class="form-group">
                    <label for="penjualan_tanggal">Tanggal Penjualan</label>
                    <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" required>
                </div>
                <div class="form-group">
                    <label for="barang_id">Barang</label>
                    <select class="form-control" id="barang_id" name="barang_id" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barang as $brg)
                            <option value="{{ $brg->barang_id }}" data-harga="{{ $brg->harga }}">{{ $brg->barang_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
