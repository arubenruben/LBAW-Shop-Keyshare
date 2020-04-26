<div id="content" class="container">
    <div class="row mt-5">
        @include('partials.products.filter')
        <div class="col ml-auto mr-auto">
            <div class="row justify-content-between text-center d-lg-none">
                <div class="col-sm-5 col-md-4 mx-auto">
                    <button class="btn btn-small  px-5 btn-blue" type="button" data-toggle="modal" data-target="#myModal"> <div class="flex-nowrap" ><i class="fas fa-filter d-inline-block"></i> <div class="d-inline-block">Filters </div></div></button>
                </div>
            </div>

            <div class="row justify-content-between mx-auto flex-wrap mt-2">
                @for ($i = 0; $i < 3; $i++)
                    @php /*
                    <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                        <a href="{{route('product', ['product_id' => $products[$i]->id])}}"><img class="card-img-top cardProductListImg img-fluid" src="{{asset($products[$i]->image->path)}})}}"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">{{$products[$i]->name}}</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>*/ @endphp
                    <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                        <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="{{asset($products[$i]->image->path)}})}}"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">{{$products[$i]->name}}</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>

                @endfor
            </div>

            <div class="row justify-content-between mx-auto flex-wrap mt-2">
                @for ($i = 3; $i < 6; $i++)
                    <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                        <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="../../../public/images/games/FIFA20/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">{{$products[$i]->name}}</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="row justify-content-between mx-auto flex-wrap mt-2">
                @for ($i = 6; $i < 9; $i++)
                    <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                        <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="../../../public/images/games/FIFA20/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">{{$products[$i]->name}}</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- filter popup (for small devices) -->
            <div id="sideBarFilterResponsive">
                <?php// drawListingsFilterModal(); ?>
            </div>
        </div>
    </div>
</div>