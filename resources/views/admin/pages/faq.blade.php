@extends('layouts.admin')
@section('title', $title)

@push('head')
    <script src="{{ asset('js/admin/faq.js') }}" defer></script>
@endpush

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_faq', ['title' => $title, 'faq' => $faq, 'links' => $links])
@endsection