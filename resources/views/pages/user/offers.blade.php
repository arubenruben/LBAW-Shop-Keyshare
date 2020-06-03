@extends('layouts.app')

@section('title', $user->username.' Offers')

@section('header')
@include('partials.header.user_header')
@endsection

<<<<<<< HEAD
@push('head')
<script src="{{ asset('js/user/offers.js') }}" defer></script>
@endpush

=======
>>>>>>> 73d64bfac17f707a4f19a2107ec71f746ee54ae0
@section('navbar')
@include('partials.navbar.profile_navbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Offers',
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