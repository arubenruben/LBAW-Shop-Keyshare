@extends('layouts.app')

@section('title', 'My Cart')

@push('head')
<script src="{{ asset('js/cart/cart.min.js') }}" defer></script>
@endpush

@section('header')
@include('partials.header.user_header')
@endsection

@section('navbar')
@include('partials.navbar.no_navbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
@include('partials.cart.cart')
@endsection

@section('footer')
@include('partials.footer.footer')
@endsection