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
    <link href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap" rel="stylesheet">
    <!--font Serif-->
    <link href="https://fonts.googleapis.com/css?family=Arvo&amp;display=swap" rel="stylesheet">


</head>

<body>
    <header class="navbar navbar-light bg-light row">
        <div class="col-2 mt-auto">
            <div class="row">
                <a class="navbar-brand" href="#">
                    <img class="img-fluid logo ml-4" src="../assets/images/logo/logo.png">
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











    <ul class="nav nav-pills  justify-content-center p-2  bg-dark text-white">
        <li class="nav-item">
            <a class="nav-link  active deco-none" href="userPage.php">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  deco-none" href="userPurchasesPage.php">Purchases</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  deco-none" href="userOffers.php">Offers(7)</a>
        </li>
    </ul>


    <div class="container">

        <div class="row mt-5">

            <div class="col-sm-4 usercontent-left  border rounded-top">
                <div class="row ">
                    <div class="col-sm-12">
                        <h4 class="text-center">Userdsfdsfsdfdsfsdfrwrrname</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img class="rounded-circle img-fluid mt-3" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&amp;_nc_sid=85a577&amp;_nc_ohc=FxTK4QbD1iIAX_KPa6o&amp;_nc_ht=scontent.flis7-1.fna&amp;oh=f273076c731a0cde48a147e1bc1c0308&amp;oe=5E835F94"
                            alt="Generic placeholder image" width="250" height="250">
                        <form class="mt-3">
                            <button type="button" class="btn btn-outline-primary"><i class="fas fa-camera-retro"></i> Upload</button>
                            <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 text-center">
                        <span class="mt-5"> 100 % positive feedback | 4000 <i class="fas fa-shopping-cart"></i></span>
                    </div>
                </div>

                <div class="row mt-2 mb-5">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-primary btn-sm mt-2">See all feedback</button>
                    </div>
                </div>
            </div>


            <div class="col-sm-7 ml-3 text-center border rounded-top-lg">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 class="text-center">Account Details</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <form class="needs-validation" novalidate="">

                            <div class="mb-3 mt-3">
                                <label for="email">Email <span class="text-muted"></span></label>
                                <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583499424002-5">
                                <div class="invalid-feedback">
                                    Please enter a valid email.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3"></textarea>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
                                </div>
                            </div>



                            <div class="mb-3 mt">
                                <label for="Password">Password (optional)</label>
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583499424002-2">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583499424002-3">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583499424002-4">
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-key"></i> Change password</button>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="mt-5 mb-5 ">
                    <button type="button mt-5 mb-5 " class="btn btn-md btn-danger"><i class="fas fa-user-times"></i> Delete account</button>
                </div>
            </div>
        </div>
    </div>


    <!-- /.container -->
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