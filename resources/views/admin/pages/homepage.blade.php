@extends('layouts.admin')

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('navbar')
    @include('admin.partials.navbar.navbar_admin', ['page' => 'Dashboard'])
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_homepage', ['title' => $title, 'contents' => $contents])
@endsection