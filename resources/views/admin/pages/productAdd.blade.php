@extends('layouts.admin')

@push('head')
<script src="{{ asset('js/admin/product.js') }}" defer></script>
@endpush

@section('header')
@include('admin.partials.header.header_admin')
@endsection
@section('navbar')
<nav>
    <h3>Add Product</h3>
</nav>
@endsection
@section('content')
<div class="col mt-3">
    <form action={{ route('product_add') }} method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('admin.partials.product.info')
        @include('admin.partials.product.description')
        <hr>
        @include('admin.partials.product.genres')
        @include('admin.partials.product.platform')
        @include('admin.partials.product.categories')
        <div class="row flex-nowrap justify-content-between mt-5">
            <!--a href="product.php" class="btn btn-blue ml-4" role="button">Preview Product</a>-->
            <input class="btn bg-orange mr-4 ml-auto text-white" role="button" type="submit" value="Publish Product">
        </div>
    </form>
</div>
@endsection