<?php function drawCart() { ?>
    <div id="cart" class="container" style="width: 80%">
        <!-- Shopping cart header -->
        <div class="row mt-5 mb-2">
            <div class="col-md-8">
                <h3>Total: $400.00</h3>
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-orange font-weight-bold rounded-pill py-2 btn-block">Procceed to checkout</a>
            </div>
        </div>

        <!-- Shopping cart table -->
        <div class="row">
            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">Product</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Price</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase text-center">Remove</div>
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row" class="border-0">
                                <div class="p-2">
                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                <div class="ml-3 d-inline-block align-middle">
                                    <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">FIFA 19</a></h5><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span>
                                </div>
                                </div>
                            </th>
                            <td class="border-0 align-middle"><strong>$79.00</strong></td>
                            <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr>
                            <th scope="row">
                                <div class="p-2">
                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-3_cexmhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                <div class="ml-3 d-inline-block align-middle">
                                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">NBA 2K16</a></h5><span class="text-muted font-weight-normal font-italic">zmax6t</span>
                                </div>
                                </div>
                            </th>
                            <td class="align-middle"><strong>$79.00</strong></td>
                            <td class="align-middle text-center"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">
                                <div class="p-2">
                                <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-2_qxjis2.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                <div class="ml-3 d-inline-block align-middle">
                                    <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block">Grand Theft Auto V</a></h5><span class="text-muted font-weight-normal font-italic">bestseller654</span>
                                </div>
                                </div>
                                <td class="align-middle"><strong>$79.00</strong></td>
                                <td class="align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>

<?php } ?>