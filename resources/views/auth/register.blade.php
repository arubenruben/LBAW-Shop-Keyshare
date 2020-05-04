@extends('layouts.app')

@section('header')
    <header id="headerFixed" class="navbar row">
        <img class="img-fluid logo" src="{{ asset('images/logo/logo.png') }}" alt="Logo of KeyShare" />
    </header>
@endsection
@section('navbar')
    @include('partials.navbar.resetPasswordnavbar')
@endsection
@section('content')
    <div class="mt-auto">
        <form class="form-horizontal" action="{{ url('/register') }}" method="post">
        @csrf
        <!-- Sign Up Form -->
            <!-- Username -->
            <div class="control-group">
                <label class="control-label" for="usernameSignUp">Username:</label>
                <div class="controls">
                    <input id="usernameSignUp" name="username" type="text" class="form-control input-medium" placeholder="username"
                           required>
                </div>
            </div>
            <!-- Email -->
            <div class="control-group mt-2">
                <label class="control-label" for="email">Email:</label>
                <div class="controls">
                    <input id="email" name="email" type="text" class="form-control input-medium" placeholder="youremail@example.com"
                           required>
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
                    <input id="passwordSignUp" name="password" class="form-control input-medium" type="password"
                           placeholder="********" required>
                </div>
            </div>
            <!-- Confirm Password input-->
            <div class="control-group">
                <label class="control-label" for="password_confirmation">Re-Enter Password:</label>
                <div class="controls">
                    <input id="password_confirmation" class="form-control input-large" name="password_confirmation" type="password"
                           placeholder="********" required>
                </div>
            </div>
            <!-- Button -->
            <div class="control-group">
                <label class="control-label" for="confirmsignup"></label>
                <div class="controls text-center">
                    <button id="confirmsignup" class="btn text-light btn-orange btn-lg" formmethod="post">Sign
                        Up</button>
                </div>
            </div>
        </form>
    </div>
@endsection