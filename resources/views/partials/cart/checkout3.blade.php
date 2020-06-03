<div id="content" class="container">
    <div class="row pt-4">
        <div class="col-12  ">
            <h3 class="d-flex justify-content-center justify-content-lg-start"> Transaction Status </h3>
        </div>
    </div>

    <!--Only draw ProgressBar when is XL. Not responsive-->
    <div class="row d-none d-xl-block pt-4">
        <div class="progress-bar-wrapper">
            <div class="status-bar">
                <!--
                            <div class="current-status" style="width: 75%; transition: width 4500ms linear 0s;"></div>
                        -->
            </div>
            <ul class="progress-bar-adapted">
                <li class="section visited current status-bar-circle">Your Info</li>
                <li class="section visited status-bar-circle">Confirm Your Order</li>
                <li class="section vistied status-bar-circle">Transaction Status</li>
            </ul>
        </div>
    </div>
    <div id="checkoutPage4" class="row mt-5 mb-5 pb-5">
        <div class="col text-center">

            <div id="checkout-success">
                <i id="checkoutStatusEmojiTrue" class="fas fa-check-circle mb-2" style="font-size: 4rem;"></i>
                <h1 id="checkoutStatusTitleTrue">Success</h1>
                <a href="/user/purchases" id="checkoutStatusButtonSuccess" class="btn btn-primary btn-lg mt-3">Back to
                    my purchases</a>
            </div>

            <div id="checkout-fail">
                <i id="checkoutStatusEmojiFalse" class="fas fa-times-circle mb-2" style="font-size: 4rem;"></i>
                <h3 id="checkoutStatusTitle">Fail</h3>
                <a href="/" id="checkoutStatusButtonFailure" class="btn btn-primary btn-lg mt-3">Back to Homepage</a>

            </div>


        </div>
    </div>
</div>