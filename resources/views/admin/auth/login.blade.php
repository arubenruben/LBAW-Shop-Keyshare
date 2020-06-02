@extends('layouts.admin')

@section('content')
<div class="row justify-content-center vh-100">
    <div class="col-12 col-sm-10 col-md-5 col-lg-5 p-4 my-auto" style="background-color: white; border-radius: 5px;">
        <div class="row">
            <div class="col text-center mb-4">
                <h4> Administrator Login </h4>
            </div>
        </div>
        <div class="row">
            <div class="col text-center ">
                <img class="img-fluid logo " src={{ asset('/pictures/logo/logo.png') }} />
            </div>
        </div>
        <form class="form-horizontal mt-5" action={{url('admin/login')}} method="POST">
            @csrf
            <!-- Sign In Form -->
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label" for="username">Username:</label>
                <div class="controls">
                    <input required id="username" name="username" type="text" class="form-control"
                        placeholder="username" class="input-medium" required="">
                </div>
            </div>
            <div class="control-group mt-4 mb-2">
                <label class="control-label" for="passwordLogIn">Password:</label>
                <div class="controls">
                    <input required="" id="passwordLogIn" name="password"
                        class="form-control input-medium @error('password') is-invalid @enderror" type="password"
                        placeholder="********">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <!-- Button -->
            <div class="control-group">
                <label class="control-label" for="signin"></label>
                <div class="controls text-center">
                    <input type="submit" class="btn text-light btn-orange" role="button" value="Sign In">
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection