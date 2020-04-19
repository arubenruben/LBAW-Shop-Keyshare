@extends('layouts.user')

@section('title', $user->name.' Offers')

@section('content')
    @include('partials.breadcrumbs', ['breadcrumbs' => ['/' => 'Home', '/user/'.$user->username => 'Profile'], 'active' => ['/user/'.$user->username => 'Offers']])
    @include('partials.user.navbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Offers'])
    @if ($isOwner)
        @include('partials.user.offersAsOwner', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @else
        @include('partials.user.offersAsGuest', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @endif
@endsection

