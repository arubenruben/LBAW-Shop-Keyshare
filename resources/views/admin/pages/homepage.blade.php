@extends('layouts.admin')

@section('header')
@include('admin.partials.header.header_admin')
@endsection
@section('navbar')
<nav>
    <h3>Dashboard</h3>
</nav>
@endsection
@section('content')

@include('admin.partials.sidebar.sidebar')
@include('admin.partials.tables.table_homepage')
@endsection