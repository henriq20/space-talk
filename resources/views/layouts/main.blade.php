<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/utilities.css">
    <link rel="stylesheet" href="/css/mobile.css" media="screen and (max-width: 980px)">
    <script src="/js/main.js" defer></script>
    <script src="https://kit.fontawesome.com/c95e24b655.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    @include('inc.flash-message')
    @yield('content')
</body>
</html>