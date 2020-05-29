@extends('layouts.app')

@section('title', 'Homepage')

@push('head')
    <script src="{{ asset('js/homepage/homepage.js') }}" defer></script>
@endpush

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.commerce_navbar',['breadcrumbs' => $breadcrumbs])
@endsection

@section('content')
    @include('partials.homepage.carousel',['carousel' => $data['carousel']])
    @include('partials.homepage.most_populars',['data' => $data['mostPopulars']])
    @include('partials.homepage.most_recents',['data' => $data['mostRecents']])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection