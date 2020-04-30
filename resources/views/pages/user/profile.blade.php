@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.userheader')


@section('javascript')
    <script src="{{ asset('js/user/profile.js') }}" defer></script>
@endsection


@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Account', 'breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @if ($isOwner)
        @include('partials.user.profileAsOwner', ['user' => $user])
    @else
        @include('partials.user.profileAsGuest', ['user' => $user])
    @endif
    @include('partials.feedback', ['user' => $user])
@endsection

@section('footer')
	@include('partials.footer.userfooter')	
@endsection


