<!--Only draw ProgressBar when is XL. Not responsive-->
<div class="row">
    <div class="col-10 mx-auto my-auto">
        <div class="row mt-5">
            <div class="col-12">
                <h3>Your Info</h3>
            </div>
        </div>

        <div class="row">
            <div class="col d-none d-xl-block pt-4">

                @include('partials.cart.progressBar');
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-8  border">

                <form id="formCheckout">
                    <div class="form-group">
                        <label for="checkoutInputName">Name</label>
                        <input type="text" class="form-control checkoutInput" id="checkoutInputName" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <label for="checkoutInputEmail">Email</label>
                        <input type="email" class="form-control checkoutInput" id="checkoutInputEmail" aria-describedby="emailHelp" placeholder="Enter Your Email">
                    </div>
                    <div class="form-group">
                        <label for="checkoutInputAddress">Address</label>
                        <input type="text" class="form-control checkoutInput" id="checkoutInputAddress" placeholder="Enter Your Address">
                    </div>
                    <div class="form-group">
                        <label for="checkoutInputZipcode">Zipcode</label>
                        <input type="text" class="form-control checkoutInput" id="checkoutInputZipcode" placeholder="Enter Your Zipcode">
                    </div>
                </form>
            </div>
            <div class="col-sm-3  ml-1 text-right border d-md-inline d-block ">
                <div style="margin-top: 50%; margin-bottom: 50%;" class="flec-nowrap">
                    <div>
                        <h5 class="d-inline"> Subtotal </h5>
                        <h5 class="d-inline"> ({{count($userCartEntries)}} items) </h5>
                    </div>
                    <hr>
                    <span>
                            <h5> Total price: <h3>{{$totalPrice}}€</h3>
                            </h5>
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-11 ml-1 mt-5 text-right p-0">
                <a  id="confirm-order" class="btn btn-blue btn-lg mr-auto ml-4"> <span class="d-none d-md-inline">Confirm Order</span> <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
