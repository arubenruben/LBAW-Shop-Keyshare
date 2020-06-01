@extends('layouts.admin')

@push('head')
    <script src="{{ asset('js/all_users.js') }}" defer></script>
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