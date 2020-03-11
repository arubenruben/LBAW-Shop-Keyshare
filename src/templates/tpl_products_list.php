<?php function drawProductList()
{ ?>
    <div id="content" class="container">
        <div class="row mt-5">
            <?php drawListingsFilter(1); ?>
            <div class="col ml-auto mr-auto">
                    <!-- filter button (for small devices) -->
                    <div class="row justify-content-between text-center d-lg-none">
                        <div class="col-sm-5 col-md-4 mx-auto">
                            <button class="btn btn-small px-5 btn-secondary" type="button" data-toggle="modal" data-target="#myModal"> <div class="flex-nowrap" ><i class="fas fa-filter d-inline-block"></i> <div class="d-inline-block">Filters </div></div></button>
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
                    <!-- filter popup (for small devices) -->
                    <div id="sideBarFilterResponsive">
                        <?php drawListingsFilterModal(); ?>
                    </div>
            </div>
        </div>
<?php } ?>

<?php function drawListingsFilter(int $option)
{ 
    switch($option) {
        case 1: ?>
            <div id="sidebar" class="col-3 d-none d-lg-block">
                <form>
                    <div class="col">
                        <section>
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                                <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapseOrder" class="collapse show">
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy1" name="example1">
                                    <label class="custom-control-label" for="SortBy1">Highest Price</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy2" name="example1">
                                    <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy3" name="example1">
                                    <label class="custom-control-label" for="SortBy3">Most popular</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
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
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre1">
                                    <label class="custom-control-label" for="checkBoxGenre1">Action</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre2">
                                    <label class="custom-control-label" for="checkBoxGenre2">Sports</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre3">
                                    <label class="custom-control-label" for="checkBoxGenre3">Racing</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre4">
                                    <label class="custom-control-label" for="checkBoxGenre4">Simulation</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre5">
                                    <label class="custom-control-label" for="checkBoxGenre5">Puzzle</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre6">
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
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms1" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms1">PC</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms2" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms2">PS4</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms3" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms3">Nintendo</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms4" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms4">XBox</label>
                                </div>
                            </div>
                            <hr>
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                                <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapseCategories" class="collapse show">
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories1" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories1">Full Game</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories2" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories2">DLC</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories3" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories3">Skin</label>
                                </div>
                            </div>
                            <hr>
                        </section>
                        <section class="mt-4">
                            <h5 class="productSideBarTitle">Max Price</h5>
                            <label for="price-range">Value</label>
                            <input type="range" class="custom-range" id="price-range" name="maxPrice">
                        </section>
                    </div>
                </form>
            </div>
        <?php break;
        case 2: ?>
            <div id="sidebar" class="col">
                <form>
                    <div class="col">
                        <section>
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder1" aria-expanded="true" aria-controls="collapseOrder">
                                <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapseOrder1" class="collapse show">
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy11" name="sort">
                                    <label class="custom-control-label" for="SortBy11">Highest Price</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy22" name="sort">
                                    <label class="custom-control-label" for="SortBy22">Lowest Price</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy33" name="sort">
                                    <label class="custom-control-label" for="SortBy33">Most popular</label>
                                </div>
                                <div class="custom-control custom-radio my-2 ml-3">
                                    <input type="radio" class="custom-control-input" id="SortBy44" name="sort">
                                    <label class="custom-control-label" for="SortBy44">Most recent</label>
                                </div>
                            </div>
                            <hr>
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseGenres1" aria-expanded="true" aria-controls="collapseGenres">
                                <h5 class="productSideBarTitle pb-2">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapseGenres1" class="collapse show">
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre11" name="genreAction">
                                    <label class="custom-control-label" for="checkBoxGenre11">Action</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre22" name="genreSports">
                                    <label class="custom-control-label" for="checkBoxGenre22">Sports</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre33" name="genreRacing">
                                    <label class="custom-control-label" for="checkBoxGenre33">Racing</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre44" name="genreSimulation">
                                    <label class="custom-control-label" for="checkBoxGenre44">Simulation</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre55" name="genrePuzzle">
                                    <label class="custom-control-label" for="checkBoxGenre55">Puzzle</label>
                                </div>
                                <div class="custom-control custom-checkbox row ml-3 my-2">
                                    <input type="checkbox" class="custom-control-input" id="checkBoxGenre66" name="genreFPS">
                                    <label class="custom-control-label" for="checkBoxGenre66">FPS</label>
                                </div>
                            </div>
                            <hr>
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapsePlatforms1" aria-expanded="true" aria-controls="collapsePlatforms">
                                <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapsePlatforms1" class="collapse show">
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms11" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms11">PC</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms22" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms22">PS4</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms33" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms33">Nintendo</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms44" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms44">Wii</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms55" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms55">Xbox</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxPlatforms66" name="platform">
                                    <label class="custom-control-label" for="checkBoxPlatforms66">Xbox</label>
                                </div>
                            </div>
                            <hr>
                        </section>
                        <section class="mt-4">
                            <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseCategories1" aria-expanded="true" aria-controls="collapseCategories">
                                <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                            </button>
                            <div id="collapseCategories1" class="collapse show">
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories11" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories11">Full Game</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories22" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories22">DLC</label>
                                </div>
                                <div class="custom-control custom-radio row ml-3 my-2">
                                    <input type="radio" class="custom-control-input" id="checkBoxCategories33" name="category">
                                    <label class="custom-control-label" for="checkBoxCategories33">Skin</label>
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
        <?php break;
    } ?>
    
<?php } ?>

<?php function drawListingsFilterModal()
{ ?>
    <!-- Modal -->
    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <?php drawListingsFilter(2); ?>
                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
<?php } ?>