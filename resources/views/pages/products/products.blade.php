@extends('layouts.app')

@section('title')Products @endsection

@include('partials.header.userheader')

@section('javascript')
    <script src="{{ asset('js/products/products.js') }}" defer></script>
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['pages'=>$pages, 'links'=>$links])
@endsection

@section('content')
    @include('partials.products.list')
    @include('partials.products.pagination')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection