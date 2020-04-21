@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Offers','pages'=>$pages,'links'=>$links])	
@endsection

@section('content')
    @if ($isOwner)
        @include('partials.user.offersAsOwner', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @else
        @include('partials.user.offersAsGuest', ['user' => $user, 'pastOffers' => $pastOffers,
            'currOffers' => $currOffers])
    @endif
@endsection

