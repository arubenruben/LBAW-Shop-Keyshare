<?php function drawCart()
{ ?>
    <div id="content" class="container mt-5">
        <div class="row">
            <div class="col-6 text-left">
                <h4>My Cart <span class="badge badge-secondary align-left">7</span></h4>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-lg btn-orange deleteButtonCheckout align-right" href="checkout1.php" role="button" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart"><i class="fas fa-money-check-alt d-inline"></i> <span class="d-none d-md-inline"> Checkout</span></a>
            </div>
            <div class="col-sm-6 text-right">
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
                            <?php drawCartEntry(1); ?>
                            <?php drawCartEntry(2); ?>
                            <?php drawCartEntry(3); ?>
                            <?php drawCartEntry(4); ?>
                            <?php drawCartEntry(5); ?>
                            <?php drawCartEntry(6); ?>
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
        <div class="row mt-4">
            <div class="col text-right">
            <a class="btn btn-lg btn-orange deleteButtonCheckout align-right" href="checkout1.php" role="button" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart"><i class="fas fa-money-check-alt d-inline"></i> <span class="d-inline"> Checkout</span></a>
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
                            <?php drawCartEntry(1); ?>
                            <?php drawCartEntry(2); ?>
                            <?php drawCartEntry(3); ?>
                            <?php drawCartEntry(4); ?>
                            <?php drawCartEntry(5); ?>
                            <?php drawCartEntry(6); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php }

function drawCartEntry($id)
{ ?>
    <tr>
        <td scope="row" class="border-0 align-middle">
            <div class="p-2">
                <a href="product.php"><img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage"></a>
                <div class="ml-3 d-inline-block align-middle">
                    <h5 class="mb-0"><a href="product.php" class="text-dark d-inline-block">NBA 2K16</a></h5><a href="#" data-toggle="modal" data-target=".bd-modal-lg<?=$id?>" class="text-muted font-weight-normal font-italic">zmax6t</a>
                    <?php drawFeedbackPopup($id); ?>
                </div>
            </div>
        </td>
        <td class="text-center align-middle">2020/07/10</td>
        <td class="text-center align-middle"><strong>$79.00</strong></td>
        <td class="align-middle">
            <div class="btn-group-justified btn-group-md">
                <button class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fa fa-trash cl-fail"></i> <span class="d-none d-md-inline-block"> Delete </span></button>
            </div>
        </td>
    </tr>
<?php } ?>