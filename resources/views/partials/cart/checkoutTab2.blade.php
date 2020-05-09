
<!--Only draw ProgressBar when is XL. Not responsive-->
<div class="col">
    <div class="row px-3">
        <h3>Confirm Your Order</h3>
    </div>

    <div class="row d-none d-xl-block pt-4">
        @include('partials.cart.progressBar')
    </div>
    <div id="checkoutProductPreviewContainer mb-0" class="row">
        <div id="content" class="container mt-4 pb-0">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h4>My Cart <span class="badge badge-secondary">7</span></h4>
                </div>
            </div>
            <div class="row">
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
                            @foreach ($userCartEntries as $item)
                                @php $allOffers->add($item->offer);@endphp
                                @include('partials.cart.cartentry',['data'=>$item])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <h4>Your Personal Information</h4>
            <p>Name: <span id="client-name"></span></p>
            <p>Email: <span id="client-email"></span></p>
            <p>Address: <span id="client-address"></span></p>
            <p>Zipcode: <span id="client-zip-code"></span></p>
        </div>
        <div class="col-sm-6 text-right">
            <h4>Pricing</h4>
            <h5> Subtotal ({{count($userCartEntries)}} items) </h5>
            <span>
                    <h5> Total price: <h3>{{$totalPrice}} €</h3> </h5>
            </span>
        </div>
    </div>
    <hr>
    <div id="checkoutButtonsContainer" class="row">
        <a  id="your-info"  class="btn btn-blue btn-lg mr-auto ml-4"> <i class="fas fa-arrow-left"></i> <span class="d-none d-md-inline">Your Info</span></a>
        <a id="paypalButton" href="checkout.php?page=3" role="button" class="btn btn-lg px-4  btn-outline-primary"> <img src="/pictures/paypal/paypalLogo.png" height="25"> <strong class="mr-2 d-none d-sm-inline-block" style="color: black; ">Pay with Paypal</strong> </a>
    </div>
</div>
