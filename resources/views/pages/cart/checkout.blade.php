@extends('layouts.app')

@section('title')Checkout @endsection
@section('javascript')
    <script src="{{ asset('js/cart/checkout.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.nonavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <div id="content" class="container">
        <section id="checkout-tab-1" >
        @include('partials.cart.checkoutTab1', ['userCartEntries' => $userCartEntries, 'totalPrice' => $totalPrice])
        </section>

        <section id="checkout-tab-2" style="display: none;">
        @include('partials.cart.checkoutTab2', ['userCartEntries' => $userCartEntries, 'totalPrice' => $totalPrice])
        </section>
    </div>
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
