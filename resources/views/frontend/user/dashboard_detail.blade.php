@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <user-dashboard client-id="{{$clientId}}" test-id="{{$testId}}"></user-dashboard>
@endsection
