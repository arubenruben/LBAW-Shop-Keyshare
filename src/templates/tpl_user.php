<?php
function drawUserDetails()
{
    drawUserNavBar("account"); ?>

    <div id="content" class="container">
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
                            <button type="button" class="btn btn-blue"><i class="fas fa-camera-retro"></i> Upload</button>
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
                        <button type="button" class="btn btn-blue btn-sm mt-2">See all feedback</button>
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
                            <div class="mb-3 mt-3">
                                <label for="email">Email <span class="text-muted"></span></label>
                                <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
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
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
                                <input type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
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
        <div class="row mb-4">
            <div class="col-sm-12 text-center">
                <div class="mt-5 mb-5 accountDelete-button">
                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-md btn-danger"><i class="fas fa-user-times"></i> Delete account</button>
                </div>
            </div>
        </div>
    </div>
<?php
} ?>
<?php function drawUserOffers()
{
    drawUserNavBar("account"); ?>
    <div id="content" class="container mt-5">
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
                                <table class="table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Product Image </th>
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
                                            <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                            <td class="text-center">
                                                <h5 class="font-weight-bold">124,90 € </h5>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group-justified btn-group-lg">
                                                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/2711/271x377/star-wars-jedi-fallen-order-cover.jpg" height="200" /> </td>
                                            <td>
                                                <h5 class="text-center">Star Wars jedi fallen order (PC)</h5>
                                            </td>
                                            <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                            <td class="text-center">
                                                <h5 class="font-weight-bold">33,90 €</h5>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group-justified btn-group-lg">
                                                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                                    <?php  ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/4502/271x377/fifa-20-cover.jpg" height="200" /> </td>
                                            <td>
                                                <h5 class="text-center">Fifa 20 (PC)<h5>
                                            </td>
                                            <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                            <td class="text-center">
                                                <h5 class="font-weight-bold">70,00 €</h5>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group-justified btn-group-lg">
                                                    <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
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
                                                <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                                <td class="text-center">
                                                    <h5 class="font-weight-bold">124,90 € </h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group-justified btn-group-lg">
                                                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/2711/271x377/star-wars-jedi-fallen-order-cover.jpg" height="200" /> </td>
                                                <td>
                                                    <h5 class="text-center">Star Wars jedi fallen order (PC)</h5>
                                                </td>
                                                <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                                <td class="text-center">
                                                    <h5 class="font-weight-bold">33,90 €</h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group-justified btn-group-lg">
                                                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
                                                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-outline-danger btn-block"> <i class="fas fa-trash-alt"></i> Delete offer</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><img src="https://s3.gaming-cdn.com/images/products/4502/271x377/fifa-20-cover.jpg" height="200" /> </td>
                                                <td>
                                                    <h5 class="text-center">Fifa 20 (PC)<h5>
                                                </td>
                                                <td class="text-center"> <img class="rounded-circle img-fluid mt-1" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="60" height="60"><a href="#">LockdownPT</a> <br> <span class="mt-5"> 100% <i class="fas fa-thumbs-up"></i> | 4000 <i class="fas fa-shopping-cart"></i></span></td>

                                                <td class="text-center">
                                                    <h5 class="font-weight-bold">70,00 €</h5>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group-justified btn-group-lg">
                                                        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-lg btn-blue btn-block"><i class="fas fa-key"></i> Manage Keys</button>
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
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php function drawUserPurchases()
{
    drawUserNavBar("purchases") ?>
    <div id="content" class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="row ">
                    <div class="col-sm-12">
                        <h3 class="text-left">Past purchases (10)</h3>
                    </div>
                </div>
                <div class="row ">
                    <div class="col">
                        <div class="table-responsive table-striped">
                            <table class="table mt-3">
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
                                        <th scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </th>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-outline-danger btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </th>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-outline-danger btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </th>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-outline-danger btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>

                                        </th>
                                        <td class="text-center align-middle">2020/07/10</td>
                                        <td class="text-center align-middle"><strong>$79.00</strong></td>
                                        <td class="align-middle">
                                            <div class="btn-group-justified btn-group-md">
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-outline-danger btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
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



<?php drawReportPopup();
    drawFeedbackPopup("1");
    drawGiveFeedbackPopup();
    drawKeyPopup();
} ?>

<!-- user popups -->

<?php function drawKeyPopup()
{ ?>
    <div id="modalSeeKey" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Key Info</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                <div class="modal-header">
                    <h5 class="modal-title">Give Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="reportBorderInfo" class="col-6 text-left">
                            <h5>Seller's Info</h5>
                            <h6>Lockdownpt</h6>
                            <p><i class="fas fa-thumbs-up cl-success"></i> <span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
                        </div>
                        <div class="col-6 text-right">
                            <h5>Product in question</h5>
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
                            <button class="btn btn-outline-danger btn-lg px-5">
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



<?php function drawUserNavBar($page)
{

    switch ($page) {
        case "account":

?>
            <ul class="nav nav-tabs  justify-content-center p-2  bg-dark text-white">
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link  active deco-none" href="user.php">Account</a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link  deco-none" href="userPurchasesPage.php">Purchases</a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link  deco-none" href="userOffers.php">Offers(7)</a>
                </li>
            </ul>

        <?php

            break;

        case "offers":

        ?>
            <ul class="nav nav-tabs  justify-content-center p-2  bg-dark text-white">
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link   deco-none" href="user.php">Account</a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link  deco-none" href="userPurchasesPage.php">Purchases</a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link  active deco-none" href="userOffers.php">Offers(7)</a>
                </li>
            </ul>



        <?php

            break;


        case "purchases":
        ?>

            <ul class="nav nav-tabs  justify-content-center p-2  bg-dark text-white">
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link   deco-none" href="user.php">Account</a>
                </li>
                <li class="nav-item mr-3 ml-3 ">
                    <a class="nav-link  active  deco-none" href="userPurchasesPage.php">Purchases</a>
                </li>
                <li class="nav-item mr-3 ml-3">
                    <a class="nav-link deco-none" href="userOffers.php">Offers(7)</a>
                </li>
            </ul>

    <?php
            break;

        default:
            break;
    }
    ?>



<?php
}

?>


<?php function drawReportPopup()
{ ?>
    <div id="modalReport" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Report Seller </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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