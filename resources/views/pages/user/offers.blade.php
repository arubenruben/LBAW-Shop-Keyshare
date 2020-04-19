@extends('layouts.user')

@section('title', $user->name.' Offers')

@section('content')
    @include('partials.breadcrumbs', ['breadcrumbs' => ['/' => 'Home'], 'active' => ['/user/'.$user->username => 'Offers']])
    @include('partials.user.navbar', ['user' => $user, 'canEdit' => $canEdit, 'active' => 'Account'])
    @if ($canEdit)
        @include('partials.user.offersAsOwner', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @else
        @include('partials.user.offersAsGuest', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @endif
@endsection

