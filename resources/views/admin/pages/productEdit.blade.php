@extends('layouts.admin')
@section('title', 'Product edit')

@push('head')
<script src="{{ asset('js/admin/product.js') }}" defer></script>
@endpush

@section('header')
@include('admin.partials.header.header_admin')
@endsection
@section('navbar')
<nav>
    <h3>Edit Product</h3>
</nav>
@endsection
@section('content')

<div class="col mt-3">
    <form action={{ url('/admin/product/'.$data->id) }} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @include('admin.partials.product.picture',['data'=>$data])
            @include('admin.partials.product.name',['data'=>$data])
        </div>
        @include('admin.partials.product.description',['data'=>$data])
        <hr>
        @include('admin.partials.product.genres',['data'=>$data,'genres'=>$genres])
        @include('admin.partials.product.platform',['data'=>$data,'platforms'=>$platforms])
        @include('admin.partials.product.categories',['data'=>$data,'categories'=>$categories])
        <div class="row flex-nowrap justify-content-between mt-5 mb-5">
            <!--<a href="product.php" class="btn btn-blue ml-4" role="button">Preview Product</a>-->
            <button class="btn btn-orange mr-4 ml-auto text-white" role="button" type="submit">Edit Product</button>
        </div>
    </form>
</div>
@endsection