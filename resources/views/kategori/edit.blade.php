@extends('layouts.app')

@section('subtitle', 'welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>
            <form action="../kategori{{ $data->kategori_id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" value="{{ $data->kategori_id }}" name="kodeKategori" id="kodeKategori"
                            class="form-control" placeholder="Masukkan Kode Kategori">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" value="{{ $data->kategori_nama }}"="namaKategori" id="kodeKategori"
                            placeholder="Masukkan Nama Kategori" class="form-control">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
