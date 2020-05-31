@extends('layouts.app')

@section('title', 'Add an offer')

@include('partials.header.user_header')

@push('head')
        <script src="{{ asset('js/offer/add.js') }}" defer></script>
@endpush

@section('navbar')
    @include('partials.navbar.no_navbar', ['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
        @include('partials.offer.add', ['products' => $products])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
