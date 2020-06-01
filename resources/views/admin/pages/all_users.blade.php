@extends('layouts.admin')

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_all_users', ['title' => $title, 'users' => $users, 'page' => $page, 'max' => $max, 'query' => $query])
@endsection