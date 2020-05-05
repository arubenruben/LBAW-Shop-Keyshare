@extends('layouts.app')

@section('title', 'Add an offer')

@include('partials.header.userheader')

@section('javascript')
        <script src="{{ asset('js/offer/add.js') }}" defer></script>
@endsection

@section('navbar')
    @include('partials.navbar.nonavbar', ['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
        @include('partials.offer.add', ['products' => $products])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
