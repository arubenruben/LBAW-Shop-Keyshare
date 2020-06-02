@extends('layouts.admin')
@section('title', 'Transactions')

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_transactions', ['title' => $title, 'transactions' => $transactions, 'links' => $links])
@endsection