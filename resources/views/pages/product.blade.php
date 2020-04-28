@extends('layouts.app')

@section('title')product @endsection

@section('javascript')
    <script src="{{ asset('js/product/product.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.product.product', ['product' => $product, 'offers' => $offers, 'platformName' => $platformName])
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection
