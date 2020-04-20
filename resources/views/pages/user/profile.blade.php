
@extends('layouts.user')

@section('title', $user->username.' Profile')

@section('content')
    @include('partials.breadcrumbs', ['breadcrumbs' => ['/' => 'Home'], 'active' => ['/user/'.$user->username => 'Profile']])
    @include('partials.user.navbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Account'])
    @if ($isOwner)
        @include('partials.user.profileAsOwner', ['user' => $user])
    @else
        @include('partials.user.profileAsGuest', ['user' => $user])
    @endif
@endsection
