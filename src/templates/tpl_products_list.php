<?php function drawProductList()
{ ?>
    <div id="content" class="container-fluid">
        <div class="row">
            <div id="sidebar" class="col-2 d-none d-lg-block">
                <form>
                    <div class="col">
                        <section>
                            <h5 class="productSideBarTitle">Genres</h5>
                            <hr>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre1">
                                <label class="form-check-label" for="checkBoxGenre1">Action</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre2">
                                <label class="form-check-label" for="checkBoxGenre2">Sports</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre3">
                                <label class="form-check-label" for="checkBoxGenre3">Racing</label>
                            </div>
                            <button class="btn btn-primary showAllProductListSideBar mt-4 mb-3 ml-2" type="button" data-toggle="collapse" data-target="#collapseGenres" aria-expanded="false" aria-controls="collapseGenres">
                                Show All
                                <i class="fas fa-arrow-circle-down"></i>
                            </button>
                            <div id="collapseGenres" class="collapse">
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre4">
                                    <label class="form-check-label" for="checkBoxGenre4">Simulation</label>
                                </div>
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre5">
                                    <label class="form-check-label" for="checkBoxGenre5">Puzzle</label>
                                </div>
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxGenre6">
                                    <label class="form-check-label" for="checkBoxGenre6">FPS</label>
                                </div>
                            </div>
                        </section>
                        <section class="mt-2">
                            <h5 class="productSideBarTitle">Platforms</h5>
                            <hr>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms1">
                                <label class="form-check-label" for="checkBoxPlatforms1">PC</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms2">
                                <label class="form-check-label" for="checkBoxPlatforms2">PS4</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms3">
                                <label class="form-check-label" for="checkBoxPlatforms3">Xbox</label>
                            </div>
                            <button class="btn btn-primary showAllProductListSideBar mt-4 mb-3 ml-2" type="button" data-toggle="collapse" data-target="#collapsePlatforms" aria-expanded="false" aria-controls="collapsePlatforms">
                                Show All
                                <i class="fas fa-arrow-circle-down"></i>
                            </button>
                            <div id="collapsePlatforms" class="collapse">
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms4">
                                    <label class="form-check-label" for="checkBoxPlatforms4">Nintentdo</label>
                                </div>
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms5">
                                    <label class="form-check-label" for="checkBoxPlatforms5">Android</label>
                                </div>
                                <div class="form-group form-check row ml-2 productListSideBarEntry">
                                    <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxPlatforms6">
                                    <label class="form-check-label" for="checkBoxPlatforms6">Linux</label>
                                </div>
                            </div>
                        </section>
                        <section class="mt-2">
                            <h5 class="productSideBarTitle">Categories</h5>
                            <hr>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxCategories1">
                                <label class="form-check-label" for="checkBoxCategories1">Action</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxCategories2">
                                <label class="form-check-label" for="checkBoxCategories2">Sports</label>
                            </div>
                            <div class="form-group form-check row ml-2 productListSideBarEntry">
                                <input type="checkbox" class="form-check-input productListCheckbox" id="checkBoxCategories3">
                                <label class="form-check-label" for="checkBoxCategories3">Racing</label>
                            </div>
                        </section>
                    </div>

                    <!--
                        <div class="productSideBarEntry">
                            <button class="btn btn-primary productSideBarDropdownButton" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">All Categories</button>
                            <div class="collapse" id="collapseExample2">
                                <div class="form-check-inline">
                            <label class="form-check-label">
                                <div class="checkbox">
                                    <label for="checkbox1">
                                        <span>Action</span>
                                    </label>
                                    <input type="checkbox" id="checkbox1" class="checkbox style-2 pull-right" />
                                </div>
                                <div class="checkbox">
                                    <label for="checkbox2">
                                        <span>Sports</span>
                                    </label>
                                    <input type="checkbox" id="checkbox2" class="checkbox style-2 pull-right" />
                                </div>
                                <div class="checkbox">
                                    <label for="checkbox3">
                                        <span>Racing</span>
                                    </label>
                                    <input type="checkbox" id="checkbox3" class="checkbox style-2 pull-right" />
                                </div>
                                <div class="checkbox">
                                    <label for="checkbox4">
                                        <span>Adventure</span>
                                    </label>
                                    <input type="checkbox" id="checkbox4" class="checkbox style-2 pull-right" />
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="productSideBarEntry">
                <header class="productSideBarTitle">Platforms</header>
                <button class="btn btn-primary productSideBarDropdownButton" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">All Platforms</button>
                <div class="collapse" id="collapseExample1">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <div class="checkbox">
                                <label for="checkbox5">
                                    <span>PC</span>
                                </label>
                                <input type="checkbox" id="checkbox5" class="checkbox style-2 pull-right" />
                            </div>
                            <div class="checkbox">
                                <label for="checkbox6">
                                    <span>PS4</span>
                                </label>
                                <input type="checkbox" id="checkbox6" class="checkbox style-2 pull-right" />
                            </div>
                            <div class="checkbox">
                                <label for="checkbox7">
                                    <span>Xbox</span>
                                </label>
                                <input type="checkbox" id="checkbox7" class="checkbox style-2 pull-right" />
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="productSideBarEntry">
                <header class="productSideBarTitle">Genres</header>
                <button class="btn btn-primary productSideBarDropdownButton" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">All Genres</button>
                <div class="collapse" id="collapseExample">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <div class="checkbox">
                                <label for="checkbox8">
                                    <span>Game</span>
                                </label>
                                <input type="checkbox" id="checkbox8" class="checkbox style-2 pull-right" />
                            </div>
                            <div class="checkbox">
                                <label for="checkbox9">
                                    <span>DLC</span>
                                </label>
                                <input type="checkbox" id="checkbox9" class="checkbox style-2 pull-right" />
                            </div>
                        </label>
                    </div>
                </div>
            </div>-->
                </form>
            </div>
            <div class="col-8 ml-auto mr-auto">
                <!--Order By-->
                <div class="row mt-4 mr-1">
                    <div class="btn-group ml-auto">
                        <button class="btn btn-secondary btn-sm dropdown-toggle pl-4 pt-2 pb-2 pr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Order By</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Price</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Rating</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Release Date</a>
                        </div>
                    </div>
                </div>
                <!--First Row-->
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-lg-block d-none">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-lg-block d-none">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5">
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-lg-block d-none">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto mt-5 mb-5">
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-12 col-sm-4 col-md-4 col-xl-2 h-100">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
                            <h5 class="cl-orange2">$24.99</h5>
                        </div>
                    </div>
                    <div class="card col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-lg-block d-none">
                        <a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
                        <div class="card-body">
                            <h6 class="card-title"> <a href="#" class="text-decoration-none text-secondary"> Star Wars Jedi: Fallen Order </a> </h6>
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
            <div class="col-2 d-none d-md-block">
                <!--PlaceHolder-->
            </div>
        </div>
    </div>
<?php } ?>