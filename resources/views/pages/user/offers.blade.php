@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.userheader')

@push('head')
    <script src="{{ asset('js/user/offers.js') }}" defer></script>
@endpush

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Offers',
        'breadcrumbs'=> $breadcrumbs])
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

@section('footer')
    @include('partials.footer.footer')
@endsection