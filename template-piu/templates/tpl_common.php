<?php function drawHead($jsArray = null) { ?>
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
                //Draw Homepage header
            case 0: ?>
                <header class="navbar navbar-light bg-light justify-content-between">
                    <div class="col">
                        <div class="row">
                            <a class="navbar-brand" href="#">
                                <img class="img-fluid logo" src="../assets/images/logo/logo.png" />
                            </a>
                            <form id="navbarSearchContainer" class="form-inline mr-auto mt-auto">
                                <i id="headerSearchIcon" class="fas fa-search mr-2"></i>
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <div class="row">
                            <button type="button" class="btn btn-primary mr-5">Explore</button>
                            <button type="button" class="btn btn-primary ml-5">Sell Now</button>
                            <div class="ml-auto mr-4">
                                <i id="myAccountIcon" class="fas fa-user"></i>
                                <i id="shoppingCartIcon" class="fas fa-shopping-cart"></i>
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
    } ?>

<?php function drawFooter() { ?>
            <footer>
                <div id="footer" class="container">
                    <hr id="footer-line">
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
<?php } ?>
