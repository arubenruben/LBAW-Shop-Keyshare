@extends('layouts.app')

@section('title')Homepage @endsection
@section('javascript')
<script src="{{ asset('js/cart/cart.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
@include('partials.navbar.nonavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
<article>
    <header class="row">
        <div class="col-sm-6 text-left">
            <h4>My Cart <span id="counter_products_cart" class="badge badge-secondary">{{count($data)}}</span></h4>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-lg btn-orange deleteButtonCheckout align-right" href="{{url('/cart/checkout') }}"
                role="button"><i class="fas fa-money-check-alt d-inline"></i> <span class="d-inline">
                    Checkout</span></a>
        </div>
    </header>
    <section class="row">
        <div class="col-sm-12">
            <div class="table-responsive table-striped  mt-3">
                <table id="userOffersTable" class="table p-0">
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">Product Details</div>
                            </th>
                            <th scope="col" class="border-0 bg-light text-center">
                                <div class="py-2 text-uppercase">Price</div>
                            </th>
                            <th scope="col" class="border-0 bg-light text-center">
                                <div class="py-2 text-uppercase">Remove</div>
                            </th>
                        </tr>
                    </thead>
                    @php $allOffers = collect(); @endphp
                    <tbody>
                        @foreach ($data as $item)
                        @php $allOffers->add($item->offer);@endphp
                        @include('partials.cart.cartentry',['data'=>$item])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @php($totalPrice = 0);
    <div class="row mt-4">
        <div class="col text-right">
            <h4>Total Price: <span id="total_price">{{$allOffers->sum('discountPriceColumn')}}</span>$</h4>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-right">
            <a class="btn btn-lg btn-orange deleteButtonCheckout align-right" href="{{url('/cart/checkout') }}"
                role="button"><i class="fas fa-money-check-alt d-inline"></i> <span class="d-inline">
                    Checkout</span></a>
        </div>
    </div>


</article>
@endsection

@section('footer')
@include('partials.footer.footer')
@endsection