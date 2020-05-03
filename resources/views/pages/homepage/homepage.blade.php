@extends('layouts.app')

@section('title')Homepage @endsection

@section('header')
    @include('partials.header.userheader')
@endsection

@section('navbar')
	@include('partials.navbar.commercenavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @include('partials.homepage.carousel')
	@include('partials.homepage.mostpopulars',['data'=>$data['mostPopulars']])
	@include('partials.homepage.mostrecents',['data'=>$data['mostRecents']])
@endsection

@section('footer')
	@include('partials.footer.footer')
@endsection