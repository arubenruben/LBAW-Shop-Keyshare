@extends('layouts.app')

@section('title', 'Add an offer')

@include('partials.header.userheader')

@section('navbar')
@include('partials.navbar.nonavbar', ['breadcrumbs'=> $breadcrumbs])
@endsection

@section('javascript')
{{--    <script src="{{ asset('js/user/offers.js') }}" defer></script>--}}
@endsection


@section('content')
@include('partials.offer.add')
@endsection


@section('footer')
@include('partials.footer.userfooter')
@endsection