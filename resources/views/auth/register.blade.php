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
    <form class="form-horizontal" action="{{ url('/register') }}" method="post">
        @csrf
        <div class="control-group">
            <label class="control-label" for="usernameSignUp">Username:</label>
            <div class="controls">
                <input id="usernameSignUp" name="username" type="text"
                    class="form-control input-medium @error('username') is-invalid @enderror" placeholder="username"
                    required>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="control-group mt-2">
            <label class="control-label" for="email">Email:</label>
            <div class="controls">
                <input id="email" name="email" type="text"
                    class="form-control input-medium @error('email') is-invalid @enderror"
                    placeholder="youremail@example.com" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="control-group mt-2">
            <label class="control-label" for="birthDate">Date of birth:</label>
            <div class="controls">
                <input id="birthDate" name="birthDate" type="date"
                    class="form-control input-medium @error('birthDate') is-invalid @enderror" required>
                @error('birthDate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="control-group mt-4 mb-2">
            <label class="control-label" for="passwordSignUp">Password:</label>
            <div class="controls">
                <input id="passwordSignUp" name="password"
                    class="form-control input-medium @error('password') is-invalid @enderror" type="password"
                    placeholder="********" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password_confirmation">Re-Enter Password:</label>
            <div class="controls">
                <input id="password_confirmation"
                    class="form-control input-large @error('password') is-invalid @enderror "
                    name="password_confirmation" type="password" placeholder="********" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="confirmsignup"></label>
            <div class="controls text-center">
                <button id="confirmsignup" class="btn text-light btn-orange btn-lg" formmethod="post">Sign Up</button>
            </div>
        </div>
    </form>
</div>
@endsection