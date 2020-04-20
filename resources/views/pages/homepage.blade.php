@extends('layouts.app')

@section('title')Homepage @endsection

@include('partials.header.userheader')

@section('navbar')
	@include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])	
@endsection

@section('content')
    @include('partials.homepage.carousel')
	@include('partials.homepage.mostpopulars')
	@include('partials.homepage.mostrecents')
@endsection

@section('footer')
	@include('partials.footer.userfooter')	
@endsection







