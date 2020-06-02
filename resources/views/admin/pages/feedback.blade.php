@extends('layouts.admin')
@section('title', 'Feedback')

@section('header')
    @include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
    @include('admin.partials.tables.table_feedback', ['title' => $title, 'feedback' => $feedback, 'links' => $links])
@endsection