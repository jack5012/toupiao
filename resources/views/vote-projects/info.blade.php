<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>活动介绍</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="{{ asset('/css/mui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icons-extra.css') }}" />
    <style type="text/css">
        body,.mui-content{
            background-color: #fff;
        }
        .mui-content{
           padding:0 15px;
        }
        .title {
            font-size: 17px;
            font-weight: 500;
            line-height: 44px;
            display: block;
            width: 100%;
            margin: 0 -10px;
            padding: 0;
            text-align: center;
            white-space: nowrap;
            color: #000;}
    </style>
</head>
<body>
<div class="mui-content">
    <p class="title">活动介绍</p>
   {!! $voteProject->desc !!}
</div>
</body>
</html>