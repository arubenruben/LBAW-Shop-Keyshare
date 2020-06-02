@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.user_header')

@push('head')
    <script src="{{ asset('js/user/profile.js') }}" defer></script>
    <script src="{{ asset('js/feedback/feedback.js') }}" defer></script>
@endpush

@section('navbar')
    @include('partials.navbar.profile_navbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Account',
        'breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @if ($isOwner)
        @include('partials.user.profileAsOwner', ['user' => $user])
        @include('partials.user.ban_appeal')
    @else
        @include('partials.user.profileAsGuest', ['user' => $user])
    @endif
    @include('partials.feedback.feedback', ['seller' => $user])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection