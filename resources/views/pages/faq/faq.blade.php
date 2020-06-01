@extends('layouts.app')
@section('title', 'FAQ')

@include('partials.header.user_header')

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.faq.faq')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection