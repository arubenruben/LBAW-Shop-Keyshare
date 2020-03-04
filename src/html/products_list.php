<?php
include_once('../templates/common.php');

drawHead();
//drawHeader(0);
drawNavbar(0);
?>


<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <div class="list-group">
                    <div class="productSideBarEntry">
                        <header class="productSideBarTitle">Categories</header>
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
                    </div>
                </div>
            </div>
        </nav>
        <div class="container col-10">
            <!--Order By-->
            <div class="row justify-content-end">
                <span id="productSearchBlock">
                    <label for="order-by">Order By</label>
                    <select id="order-by" class="form-control form-control-ls">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option>Price</option>
                        <option>Rating</option>
                        <option>Release Date</option>
                    </select>
                </span>
            </div>
            <div class="row">
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>

                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>

                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
                <div class="col card h-100">
                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Item One</a>
                        </h4>
                        <h5>$24.99</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <nav class="row justify-content-end" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<?php drawFooter(); ?>