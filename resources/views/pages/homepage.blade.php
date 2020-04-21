@extends('layouts.app')

@section('title')Homepage @endsection

@include('partials.header.userheader')

@section('navbar')
	@include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])	
@endsection

@section('content')
    @include('partials.homepage.carousel')
	@include('partials.homepage.mostpopulars',['data'=>$data['mostPopulars']])
	@include('partials.homepage.mostrecents',['data'=>$data['mostRecents']])
@endsection

@section('footer')
	@include('partials.footer.userfooter')	
@endsection







