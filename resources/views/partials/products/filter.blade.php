<div id="sidebar" class="col-3 d-none d-lg-block h-100">
    <form id="option">
        <div class="col">
            <section>
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseOrder" class="collapse show">
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy1" name="sort_by" value="Highest Price">
                        <label class="custom-control-label" for="SortBy1">Highest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy2" name="sort_by" value="Lowest Price">
                        <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy3" name="sort_by" value="Most popular">
                        <label class="custom-control-label" for="SortBy3">Most popular</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy4" name="sort_by" value="Most recent">
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
                    @php $i = 1; @endphp
                    @foreach($genres as $genre)
                        @php $i++; @endphp
                        <div class="custom-control custom-checkbox row ml-3 my-2">
                            <input type="checkbox" class="custom-control-input genre" id="checkBoxGenre{{$i}}" value="{{$genre->name}}">
                            <label class="custom-control-label" for="checkBoxGenre{{$i}}">{{$genre->name}}</label>
                        </div>
                    @endforeach
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapsePlatforms" aria-expanded="true" aria-controls="collapsePlatforms">
                    <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapsePlatforms" class="collapse show">
                    @php $i = 1; @endphp
                    @foreach($platforms as $platform)
                        @php $i++; @endphp
                        <div class="custom-control custom-radio my-2 ml-3">
                            <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms{{$i}}" name="platform" value="{{$platform->name}}">
                            <label class="custom-control-label" for="checkBoxPlatforms{{$i}}">{{$platform->name}}</label>
                        </div>
                    @endforeach
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                    <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseCategories" class="collapse show">
                    @php $i = 1; @endphp
                    @foreach($categories as $category)
                        @php $i++; @endphp
                        <div class="custom-control custom-radio row ml-3 my-2">
                            <input type="radio" class="custom-control-input category" id="checkBoxCategories{{$i}}" name="category" value="{{$category->name}}">
                            <label class="custom-control-label" for="checkBoxCategories{{$i}}">{{$category->name}}</label>
                        </div>
                    @endforeach
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <h5 class="productSideBarTitle my-2 ml-3">Max Price</h5>
                <label for="price-range" class="my-2 ml-3" id="max_price_value">Value</label>
                <input type="range" class="custom-range my-2 mx-auto" id="price-range" name="maxPrice" max="{{$max_price}}" min="{{$min_price}}" value="{{$max_price}}">
            </section>
        </div>
    </form>
</div>