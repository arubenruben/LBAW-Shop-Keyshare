<?php function drawCart()
{ ?>

    <div id="content" class="container">
        <div class="col-12 bg-white pb-5">
            <div id="cartContainerFirstRow" class="row mt-4 flex-nowrap">
                <h3 id="total" class="mr-auto mt-auto mb-auto">Total: $400</h3>
                <a class="btn btn-primary ml-auto mt-auto mb-auto font-weight-bold rounded-pill proceedToCheckoutButton pl-5 pr-5" href="checkout1.php" role="button">Proceed to Checkout<i class="fas fa-shopping-cart"></i></a>
            </div>
            <div class="row">
                <div class="col">
                    <div id="cartContainerSecondRow" class="row pt-5 flex-nowrap">
                        <div class="col col-md-8">
                            <h5>Product</h5>
                        </div>
                        <div class="col col-md-2">
                            <h5>Price</h5>
                        </div>
                        <div class="col col-md-1 mr-auto">
                            <h5>Remove</h5>
                        </div>
                    </div>
                    <?php
                    drawCartEntry();
                    drawCartEntry();
                    drawCartEntry();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php /*
    <div id="content" class="container">
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
            <!-- product 1 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <a href="product.php"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm"></a>
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="product.php" class="text-dark d-inline-block align-middle text-decoration-none">FIFA 19</a></h5>
                        <span class="text-muted font-weight-normal font-italic d-block" data-toggle="modal" data-target=".bd-modal-lg2">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-fail"></i></a></div>
                </div>
            </div>
            <?php drawFeedbackPopup("1"); ?>

            <!-- product 2 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <a href=""></a><img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm"></a>
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="product.php" class="text-dark d-inline-block align-middle text-decoration-none">FIFA 19</a></h5>
                        <span class="text-muted font-weight-normal font-italic d-block" data-toggle="modal" data-target=".bd-modal-lg2">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-fail"></i></a></div>
                </div>
            </div>
            <?php drawFeedbackPopup("2"); ?>

            <!-- product 3 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <a href="product.php"></a><img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm"></a>
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="product.php" class="text-dark d-inline-block align-middle text-decoration-none">FIFA 19</a></h5>
                        <span class="text-muted font-weight-normal font-italic d-block" data-toggle="modal" data-target=".bd-modal-lg2">nightwalker123</span>
                    </div>
                </div>

                <div class="col-md-2 ">
                    <div class="border-0 align-middle"><strong>$79.00</strong></div>
                </div>
                <div class="col-md-2 pl-4">
                    <div class="border-0 align-middle"><a href="#" class="text-dark ml-4"><i class="fa fa-trash cl-fail"></i></a></div>
                </div>
            </div>
            <?php drawFeedbackPopup("3"); ?>
        </div>
  </div>
  */ ?>

<?php }
function drawCartEntry()
{ ?>
    <div class="row mt-5 flex-nowrap">
        <div class="col col-md-8">
            <div class="row flex-nowrap">
                <div class="col col-md-2 ml-3 mt-auto mb-auto d-none d-md-block">
                    <img class="img-fluid rounded shadow-sm float-left cartImgPreview" src="../../assets/images/games/GTAV/1.png">
                </div>
                <div class="col col-md-6 mt-auto mb-auto">
                    <h5>GTAV</h5>
                    <h6 class="text-muted font-italic">Bestseller439</h6>
                </div>
            </div>
        </div>
        <div class="col col-md-2 mt-auto mb-auto">
            <h5>$70</h5>
        </div>
        <div class="col col-md-1 mt-auto mb-auto text-center">
            <a href="#" class="text-dark"><i class="fa fa-trash cl-fail"></i></a>
        </div>
    </div>



<?php } ?>