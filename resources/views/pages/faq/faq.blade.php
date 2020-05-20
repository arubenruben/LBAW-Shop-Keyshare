@extends('layouts.app')

@section('title') FAQ @endsection

@include('partials.header.userheader')

@section('navbar')
@include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
@include('partials.faq.faq')
@endsection

@section('footer')
@include('partials.footer.footer')
@endsection