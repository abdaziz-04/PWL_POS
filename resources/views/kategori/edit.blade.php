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
        <a href="{{ url('kategori') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('/kategori/'.$kategori->kategori_id) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang membutuhkan method PUT -->

            <div class="form-group row">
                <label class="col-1 control-label col-form-label">ID Kategori</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ old('kategori_id', $kategori->kategori_id) }}" required>
                    @error('kategori_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">kode Kategori</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="{{ old('kategori_kode', $kategori->kategori_kode) }}" required>
                    @error('kategori_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">nama kategori</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
                    @error('kategori_nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Gambar</label>
                <div class="col-10">
                    <div class="col-11">
                        @if($kategori->image)
                            <img src="{{ asset('storage/gambar/kategori/' . $kategori->image) }}" alt="Gambar Barang" style="object-fit: cover; width: 200px; height: 200px;">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="No Image Available" style="object-fit: cover; width: 100px; height: 100px;">
                        @endif
                        <input type="file" class="form-control-file mt-2" id="image" name="image">
                        @if ($errors->has('image'))
                            <small class="form-text text-danger">{{ $errors->first('image') }}</small>
                        @else
                            <small class="form-text text-muted">Abaikan jika tidak ingin mengubah gambar.</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('kategori') }}">Kembali</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
