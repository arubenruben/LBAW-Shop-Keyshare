@extends('layouts.admin')
@section('title', $title)

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_homepage', ['title' => $title, 'contents' => $contents])
@endsection