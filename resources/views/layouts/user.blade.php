<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
        <link href="{{ asset('css/feedback.css') }}" rel="stylesheet">
        <link href="{{ asset('css/product.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="{{ asset('js/active_popovers.js') }}" defer></script>
        <script src="{{ asset('js/progress_bar.js') }}" defer></script>
        <script src="{{ asset('js/progress_bar_draw.js') }}" defer></script>

    </head>

    <body>
        <main>
            @if (Auth::check())
                <header id="headerFixed" class="navbar row">
                    <div class="col col-md-3 col-lg-3 col-xl-1 mt-auto mb-auto">
                        <a href="{{ url('/') }}">
                            <img class="img-fluid logo" src="../../../public/images/logo/logo.png" />
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
                            @endif
                            <button class="btn btn-outline-light mt-auto mb-auto ml-5 pl-4 pr-4" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
                                <i class="fas fa-user headerIcon"></i> Log in
                            </button>
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
                            <button class="btn btn-outline-light mt-auto mb-auto navbarButtonSmall ml-2" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
                                <i class="fas fa-user headerIcon"></i> Log in
                            </button>
                            <a href="products_list.php" class="btn btn-outline-light navbarButtonSmall" role="button">Explore</a>
                            <a id="sellNowButtonNavbar" href="products_list.php" class="btn btn-outline-light navbarButtonSmall" role="button">Sell Now</a>
                            <a id="shoppingCartIconHamburguer" href="cart.php" class="mt-auto mb-auto mr-2"><i class="fas fa-shopping-cart headerIcon cl-orange"></i><span class="badge badge-secondary">3</span></a>
                        </div>
                    </div>
                </div>
            @endif
           <section id="content">
                @yield('content')
            </section>
        </main>
    </body>
</html>