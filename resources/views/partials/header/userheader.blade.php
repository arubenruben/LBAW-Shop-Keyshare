<header id="headerFixed" class="navbar row">
    <div class="col col-md-3 col-lg-3 col-xl-1 mt-auto mb-auto">
        <a href="{{ url('/') }}">
            <img class="img-fluid logo" src="{{ asset('images/logo/logo.png') }}" />
        </a>
    </div>
    <!-- Search -->
    <div class="col-xl-4 d-none d-xl-block mt-auto mb-auto">
        <form class="form-inline">
            <a class="ml-auto" href="{{ url('/search') }}">
                <i id="headerSearchIcon" class="fas fa-search mr-2"></i>
            </a>
            <input id="searchBar" class="form-control mr-auto mt-auto mb-auto mr-auto" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
    <!--Buttons-->
    <div class="col d-none d-xl-block mt-auto mb-auto">
        <div class="row justify-content-end">
            <a href="{{ url('/search') }}" class="btn btn-outline-light mr-5 pl-4 pr-4 navbarButton" role="button">Explore</a>
            @if (Auth::check())
                <a href="{{ url('/offer') }}" class="btn btn-orange navbarButton pl-4 pr-4" role="button">Sell Now</a>
                <!-- User Image -->
                <button class="btn btn-outline-light ml-5 navbarButton dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('images/profile/default.jpg') }}" width="25" class="img-header rounded-circle" alt=""> {{Auth::user()->username}}
                </button>
                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/user/'.Auth::user()->username) }}">My Profile</a>
                    <a class="dropdown-item" href="{{ url('/user/purchases') }}">My Purchases</a>
                    <a class="dropdown-item" href="{{ url('/user/'.Auth::user()->username.'/offers') }}">My Offers</a>
                    <a class="dropdown-item" href="{{ url('/user/reports') }}">Reports</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/logout') }}">Log out</a>
                </div>
            @else
                <button class="btn btn-outline-light mt-auto mb-auto ml-5 pl-4 pr-4" href="#signup" data-toggle="modal" data-target="#authenticationModal">
                    <i class="fas fa-user headerIcon"></i> Log in
                </button>
            @endif
         </div>
    </div>
    <!-- Cart icon -->
    <div class="col d-none col-xl-2 d-xl-block mt-auto mb-auto">
        <div class="row">
            <a href="{{ url('/cart') }}" class="mt-auto mb-auto ml-auto mr-3"><i class="fas fa-shopping-cart headerIcon cl-orange"></i><span class="badge badge-secondary">3</span></a>
        </div>
    </div>
    <!--Button Collapse Small -->
    <div class="col d-xl-none text-right pos-f-t">
        <button id="navbarHamburguer" type="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#hamburguerContentNavSmall" data-target="#hamburguerContentNavSmall" aria-controls="hamburguerContentNavSmall" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>
<!--Collapse Small -->
<div id="hamburguerContentNavSmall" class="collapse sticky-top pt-3 pb-3">
    <div class="col w-100">
        <div class="row">
            <a class="mt-auto mb-auto ml-auto" href="{{ url('/search') }}">
                <i id="headerSearchIcon" class="fas fa-search mr-2"></i>
            </a>
            <input id="searchBar" class="form-control mr-auto mt-auto mb-auto mr-auto" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="row flex-nowrap justify-content-around mt-3">
            @if (!Auth::check())
                <button class="btn btn-outline-light mt-auto mb-auto navbarButtonSmall ml-2" href="#signup" data-toggle="modal" data-target="#authenticationModal">
                    <i class="fas fa-user headerIcon"></i> Log in
                </button>
            @endif
            <a href="{{ url('/search') }}" class="btn btn-outline-light navbarButtonSmall" role="button">Explore</a>
            @if (Auth::check())
                <a id="sellNowButtonNavbar" href="{{ url('/offer') }}products_list.php" class="btn btn-outline-light navbarButtonSmall" role="button">Sell Now</a>
            @endif
            <a id="shoppingCartIconHamburguer" href="{{ url('/cart') }}" class="mt-auto mb-auto mr-2"><i class="fas fa-shopping-cart headerIcon cl-orange"></i><span class="badge badge-secondary"></span></a>
        </div>
    </div>
</div>