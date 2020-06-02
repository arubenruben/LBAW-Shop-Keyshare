@extends('layouts.app')

@section('title', 'About us')

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.static.about')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection