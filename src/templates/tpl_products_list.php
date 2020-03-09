<?php function drawProductList()
{ ?>
    <div id="content" class="container">
        <div class="row">
            <div id="sidebar" class="col-3 d-none d-lg-block mt-5">
                <form>
                    <div class="col">
                        <section>
                            <button class="btn btn-primary showAllProductListSideBar mt-4 mb-3 ml-2" type="button" data-toggle="collapse" data-target="#collapseGenres" aria-expanded="false" aria-controls="collapseGenres">
                                <h5 class="productSideBarTitle">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <hr>
                            <div id="collapseGenres" class="collapse">
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre1">
                                    <label class="custom-control-label" for="checkBoxGenre1">Action</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre2">
                                    <label class="custom-control-label" for="checkBoxGenre2">Sports</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre3">
                                    <label class="custom-control-label" for="checkBoxGenre3">Racing</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre4">
                                    <label class="custom-control-label" for="checkBoxGenre4">Simulation</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre5">
                                    <label class="custom-control-label" for="checkBoxGenre5">Puzzle</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxGenre6">
                                    <label class="custom-control-label" for="checkBoxGenre6">FPS</label>
                                </div>
                            </div>
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar mt-4 mb-3 ml-2" type="button" data-toggle="collapse" data-target="#collapsePlatforms" aria-expanded="false" aria-controls="collapsePlatforms">
                                <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <hr>
                            <div id="collapsePlatforms" class="collapse">
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
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar mt-4 mb-3 ml-2" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                                <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <hr>
                            <div id="collapseCategories" class="collapse">
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories1">
                                    <label class="custom-control-label" for="checkBoxCategories1">Full Game</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories2">
                                    <label class="custom-control-label" for="checkBoxCategories2">DLC</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="custom-control-input productListCheckbox" id="checkBoxCategories3">
                                    <label class="custom-control-label" for="checkBoxCategories3">Skin</label>
                                </div>
                            </div>
                        </section>
                        <section class="mt-4">
                            <h5 class="productSideBarTitle">Max Price</h5>
                            <label for="price-range">Value</label>
                            <input type="range" class="custom-range" id="price-range" name="points1">
                        </section>
                    </div>
                </form>
            </div>
            <div class="col ml-auto mr-auto">
                <!--Order By-->
                <div class="row mt-4 mr-1">
                    <div class="btn-group ml-auto">
                        <button class="btn btn-secondary btn-sm dropdown-toggle pl-4 pt-2 pb-2 pr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="product.php">Price</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="product.php">Rating</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="product.php">Release Date</a>
                        </div>
                    </div>
                </div>
                <!--First Row-->
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-2 col-xl-2 cardProductList">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/FIFA20/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA 20</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-2 col-xl-2 cardProductList d-sm-block d-none">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/CSGO/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
                            <h5 class="cl-orange2">$25.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-2  col-xl-2 d-xl-block d-none cardProductList">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
                            <h5 class="cl-orange2">$26.99</h5>
                        </div>
                    </div>
                </div>
                <!--Second Row-->
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-2 col-xl-2 d-sm-block d-none cardProductList ">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/MINECRAFT/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Minecraft</a></h6>
                            <h5 class="cl-orange2">$19.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-2  col-xl-2 d-xl-block d-none cardProductList">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/FIFA20/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA 20</a></h6>
                            <h5 class="cl-orange2">$18.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-2 col-xl-2 d-sm-block d-none cardProductList ">
                        <a href="product.php"><img class="card-img-top cardProductListImg img-fluid" src="../../assets/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
                            <h5 class="cl-orange2">$43.99</h5>
                        </div>
                    </div>
                </div>
                <!--Third Row-->
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 cardHomepage">
                        <a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../assets/images/games/GTAV/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">GTA V</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 cardHomepage">
                        <a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../assets/images/games/GTAV/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">GTA V</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 cardHomepage">
                        <a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../assets/images/games/GTAV/1.png"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">GTA V</a></h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                </div>
                <!--Paging-->
                <div>
                    <nav class="row justify-content-center mt-5" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<?php } ?>