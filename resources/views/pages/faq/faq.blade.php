@extends('layouts.app')
@section('title', 'FAQ')

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.faq.faq')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection