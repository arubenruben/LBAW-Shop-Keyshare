@extends('layouts.admin')

@section('header')
@include('admin.partials.header.header_admin')
@endsection
@section('navbar')
<nav>
    <h3>Dashboard</h3>
</nav>
@endsection
@section('content')

@include('admin.partials.sidebar.sidebar')

<div class="row mt-4 justify-content-between justify-content-md-end">
    <div class="col-12 col-lg-9">
        <div class="row justify-content-between flex-nowrap">
            <h3 class="ml-3">Products</h3>
            <input class="form-control col-5 sm" type="search" placeholder="Search" aria-label="Search">
            <a href={{ url('/admin/product') }} class="btn btn-orange text-white mr-3" role="button"> <i
                    class="mr-1 fas fa-plus"></i>
                <span class="d-none d-md-inline-block">Add Product</span></a>
        </div>
    </div>
</div>
<article class="col mt-4">
    <div class="table-responsive table-striped tableFixHead">
        <table class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light">
                        <div class="p-2 px-3 text-uppercase">Image</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Name</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Categories</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Genres</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Platform</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $product)
                @include('admin.partials.tables.user_table_entry',['data'=>$product])
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-5">
        <div class="ml-auto">
            {{$data->links()}}
        </div>
    </div>
</article>
@endsection