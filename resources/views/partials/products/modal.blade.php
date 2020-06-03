<!-- modal -->
<div id="sideBarFilterResponsive">
    <div class="modal left fade" id="sideBarFilterModal" tabindex="-1" role="dialog" aria-labelledby="sideBarFilterModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="sidebar" class="col">
                        <form class="option">
                            <div class="col">
                                <section>
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true"
                                        aria-controls="collapseOrder">
                                        <h5 class="productSideBarTitle">Sort by
                                            <i class="fas fa-caret-down ml-1"></i>
                                        </h5>
                                    </button>
                                    <div id="collapseOrder" class="collapse show">
                                        @php($request = Request::has('sort_by') ? Request::get('sort_by') : 3)
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input" id="SortBy11" name="sort_by" value="1"
                                                    {{($request == 1) ? 'checked' : ''}} >
                                            <label class="custom-control-label" for="SortBy11">Highest Price</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input" id="SortBy22" name="sort_by" value="2"
                                                    {{($request == 2) ? 'checked' : ''}} >
                                            <label class="custom-control-label" for="SortBy22">Lowest Price</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input" id="SortBy33" name="sort_by" value="3"
                                                    {{($request == 3) ? 'checked' : ''}} >
                                            <label class="custom-control-label" for="SortBy33">Most popular</label>
                                        </div>
                                        <div class="custom-control custom-radio my-2 ml-3">
                                            <input type="radio" class="custom-control-input" id="SortBy44" name="sort_by" value="4"
                                                    {{($request == 4) ? 'checked' : ''}} >
                                            <label class="custom-control-label" for="SortBy44">Most recent</label>
                                        </div>
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseGenres" aria-expanded="true"
                                        aria-controls="collapseGenres">
                                        <h5 class="productSideBarTitle pb-2">Genres<i class="fas fa-caret-down ml-1"></i></h5>
                                    </button>
                                    <div id="collapseGenres" class="collapse show">
                                        @for($i = 0; $i < count($genres); $i++)
                                            <div class="custom-control custom-checkbox row ml-3 my-2">
                                                <input type="checkbox" name="genres[]" class="custom-control-input" id="checkBoxGenre{{$i+1}}_" value="{{$genres->get($i)->name}}"
                                                        {{ Request::has('genres') && in_array($genres->get($i)->name, explode(',', Request::get('genres'))) ?  'checked' : ''  }} >
                                                <label class="custom-control-label" for="checkBoxGenre{{$i+1}}_">{{$genres->get($i)->name}}</label>
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
                                            <input type="radio" class="custom-control-input" id="noPlatform"
                                               name="platform" value="">
                                            <label class="custom-control-label" for="noPlatform">All</label>
                                        </div>
                                        @for($i = 0; $i < count($platforms); $i++)
                                            <div class="custom-control custom-radio my-2 ml-3">
                                                <input type="radio" class="custom-control-input" id="checkBoxPlatforms{{$i+1}}_"
                                                   name="platform" value="{{$platforms->get($i)->name}}"
                                                   {{ (Request::has('platform') && Request::get('platform') == $platforms->get($i)->name) ?  'checked' : '' }}>
                                                <label class="custom-control-label" for="checkBoxPlatforms{{$i+1}}_">{{$platforms->get($i)->name}}</label>
                                            </div>
                                        @endfor
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <button class="btn btn-primary showAllProductListSideBar ml-3" type="button"
                                        data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true"
                                        aria-controls="collapseCategories">
                                        <h5 class="productSideBarTitle">Categories<i class="fas fa-caret-down ml-1"></i></h5>
                                    </button>
                                    <div id="collapseCategories" class="collapse show">
                                        <div class="custom-control custom-radio row ml-3 my-2">
                                            <input type="radio" class="custom-control-input" id="noCategory"
                                                   name="category" value="">
                                            <label class="custom-control-label" for="noCategory">All</label>
                                        </div>
                                        @for($i = 0; $i < count($categories); $i++)
                                            <div class="custom-control custom-radio row ml-3 my-2">
                                                <input type="radio" class="custom-control-input" id="checkBoxCategories{{$i+1}}_"
                                                       name="category" value="{{$categories->get($i)->name}}"
                                                        {{(Request::has('category') && Request::get('category') == $categories->get($i)->name) ? 'checked': '' }}>
                                                <label class="custom-control-label" for="checkBoxCategories{{$i+1}}_">{{$categories->get($i)->name}}</label>
                                            </div>
                                        @endfor
                                    </div>
                                    <hr>
                                </section>
                                <section class="mt-4">
                                    <h5 class="productSideBarTitle my-2 ml-3">Price Range</h5>
                                    <article class="form-check form-check-inline">
                                        <input class="form-control my-2 ml-3" type="number" value="{{Request::has('min_price') ? Request::get('min_price') : ''}}" name="min_price" placeholder="Min">
                                        <input class="form-control my-2 ml-3" type="number" value="{{Request::has('max_price') ? Request::get('max_price') : ''}}" name="max_price" placeholder="Max">
                                    </article>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>