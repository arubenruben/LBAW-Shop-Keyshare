@extends('layouts.app')

@section('header')
    <header id="headerFixed" class="navbar row">
        <img class="img-fluid logo" src="{{ asset('pictures/logo/logo.png') }}" alt="Logo of KeyShare" />
    </header>
@endsection
@section('navbar')
    @include('partials.navbar.reset_password_navbar')
@endsection
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="submit" class="btn text-light btn-orange mt-3" value="Send me a recovery email">
            </div>
        </div>
    </form>
@endsection