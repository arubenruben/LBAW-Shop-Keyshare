@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Offers', 'pages'=>$pages, 'links'=>$links])
@endsection

@section('javascript')
    <script src="{{ asset('js/user/offers.js') }}" defer></script>
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
