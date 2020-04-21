@extends('layouts.app')

@section('title', $user->username.' Profile')

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Account','pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.user.purchases', ['user' => $user, 'orders' => $orders])
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection
