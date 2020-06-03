@extends('layouts.admin')
@section('title', $title)

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_appeals', ['title' => $title, 'appeals' => $appeals, 'links' => $links])
@endsection