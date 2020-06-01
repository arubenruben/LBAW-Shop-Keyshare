@extends('layouts.app')

@section('title') About us @endsection

@include('partials.header.user_header')

@section('navbar')
@include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
@include('partials.static.contact')
@endsection

@section('footer')
@include('partials.footer.footer')
@endsection