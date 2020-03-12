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
        <link rel="stylesheet" href="../styles/product.css">
        <!-- jquery -->
        <script defer src="../../assets/jquery/jquery.min.js"></script>
        <!-- bootstrap -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <script defer src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script defer src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome -->
        <script src="../../assets/fontawesome/js/fontawesome.min.js"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min">
        <!--Required by Bootstrap for buttons -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src="<?= '../js/' . $jsFile ?>" defer></script>
        <?php }
        } ?>
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
                <header id="headerFixed" class="navbar row">
                    <div class="col col-md-3 col-lg-3 col-xl-1 mt-auto mb-auto">
                        <a href="homepage.php">
                            <img class="img-fluid logo" src="../../assets/images/logo/logo.png" />
                        </a>
                    </div>
                    <!-- Search -->
                    <div class="col-xl-4 d-none d-xl-block mt-auto mb-auto">
                        <form class="form-inline">
                            <a class="ml-auto" href="products_list.php">
                                <i id="headerSearchIcon" class="fas fa-search mr-2"></i>
                            </a>
                            <input id="searchBar" class="form-control mr-auto mt-auto mb-auto mr-auto" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                    <!--Buttons-->
                    <div class="col d-none d-xl-block mt-auto mb-auto">
                        <div class="row justify-content-end">
                            <a href="products_list.php" class="btn btn-outline-light mr-5 pl-4 pr-4 navbarButton" role="button">Explore</a>
                            <a href="products_list.php" class="btn btn-orange navbarButton pl-4 pr-4" role="button">Sell Now</a>
                            <button class="btn btn-outline-light mt-auto mb-auto ml-5 pl-4 pr-4" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
                                <i class="fas fa-user headerIcon"></i> Log in
                            </button>
                        </div>
                    </div>
                    <!-- Cart icon -->
                    <div class="col d-none col-xl-2 d-xl-block mt-auto mb-auto">
                        <div class="row">
                            <a href="cart.php" class="mt-auto mb-auto ml-auto mr-3"><i class="fas fa-shopping-cart headerIcon cl-orange"></i><span class="badge badge-secondary">3</span></a>
                        </div>
                    </div>
                    <!--Button Collapse Small -->
                    <div class="col d-xl-none text-right pos-f-t">
                        <button id="navbarHamburguer" type="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#hamburguerContentNavSmall" data-target="#hamburguerContentNavSmall" aria-controls="hamburguerContentNavSmall" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </header>
                <!--Collapse Small -->
                <div id="hamburguerContentNavSmall" class="collapse sticky-top pt-3 pb-3">
                    <div class="col w-100">
                        <div class="row">
                            <a class="mt-auto mb-auto ml-auto" href="products_list.php">
                                <i id="headerSearchIcon" class="fas fa-search mr-2"></i>
                            </a>
                            <input id="searchBar" class="form-control mr-auto mt-auto mb-auto mr-auto" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="row flex-nowrap justify-content-around mt-3">
                            <button class="btn btn-outline-light mt-auto mb-auto navbarButtonSmall ml-2" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
                                <i class="fas fa-user headerIcon"></i> Log in
                            </button>
                            <a href="products_list.php" class="btn btn-outline-light navbarButtonSmall" role="button">Explore</a>
                            <a id="sellNowButtonNavbar" href="products_list.php" class="btn btn-outline-light navbarButtonSmall" role="button">Sell Now</a>
                            <a id="shoppingCartIconHamburguer" href="cart.php" class="mt-auto mb-auto mr-2"><i class="fas fa-shopping-cart headerIcon cl-orange"></i><span class="badge badge-secondary">3</span></a>
                        </div>
                    </div>
                </div>
            <?php
            break;
        default: ?>
        <?php
            break;
    }
        ?>
    <?php
} ?>

<?php function drawBreadcrumb($pageName = '')
{ ?>
    <div id="breadcrumbContainer">
        <?php
        if (strcmp($pageName, '') == 0) { ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i>Home</a></li>
            </ol>
        <?php
        } else { ?>
            <ol class="breadcrumb d-none d-md-inline-flex">
                <li class="breadcrumb-item"><a href="homepage.php"><i class="fas fa-home"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $pageName ?></li>
            </ol>
            <ol class="breadcrumb d-md-none">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i><?= $pageName ?></a></li>
            </ol>
        <?php } ?>
    </div>
<?php } ?>

