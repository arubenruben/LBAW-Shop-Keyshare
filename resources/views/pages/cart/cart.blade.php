@extends('layouts.app')

@section('title')Homepage @endsection

@push('head')
    <script src="{{ asset('js/cart/cart.js') }}" defer></script>
@endpush

@include('partials.header.user_header')

@section('navbar')
    @include('partials.navbar.nonavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @include('partials.cart.cart')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection