<!-- modal -->
<div id="sideBarFilterResponsive">
    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="sidebar" class="col">
                        <form>
                            <div class="col">
                                <section>
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true"
                                        aria-controls="collapseOrder">
                                        <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i>
                                        </h5>
                                    </button>
                                    <div id="collapseOrder" class="collapse show">
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input sort-by" id="SortBy11"
                                                name="sort_by" value="Highest Price">
                                            <label class="custom-control-label" for="SortBy11">Highest Price</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input sort-by" id="SortBy22"
                                                name="sort_by" value="Lowest Price">
                                            <label class="custom-control-label" for="SortBy22">Lowest Price</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input sort-by" id="SortBy33"
                                                name="sort_by" value="Most popular">
                                            <label class="custom-control-label" for="SortBy33">Most popular</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input sort-by" id="SortBy44"
                                                name="sort_by" value="Most recent">
                                            <label class="custom-control-label" for="SortBy44">Most recent</label>
                                        </div>
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseGenres" aria-expanded="true"
                                        aria-controls="collapseGenres">
                                        <h5 class="productSideBarTitle pb-2">Genres<i
                                                class="fas fa-caret-down ml-1"></i></h5>
                                    </button>
                                    <div id="collapseGenres" class="collapse show">
                                        @php $i = 1; @endphp
                                        @foreach($genres as $genre)
                                        @php $i++; @endphp
                                        <div class="custom-control custom-checkbox row ml-3 my-2">
                                            <input type="checkbox" class="custom-control-input genre"
                                                id="checkBoxGenre{{$i}}{{$i}}" value="{{$genre->name}}">
                                            <label class="custom-control-label"
                                                for="checkBoxGenre{{$i}}{{$i}}">{{$genre->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapsePlatforms" aria-expanded="true"
                                        aria-controls="collapsePlatforms">
                                        <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i>
                                        </h5>
                                    </button>
                                    <div id="collapsePlatforms" class="collapse show">
                                        @php $i = 1; @endphp
                                        @foreach($platforms as $platform)
                                        @php $i++; @endphp
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input platform"
                                                id="checkBoxPlatforms{{$i}}{{$i}}" name="platform"
                                                value="{{$platform->name}}">
                                            <label class="custom-control-label"
                                                for="checkBoxPlatforms{{$i}}{{$i}}">{{$platform->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true"
                                        aria-controls="collapseCategories">
                                        <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i>
                                        </h5>
                                    </button>
                                    <div id="collapseCategories" class="collapse show">
                                        @php $i = 1; @endphp
                                        @foreach($categories as $category)
                                        @php $i++; @endphp
                                        <div class="custom-control custom-radio row ml-3 my-2">
                                            <input type="radio" class="custom-control-input category"
                                                id="checkBoxCategories{{$i}}{{$i}}" name="category"
                                                value="{{$category->name}}">
                                            <label class="custom-control-label"
                                                for="checkBoxCategories{{$i}}{{$i}}">{{$category->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <h5 class="productSideBarTitle my-2 ml-3">Max Price</h5>
                                    <label for="price-range" class="my-2 ml-3" id="max_price_value">Value</label>
                                    <input type="range" class="custom-range my-2 mx-auto" id="price-range"
                                        name="maxPrice" max="{{$max_price}}" min="{{$min_price}}"
                                        value="{{$max_price}}">
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>