<!-- navbar -->
<?php function drawNavbar($type, $pageName = '')
{
    switch ($type) {
            //Draw Homepage navbar
        case 0: ?>
            <nav id="navbar" class="nav pt-3">
                <?php drawBreadcrumb($pageName); ?>
                <div class="col-8 d-none d-sm-block ml-auto mr-auto">
                    <div class="row">
                        <div class="dropdown show ml-auto">
                            <button class="btn btn-primary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="productSideBarTitle">Genres<i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                            </button>
                            <div id="collapseGenres" class="dropdown-menu">
                                <a class="dropdown-item" href="product.php">Action</a>
                                <a class="dropdown-item" href="product.php">Racing</a>
                                <a class="dropdown-item" href="product.php">Sports</a>
                                <a class="dropdown-item" href="product.php">Puzzle</a>
                                <a class="dropdown-item" href="product.php">FPS</a>
                                <a class="dropdown-item" href="product.php">Simulation</a>
                            </div>
                        </div>
                        <div class="dropdown show">
                            <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <h5 class="productSideBarTitle">Platforms<i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                            </button>
                            <div id="collapsePlatforms" class="dropdown-menu">
                                <a class="dropdown-item" href="product.php">PC</a>
                                <a class="dropdown-item" href="product.php">PS4</a>
                                <a class="dropdown-item" href="product.php">Xbox</a>
                                <a class="dropdown-item" href="product.php">Nintendo</a>
                            </div>
                        </div>
                        <div class="dropdown show mr-auto">
                            <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <h5 class="productSideBarTitle">Categories <i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                            </button>
                            <div id="collapseCategories" class="dropdown-menu">
                                <a class="dropdown-item" href="product.php">Game</a>
                                <a class="dropdown-item" href="product.php">DCL</a>
                                <a class="dropdown-item" href="product.php">Patch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        <?php break;
        case 1: ?>
            <nav id="navbar" class="nav">
                <?php drawBreadcrumb($pageName); ?>
                <div class="col-12 d-none d-sm-block">
                    <div class="row">
                        <a class="nav-link active deco-none ml-auto" href="user.php">Genres</a>
                        <a class="nav-link deco-none" href="userPurchasesPage.php">Platform</a>
                        <a class="nav-link deco-none mr-auto" href="userOffers.php">Categories</a>
                    </div>
                </div>
            </nav>
        <?php
            break;
        case 2: ?>
            <nav id="navbar" class="nav">
                <?php drawBreadcrumb($pageName); ?>
                <div class="col-12 d-none d-sm-block">
                    <div class="row">
                        <a class="nav-link active deco-none ml-auto" href="user.php">Genres</a>
                        <a class="nav-link deco-none" href="userPurchasesPage.php">Platform</a>
                        <a class="nav-link deco-none mr-auto" href="userOffers.php">Categories</a>
                    </div>
                </div>
            </nav>
        <?php
            break;
        case 3: ?>
            <nav id="navbar" class="nav">
                <?php drawBreadcrumb($pageName); ?>
                <div class="col-12 d-none d-sm-block">
                    <div class="row">
                        <a class="nav-link active deco-none ml-auto" href="user.php">Genres</a>
                        <a class="nav-link deco-none" href="userPurchasesPage.php">Platform</a>
                        <a class="nav-link deco-none mr-auto" href="userOffers.php">Categories</a>
                    </div>
                </div>
            </nav>
        <?php
            break;
        case 4: ?>
            <nav id="navbar" class="nav">
                <?php drawBreadcrumb($pageName); ?>                        
        </nav>
        <?php
            break;
        default: ?>

    <?php break;
    } ?>

<?php } ?>

<!-- authentication modal -->
<?php function drawAthenticationModal()
{ ?>
    <!-- authentication modal -->
    <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <!-- authentication popup header -->
                <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li class="active ml-auto mr-auto my-2"><a href="#signin" class="nav-link cl-orange" data-toggle="tab" role="tab" aria-controls="signin" aria-selected="true">Sign In</a></li>
                        <li class="ml-auto mr-auto my-2"><a href="#signup" class="nav-link cl-orange" data-toggle="tab" role="tab" aria-controls="signup" aria-selected="false">Sign Up</U></a></li>
                    </ul>
                </div>
                <!-- modal body-->
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin">
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
                            <div class="modal-body">
                                <button id="google-signup" name="google-signup" class="btn btn-blue col">
                                    <div class="row">
                                        <svg class="ml-2" viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 20px; width: 20px; display: block;"><g fill="none" fill-rule="evenodd"><path d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z" fill="#EA4335"></path><path d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z" fill="#4285F4"></path><path d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z" fill="#FBBC05"></path><path d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z" fill="#34A853"></path><path d="M0 0h18v18H0V0z"></path></g></svg>
                                        <span class="mx-auto">Sign in with Google</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup">
                            <form class="form-horizontal">
                                <fieldset>
                                    <!-- Sign Up Form -->
                                    <!-- Username -->
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
                            <div class="modal-body">
                                <button id="google-signup" name="google-signup" class="btn btn-blue col">
                                    <div class="row">
                                        <svg class="ml-2" viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 20px; width: 20px; display: block;"><g fill="none" fill-rule="evenodd"><path d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z" fill="#EA4335"></path><path d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z" fill="#4285F4"></path><path d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z" fill="#FBBC05"></path><path d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z" fill="#34A853"></path><path d="M0 0h18v18H0V0z"></path></g></svg>
                                        <span class="mx-auto">Sign up with Google</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-blue col" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- footer + authentication modal-->
<?php function drawFooter()
{ ?>
        <?php drawAthenticationModal(); ?>
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
<?php } 

function drawAdminFooter() { ?>
    
    
    
<?php } ?>