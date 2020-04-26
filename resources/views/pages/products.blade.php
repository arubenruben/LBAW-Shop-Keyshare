@extends('layouts.app')

@section('title')Products @endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.commercenavbar', ['pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.products.list')
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection







