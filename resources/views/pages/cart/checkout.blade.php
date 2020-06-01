@extends('layouts.app')

@section('title')Checkout @endsection

@push("head")
    <!-- Load the required checkout.js script -->
    <!-- Load PayPal's checkout.js Library. -->
    <!-- Load the required checkout.js script -->
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.62.0/js/data-collector.min.js"></script>

    <script src="{{ asset('js/cart/checkoutC.js') }}" defer></script>
    <script src="{{ asset('js/cart/cart.js') }}" defer></script>
@endpush

@include('partials.header.user_header')

@section('navbar')
    @include('partials.navbar.no_navbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')

    <span class="d-none" id="client-token">{{$clientToken}}</span>
    <div id="content" class="container">
        <section id="checkout-tab-1" >
            @include('partials.cart.checkout1.blade.php', ['userCartEntries' => $userCartEntries, 'totalPrice' => $totalPrice])
        </section>

        <section id="checkout-tab-2">
            @include('partials.cart.checkout2', ['userCartEntries' => $userCartEntries, 'totalPrice' => $totalPrice])
        </section>

        <section id="checkout-tab-3">
            @include('partials.cart.checkout3')
        </section>
    </div>

@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
