@extends('layouts.app')

@section('title')product @endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.product.product', ['product' => $product, 'offers' => $offers])
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection
