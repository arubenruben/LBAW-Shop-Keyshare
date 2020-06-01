<div id="sidebar" class="col-3 d-none d-lg-block h-100">
    <form id="option">
        <div class="col">
            <section>
                <button class="btn btn-primary showAllProductListSideBar ml-3" type="button" data-toggle="collapse"
                    data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <h5 class="productSideBarTitle">Sort by<i class="fas fa-caret-down ml-1"></i></h5>
                </button>
                <div id="collapseOrder" class="collapse show">
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy1" name="sort_by" value="1"
                        @if(Request::has('sort_by') && Request::get('sort_by') == '1') checked @endif>
                        <label class="custom-control-label" for="SortBy1">Highest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy2" name="sort_by" value="2"
                        @if(Request::has('sort_by') && Request::get('sort_by') == '2') checked @endif>
                        <label class="custom-control-label" for="SortBy2">Lowest Price</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy3" name="sort_by" value="3"
                        @if(Request::has('sort_by') && Request::get('sort_by') == '3') checked @endif>
                        <label class="custom-control-label" for="SortBy3">Most popular</label>
                    </div>
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input sort-by" id="SortBy4" name="sort_by" value="4"
                            @if(Request::has('sort_by') && Request::get('sort_by') == '4') checked @endif>
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
                    @php $i = 1; @endphp
                    @foreach($genres as $genre)
                        @php $i++; @endphp
                        <div class="custom-control custom-checkbox row ml-3 my-2">
                            <input type="checkbox" name="genres[]" class="custom-control-input genre" id="checkBoxGenre{{$i}}" value="{{$genre->name}}"
                               {{ Request::has('genres') && in_array($genre->name, explode(',', Request::get('genres'))) ?  'checked' : ''  }} >

                            <label class="custom-control-label" for="checkBoxGenre{{$i}}">{{$genre->name}}</label>
                        </div>
                    @endforeach
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
                    @php $i = 1; @endphp
                    @foreach($platforms as $platform)
                    @php $i++; @endphp
                    <div class="custom-control custom-radio my-2 ml-3">
                        <input type="radio" class="custom-control-input platform" id="checkBoxPlatforms{{$i}}"
                            name="platform" value="{{$platform->name}}"
                            @if(Request::has('platform') && Request::get('platform') == $platform->name) checked @endif>
                        <label class="custom-control-label" for="checkBoxPlatforms{{$i}}">{{$platform->name}}</label>
                    </div>
                    @endforeach
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
                        <input type="radio" class="custom-control-input category" id="noCategory"
                               name="category" value="">
                        <label class="custom-control-label" for="noCategory">All</label>
                    </div>
                    @php $i = 1; @endphp
                    @foreach($categories as $category)
                    @php $i++; @endphp
                    <div class="custom-control custom-radio row ml-3 my-2">
                        <input type="radio" class="custom-control-input category" id="checkBoxCategories{{$i}}"
                            name="category" value="{{$category->name}}"
                            @if(Request::has('category') && Request::get('category') == $category->name) checked @endif>
                        <label class="custom-control-label" for="checkBoxCategories{{$i}}">{{$category->name}}</label>
                    </div>
                    @endforeach
                </div>
                <hr>
            </section>
            <section class="mt-4">
                <h5 class="productSideBarTitle my-2 ml-3">Price Range</h5>
                <article class="form-check form-check-inline">
                    <input class="form-control my-2 ml-3" type="number" value="" name="min_price" id="min-price-range" placeholder="Min">
                    <input class="form-control my-2 ml-3" type="number" value="" name="max_price" id="max-price-range" placeholder="Max">
                </article>
            </section>
        </div>
    </form>
</div>