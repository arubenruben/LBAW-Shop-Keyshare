@extends('layouts.admin')

@section('header')
@include('admin.partials.header.header_admin')
@endsection

@section('sidebar')
@include('admin.partials.sidebar.sidebar')
@endsection

@section('content')
<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
    <form action="{{ url('/admin/products') }}" method="get" class="col-5 d-inline-flex">
        <input class="form-control" name="query" type="text" placeholder="Search" aria-label="Search"
            value="{{ $query }}">
        <button type="submit" class="form-control ml-1 btn btn-outline-dark w-25"><i class="fas fa-search"></i></button>
        <a href="{{ url('/admin/products') }}" type="reset" class="form-control ml-1 btn btn-outline-dark w-25"><i
                class="fas fa-times"></i></a>
    </form>
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
                @foreach ($products as $product)
                @include('admin.partials.tables.product_table_entry',['data'=>$product])
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row mt-5">
        <div class="ml-auto">
            {{$links}}
        </div>
    </div>
</article>
@endsection