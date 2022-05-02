<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Description" content="Invoice system">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    @include('layouts.includes.head-css')
</head>

<body class="main-body bg-primary-transparent">
<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
@yield('content')

@include('layouts.includes.script')
</body>
</html>
