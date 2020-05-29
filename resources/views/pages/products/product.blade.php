@extends('layouts.app')

@section('title')product @endsection

@push('head')
    <script src="{{ asset('js/products/product.js') }}" defer></script>
    <script src="{{ asset('js/feedback/feedback.js') }}" defer></script>
@endpush

@include('partials.header.user_header')

@section('content')
    @include('partials.product.product')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection