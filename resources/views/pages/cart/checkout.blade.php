@extends('layouts.app')

@section('title')Checkout @endsection
@section('javascript')

    <!-- Load the required checkout.js script -->
    <!-- Load PayPal's checkout.js Library. -->
    <!-- Load the required checkout.js script -->
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>

    <script src="{{ asset('js/cart/checkoutC.js') }}" defer></script>
    <script src="{{ asset('js/cart/cart.js') }}" defer></script>

@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.nonavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <span id="client-token">{{$clientToken}}</span>
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
