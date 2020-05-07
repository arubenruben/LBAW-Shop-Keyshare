@extends('layouts.app')

@section('header')
    <header id="headerFixed" class="navbar row">
        <img class="img-fluid logo" src="{{ asset('pictures/logo/logo.png') }}" alt="Logo of KeyShare" />
    </header>
@endsection
@section('navbar')
    @include('partials.navbar.resetPasswordnavbar')
@endsection
@section('content')
    <div class="mt-auto">
        <form class="form-horizontal" action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}
        <!-- Log in Form -->
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="usernameLogIn">Username:</label>
                <div class="controls">
                    <input id="usernameLogIn" name="username" type="text"
                           class="form-control input-medium" placeholder="username" required>
                </div>
            </div>
            <!-- Password input-->
            <div class="control-group mt-4 mb-2">
                <label class="control-label" for="passwordLogIn">Password:</label>
                <div class="controls">
                    <input required="" id="passwordLogIn" name="password"
                           class="form-control input-medium" type="password" placeholder="********">
                </div>
            </div>
            <input required id="page" name="page" hidden value="{{ Request::url() }}">
            <!-- Button -->
            <div class="control-group">
                <label class="control-label" for="login"></label>
                <div class="controls text-center">
                    <button id="login" name="login" class="btn btn-lg text-light btn-orange"
                            formmethod="post">Log in</button>
                </div>
            </div>
        </form>
        <div class="text-center mt-5">
            <button id="google-signup" name="google-signup" class="btn btn-blue">
                <svg class="ml-2 float-left" viewBox="0 0 18 18" role="presentation" aria-hidden="true"
                     focusable="false" style="height: 20px; width: 20px; display: block;">
                    <g fill="none" fill-rule="evenodd">
                        <path
                                d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z"
                                fill="#EA4335"></path>
                        <path
                                d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z"
                                fill="#4285F4"></path>
                        <path
                                d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z"
                                fill="#FBBC05"></path>
                        <path
                                d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z"
                                fill="#34A853"></path>
                        <path d="M0 0h18v18H0V0z"></path>
                    </g>
                </svg>
                <span class="mx-auto">Log in with Google</span>
            </button>
        </div>
        <div class="text-center">
            <button type="button" class="btn mt-3" data-toggle="modal" data-target="#recover-password-modal" data-dismiss="modal">
                Forgot Password
            </button>
        </div>
    </div>
@endsection