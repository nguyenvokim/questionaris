@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <recent-finished-test></recent-finished-test>
    <user-dashboard></user-dashboard>
@endsection
