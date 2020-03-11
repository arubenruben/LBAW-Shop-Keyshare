<?php
include_once("../templates/tpl_feedback.php");

function drawProduct() { ?>
    <div id="content" class="container pt-4">
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
                <div class="d-none d-lg-inline">
                    <p>
                        Grand Theft Auto V is a action-adventure game developed by Rockstar North and published
                        by Rockstar Games. Set within the fictional state of San Andreas<span id="dots" class="collapse show demo1">...</span><span id="extraText"class="collapse demo1">, based on Southern
                        California, the single-player story follows three criminals and their efforts to commit
                        heists while under pressure from a government agency and powerful crime figures. The open
                        world design lets players freely roam San Andreas' open countryside and the fictional city
                        of Los Santos, based on Los Angeles.                 
                    </span>
                    </p>
    
                    <a href="#" role="button" data-toggle="collapse" data-target=".demo1" aria-expanded="true" aria-controls="dots extraTest more less">
                        <span id="more" class="collapse show demo1">Read more</span><span id="less"class="collapse demo1">Show less</span>
                    </a>
                </div>    
            </div>
            <div class="col-lg-6 col-0"></div>
            <div class="col-lg-6 col-md-12 mt-2 pl-0 d-lg-none">
                <p>
                    Grand Theft Auto V is a action-adventure game developed by Rockstar North and published
                    by Rockstar Games. Set within the fictional state of San Andreas<span id="dotsOut" class="collapse show demo2">...</span><span id="extraTextOut"class="collapse demo2">, based on Southern
                    California, the single-player story follows three criminals and their efforts to commit
                    heists while under pressure from a government agency and powerful crime figures. The open
                    world design lets players freely roam San Andreas' open countryside and the fictional city
                    of Los Santos, based on Los Angeles.                 
                </span>
                
                </p>

                <a href="#" role="button" data-toggle="collapse" data-target=".demo2" aria-expanded="true" aria-controls="dotsOut extraTestOut moreOut lessOut">
                    <span id="moreOut" class="collapse show demo2">Read more</span><span id="lessOut"class="collapse demo2">Show less</span>
                </a>
            </div>
        </div>
        <div id="offersListing" class="section bg-white p-2">
            <div class="row my-3">
                <div class="col-4">
                    <h3>Offers: 2</h3>
                </div>
                <!-- sort by -->
                <div class="col-8 text-right">
                    <span>Sort by:</span>
                    <div class="d-inline custom-control custom-radio radio-inline mr-2">
                        <input type="radio" class="custom-control-input" id="customRadio1" name="example1" value="customEx">
                        <label class="custom-control-label" for="customRadio1">Best price</label>
                    </div>
                    <div class="d-inline custom-control custom-radio radio-inline">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="example1" value="customEx">
                        <label class="custom-control-label" for="customRadio2">Best rating</label>
                    </div>
                </div>
            </div>
            <div class="row my-3 py-1 mx-2 offer">
                <div class="col-md-7 col-sm-12 px-1 seller" data-toggle="modal" data-target=".bd-modal-lg1">
                    <h4>bestseller439</h4>
                    <span>
                        <span class="font-weight-bold cl-success"><i class="fas fa-thumbs-up"></i> 99%</span>
                         | <i class="fas fa-shopping-cart"></i> 1897 | Stock: 10 keys</span>
                </div>
                <div class="col-md-2 my-auto text-right">
                    <span class="font-weight-bold">39.99 US$</span>
                </div>
                <div class="col-md-3 my-auto text-right">
                    <button type="button" class="btn btn-orange p-1 mb-2" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
                <?php drawFeedbackPopup("1"); ?>
            </div>
            <hr class="my-1">
            <div class="row my-3 py-1 mx-2 offer">
                <div class="col-md-7 col-sm-12 px-1 seller" data-toggle="modal" data-target=".bd-modal-lg2">
                    <h4>worstseller712</h4>
                    <span>
                        <span class="font-weight-bold cl-fail"><i class="fas fa-thumbs-down"></i> 43%</span>
                         | <i class="fas fa-shopping-cart"></i> 24 | Stock: 1 keys
                    </span>
                </div>
                <div class="col-md-2 my-auto text-right">
                    <span class="font-weight-bold">49.99 US$</span>
                </div>
                <div class="col-md-3 my-auto text-right">
                    <button type="button" class="btn btn-orange p-1 mb-2" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
                <?php drawFeedbackPopup("2"); ?>
            </div>
        </div>
    </div>
<?php } ?>