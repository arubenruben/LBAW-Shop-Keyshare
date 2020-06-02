@extends('layouts.admin')
@section('title', 'Reports')

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_reports', ['title' => $title, 'reports' => $reports, 'links' => $links])
@endsection