<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $breadcumb->title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcumb->list as $key => $value)
                        @if ($key == count($breadcumb->list) - 1)
                            <li class="breadcumb-item active">{{ $value }}</li>
                        @else
                            <li class="breadcumb-item">{{ $value }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
