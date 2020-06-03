@extends('layouts.app')

@section('title', $user->username.' Purchases')

@push('head')
<script src="{{ asset('js/user/purchases_min.js') }}" defer></script>
@endpush

@include('partials.header.user_header')

@section('navbar')
@include('partials.navbar.profile_navbar', ['user' => $user, 'isOwner' => $isOwner,
'active' =>'Purchases','breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
@include('partials.user.purchases', ['user' => $user, 'orders' => $orders])
@endsection

@section('footer')
@include('partials.footer.footer')
@endsection