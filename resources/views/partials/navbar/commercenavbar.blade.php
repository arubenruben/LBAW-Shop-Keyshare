<nav id="navbar" class="nav pt-3">
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=>$breadcrumbs])
    <article class="col-8 d-none d-sm-block ml-auto mr-auto">
        <section class="row">
            <div class="dropdown show ml-auto">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h5 class="productSideBarTitle">Genres<i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                </button>
                <div id="collapseGenres" class="dropdown-menu">
                    <a class="dropdown-item" href="product.php">Action</a>
                    <a class="dropdown-item" href="product.php">Racing</a>
                    <a class="dropdown-item" href="product.php">Sports</a>
                    <a class="dropdown-item" href="product.php">Puzzle</a>
                    <a class="dropdown-item" href="product.php">FPS</a>
                    <a class="dropdown-item" href="product.php">Simulation</a>
                </div>
            </div>
            <div class="dropdown show">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    <h5 class="productSideBarTitle">Platforms<i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                </button>
                <div id="collapsePlatforms" class="dropdown-menu">
                    <a class="dropdown-item" href="product.php">PC</a>
                    <a class="dropdown-item" href="product.php">PS4</a>
                    <a class="dropdown-item" href="product.php">Xbox</a>
                    <a class="dropdown-item" href="product.php">Nintendo</a>
                </div>
            </div>
            <div class="dropdown show mr-auto">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    <h5 class="productSideBarTitle">Categories <i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                </button>
                <div id="collapseCategories" class="dropdown-menu">
                    <a class="dropdown-item" href="product.php">Game</a>
                    <a class="dropdown-item" href="product.php">DCL</a>
                    <a class="dropdown-item" href="product.php">Patch</a>
                </div>
            </div>
        </section>
    </article>
</nav>
