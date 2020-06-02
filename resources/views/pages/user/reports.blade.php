@extends('layouts.app')

@section('title', $user->username.' Reports')

@include('partials.header.user_header')

@section('navbar')
    @include('partials.navbar.profile_navbar', ['user' => $user, 'isOwner' => $isOwner,
        'active' => 'Reports','breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @include('partials.user.reports', ['user' => $user, 'myReports' => $myReports,
        'reportsAgainstMe' => $reportsAgainstMe])
    @include('partials.user.ban_appeal')
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection