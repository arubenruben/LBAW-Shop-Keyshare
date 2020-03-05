<?php
function drawHead($jsArray = null)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>KeyShare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/style.css">

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <!--font Sans-Serif-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <!--font Serif-->
        <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">


        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src=<?= $jsFile ?> defer></script>
        <?php }
        }
        ?>
    </head>

    <body>
        <?php
    }
    function drawHeader($type)
    {
        switch ($type) {
                //Draw Homepage header
            case 0: ?>
                <header class="navbar navbar-light bg-light row">
                    <div class="col-2 mt-auto">
                        <div class="row">
                            <a class="navbar-brand" href="#">
                                <img class="img-fluid logo ml-4" src="../assets/images/logo/logo.png" />
                            </a>
                        </div>
                    </div>
                    <div class="col-6 mt-auto mb-3">
                        <div class="row">
                            <form id="headerSearchContainer" class="form-inline mr-auto mt-auto">
                                <i id="headerSearchIcon" class="fas fa-search mr-3 pl-2 pr-2 pt-1 pb-2"></i>
                                <input id="headerSearchInput" class="form-control mr-sm-2 pr-5" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                    </div>
                    <div class="col-3 mt-auto mb-3">
                        <div class="row">
                            <button id="headerExploreButton" type="button" class="btn btn-primary pl-5 pr-5">Explore</button>
                            <button id="headerSellButton" type="button" class="btn btn-primary ml-5 pl-5 pr-5">Sell Now</button>
                            <!-- 
                            <button id="headerLoginButton" type="button" class="btn btn-primary ml-5 pl-5 pr-5">Login</button>
                            -->
                        </div>
                    </div>
                    <div class="col-1 mt-auto mb-4">
                        <div class="row">
                            <div class="ml-auto mr-5">
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
    }

    function drawFooter()
    { ?>
        <!-- Footer -->
        <footer>
            <div class="container">
                <br>
                <hr class="style1"> <br>
                <div class="row ">
                    <div class="col-md-6">
                        <h5 class="title"> More </h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#"> Contact </a>
                            </li>
                            <li>
                                <a href="#"> FAQs </a>
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