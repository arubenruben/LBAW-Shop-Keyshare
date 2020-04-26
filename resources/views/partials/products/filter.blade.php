<div id="sidebar" class="col-3 d-none d-lg-block">
    <form id="option">
        <div class="col">
            <section>
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseOrder" class="collapse show">
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy1" name="example1">
                        <label class="custom-control-label" for="SortBy1">Highest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy2" name="example1">
                        <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3 sort-by">
                        <input type="radio" class="custom-control-input" id="SortBy3" name="example1">
                        <label class="custom-control-label" for="SortBy3">Most popular</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3 sort-by">
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
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre1">
                        <label class="custom-control-label" for="checkBoxGenre1">Action</label>
                    </div>
                    <div class="custom-control custom-checkbox row ml-3 my-2">
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre2">
                        <label class="custom-control-label" for="checkBoxGenre2">Sports</label>
                    </div>
                    <div class="custom-control custom-checkbox row ml-3 my-2">
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre3">
                        <label class="custom-control-label" for="checkBoxGenre3">Racing</label>
                    </div>
                    <div class="custom-control custom-checkbox row ml-3 my-2">
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre4">
                        <label class="custom-control-label" for="checkBoxGenre4">Simulation</label>
                    </div>
                    <div class="custom-control custom-checkbox row ml-3 my-2">
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre5">
                        <label class="custom-control-label" for="checkBoxGenre5">Puzzle</label>
                    </div>
                    <div class="custom-control custom-checkbox row ml-3 my-2">
                        <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre6">
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
                        <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms1" name="platform">
                        <label class="custom-control-label" for="checkBoxPlatforms1">PC</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms2" name="platform">
                        <label class="custom-control-label" for="checkBoxPlatforms2">PS4</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms3" name="platform">
                        <label class="custom-control-label" for="checkBoxPlatforms3">Nintendo</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms4" name="platform">
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
                        <input type="radio" class="custom-control-input category" id="checkBoxCategories1" name="category">
                        <label class="custom-control-label" for="checkBoxCategories1">Full Game</label>
                    </div>
                    <div class="custom-control custom-radio row ml-3 my-2">
                        <input type="radio" class="custom-control-input category" id="checkBoxCategories2" name="category">
                        <label class="custom-control-label" for="checkBoxCategories2">DLC</label>
                    </div>
                    <div class="custom-control custom-radio row ml-3 my-2">
                        <input type="radio" class="custom-control-input category" id="checkBoxCategories3" name="category">
                        <label class="custom-control-label" for="checkBoxCategories3">Skin</label>
                    </div>
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <h5 class="productSideBarTitle my-2 ml-3">Max Price</h5>
                <label for="price-range" class="my-2 ml-3">Value</label>
                <input type="range" class="custom-range my-2 mx-auto" id="price-range" name="maxPrice">
            </section>
        </div>
    </form>
</div>