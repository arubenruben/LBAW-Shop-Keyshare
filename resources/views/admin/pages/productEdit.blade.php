@extends('layouts.admin')

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
    <form action="" method="POST">
        @csrf
        @method('put')
        <div class="row">
            @include('admin.partials.product.picture',['data'=>$data])
            @include('admin.partials.product.name',['data'=>$data])
        </div>
        @include('admin.partials.product.description',['data'=>$data])
        <hr>
        @include('admin.partials.product.genres',['data'=>$data])
        @include('admin.partials.product.platform',['data'=>$data])
        @include('admin.partials.product.categories',['data'=>$data])
    </form>
    <div class="row flex-nowrap justify-content-between mt-5">
        <!--
        <a href="product.php" class="btn btn-blue ml-4" role="button">Preview Product</a>
        -->
        <input class="btn bg-orange mr-4 ml-auto text-white" role="button" type="submit" value="Edit Product">
    </div>
</div>
@endsection