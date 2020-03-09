<?php
include_once("../templates/tpl_feedback.php");

function drawProduct() { ?>
    <div id="content" class="container mt-4">
        <div class="row ml-auto mr-auto">
            <div class="col-6 p-0">
                <img class="img-fluid productPageImgPreview" src="../../assets/images/games/GTAV/1.png"/>
            </div>
            <div class="col-6">
                <h3>Grand Theft Auto V Rockstar Key</h3>
                <span>
                    <h6 class="title-price">Starting at:</h6>
                    <h4>US$ 39.99</h4>
                </span>
                <p>Grand Theft Auto V is a action-adventure game developed by Rockstar North and published
                    by Rockstar Games. Set within the fictional state of San Andreas, based on Southern
                    California, the single-player story follows three criminals and their efforts to commit
                    heists while under pressure from a government agency and powerful crime figures. The open
                    world design lets players freely roam San Andreas' open countryside and the fictional city
                    of Los Santos, based on Los Angeles. </p>
            </div>
        </div>
        <div class="section mt-5">
            <div class="row">
                <div class="col-8">
                    <h3>Offers: 2</h3>
                </div>
                <div class="row">
                    <div class="col">Sort by:</div>
                    <div class="custom-control custom-radio radio-inline mr-2">
                        <input type="radio" class="custom-control-input" id="customRadio1" name="example1" value="customEx">
                        <label class="custom-control-label" for="customRadio1">Best price</label>
                    </div>
                    <div class="custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="example1" value="customEx">
                        <label class="custom-control-label" for="customRadio2">Best rating</label>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-7" data-toggle="modal" data-target=".bd-modal-lg1">
                    <h4>bestseller439</h4>
                    <span>
                        Rating: <span class="font-weight-bold cl-success">99%</span>
                         | <i class="fas fa-shopping-cart"></i> 1897 | Stock: 10 keys</span>
                </div>
                <div class="col-md-2 mt-2">
                    <span class="font-weight-bold">39.99 US$</span>
                </div>
                <div class="col-md-3">
                    <button class="btn bg-interactive"><i
                            class="fas fa-shopping-cart"></i> Add to Cart</button>
                </div>
                <?php drawFeedbackPopup("1"); ?>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-7" data-toggle="modal" data-target=".bd-modal-lg2">
                    <h4>worstseller712</h4>
                    <span>
                        Rating: <span class="font-weight-bold cl-fail">43%</span>
                         | <i class="fas fa-shopping-cart"></i> 24 | Stock: 1 keys
                    </span>
                </div>
                <div class="col-md-2 mt-2">
                    <span class="font-weight-bold">49.99 US$</span>
                </div>
                <div class="col-md-3">
                    <button class="btn hv-interactive bg-interactive"><i
                            class="fas fa-shopping-cart"></i> Add to Cart</button>
                </div>
                <?php drawFeedbackPopup("2"); ?>
            </div>
        </div>
    </div>
<?php } ?>