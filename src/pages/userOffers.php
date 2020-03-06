<?php
include_once('../templates/tpl_common.php');

drawHead();
drawHeader(0);
drawNavbar(0);
?>






<ul class="nav nav-pills  justify-content-center p-2  bg-dark text-white">
    <li class="nav-item">
        <a class="nav-link deco-none" href="userPage.php">Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  deco-none" href="userPurchasesPage.php">Purchases</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active deco-none" href="userOffers.php">Offers(7)</a>
    </li>
</ul>
</ul>



<div class="container mt-5">
    <div class="row mt-5">

        <div class="col-sm-12 usercontent-left">
            <div class="row ">
                <div class="col-sm-9">
                    <h3 class="text-left">Current Offers (7)</h3>
                </div>

                <div class="col-sm-3">
               
                    <button id="headerSellButton" type="button" class="btn p-3 btn-md btn btn-block text-white"><i class="fas fa-plus"></i> Add offer</button>
                </div>

            </div>


            <div class="container mt-4 mb-4">
                <div class="row ">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center"> Product Image </th>
                                        <th scope="col" class="text-center">Product name</th>
                                        <th scope="col" class="text-center">Seller</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Options</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><img src="https://upload.wikimedia.org/wikipedia/pt/9/98/Destiny_2_capa.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Destiny 2 (PC)</h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">124,90 € </h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/2711/271x377/star-wars-jedi-fallen-order-cover.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Star Wars jedi fallen order (PC)</h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">33,90 €</h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/4502/271x377/fifa-20-cover.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Fifa 20 (PC)<h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">70,00 €</h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-sm-12 text-center">
                    <div class="mt-5 mb-5 accountDelete-button">
                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-primary"><i class="fas fa-angle-down"></i> See more (4) <i class="fas fa-angle-down"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 usercontent-left">
            <div class="row ">
                <div class="col-sm-12">
                    <h3 class="text-left">Past Offers (20)</h3>
                </div>
            </div>

            
            <div class="container mt-4 mb-4">
                <div class="row ">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center"> Product Image </th>
                                        <th scope="col" class="text-center">Product name</th>
                                        <th scope="col" class="text-center">Seller</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Options</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><img src="https://upload.wikimedia.org/wikipedia/pt/9/98/Destiny_2_capa.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Destiny 2 (PC)</h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">124,90 € </h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/2711/271x377/star-wars-jedi-fallen-order-cover.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Star Wars jedi fallen order (PC)</h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">33,90 €</h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/4502/271x377/fifa-20-cover.jpg" height="200" /> </td>
                                        <td>
                                            <h5 class="text-center">Fifa 20 (PC)<h5>
                                        </td>
                                        <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i>  |  4000 <i class="fas fa-shopping-cart"></i></span></td>

                                        <td class="text-center">
                                            <h5 class="font-weight-bold">70,00 €</h5>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group-justified btn-group-lg">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-primary btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-sm-12 text-center">
                    <div class="mt-5 mb-5 accountDelete-button">
                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-primary"><i class="fas fa-angle-down"></i> See more (17) <i class="fas fa-angle-down"></i></button>
                    </div>
                </div>
            </div>





            <!-- /.container -->
            <?php drawFooter(); ?>