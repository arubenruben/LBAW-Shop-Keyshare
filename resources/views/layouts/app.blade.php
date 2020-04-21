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
        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}" defer></script>
        <script src="{{ asset('popper/popper.min.js') }}" defer></script>
        <script src="{{ asset('js/activate_popovers.js') }}" defer></script>
{{--
        <script src="{{ asset('js/progress_bar.js') }}" defer></script>
        <script src="{{ asset('js/progress_bar_draw.js') }}" defer></script>
--}}
    </head>
    <body>
      <main>
        <header> 
          @yield('header')
        </header>
        <div id="wrapper">
          @yield('navbar')
          <section id="content" class="container mt-5">
            @yield('content')
          </section>
          <footer id="footerGeneric">
            @yield('footer')
          </footer>
        </div>
      </main>
    </body>
</html>