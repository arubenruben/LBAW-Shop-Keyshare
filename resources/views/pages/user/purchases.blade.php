@extends('layouts.app')

@section('title', $user->username.' Purchases')

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Purchases','pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.user.purchases', ['user' => $user, 'orders' => $orders])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
