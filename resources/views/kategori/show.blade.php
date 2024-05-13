@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($kategori)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
        @else
        <table class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>ID Kategori</th>
                <td>{{ $kategori->kategori_id }}</td>
            </tr>
            <tr>
                <th>Gambar</th>
                <td>
                    @if($kategori->image)
                        <img src="{{ asset('/storage/gambar/kategori/' . $kategori->image) }}" style="object-fit: cover; width: 300px; height: 300px; alt="Gambar Barang">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" style="object-fit: cover; width: 150px; height: 150px;" />
                    @endif
                </td>
            </tr>
            <tr>
                <th>Kategori Kode</th>
                <td>{{ $kategori->kategori_kode }}</td>
            </tr>
            <tr>
                <th>Kategori Nama</th>
                <td>{{ $kategori->kategori_nama }}</td>
            </tr>

        </table>
        @endempty
        <a href="{{ url('kategori') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
