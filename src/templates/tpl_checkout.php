<?php
function drawCheckoutFirstPage()
{ ?>
    <div id="content" class="container">
        <!--Only draw ProgressBar when is XL. Not responsive-->
        <div class="col">
            <div class="row mt-5">
                <h3>Your Info</h3>
            </div>
            <div class="row d-none d-xl-block pt-4">
                <?php drawProgressBar1(); ?>
            </div>
            <div class="row mt-3 mb-5 ml-2">
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
            <div class="col text-right">
                <h5> Subtotal (4 items) </h5>
                <hr>
                <span>
                    <h5> Total price: <h3>120 €</h3>
                    </h5>
                </span>
                <div id="checkoutButtonsContainer" class="row mt-5">
                    <a href="checkout2.php" class="btn btn-primary btn-lg ml-auto mr-4 checkoutNextButton"><span class="d-none d-md-inline">Confirm Your Order</span> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php }

function drawCheckoutSecondPage()
{ ?>
    <div id="content" class="container">
        <!--Only draw ProgressBar when is XL. Not responsive-->
        <div class="col">
            <div class="row">
                <h3>Confirm Your Order</h3>
            </div>
            <div class="row d-none d-xl-block pt-4">
                <?php drawProgressBar2(); ?>
            </div>
            <div id="checkoutProductPreviewContainer" class="row">
                <div class="col">
                    <h4>Your Products</h4>
                    <div class="col">
                        <?php
                        drawCartProductReviewEntry();
                        drawCartProductReviewEntry();
                        drawCartProductReviewEntry();
                        drawCartProductReviewEntry();
                        ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Your Personal Information</h4>
                    <p>Name:Ruben Almeida</p>
                    <p>Email:email@example.com</p>
                    <p>Address:Heinrich-Heine-Straße,Berlin,Deutschland</p>
                    <p>Zipcode:4000-000</p>
                </div>
                <div class="col-sm-6 text-right">
                    <h4>Pricing</h4>
                    <h5> Subtotal (4 items) </h5>
                    <span>
                        <h5> Total price: <h3>120 €</h3>
                        </h5>
                    </span>
                </div>
            </div>
            <hr>
            <div id="checkoutButtonsContainer" class="row">
                <a href="checkout1.php" class="btn btn-primary btn-lg mr-auto ml-4 checkoutBackButton"> <i class="fas fa-arrow-left"></i> <span class="d-none d-md-inline">Your Info</span></a>
                <a href="checkout3.php" class="btn btn-primary btn-lg ml-auto mr-4 checkoutNextButton"><span class="d-none d-md-inline">Proceed to Checkout</span> <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    <?php }
function drawCheckoutThirdPage($sucess = true)
{ ?>
        <div id="content" class="container">
            <div class="col my-auto">
                <!--Only draw ProgressBar when is XL. Not responsive-->
                <div class="row d-none d-xl-block pt-4">
                    <?php drawProgressBar3(); ?>
                </div>
                <div id="checkoutPage4" class="row">
                    <div class="col text-center mt-auto mb-auto">
                        <?php
                        if ($sucess === true) { ?>
                            <i id="checkoutStatusEmojiTrue" class="fas fa-check-circle mb-2"></i>
                            <h1 id="checkoutStatusTitleTrue">Sucess</h1>
                        <?php
                        } else { ?>
                            <i id="checkoutStatusEmojiFalse" class="fas fa-times-circle mb-2"></i>
                            <h3 id="checkoutStatusTitle">Fail</h3>
                        <?php
                        }  ?>
                        <a href="user.php" id="checkoutStatusButton" class="btn btn-primary btn-lg mt-3">Back to My Account</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
function drawProgressBar1()
{ ?>
        <div class="progress-bar-wrapper">
            <div class="status-bar">
                <!--
                <div class="current-status" style="width: 75%; transition: width 4500ms linear 0s;"></div>
            -->
            </div>
            <ul class="progress-bar-adapted">
                <li class="section visited current status-bar-circle">Your Info</li>
                <li class="section status-bar-circle">Confirm Your Order</li>
                <li class="section status-bar-circle">Transaction Complete</li>
            </ul>
        </div>
    <?php }


function drawProgressBar2()
{ ?>
        <div class="progress-bar-wrapper">
            <div class="status-bar">
                <!--
                <div class="current-status" style="width: 75%; transition: width 4500ms linear 0s;"></div>
            -->
            </div>
            <ul class="progress-bar-adapted">
                <li class="section visited current status-bar-circle">Your Info</li>
                <li class="section visited current status-bar-circle">Confirm Your Order</li>
                <li class="section status-bar-circle">Transaction Complete</li>
            </ul>
        </div>
    <?php }

function drawProgressBar3()
{ ?>
        <div class="progress-bar-wrapper">
            <div class="status-bar">
                <!--
                <div class="current-status" style="width: 75%; transition: width 4500ms linear 0s;"></div>
            -->
            </div>
            <ul class="progress-bar-adapted">
                <li class="section visited current status-bar-circle">Your Info</li>
                <li class="section visited current status-bar-circle">Confirm Your Order</li>
                <li class="section visited current status-bar-circle">Transaction Complete</li>
            </ul>
        </div>
    <?php }

function drawCartProductReviewEntry()
{ ?>
        <hr>
        <div class="row">
            <div class="col-3">
                <img class="img-fluid cartProductImage" src="../../assets/images/games/GTAV/1.png" />
            </div>
            <div class="col-5 mt-auto mb-auto">
                <div class="row">
                    <h5>Grand Theft Auto V</h5>
                </div>
                <div class="row">
                    <p>BestSeller:Rating: <span class="font-weight-bold cl-success">99%</span>| <i class="fas fa-shopping-cart"></i>1897</p>
                </div>
            </div>
            <div class="col-2 mt-auto mb-auto">
                <h6>Price:</h6>
                <h6>30€</h6>
            </div>
            <div class="col-2 mt-auto mb-auto ml-auto">
                <button type="button" class="btn btn-dark deleteButtonCheckout"><i class="fa fa-trash "></i><span> Delete </span></button>
            </div>
        </div>
        <hr>
    <?php } ?>