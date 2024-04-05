@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Sales and Transactions</h2>
        <div class="row">
            <!-- Sales Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" class="btn btn-primary">View Sales Details</a>
                    </div>
                </div>
            </div>
            <!-- Transactions Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Transactions</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Transaction 1 - $100</li>
                            <li class="list-group-item">Transaction 2 - $150</li>
                            <li class="list-group-item">Transaction 3 - $80</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-2">View All Transactions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
