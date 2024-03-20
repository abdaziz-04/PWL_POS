@extends('layouts.app')

{{-- Customize layout section --}}

@section('subtitle', 'welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

@section('content_body')
    <p>Welcome to this beautiful admin panel</p>
@stop

{{-- Push Extra CSS --}}
@push('css')
@endpush

{{-- Push Extra Script --}}

@push('js')
    <script>
        console.log("Hi, I'm using Laravel-AdminLTE package");
    </script>
@endpush
