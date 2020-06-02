<article>
    <header class="row mt-4">
        <div class="col-sm-6 text-left">
            <h4>My Cart <span id="counter_products_cart" class="badge badge-secondary">{{count($data)}}</span></h4>
        </div>
        <div class="col-6 text-right">
            <a id="checkout-top-button" class="btn btn-lg btn-orange deleteButtonCheckout align-right {{count($data) == 0 ? 'd-none' : ''}}" href="{{route('checkoutInit') }}" role="button">
                <i class="fas fa-money-check-alt d-inline"></i> <span class="d-inline"> Checkout</span>
            </a>
        </div>
    </header>
    <section class="row">
        <div class="col-sm-12">
                <div id = "cart-no-entries" class="{{count($data) == 0 ? '' : 'd-none'}}">
                    @include('partials.cart.cart_no_entries')
                </div>
                <div id="tableOffers" class="table-responsive table-striped  mt-3 {{count($data) == 0 ? 'd-none' : ''}}">
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
                            @php
                                $allOffers->add($item->offer);
                            @endphp
                            @include('partials.cart.cart_entry',['data'=>$item])
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </section>
    <div id="total-price-div" class="{{count($data) == 0 ? 'd-none' : ''}}">
        <div class="row mt-4">
            <div class="col text-right">
                <h4>Total Price: <span id="total_price">{{$allOffers->sum('discountPriceColumn')}}</span>$</h4>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-right">
                <a class="btn btn-lg btn-orange deleteButtonCheckout align-right" href="{{route('checkoutInit') }}"
                   role="button"><i class="fas fa-money-check-alt d-inline"></i> <span class="d-inline">Checkout</span>
                </a>
            </div>
        </div>
    </div>

</article>