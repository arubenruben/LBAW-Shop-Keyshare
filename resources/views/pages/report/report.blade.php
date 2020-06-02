@extends('layouts.app')
@section('title', 'Products')

@include('partials.header.user_header')

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.report.report', ['report' => $report, ])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection