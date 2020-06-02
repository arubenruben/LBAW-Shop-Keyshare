@extends('layouts.admin')


@section('header')
@include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
@include('admin.partials.sidebar.sidebar')
@endsection
@section('navbar')
<nav>
    <h3>Platform</h3>
</nav>
@endsection
@section('content')

<div class="row mt-4 justify-content-between justify-content-md-end">
    <div class="col-12 col-lg-9">
        <div class="row justify-content-between flex-nowrap">
            <h3 class="ml-3">Platform</h3>
            <button href="#" class="btn btn-orange text-white mr-3" data-toggle="modal" data-target="#modalPlatformAdd">
                <i class="mr-1 fas fa-plus"></i>
                <span class="d-none d-md-inline-block">Add Platform</span>
            </button>
        </div>
    </div>
</div>

@include('admin.partials.modal.platform.platformAdd',['data'=>$data])
@include('admin.partials.tables.platform_table',['data'=>$data])

@endsection