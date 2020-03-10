<!-- head -->
<?php function drawHead($jsArray = null)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>KeyShare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- styles -->
        <link rel="stylesheet" href="../styles/common.css">
        <link rel="stylesheet" href="../styles/feedback.css">
        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src="<?= '../js/' . $jsFile ?>" defer></script>
        <?php }
        } ?>
        <!-- jquery -->
        <script defer src="../../assets/jquery/jquery.min.js"></script>
        <!-- bootstrap -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <script defer src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome -->
        <script src="../../assets/fontawesome/js/fontawesome.min.js"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min">
        <!--Required by Bootstrap for buttons -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    </head>

    <body>

    <?php
} ?>

    <!-- header -->
    <?php function drawHeader($type)
    {
        switch ($type) {
            case 0: ?>
                <div id="wrapper">
                    <header id="headerFixed" class="navbar">
                        <div class="col-4 col-md-2 col-xl-1 my-auto">
                            <a href="homepage.php">
                                <img class="img-fluid" src="../../assets/images/logo/logo.png"/>
                            </a>
                        </div>
                        <div class="col-md-5 col-6 col-xl-6 my-auto">
                            <form class="form-inline ml-5">
                                    <i id="headerSearchIcon" class="fas fa-search d-none d-sm-block mr-2"></i>
                                    <input id="searchBar" class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                        <div class="col-md-3 d-none d-md-block">
                            <div class="row">
                                <a href="products_list.php" class="btn btn-outline-light ml-auto mr-2 pl-3 pr-3 d-none d-lg-block" role="button">Explore</a>
                                <a id="headerSellButton" href="offer.php" class="btn btn-primary ml-3 pl-3 pr-3" role="button">Sell Now</a>
                            </div>
                        </div>
                        <div class="col-md-2 col-1 d-none d-md-block">
                            <div class="row">
                                <button class="btn btn-outline-light ml-auto mr-5 pl-3 pr-3 d-none d-lg-block" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
                                    <i class="fas fa-user headerIcon"></i> Log in
                                </button>
                                <a href="cart.php"><i class="fas fa-shopping-cart headerIcon mr-2 mt-2 cl-orange"></i><span class="badge badge-secondary">3</span></a>
                            </div>
                        </div>
                        <!-- mobile -->
                        <div class="col-2 d-md-none d-xs-block">
                            <button id="navbarHamburguer" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="pos-f-t">
                            <div class="collapse" id="navbarToggleExternalContent">
                                <div class="ml-auto p-2">
                                    <i id="myAccountIcon" class="fas fa-user headerIcon"></i>
                                    <a href="cart.php"><i class="fas fa-shopping-cart headerIcon m-auto cl-orange"></i></a>
                                </div>
                            </div>
                        </div>

                        
                    </header>

                <?php
                break;
            default: ?>


            <?php


                break;
        }
            ?>

        <?php
    } ?>

        <!-- navbar -->
        <?php function drawNavbar($type)
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
        <?php } ?>

        <!-- footer -->
        <?php function drawFooter()
        { ?>
            <!-- authentication modal -->
            <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <!-- authentication popup header -->
                        <div class="bs-example bs-example-tabs">
                            <ul id="myTab" class="nav nav-tabs">
                            <li class="active ml-auto mr-auto my-2"><a href="#signin" class="cl-orange" data-toggle="tab">Sign In</a></li>
                            <li class="ml-auto mr-auto my-2"><a href="#signup" class="cl-orange" data-toggle="tab">Sign Up</U></a></li>
                            </ul>
                        </div>
                        <!-- modal body-->
                        <div class="modal-body">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="signin">
                                    <form class="form-horizontal">
                                    <fieldset>
                                        <!-- Sign In Form -->
                                        <!-- Text input-->
                                        <div class="control-group">
                                            <label class="control-label" for="userid">Username:</label>
                                            <div class="controls">
                                                <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="username" class="input-medium" required="">
                                            </div>
                                        </div>
                                        <!-- Password input-->
                                        <div class="control-group mt-4 mb-2">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
                                                <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="control-group">
                                            <label class="control-label" for="signin"></label>
                                            <div class="controls text-center">
                                                <button id="signin" name="signin" class="btn text-light btn-orange">Sign In</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="signup">
                                    <form class="form-horizontal">
                                    <fieldset>
                                        <!-- Sign Up Form -->	
                                        <!-- Text input-->
                                        <div class="control-group">
                                            <label class="control-label" for="userid">Username:</label>
                                            <div class="controls">
                                                <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="username" class="input-medium" required="">
                                            </div>
                                        </div>
                                        
                                        <!-- Password input -->
                                        <div class="control-group mt-4 mb-2">
                                            <label class="control-label" for="passwordinput">Password:</label>
                                            <div class="controls">
                                                <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
                                            </div>
                                        </div>
                                        
                                        <!-- Confirm Password input-->
                                        <div class="control-group">
                                        <label class="control-label" for="reenterpassword">Re-Enter Password:</label>
                                        <div class="controls">
                                            <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
                                        </div>
                                        </div>

                                        <!-- Button -->
                                        <div class="control-group">
                                            <label class="control-label" for="confirmsignup"></label>
                                            <div class="controls text-center">
                                                <button id="confirmsignup" name="confirmsignup" class="btn text-light btn-orange">Sign Up</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer id="footerGeneric">
                <div class="container">
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 class="title"> More </h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="faq.php"> Help </a>
                                </li>
                                <li>
                                    <a href="contact.php"> Contact </a>
                                </li>
                                <li>
                                    <a href="about.php"> About us </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <h5 class="title"> Shortcuts </h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="user.php"> Profile </a>
                                </li>
                                <li>
                                    <a href="homepage.php"> Homepage </a>
                                </li>
                                <li>
                                    <a href="products_list.php"> All products </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col ml-auto my-auto">
                            <p>© Copyright 2020 Key Share. All rights reserved.</p>
                        </div>
                    </div>
            </footer>
            <!--This Div closes the container that mantains the footer at the bottom -->
                </div>
    </body>

    </html>
<?php } ?>

