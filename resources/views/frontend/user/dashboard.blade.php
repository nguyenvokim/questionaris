@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <router-view></router-view>
@endsection

@prepend('before-scripts')
    <script>
        var useVueRoute = true;
    </script>
@endprepend
