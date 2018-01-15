<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title></title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layer.css') }}">
    <script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ URL::asset('js/layer.js') }}"></script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
