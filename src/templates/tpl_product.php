<?php function drawProduct() { ?>
    <div id="content" class="container pt-4">
        <div class="row ml-auto mr-auto">
            <div class="col-5 p-0">
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

        <div class="row" id="offersListing">
            <div class="col-sm-12">
                <div class="table-responsive table-striped mt-3">
                    <table id="userOffersTable" class="table p-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Seller Details</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php drawProductOffer(); ?>
                            <?php drawProductOffer(); ?>
                            <?php drawProductOffer(); ?>
                            <?php drawProductOffer(); ?>
                            <?php drawProductOffer(); ?>
                            <?php drawProductOffer(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawProductOffer() { ?>
    <tr class="offer">
        <td scope="row" class="border-0 align-middle">
            <div class="p-2" data-toggle="modal" data-target=".bd-modal-lg1">
                <h4 class="seller">bestseller439</h4>
                <span>
                    <span class="font-weight-bold cl-success"><i class="fas fa-thumbs-up"></i> 99%</span>
                        | <i class="fas fa-shopping-cart"></i> 1897 | Stock: 10 keys
                </span>
            </div>
        </td>
        <td class="text-center align-middle"><strong>$39.00</strong></td>
        <td class="text-center align-middle">
            <div class="btn-group-justified">
            <button class="btn btn-orange animationButton" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart"><i class="fas fa-shopping-cart"></i> <span> Add to Cart </span></button>
            </div>
        </td>
    </tr>
<?php } ?>