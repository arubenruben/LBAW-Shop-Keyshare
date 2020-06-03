@extends('layouts.app')
@section('title', 'Products')

@section('header')
    @include('partials.header.user_header')
@endsection

@section('navbar')
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=> $breadcrumbs])
@endsection

@section('content')
    @include('partials.report.report', ['report' => $report])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection