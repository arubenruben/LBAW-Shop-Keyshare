<?php function drawOtherUserDetails()
{
    drawOtherUserNavBar("account"); ?>
    <div id="content" class="container">
        <?php drawFeedbackPopup("1"); ?>
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
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 text-center">
                        <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
                    </div>
                </div>
                <div class="row mt-2 mb-5">
                    <div class="col-sm-12 text-center">
                        <button type="button" data-toggle="modal" data-target=".bd-modal-lg1" class="btn btn-blue btn-sm mt-2 ">See all feedback</button>
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
                                <input type="email" class="form-control userDetailsForm " id="email" vzlue="email@email.com" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
                                <div class="invalid-feedback">
                                    email@email.com
                                </div>
                            </div>
                            <div class="mb-3 text-left">
                                <label for="description">Description</label>
                                <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" maxlength="150" rows="5" disabled> O Lorem Ipsum é umdasdadadasdas das das das d asd asd as dsa ds ad asd sad sd ue incluem versões do Lorem Ipsum.</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php } ?>

<?php function drawOtherUserOffers()
{
    drawOtherUserNavBar("offers"); ?>
    <div id="content" class="container mt-5">
        <div class="row mt-5">
            <div class="col-sm-12 usercontent-left">
                <div class="row px-3">
                    <div class="col-sm-9 " style=" display:flex;
    align-items: center;">
                        <h4 class="text-left">lockdownpt Offers <span class="badge ml-1 badge-secondary">4</span></h4>
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
                                                    </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBox One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBox One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBox One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [XBox One]</span>
                                                        <h6>Stock: 10 keys</h6>
                                                    </div><!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                                </div>

                                            </th>
                                            <td class="text-center align-middle">2020/07/10</td>
                                            <td class="text-center align-middle"><strong>$79.00</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
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
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
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
                                                    <a href="product.php" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
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
<?php } ?>


<!-- other user popups -->

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

<!-- user navbar -->
<?php function drawOtherUserNavBar($page)
{
    switch ($page) {
        case "account": ?>
            <ul class="nav nav-tabs  justify-content-center p-2" style="border: none">
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link deco-none" href="otherUser.php"><button class="btn btn-blue-full active">lockdownpt</button></a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link deco-none" href="otherUserOffers.php"><button class="btn btn-blue">Offers <span class="badge ml-1 badge-secondary">4</span></button></a>
                </li>
            </ul>
        <?php
            break;
        case "offers": ?>
            <ul class="nav nav-tabs  justify-content-center p-2 cl-white text-white" style="border: none">
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link deco-none" href="otherUser.php"><button class="btn btn-blue">lockdownpt</button></a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link deco-none" href="userPurchasesPage.php"><button class="btn btn-blue">Offers <span class="badge ml-1 badge-secondary">4</span></button></a>
                </li>
            </ul>
<?php
            break;

        default:
            break;
    }
} ?>