<?php
function drawHead($jsArray = null)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Key Share</title>
        <meta charset="UTF-8" name="viewport" content="initial-scale=1.0">
        <!-- bootstrap -->
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome -->
		<script src="../../assets/fontawesome/js/fontawesome.min.js"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
        <!-- styles -->
        <link rel="stylesheet" href="../styles/common.css">
        <link rel="stylesheet" href="../styles/homepage.css">

        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src=<?= $jsFile ?> defer></script>
        <?php }
        } ?>
    </head>

    <body>
        <?php
    }
    function drawHeader($type)
    {
        switch ($type) {
            case 0: ?>
                <header class="navbar navbar-light bg-light">
                    <div class="col-md-2 col-3 col-xl-1 mt-auto mb-auto">
                        <a href="#">
                            <img class="img-fluid logo" src="../../assets/images/logo/logo.png" />
                        </a>
                    </div>
                    <div class="col-md-5 col-6 col-xl-6 mt-auto mb-auto">
                        <form class="form-inline">
                            <div class="form-group mb-auto">
                                <i id="headerSearchIcon" class="fas fa-search d-none d-sm-block mr-2"></i>
                                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 d-none d-md-block">
                        <div class="row">
                            <button id="headerExploreButton" type="button" class="btn btn-primary ml-auto mr-2 pl-3 pr-3 d-none d-lg-block">Explore</button>
                            <button id="headerSellButton" type="button" class="btn btn-primary ml-2 pl-3 pr-3">Sell Now</button>
                        </div>
                    </div>
                    <div class="col-md-2 col-1 d-none d-md-block">
                        <div class="row">
                            <i id="myAccountIcon" class="fas fa-user headerIcon ml-auto mr-5"></i>
                            <i id="shoppingCartIcon" class="fas fa-shopping-cart headerIcon"></i>
                        </div>
                    </div>
                    <div class="col-2 d-md-none d-xs-block">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="pos-f-t">
                        <div class="collapse" id="navbarToggleExternalContent">
                            <div class="ml-auto p-2">
                                <i id="myAccountIcon" class="fas fa-user headerIcon"></i>
                                <i id="shoppingCartIcon" class="fas fa-shopping-cart headerIcon"></i>
                            </div>
                        </div>
                    </div>
                </header>
        <?php
                break;
            default:

                break;
        }
        ?>

        <?php }

    function drawNavbar($type)
    {
        switch ($type) {
                //Draw Homepage navbar
            case 0: ?>



        <?php
                break;


            default:

                break;
        }

        ?>
    <?php
    }
    function drawFooter()
    { ?>
            <footer>
                <div id="footer" class="container">
                    <hr id="footer-line" class="mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="title"> More </h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#"> Help </a>
                                </li>
                                <li>
                                    <a href="#"> Contact </a>
                                </li>
                                <li>
                                    <a href="#"> About us </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 d-flex justify-content-end align-items-end">
                            <p>© Copyright 2020 Key Share. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </body>
    </html>
<?php
    } ?>
