@extends('layouts.app')

@section('title')product @endsection

@section('javascript')
    <script src="{{ asset('js/products/product.js') }}" defer></script>
    <script src="{{ asset('js/feedback/feedback.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('content')
    @include('partials.product.product')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection