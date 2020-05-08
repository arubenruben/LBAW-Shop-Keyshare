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
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script src="{{ asset('jquery/jquery.slim.js') }}" defer></script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('popper/popper.min.js') }}"></script>

        @stack('head')
        <script src="{{ asset('js/activate_popovers.js') }}" defer></script>
        <script src="{{ asset('js/user/offers.js') }}" defer></script>
{{--
        <script src="{{ asset('js/progress_bar.js') }}" defer></script>
        <script src="{{ asset('js/progress_bar_draw.js') }}" defer></script>
--}}

    </head>
    <body>
        <main>
            <header id="headerFixed" class="navbar row">
                <div class="col col-md-3 col-lg-3 col-xl-1 mt-auto mb-auto">
                    <a href="{{ url('/') }}">
                        <img class="img-fluid logo" src="{{ asset('images/logo/logo.png') }}"  alt="Logo of KeyShare"/>
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
                                <img src="{{ asset('pictures/profile/'.Auth::user()->picture()->url) }}" width="25" class="img-header rounded-circle" alt=""> {{Auth::user()->username}}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/user/'.Auth::user()->username) }}">My Profile</a>
                                <a class="dropdown-item" href="{{ url('/user/purchases') }}">My Purchases</a>
                                <a class="dropdown-item" href="{{ url('/user/'.Auth::user()->username.'/offers') }}">My Offers</a>
                                <a class="dropdown-item" href="{{ url('/user/reports') }}">Reports</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/logout') }}">Log out</a>
                            </div>
                        @else
                            <button class="btn btn-outline-light mt-auto mb-auto ml-5 pl-4 pr-4" data-toggle="modal" data-target="#authenticationModal">
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
                    <button id="navbarHamburguer" type="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#hamburguerContentNavSmall" aria-controls="hamburguerContentNavSmall" aria-expanded="false" aria-label="Toggle navigation">
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
                            <button class="btn btn-outline-light mt-auto mb-auto navbarButtonSmall ml-2" data-toggle="modal" data-target="#authenticationModal">
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
            @if(!Auth::check())
                <!-- authentication modal -->
                <div class="modal fade bs-modal-sm" id="authenticationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <!-- authentication popup header -->
                            <div class="bs-example bs-example-tabs">
                                <ul id="myTab" class="nav nav-tabs" role="tablist">
                                    <li class="active ml-auto mr-auto my-2"><a href="#login" class="nav-link cl-orange" data-toggle="tab" role="tab" aria-controls="signin" aria-selected="true">Log In</a></li>
                                    <li class="ml-auto mr-auto my-2"><a href="#signup" class="nav-link cl-orange" data-toggle="tab" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a></li>
                                </ul>
                            </div>
                            <!-- modal body-->
                            <div class="modal-body">
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login">
                                        <form class="form-horizontal" action="{{ url('/login') }}" method="post">
                                            {{ csrf_field() }}
                                            <!-- Log in Form -->
                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="usernameLogIn">Username:</label>
                                                <div class="controls">
                                                    <input id="usernameLogIn" name="username" type="text" class="form-control input-medium" placeholder="username" required>
                                                </div>
                                            </div>
                                            <!-- Password input-->
                                            <div class="control-group mt-4 mb-2">
                                                <label class="control-label" for="passwordLogIn">Password:</label>
                                                <div class="controls">
                                                    <input required="" id="passwordLogIn" name="password" class="form-control input-medium" type="password" placeholder="********">
                                                </div>
                                            </div>
                                            <input required id="page" name="page" hidden value="{{ Request::url() }}">
                                            <!-- Button -->
                                            <div class="control-group">
                                                <label class="control-label" for="login"></label>
                                                <div class="controls text-center">
                                                    <button id="login" name="login" class="btn text-light btn-orange" formmethod="post">Log in</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal-body">
                                            <button id="google-signup" name="google-signup" class="btn btn-blue">
                                                    <svg class="ml-2 float-left" viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 20px; width: 20px; display: block;"><g fill="none" fill-rule="evenodd"><path d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z" fill="#EA4335"></path><path d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z" fill="#4285F4"></path><path d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z" fill="#FBBC05"></path><path d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z" fill="#34A853"></path><path d="M0 0h18v18H0V0z"></path></g></svg>
                                                    <span class="mx-auto">Log in with Google</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup">
                                        <form class="form-horizontal" action="{{ url('/register') }}" method="post">
                                            {{ csrf_field() }}
                                            <!-- Sign Up Form -->
                                            <!-- Username -->
                                            <div class="control-group">
                                                <label class="control-label" for="usernameSignUp">Username:</label>
                                                <div class="controls">
                                                    <input id="usernameSignUp" name="username" type="text" class="form-control input-medium" placeholder="username" required>
                                                </div>
                                            </div>
                                            <!-- Email -->
                                            <div class="control-group mt-2">
                                                <label class="control-label" for="email">Email:</label>
                                                <div class="controls">
                                                    <input id="email" name="email" type="text" class="form-control input-medium" placeholder="youremail@example.com" required>
                                                </div>
                                            </div>
                                            <!-- BirthDate -->
                                            <div class="control-group mt-2">
                                                <label class="control-label" for="birthDate">Date of birth:</label>
                                                <div class="controls">
                                                    <input id="birthDate" name="birthDate" type="date" class="form-control input-medium" required>
                                                </div>
                                            </div>
                                            <!-- Password input -->
                                            <div class="control-group mt-4 mb-2">
                                                <label class="control-label" for="passwordSignUp">Password:</label>
                                                <div class="controls">
                                                    <input id="passwordSignUp" name="password" class="form-control input-medium" type="password" placeholder="********" required>
                                                </div>
                                            </div>
                                            <!-- Confirm Password input-->
                                            <div class="control-group">
                                                <label class="control-label" for="password_confirmation">Re-Enter Password:</label>
                                                <div class="controls">
                                                    <input id="password_confirmation" class="form-control input-large" name="password_confirmation" type="password" placeholder="********" required>
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="control-group">
                                                <label class="control-label" for="confirmsignup"></label>
                                                <div class="controls text-center">
                                                    <button id="confirmsignup" class="btn text-light btn-orange" formmethod="post">Sign Up</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal-body">
                                            <button id="google-signup" name="google-signup" class="btn btn-blue">
                                                    <svg class="ml-2 float-left" viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 20px; width: 20px; display: block;"><g fill="none" fill-rule="evenodd"><path d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z" fill="#EA4335"></path><path d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z" fill="#4285F4"></path><path d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z" fill="#FBBC05"></path><path d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z" fill="#34A853"></path><path d="M0 0h18v18H0V0z"></path></g></svg>
                                                    <span class="mx-auto">Sign up with Google</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-blue col" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div id="wrapper">
                <section id="content" class="container mt-5">
                    @yield('content')
                </section>
                <!-- Footer -->
                <footer id="footerGeneric">
                    <div class="container">
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="title"> More </h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ url('/faq') }}"> Help </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/contact') }}"> Contact </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/about') }}"> About us </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <h5 class="title"> Shortcuts </h5>
                                <ul class="list-unstyled">
                                    @if (Auth::check())
                                    <li>
                                        <a href="{{ url('/user/'.Auth::user()->username) }}"> Profile </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ url('/') }}"> Homepage </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/search') }}"> All products </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col ml-auto my-auto">
                                <p>© Copyright 2020 Key Share. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </body>
</html>