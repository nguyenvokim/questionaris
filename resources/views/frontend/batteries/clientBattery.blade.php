@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <client-battery :battery-id="{{$batteryId}}"></client-battery>
@endsection
