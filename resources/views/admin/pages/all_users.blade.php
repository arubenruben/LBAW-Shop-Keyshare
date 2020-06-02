@extends('layouts.admin')
@section('title', 'Users')

@push('head')
    <script src="{{ asset('js/admin/all_users.js') }}" defer></script>
@endpush

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_all_users', ['title' => $title, 'users' => $users, 'query' => $query, 'links' => $links])
@endsection