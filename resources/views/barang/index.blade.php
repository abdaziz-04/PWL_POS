@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-denger">{{ session('error')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option>
                                @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="Form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Kategori Barang</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataBarang = $('#table_barang').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('barang/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.kategori_id = $('#kategori_id').val();
                    },
                    "error": function(xhr, error, thrown) {
                        console.log('Error Occurred:', error);
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "kategori.kategori_nama",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "barang_kode",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "barang_nama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika kolom bisa dicari
                    },
                    {
                        data: "harga_jual",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika kolom bisa dicari
                    },{
                        data: "aksi",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }
                ]
            });
            $('#kategori_id').on('change', function() {
                dataBarang.ajax.reload();
            });

        });
    </script>
@endpush
