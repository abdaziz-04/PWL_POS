@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Manage Kategori
            </div>
            <div class="col-md-3 mt-3">
                <a href="/kategori/create" class="btn btn-primary"> Add Category</a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
