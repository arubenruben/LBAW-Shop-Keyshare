@extends('layouts.user')

@section('title', $user->name.' Offers')

@section('content')
    @include('partials.breadcrumbs', ['breadcrumbs' => ['/' => 'Home', '/user/'.$user->username => 'Profile'], 'active' => ['/user/'.$user->username => 'Reports']])
    @include('partials.user.navbar', ['user' => $user, 'isOwner' => true, 'active' => 'Reports'])
    @include('partials.user.reports', ['user' => $user, 'myReports' => $myReports, 'reportsAgainstMe' => $reportsAgainstMe, 'isBanned' => $isBanned])
@endsection