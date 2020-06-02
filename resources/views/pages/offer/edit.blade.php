@extends('layouts.app')

@section('title', 'Add an offer')

@section('header')
    @include('partials.header.user_header')
@endsection
@push('head')
    <meta name="offer-id" content="{{ $offer->id }}">
    <script src="{{ asset('js/offer/edit.js') }}" defer></script>
@endpush

@section('navbar')
    @include('partials.navbar.no_navbar', ['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.offer.edit', ['offer' => $offer])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
