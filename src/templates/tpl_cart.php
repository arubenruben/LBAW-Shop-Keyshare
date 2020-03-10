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
                    <div id="cartContainerSecondRow" class="row pt-5 flex-nowrap bg-light">
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
    </div
<?php }

function drawCartEntry()
{ ?>
    <div class="row mt-5 flex-nowrap">
        <div class="col col-md-8">
            <div class="row flex-nowrap">
                <div class="col col-md-2 ml-3 mt-auto mb-auto d-none d-md-block">
                    <img class="img-fluid rounded shadow-sm float-left cartImgPreview" src="../../assets/images/games/GTAV/1.png">
                </div>
                <div class="col col-md-6 mt-auto mb-auto flex-nowrap">
                    <h5>GTAV</h5>
                    <h6 class="text-muted font-italic d-inline-block">Bestseller439</h6> 
                    <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span>
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
    <hr>



<?php } ?>