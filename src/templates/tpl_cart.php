<?php function drawCart()
{ ?>
    <div id="content" class="container mt-5">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h4>My Cart <span class="badge badge-secondary">7</span></h4>
            </div>

            <div class="col-sm-6 text-right">
                <a href="checkout1.php" class="btn btn-orange" role="button"><span class="d-none d-md-inline-block"> Proceed to checkout </span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive table-striped mt-3">
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
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-right">
                <h4>Total Price: 400,00$</h4>
            </div>
        </div>
    </div>
<?php } ?>

<?php function drawCartCheckout()
{ ?>
    <div id="content" class="container mt-4 pb-0">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h4>My Cart <span class="badge badge-secondary">7</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive table-striped  mt-3">
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
                                    <div class="py-2 text-uppercase">Remove</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                            <?php drawCartEntry(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php }

function drawCartEntry()
{ ?>
    <tr>
        <td scope="row" class="border-0 align-middle">
            <div class="p-2">
                <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                <div class="ml-3 d-inline-block align-middle">
                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg1" class="text-muted font-weight-normal font-italic">zmax6t</a>
                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
            </div>
        </td>
        <td class="text-center align-middle">2020/07/10</td>
        <td class="text-center align-middle"><strong>$79.00</strong></td>
        <td class="align-middle">
            <div class="btn-group-justified btn-group-md">
                <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fa fa-trash cl-fail"></i> <span class="d-none d-md-inline-block"> Delete </span></button>
            </div>
        </td>
    </tr>
<?php } ?>