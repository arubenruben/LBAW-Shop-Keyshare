@extends('layouts.app')

@section('title')Products @endsection

@section('javascript')
    <script src="{{ asset('js/products/products.js') }}" defer></script>
@endsection

@section('header')
    @include('partials.header.userheader')
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