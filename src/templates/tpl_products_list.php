<?php function drawProductList()
{ ?>
    <div id="content" class="container">
        <div class="row mt-5">
            <?php productListingSideBar(); ?>
            <div class="col ml-auto mr-auto">
                <div class="row">
                    <div class="row justify-content-between mx-0 flex-wrap mt-2 d-lg-none">
                        <div class="sideBarButton col-md-3  cardProductList my-2 mx-auto">
                            <button class="btn btn-secondary btn-sm pl-4 py-2 pr-4" type="button"  data-toggle="modal" data-target="#myModal"> <i class="fas fa-filter"></i> Filters</button>
                        </div>

                        <div class="sideBarButton col-md-3 cardProductList my-2 mx-auto ">
                            <button class="btn btn-secondary  invisible btn-sm pl-4 py-2 pr-4 d-none disabled" type="button" > <i class="fas fa-filter"></i> Filters</button>
                        </div>

                        <div class="sideBarButton col-md-3   cardProductList my-2 mx-auto">
                            <button class="btn btn-secondary  invisible btn-sm pl-4 py-2 pr-4 d-none disabled" type="button"> <i class="fas fa-filter"></i> Filters</button>
                        </div>
                    </div>
                    <!--First Row-->
                    <div class="row justify-content-between mx-auto flex-wrap mt-2">
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/FIFA20/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA 20</a></h6>
                                <h5 class="cl-orange2">$24.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/CSGO/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
                                <h5 class="cl-orange2">$25.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img" src="../../assets/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
                                <h5 class="cl-orange2">$26.99</h5>
                            </div>
                        </div>

                    </div>
                    <!--Second Row-->
                    <div class="row justify-content-between mx-auto flex-wrap mt-2">
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/FIFA20/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA 20</a></h6>
                                <h5 class="cl-orange2">$24.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/CSGO/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
                                <h5 class="cl-orange2">$25.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img" src="../../assets/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
                                <h5 class="cl-orange2">$26.99</h5>
                            </div>
                        </div>

                    </div>
                    <!--Third Row-->
                    <div class="row justify-content-between mx-auto flex-wrap mt-2 mb-5 pb-5">
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/FIFA20/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA 20</a></h6>
                                <h5 class="cl-orange2">$24.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/CSGO/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
                                <h5 class="cl-orange2">$25.99</h5>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                            <a href="product.php"><img class="card-img-top cardProductListImg img" src="../../assets/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
                            <div class="card-body">
                                <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
                                <h5 class="cl-orange2">$26.99</h5>
                            </div>
                        </div>

                    </div>
                    <!--Paging-->
                    <div class="my-auto mx-auto">
                        <nav class="row justify-content-center mt-5" aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div id="sideBarFilterResponsive">
                    <?php drawFilterSideBar(); ?>
                </div>
            </div>
        </div>


    <?php } ?>

    <?php function productListingSideBar()
    { ?>
        <div id="sidebar" class="col-3 d-none d-lg-block">
            <form>
                <div class="col">
                    <section>
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                            <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseOrder" class="collapse show">
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy1" name="example1">
                                <label class="custom-control-label" for="SortBy1">Highest Price</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy2" name="example1">
                                <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy3" name="example1">
                                <label class="custom-control-label" for="SortBy3">Most popular</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy4" name="example1">
                                <label class="custom-control-label" for="SortBy4">Most recent</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseGenres" aria-expanded="true" aria-controls="collapseGenres">
                            <h5 class="productSideBarTitle pb-2">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseGenres" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre1">
                                <label class="custom-control-label" for="checkBoxGenre1">Action</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre2">
                                <label class="custom-control-label" for="checkBoxGenre2">Sports</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre3">
                                <label class="custom-control-label" for="checkBoxGenre3">Racing</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre4">
                                <label class="custom-control-label" for="checkBoxGenre4">Simulation</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre5">
                                <label class="custom-control-label" for="checkBoxGenre5">Puzzle</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre6">
                                <label class="custom-control-label" for="checkBoxGenre6">FPS</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapsePlatforms" aria-expanded="true" aria-controls="collapsePlatforms">
                            <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapsePlatforms" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms1">
                                <label class="custom-control-label" for="checkBoxPlatforms1">PC</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms2">
                                <label class="custom-control-label" for="checkBoxPlatforms2">PS4</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms3">
                                <label class="custom-control-label" for="checkBoxPlatforms3">Nintendo</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms4">
                                <label class="custom-control-label" for="checkBoxPlatforms4">Wii</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms5">
                                <label class="custom-control-label" for="checkBoxPlatforms5">Xbox</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms6">
                                <label class="custom-control-label" for="checkBoxPlatforms6">Xbox</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                            <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseCategories" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories1">
                                <label class="custom-control-label" for="checkBoxCategories1">Full Game</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories2">
                                <label class="custom-control-label" for="checkBoxCategories2">DLC</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories3">
                                <label class="custom-control-label" for="checkBoxCategories3">Skin</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <h5 class="productSideBarTitle">Max Price</h5>
                        <label for="price-range">Value</label>
                        <input type="range" class="custom-range" id="price-range" name="points1">
                    </section>
                </div>
            </form>
        </div>

    <?php } ?>


    <?php function productListingSideBar2()
    { ?>
        <div id="sidebar" class="col-12">
            <form>
                <div class="col">
                    <section>
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder1" aria-expanded="true" aria-controls="collapseOrder">
                            <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseOrder1" class="collapse show">
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy11" name="example11">
                                <label class="custom-control-label" for="SortBy1">Highest Price</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy21" name="example11">
                                <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy31" name="example11">
                                <label class="custom-control-label" for="SortBy3">Most popular</label>
                            </div>
                            <div class="custom-control custom-radio productListSideBarEntry ml-3">
                                <input type="radio" class="custom-control-input" id="SortBy41" name="example11">
                                <label class="custom-control-label" for="SortBy4">Most recent</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseGenres1" aria-expanded="true" aria-controls="collapseGenres">
                            <h5 class="productSideBarTitle pb-2">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseGenres1" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre11">
                                <label class="custom-control-label" for="checkBoxGenre1">Action</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre21">
                                <label class="custom-control-label" for="checkBoxGenre2">Sports</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre31">
                                <label class="custom-control-label" for="checkBoxGenre3">Racing</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre41">
                                <label class="custom-control-label" for="checkBoxGenre4">Simulation</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre51">
                                <label class="custom-control-label" for="checkBoxGenre5">Puzzle</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre61">
                                <label class="custom-control-label" for="checkBoxGenre6">FPS</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapsePlatforms1" aria-expanded="true" aria-controls="collapsePlatforms">
                            <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapsePlatforms1" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms11">
                                <label class="custom-control-label" for="checkBoxPlatforms1">PC</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms21">
                                <label class="custom-control-label" for="checkBoxPlatforms2">PS4</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms31">
                                <label class="custom-control-label" for="checkBoxPlatforms3">Nintendo</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms41">
                                <label class="custom-control-label" for="checkBoxPlatforms4">Wii</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms51">
                                <label class="custom-control-label" for="checkBoxPlatforms5">Xbox</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxPlatforms61">
                                <label class="custom-control-label" for="checkBoxPlatforms6">Xbox</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseCategories1" aria-expanded="true" aria-controls="collapseCategories">
                            <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                        </button>
                        <div id="collapseCategories1" class="collapse show">
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories11">
                                <label class="custom-control-label" for="checkBoxCategories1">Full Game</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories21">
                                <label class="custom-control-label" for="checkBoxCategories2">DLC</label>
                            </div>
                            <div class="custom-control custom-checkbox row ml-3 productListSideBarEntry">
                                <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories31">
                                <label class="custom-control-label" for="checkBoxCategories3">Skin</label>
                            </div>
                        </div>
                        <hr>
                    </section>
                    <section class="mt-4">
                        <h5 class="productSideBarTitle">Max Price</h5>
                        <label for="price-range">Value</label>
                        <input type="range" class="custom-range" id="price-range" name="points1">
                    </section>
                </div>
            </form>
        </div>

    <?php } ?>

    <?php function drawFilterSideBar()
    { ?>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <?php
                        productListingSideBar2();
                        ?>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->


    <?php }
    ?>