<!-- head -->
<?php function drawHead($jsArray = null) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>KeyShare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jquery -->
        <script defer src="../../assets/jquery/jquery.min.js"></script>
        <!-- fontawesome -->
        <script defer src="../../assets/bootstrap/js/"></script>
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <script defer src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome -->
        <script src="../../assets/fontawesome/js/fontawesome.min.js"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
        <!-- styles -->
        <link rel="stylesheet" href="../styles/common.css">
        <!-- fonts --> 
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src=<?= $jsFile ?> defer></script>
        <?php }
        }
        ?>
    </head>

    <body>
        
<?php } ?>

<!-- header -->
<?php  function drawHeader($type){ 
        switch ($type) {
            case 0: ?>
                <header class="navbar navbar-light bg-light fixed-top">
                    <div class="col-md-2 col-3 col-xl-1 mt-auto mb-auto">
                        <a href="homepage.php">
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
                            <i id="myAccountIcon" class="fas fa-user headerIcon ml-auto mr-5" data-toggle="modal" data-target=".bs-modal-sm"></i>
                            <a href="cart.php"><i class="fas fa-shopping-cart headerIcon m-auto cl-orange"></i></a>
                        </div>
                    </div>
                    <!-- mobile -->
                    <div class="col-2 d-md-none d-xs-block">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
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

                   <?php drawAuthenticationPopup(); ?>
                </header>
        <?php
                break;
            default: ?>
                

            <?php
            

                break;
        }
        ?>

<?php } ?>

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
<?php function drawFooter() { ?>
        <!-- Footer -->
        <footer id="footerGeneric" class="row mt-auto">
            <div class="row pt-3">
                <div class="col-2">
                </div>
                <div class="col-7">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#"> Contact </a>
                        </li>
                        <li>
                            <a href="faq.php"> FAQs </a>
                        </li>
                        <li>
                            <a href="#"> About us </a>
                        </li>
                    </ul>
                </div>
                <div class="col-2">
                </div>
            </footer>
        </body>
    </html>
<?php } ?>

<!-- authentication popup -->
<?php function drawAuthenticationPopup() { ?>
    <!-- Modal -->
    <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- authentication popup header -->
                <div class="row my-2">
                    <div class="col active mx-2 text-center">
                        <a href="#login" data-toggle="tab">Login</a>
                    </div>
                    <div class="col mx-2 text-center text-capitalize">
                        <a href="#signup" data-toggle="tab">Sign up</a>
                    </div>
                </div>

                <!-- modal body-->
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">
                        <!-- LOGIN -->
                        <div class="tab-pane fade active in" id="login">
                            <!-- Login In Form -->
                            <form class="form-horizontal">
                            <fieldset>
                                <!-- Username-->
                                <div class="control-group">
                                    <label class="control-label" for="userid">Username:</label>
                                    <div class="controls">
                                        <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="username" class="input-medium" required="">
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="control-group">
                                    <label class="control-label" for="passwordinput">Password:</label>
                                    <div class="controls">
                                        <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
                                    </div>
                                </div>

                                <!-- Multiple Checkboxes (inline) -->
                                <div class="control-group">
                                    <label class="control-label" for="rememberme"></label>
                                    <div class="controls">
                                        <label class="checkbox inline" for="rememberme-0">
                                        <input type="checkbox" name="rememberme" id="rememberme-0" value="Remember me">
                                        Remember me
                                        </label>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="control-group">
                                    <label class="control-label" for="signin"></label>
                                    <div class="controls">
                                        <button id="signin" name="signin" class="btn btn-success">Sign In</button>
                                    </div>
                                </div>
                            </fieldset>
                            </form>
                        </div>
                        <!-- SIGNUP -->
                        <div class="tab-pane fade" id="signup">
                            <!-- Sign Up Form -->                       
                            <form class="form-horizontal">
                            <fieldset>
                                <!-- Email: -->
                                <div class="control-group">
                                    <label class="control-label" for="Email">Email:</label>
                                    <div class="controls">
                                        <input id="Email" name="Email" class="form-control" type="text" placeholder="your@email.com" class="input-large" required="">
                                    </div>
                                </div>
                                
                                <!-- Username: -->
                                <div class="control-group">
                                    <label class="control-label" for="userid">Username:</label>
                                    <div class="controls">
                                        <input id="userid" name="userid" class="form-control" type="text" placeholder="username" class="input-large" required="">
                                    </div>
                                </div>
                                
                                <!-- Password input: -->
                                <div class="control-group">
                                    <label class="control-label" for="password">Password:</label>
                                    <div class="controls">
                                        <input id="password" name="password" class="form-control" type="password" placeholder="********" class="input-large" required="">
                                        <em>1-8 Characters</em>
                                    </div>
                                </div>
                                
                                <!-- Text input: -->
                                <div class="control-group">
                                    <label class="control-label" for="reenterpassword">Confirm Password:</label>
                                    <div class="controls">
                                        <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
                                    </div>
                                </div>         
                                
                                <!-- Signup Button -->
                                <div class="control-group">
                                    <label class="control-label" for="confirmsignup"></label>
                                    <div class="controls">
                                        <button id="confirmsignup" name="confirmsignup" class="btn btn-success">Sign Up</button>
                                    </div>
                                </div>
                            </fieldset>
                            </form>
                        </div>
                </div>  
            
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </center>
            </div>
            
        </div>
    </div>
<?php } ?> 