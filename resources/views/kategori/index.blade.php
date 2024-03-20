@extends('layouts.app');

{{-- Customize Layout Sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
            <a href="/kategori/create" class="btn btn-primary btn-md float-left m-2" style="width: 200px;">Tambah Kategori</a>
        </div>

    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
