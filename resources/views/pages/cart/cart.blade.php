@extends('layouts.app')

@section('title')Homepage @endsection

@include('partials.header.userheader')

@section('navbar')
	@include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])	
@endsection

@section('content')
    <h1>Hello World</h1>    
@endsection

@section('footer')
	@include('partials.footer.userfooter')	
@endsection







