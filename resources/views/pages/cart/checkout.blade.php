@extends('layouts.app')

@section('title')Homepage @endsection

@section('javascript')
    <script src="{{ asset('js/cart/checkout.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.nonavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection