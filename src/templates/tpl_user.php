<!-- user navbar -->
<?php function drawUserNavBar($page, $typeUser)
{
    switch ($page) {
        case "account": ?>
            <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                <li class="nav-item">
                    <?php if($typeUser == "banned"){?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUser.php"><button class="btn btnMediaSmall btn-blue-full active">Account</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user.php"><button class="btn btnMediaSmall btn-blue-full active">Account</button></a>
                    <?php } ?>
                
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUserPurchases.php"><button class="btn btnMediaSmall btn-blue">Purchases</button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_purchases.php"><button class="btn btnMediaSmall btn-blue">Purchases</button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php } ?>


            
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php } ?>
                </li>
            </ul>
        <?php
            break;
        case "offers": ?>
           <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                <li class="nav-item">
                    <?php if($typeUser == "banned"){?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUser.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php } ?>
                
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUserPurchases.php"><button class="btn btnMediaSmall  btn-blue">Purchases</button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_purchases.php"><button class="btn btnMediaSmall  btn-blue">Purchases</button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_offers.php"><button class="btn btnMediaSmall btn-blue-full">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_offers.php"><button class="btn btnMediaSmall btn-blue-full">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php } ?>
                </li>
            </ul>
        <?php
            break;
        case "purchases": ?>
             <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                <li class="nav-item">
                    <?php if($typeUser == "banned"){?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUser.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php } ?>
                
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUserPurchases.php"><button class="btn btnMediaSmall  btn-blue-full">Purchases</button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_purchases.php"><button class="btn btnMediaSmall  btn-blue-full">Purchases</button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_reports.php"><button class="btn btnMediaSmall btn-blue">Reports</button></a>
                    <?php } ?>
                </li>
            </ul>
        <?php
            break;
        case "reports": ?>
           <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                <li class="nav-item">
                    <?php if($typeUser == "banned"){?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUser.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user.php"><button class="btn btnMediaSmall btn-blue active">Account</button></a>
                    <?php } ?>
                
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="bannedUserPurchases.php"><button class="btn btnMediaSmall  btn-blue">Purchases</button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_purchases.php"><button class="btn btnMediaSmall  btn-blue">Purchases</button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php }
                    else{?>
                        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_offers.php"><button class="btn btnMediaSmall btn-blue">Offers<span class="badge badge-secondary d-none d-sm-inline-block ml-2">7</span></button></a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                <?php if($typeUser == "banned"){?>
                    <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="banneduser_reports.php"><button class="btn btnMediaSmall btn-blue-full">Reports</button></a>
                    <?php }
                    else{?>
                         <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="user_reports.php"><button class="btn btnMediaSmall btn-blue-full">Reports</button></a>
                    <?php } ?>
                </li>
            </ul>
    <?php
            break;
        default:
            break;
    } ?>
<?php } ?>

<!-- user tabs -->
<?php function drawUserDetails($type)
{
    drawUserNavBar("account", $type); ?>
    <div id="content" class="container">
        <?php 
            drawConfirmDeleteAccountPopup();
            drawFeedbackPopup("1"); //drawSaveChangesPopup(); 
        ?>
        <?php if($type == "banned"){?>    
            <div class="row mt-5 mb-2">
                <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                    You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                </div>  
            </div>
        <?php }?>
        <div class="row mt-2">
            <div class="col-sm-4 usercontent-left  border rounded-top">
                <div class="row ">
                    <div class="col-sm-12 mt-3">
                        <h4 class="text-center">Username</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img class="rounded-circle img-fluid mt-3" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="250" height="250">
                        <form class="mt-3">
                            <button type="button" class="btn btn-sm btn-blue"><i class="fas fa-camera-retro"></i> Upload</button>
                            <button type="button" class="btn  btn-sm btn-red"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 text-center">
                        <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
                    </div>
                </div>
                <div class="row mt-2 mb-5">
                    <div class="col-sm-12 text-center">
                        <button type="button" data-toggle="modal" data-target=".bd-modal-lg1" class="btn btn-blue btn-sm">See all feedback</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 ml-3 text-center border rounded-top-lg">
                <div class="row">
                    <div class="col-sm-12 mt-3 text-center">
                        <h4 class="text-center">Account Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                     
                        <form class="needs-validation" novalidate="">
                            <div class="mb-3 mt-3 text-left">
                                <label for="email">Email <span class="text-muted"></span></label>
                                <?php if($type == "banned"){?>
                                <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
                                <?php }
                                else{?>
                                    <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                               <?php } ?>
                            

                                <div class="invalid-feedback">
                                    Please enter a valid email.
                                </div>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="description">Description</label>
                                <?php if($type == "banned"){?>
                                    <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3" disabled></textarea>
                                <?php }
                                else{?>
                                    <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3"></textarea>
                               <?php } ?>
                                    
                                <div class="text-right mt-3">
                                <?php if($type == "banned"){?>
                                    <button type="button" class="btn btn-sm btn-blue" disabled><i class="fas fa-save"></i> Save changes</button>
                                <?php }
                                else{?>
                                    <button type="button" class="btn btn-sm btn-blue"><i class="fas fa-save"></i> Save changes</button>
                               <?php } ?>
                                   
                                </div>
                            </div>
                            <div class="mb-3 mt-0 text-left">
                                <label for="Password ">Password (optional)</label>
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-sm btn-blue" data-container="body" data-toggle="popover" data-trigger="focus" data-content="<span class='cl-success'>Successfully changed your password</span>" data-placement="bottom"><i class="fas fa-key"></i> Change password</button>
                                </div>
                            </div>
                            <div class="mb-5 mt-0 text-left">
                                <label for="">Paypal</label>
                                <div class="text-right mt-0 flex-nowrap">
                                    <input type="password" class="form-control userDetailsForm mb-3 d-inline-block" placeholder="Paypal Email - None" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
                                    <?php if($type == "banned"){?>
                                        <button id="paypalButton" type="button" class="btn btn-sm px-4 py-1 btn-outline-primary" disabled><img src="../../assets/images/paypal/paypal.png" height="23"></button>
                                <?php }
                                else{?>
                                    <button id="paypalButton" type="button" class="btn btn-sm px-4 py-1 btn-outline-primary"><img src="../../assets/images/paypal/paypal.png" height="23"></button>
                               <?php } ?>
                                   
                                </div>
                            </div>

                            <div class="mb-5 mt-5 text-center">
                                <span class="invisible">Easter egg</span>
                            </div>

                            <div class="mb-5 mt-5 text-center flex-nowrap">
                                <button id="deleteAccountButton" data-toggle="modal" data-target="#modalConfirm" type="button" class="btn btn-sm btn-blue d-inline-block"><i class="fas fa-user-slash"></i> <span class="d-inline-block"> Delete Account</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php drawAppealPopup() ?>
        </div>
    </div>
<?php } ?>

<?php function drawUserOffers($type)
{
    drawUserNavBar("offers", $type); ?>
    <div id="content" class="container mt-5">
        <div class="row">
            <div class="col-sm-12 usercontent-left">
            <?php if($type == "banned"){?>    
                <div class="row mb-2">
                    <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                        You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                    </div>
                </div>
            <?php }?>
                <div class="row px-3">
                    <div class="col-sm-9 " style=" display:flex; align-items: center;">
                        <h4 class="text-left">Current Offers<span class="badge ml-1 badge-secondary">4</span></h4>
                    </div>
                    <div class="col-sm-3">
                        <?php if ($type == "banned") { ?>
                            <a href="offer.php" class="btn p-2 btn-sm btn-orange btn-block text-white disabled" role="button"> <i class="mr-1 fas fa-plus"></i> <span class="d-none d-md-inline-block"> Add offer </span></a>
                        <?php } else { ?>
                            <a href="offer.php" class="btn p-2 btn-sm btn-orange btn-block text-white " role="button"> <i class="mr-1 fas fa-plus"></i> <span class="d-none d-md-inline-block"> Add offer </span></a>
                        <?php } ?>
                    </div>
                </div>
                <?php if($type == "banned"){?>
                <div class="container mt-3 mb-3">
                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive table-striped tableFixHead mt-3">
                                <table id="userOffersTable" class="table p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product Details</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Start Date</div>
                                            </th>

                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Current Price</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Options</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBOX One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/FIFA20/1.png" alt="" width="150" class="img-fluid rounded d-none d-sm-inline shadow-sm userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/MINECRAFT/1.png" alt="" width="150" class="img-fluid d-none d-sm-inline rounded shadow-sm userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                        

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else{ ?>
                <div class="container mt-3 mb-3">
                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive table-striped tableFixHead mt-3">
                                <table id="userOffersTable" class="table p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product Details</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Start Date</div>
                                            </th>

                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Current Price</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Options</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div>
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBOX One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/FIFA20/1.png" alt="" width="150" class="img-fluid rounded d-none d-sm-inline shadow-sm userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/MINECRAFT/1.png" alt="" width="150" class="img-fluid d-none d-sm-inline rounded shadow-sm userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="offer.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>

                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="col-sm-12 usercontent-left mt-5">
                    <div class="row px-3">
                        <div class="col-sm-12">
                            <h4 class="text-left">Past Offers <span class="badge ml-1 badge-secondary">4</span></h4>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">
                        <div class="row ">
                            <div class="col-12">
                                <div class="table-responsive table-striped tableFixHead mt-3 mt-3">
                                    <table id="userOffersTable" class="table p-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-0 bg-light">
                                                    <div class="p-2 px-3 text-uppercase">Product Details</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Start Date</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">End Date</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Last Price</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Profit</div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/FIFA20/1.png" alt="" width="150" class="img-fluid rounded d-none d-sm-inline shadow-sm userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBOX One]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/MINECRAFT/1.png" alt="" width="150" class="img-fluid d-none d-sm-inline rounded shadow-sm userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PC]</span>
                                                            <h6>Keys sold: 10</h6>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle">2020/07/20</td>
                                                <td class="text-center align-middle">$79.00</td>
                                                <td class="text-center align-middle"><strong>$200.00</strong></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawUserPurchases($type)
{
    drawUserNavBar("purchases", $type) ?>
    <div id="content" class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
            <?php if($type == "banned"){?>    
                <div class="row mb-2">
                    <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                        You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                    </div>
                </div>
            <?php }?>
                <div class="row ">
                    <div class="col-sm-12">
                        <h4 class="text-left">Purchase History <span class="badge ml-1 badge-secondary">4</span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive table-striped tableFixHead mt-3">
                            <table id="userOffersTable" class="table p-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-2 px-3 text-uppercase">Product Details</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Date</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Price</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Options</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="otherUser.php" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <?php if($type != "banned"){?>
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                <?php }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="otherUser.php" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </td>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="../../assets/images/games/GTAV/1.png">
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <?php if($type != "banned"){?>
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                <?php }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="../../assets/images/games/FIFA20/1.png" alt="" width="150" class="img-fluid rounded d-none d-sm-inline shadow-sm userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="otherUser.php" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </td>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <?php if($type!="banned"){ ?>
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="../../assets/images/games/MINECRAFT/1.png" alt="" width="150" class="img-fluid d-none d-sm-inline rounded shadow-sm userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="otherUser.php" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </td>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <?php if($type!="banned"){ ?>
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="../../assets/images/games/MINECRAFT/1.png" alt="" width="150" class="img-fluid d-none d-sm-inline rounded shadow-sm userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="otherUser.php" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </td>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <?php if($type!="banned"){ ?>
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php 
        drawReportPopup();
        drawFeedbackPopup("1");
        drawGiveFeedbackPopup();
        drawKeyPopup(); 
    ?>
<?php } ?>

<?php function drawUserReports($type)
{
    drawUserNavBar("reports", $type) ?>
    <div id="content" class="container mt-5">
        <div class="row mt-5">
            <div class="col-sm-12 usercontent-left">
                <?php if($type == "banned"){?>    
                    <div class="row mb-2">
                        <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                            You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                        </div>
                    </div>
                <?php }?>
                <div class="row px-3">
                    <div class="col-sm-9 " style=" display:flex; align-items: center;">
                        <h4 class="text-left">My Reports<span class="badge ml-1 badge-secondary">1</span></h4>
                    </div>
                </div>
                <div class="container mt-3 mb-3">
                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive table-striped tableFixHead mt-3">
                                <table id="userOffersTable" class="table p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product Bought</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="p-2 px-3 text-uppercase">Buy date</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Report Date</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Options</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle">2020/07/15</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 usercontent-left mt-5">
                    <div class="row px-3">
                        <div class="col-sm-12">
                            <h4 class="text-left">Reports against me<span class="badge ml-1 badge-secondary">2</span></h4>
                        </div>
                    </div>
                    <div class="container mt-3 mb-3">
                        <div class="row ">
                            <div class="col-12">
                                <div class="table-responsive table-striped tableFixHead mt-3 mt-3">
                                    <table id="userOffersTable" class="table p-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-0 bg-light">
                                                    <div class="p-2 px-3 text-uppercase">Product Sold</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Report Date</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Reporter</div>
                                                </th>
                                                <th scope="col" class="border-0 bg-light text-center">
                                                    <div class="py-2 text-uppercase">Options</div>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row" class="border-0 align-middle">
                                                    <div class="p-2">
                                                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                        <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                        </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                    </div>

                                                </th>
                                                <td class="text-center align-middle">2020/07/10</td>
                                                <td class="text-center align-middle"><a href="otherUser.php" class="text-muted font-weight-normal font-italic">zmax6t</a></td>
                                                <td class="align-middle">
                                                    <div class="btn-group-justified btn-group-md">
                                                        <a href="report.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        drawReportPopup();
        drawFeedbackPopup("1");
        drawGiveFeedbackPopup();
        drawKeyPopup(); 
    ?>
<?php } ?>

<!-- user popups -->
<?php function drawConfirmDeleteAccountPopup()
{ ?>
    <div id="modalConfirm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete account, are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <span> Confirm </span>
                    <input type="text-area" class="form-control userDetailsForm mt-2 d-inline-block" id="exampleFormControlTextarea1" placeholder="Type your username to proceed"></input>
                </div>
                <div class="modal-footer">
                    <div class="col text-left"><button class="btn btn-blue"><i class="fas fa-check mr-2"></i>Yes</button></div>
                    <div class="col text-right"><button class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cancel</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawSaveChangesPopup()
{ ?>
    <div id="modalConfirmChanges" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm changes?</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-footer">
                    <div class="col text-left"><button class="btn btn-blue"><i class="fas fa-check mr-2"></i>Yes</button></div>
                    <div class="col text-right"><button class="btn btn-blue"><i class="fas fa-times mr-2"></i>Cancel</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawKeyPopup()
{ ?>
    <div id="modalSeeKey" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row mx-0">
                    <div class="col-9 col-md-6">
                        <span class="flex-nowrap"> <i class="fas fa-key d-inline-block"></i>
                            <h5 class="d-inline-block">Key info </h5><span>
                    </div>
                    <div class="col-3 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" value="YYYY-XXXX-YYYY-XXXX" readonly></input>
                </div>
                <div class="modal-footer">
                    <div class="col text-right"><button class="btn btn-blue"><i class="fas fa-clipboard"></i> Copy to clipboard</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawGiveFeedbackPopup()
{ ?>
    <div id="modalGiveFeedback" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                        <span class="flex-nowrap"> <i class="far fa-comment-alt d-inline-block"></i>
                            <h5 class="d-inline-block">Leave feedback </h5><span>
                    </div>
                    <div class="col-9 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="reportBorderInfo" class="col-6 text-left">
                            <u>
                                <h5>Seller's Info</h5>
                            </u>
                            <h6>Lockdownpt</h6>
                            <p><i class="fas fa-thumbs-up cl-success"></i> <span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
                        </div>
                        <div class="col-6 text-right">
                            <u>
                                <h5>Product in question</h5>
                            </u>
                            <h6>Order Nº 14456666</h6>
                            <h6>Price : 124,90€ </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-success btn-lg px-5">
                                <i class="fas fa-thumbs-up cl-success"></i>
                            </button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-red btn-lg px-5">
                                <i class="fas fa-thumbs-down cl-fail"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <h6>Comment</h6>
                            <textarea class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" placeholder="Describe your experience with this seller" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-right"><button class="btn btn-blue"> Submit</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawModalConfirmBan()
{ ?>
    <div id="modalConfirmBan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                        <span class="flex-nowrap"> <i class="fas fa-key d-inline-block"></i>
                            <h5 class="d-inline-block">Key info </h5><span>
                    </div>
                    <div class="col-9 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" value="YYYY-XXXX-YYYY-XXXX" readonly></input>
                </div>
                <div class="modal-footer">
                    <div class="col text-right"><button class="btn btn-blue"><i class="fas fa-clipboard"></i> Copy to clipboard</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawAppealPopup()
{ ?>
    <div id="modalAppeal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                        <span class="flex-nowrap">
                            <h5 class="d-inline-block">Appeal</h5><span>
                    </div>
                    <div class="col-9 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                <div class="row mt-1">
                        <div class="col">
                            <h5>An admin will access your situation after you submit an appeal, please be as self explanitory as possible in the comment section</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <h6>Appeal Coment</h6>
                            <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Describe your problem" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-right"><button class="btn btn-blue">Submit</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawReportPopup()
{ ?>
    <div id="modalReport" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                        <span class="flex-nowrap"> <i class="fas fa-user-slash d-inline-block"></i>
                            <h5 class="d-inline-block">Report Seller </h5><span>
                    </div>
                    <div class="col-9 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="reportBorderInfo" class="col-6 text-left">
                            <u>
                                <h5>Seller's Info</h5>
                            </u>
                            <h6>Lockdownpt</h6>
                            <p><i class="fas fa-thumbs-up cl-success"></i><span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
                        </div>
                        <div class="col-6 text-right">
                            <u>
                                <h5>Product in question</h5>
                            </u>
                            <h6>Order Nº 14456666</h6>
                            <h6>Price : 124,90€ </h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <h6>Report Description</h6>
                            <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Describe your problem" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-right"><button class="btn btn-blue">Submit</button></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawReportPage($type) 
{ ?>
    <div id="content" class="container">
        <div class="row mt-4">
            <div class="col-11 col-md-4">
                <h4> Report Page </h4>
            </div>
        </div>
        <div class="row  justify-content-center justify-content-md-start">
            <div class="col-11 col-md-4 mt-4 border rounded-top">
                <div class="row border">
                    <div class="col">
                        <h5 class="mt-1 mb-1 "> Report Details </h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col">

                        <?php
                        if ($type == "admin") {
                        ?>
                            <div class="row mt-4">
                                <div class="col">
                                    <h6><u>Admin Options</u></h6>
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="btn-group-justified btn-group-md pl-2 pt-2">
                                                <button type="button mt-5 mb-5 " class="btn btn-red  btn-sm btn-block flex-nowrap" data-toggle="modal" data-target="#modalConfirmBan"> <span> Ban Buyer </span></button>
                                                <button type="button mt-5 mb-5 " class="btn btn-red   btn-sm btn-block flex-nowrap" data-toggle="modal" data-target="#modalConfirmBan"> <span>Ban Seller</span> </button>
                                                <button type="button mt-5 mb-5 " class="btn btn-outline-success  btn-sm btn-block flex-nowrap" data-toggle="modal" data-target="#modalConfirmArquive"> <span> Arquive Report </span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }

                        ?>

                        <div class="row mt-4">
                            <div class="col">
                                <h6><u>Report Status</u></h6>
                                <h6 class="pl-2 pt-2">In Process </h6>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <h6><u> Product in question</u></h6>
                                <div class="pl-2 pt-2">
                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-smuserOffersTableEntryImage">
                                    <div class="ml-1 align-middle flex-nowrap">
                                        <h6 class="mb-0 d-inline"><a href="#" class="text-dark">NBA 2K16</a></h6><span class="text-muted font-italic d-inline"> [PS4]</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4 mb-4">
                            <div class="col">
                                <h6><u>Intervenients</u></h6>

                                <div class="row mt-2 pl-2 pt-2">
                                    <div class="col incoming_msg_img_inter">
                                        <div class="incoming_msg_img_inter"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> <span class="d-inline-block">LockdownPT (admin) <span>
                                    </div>
                                </div>
                                <div class="row mt-2  pl-2 pt-2">
                                    <div class="col">
                                        <div class="incoming_msg_img_inter"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> <span class="d-inline.block">nightwalker (seller) </span>
                                    </div>
                                </div>
                                <div class="row mt-2  pl-2 pt-2">
                                    <div class="col">
                                        <div class="incoming_msg_img_inter"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil "> </div> <span class="d-inline.block"> sterillium (buyer) </span>
                                    </div>
                                </div>



                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="col-11 col-md-8  mt-4 border rounded-top">
                <div class="row border">
                    <div class="col">
                        <h5 class="mt-1 mb-1"> Messaging </h5>
                    </div>
                </div>

                <div class="msg_history ">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all
                                    solutions</p>
                                <span class="time_date"> 11:01 AM | June 9</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Test which is a new approach to have all
                                solutions</p>
                            <span class="time_date"> 11:01 AM | June 9</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test, which is a new approach to have</p>
                                <span class="time_date"> 11:01 AM | Yesterday</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM | Today</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                <span class="time_date"> 11:01 AM | Today</span>
                            </div>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                <span class="time_date"> 11:01 AM | Today</span>
                            </div>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                <span class="time_date"> 11:01 AM | Today</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM | Today</span>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM | Today</span>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM | Today</span>
                        </div>
                    </div>
                </div>
                <div class="type_msg  border rounded-top">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message" />
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>

        </div>
    </div>

<?php } ?>