@extends('layouts.app')

@section('title') About us @endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.breadcrumbs',['pages'=>$pages, 'links'=>$links])
@endsection

@section('content')
    @include('partials.static.contact')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection