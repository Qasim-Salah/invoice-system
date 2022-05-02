<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Invoice system">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title> @yield('title') </title>
    @include('layouts.includes.head-css')
</head>

<body class="main-body app sidebar-mini">
<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
@include('layouts.includes.main-sidebar')
<!-- main-content -->
<div class="main-content app-content">
@include('layouts.includes.main-header')
<!-- container -->
    <div class="container-fluid">
        @yield('content')

        @include('layouts.includes.footer')

        @include('layouts.includes.script')
    </div>
</div>
</body>
</html>
