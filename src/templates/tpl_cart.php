<?php function drawCart() { ?>
    <div id="cart" class="container" style="width: 80%">
        <!-- Shopping cart header -->
        <div class="row mt-5 mb-2">
            <div class="col-md-8">
                <h3>Total: $400.00</h3>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-orange font-weight-bold rounded-pill py-2 btn-block">Procceed to checkout</a>
            </div>
        </div>

        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
            <!-- table header -->
            <div class="row">
                <div class="col-md-8 bg-light">
                    <div class="p-2 text-uppercase">Product</div>
                </div>
                <div class="col-md-2 bg-light">
                    <div class="p-2 text-uppercase">Price</div>
                </div>
                <div class="col-md-2 bg-light">
                    <div class="p-2 text-uppercase">Remove</div>
                </div>
            </div>
            
            <!-- products in cart -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">FIFA 19</a></h5><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-insucess"></i></a></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-8">
                    <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">FIFA 19</a></h5><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-insucess"></i></a></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-8">
                    <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">FIFA 19</a></h5><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2 ">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-insucess"></i></a></div>
                </div>
            </div>
        </div>
  </div>

<?php } ?>