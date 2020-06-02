<div id="sidebar" class="col-3 d-none d-lg-block h-100">
    <form class="option">
        @csrf
        <div class="col">
            <section>
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse"
                    data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseOrder" class="collapse show">
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy1" name="sort_by" value="1"
                                {{(Request::has('sort_by') && Request::get('sort_by') == 1) ? 'checked' : ''}} >
                        <label class="custom-control-label" for="SortBy1">Highest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy2" name="sort_by" value="2"
                                {{(Request::has('sort_by') && Request::get('sort_by') == 2) ? 'checked' : ''}} >
                        <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy3" name="sort_by" value="3"
                                {{(Request::has('sort_by') && Request::get('sort_by') == 3) ? 'checked' : ''}} >
                        <label class="custom-control-label" for="SortBy3">Most popular</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy4" name="sort_by" value="4"
                                {{(Request::has('sort_by') && Request::get('sort_by') == 4) ? 'checked' : ''}} >
                        <label class="custom-control-label" for="SortBy4">Most recent</label>
                    </div>
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse"
                    data-target="#collapseGenres" aria-expanded="true" aria-controls="collapseGenres">
                    <h5 class="productSideBarTitle pb-2">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseGenres" class="collapse show">
                    @for($i = 0; $i < count($genres); $i++)
                        <div class="custom-control custom-checkbox row ml-3 my-2">
                            <input type="checkbox" name="genres[]" class="custom-control-input genre" id="checkBoxGenre{{$i+1}}" value="{{$genres->get($i)->name}}"
                               {{ Request::has('genres') && in_array($genres->get($i)->name, explode(',', Request::get('genres'))) ?  'checked' : ''  }} >
                            <label class="custom-control-label" for="checkBoxGenre{{$i+1}}">{{$genres->get($i)->name}}</label>
                        </div>
                    @endfor
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse"
                    data-target="#collapsePlatforms" aria-expanded="true" aria-controls="collapsePlatforms">
                    <h5 class="productSideBarTitle">Platforms<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapsePlatforms" class="collapse show">
                    <div class="custom-control custom-radio row ml-3 my-2">
                        <input type="radio" class="custom-control-input category" id="noPlatform"
                               name="platform" value="">
                        <label class="custom-control-label" for="noPlatform">All</label>
                    </div>
                    @for($i = 0; $i < count($platforms); $i++)
                        <div class="custom-control custom-radio my-2 ml-3">
                            <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms{{$i+1}}" name="platform" value="{{$platforms->get($i)->name}}"
                                {{ (Request::has('platform') && Request::get('platform') == $platforms->get($i)->name) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="checkBoxPlatforms{{$i+1}}">{{$platforms->get($i)->name}}</label>
                        </div>
                    @endfor
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse"
                    data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                    <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseCategories" class="collapse show">
                    <div class="custom-control custom-radio row ml-3 my-2">
                        <input type="radio" class="custom-control-input category" id="noCategory" name="category" value="">
                        <label class="custom-control-label" for="noCategory">All</label>
                    </div>
                    @for($i = 0; $i < count($categories); $i++)
                        <div class="custom-control custom-radio row ml-3 my-2">
                            <input type="radio" class="custom-control-input category" id="checkBoxCategories{{$i+1}}"
                                name="category" value="{{$categories->get($i)->name}}"
                                {{ (Request::has('category') && Request::get('category') == $categories->get($i)->name) ? 'checked': '' }}>
                            <label class="custom-control-label" for="checkBoxCategories{{$i+1}}">{{$categories->get($i)->name}}</label>
                        </div>
                    @endfor
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <h5 class="productSideBarTitle my-2 ml-3">Price Range</h5>
                <article class="form-check form-check-inline">
                    <input class="form-control my-2 ml-3" type="number" value="{{Request::has('min_price') ? Request::get('min_price') : ''}}" name="min_price" id="min-price-range" placeholder="Min">
                    <input class="form-control my-2 ml-3" type="number" value="{{Request::has('max_price') ? Request::get('max_price') : ''}}" name="max_price" id="max-price-range" placeholder="Max">
                </article>
            </section>
        </div>
    </form>
</div>