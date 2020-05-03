
@extends('layouts.app')

@section('title', $user->username.' Reports')

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.profilenavbar', ['user' => $user, 'isOwner' => $isOwner, 'active' => 'Reports','pages'=>$pages,'links'=>$links])
@endsection

@section('content')
    @include('partials.user.reports', ['user' => $user, 'myReports' => $myReports, 'reportsAgainstMe' => $reportsAgainstMe])
@endsection

@section('footer')
    @include('partials.footer.footer')
@endsection
