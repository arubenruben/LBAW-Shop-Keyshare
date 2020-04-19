@extends('layouts.user')

@section('title', $user->name.' Profile')

@section('content')
    @include('partials.breadcrumbs', ['breadcrumbs' => ['/' => 'Home'], 'active' => ['/user/'.$user->username => 'Profile']])
    @include('partials.user.navbar', ['user' => $user, 'canEdit' => $canEdit, 'active' => 'Account'])
    @if ($canEdit)
        @include('partials.user.profileAsOwner', ['user' => $user])
    @else
        @include('partials.user.profileAsGuest', ['user' => $user])
    @endif
@endsection
