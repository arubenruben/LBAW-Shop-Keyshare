@extends('layouts.app')
@section('title', 'Products')

@push('head')
    <script src="{{ asset('js/products/products.js') }}" defer></script>
@endpush

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @include('partials.products.list', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
        'min_price' => $min_price, 'max_price' => $max_price, 'products' => $products])
    @include('partials.products.pagination')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection