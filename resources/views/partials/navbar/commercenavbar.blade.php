<nav id="navbar" class="nav pt-3">
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=>$breadcrumbs])
    <article class="col-8 d-none d-sm-block ml-auto mr-auto">
        <section class="row">
            <div class="dropdown show ml-auto">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <h5 class="productSideBarTitle">Genres<i class="fas fa-angle-down ml-1 homepageDropdownArrow"></i>
                    </h5>
                </button>
                <div id="collapseGenres" class="dropdown-menu">
                    @foreach($genres as $genre)
                        <a class="dropdown-item" href="{{route('search')}}">{{$genre->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown show">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown"
                    aria-haspopup="false" aria-expanded="false">
                    <h5 class="productSideBarTitle">Platforms<i
                            class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                </button>
                <div id="collapsePlatforms" class="dropdown-menu">
                    @foreach($platforms as $platform)
                        <a class="dropdown-item" href="{{route('search')}}">{{$platform->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown show mr-auto">
                <button class="btn btn-secondary homepageDropdownButton" type="button" data-toggle="dropdown"
                    aria-haspopup="false" aria-expanded="false">
                    <h5 class="productSideBarTitle">Categories <i
                            class="fas fa-angle-down ml-1 homepageDropdownArrow"></i></h5>
                </button>
                <div id="collapseCategories" class="dropdown-menu">
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('search')}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
        </section>
    </article>
</nav>