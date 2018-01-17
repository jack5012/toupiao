<!DOCTYPE html>
<html lang="ch" class="feedback">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>报名</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/mui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icons-extra.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/feedback.css') }}" />
    <style>
        #slider1,#slider1 img{
            height: 220px;
        }
        .grey{color: #929292;}
        .mui-table-view .mui-table-view-cell.mui-media-icon .mui-media-object .mui-icon {
            font-size: 20px;
        }
        .mui-table-view .mui-table-view-cell.mui-media-icon .mui-media-body:after{
            height:0;
        }
        .mui-btn-block {
            font-size: 18px;
            display: block;
            width: 40%;
            margin: 0 auto;
            padding: 6px 0;
            background-color:#00B0F0;
            color: #fff;
        }
        .mui-btn-block3 {
            font-size: 18px;
            display: block;
            width: 100%;
            margin: 0 auto;
            padding: 10px 0;
            background-color:#00B0F0;
            color: #fff;
        }
        .mui-media-body{
            font-size: 15px;
            color:#333;
        }
        #inputBox{
            float: left;
            overflow: hidden;

        }
        #inputBox input{
            width: 114%;
            height: 40px;
            opacity: 0;
            cursor: pointer;
            position: absolute;
            top: 0;
            left: -14%;

        }


    </style>
</head>

<body>

<div id="slider1" class="mui-content mui-slider mui-slider1" >
    @if ($count = count($slides = $voteProject->slide))
        <div class="mui-slider-group mui-slider-loop">
            <!--额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    @php
                        $first = current($slides);
                        $end = end($slides);
                        reset($slides);
                    @endphp
                    <img src="{{ asset('uploads/'.$first) }}">
                </a>
            </div>
            @foreach ($slides as $slide)
                <div class="mui-slider-item">
                    <a href="#">
                        <img src="{{ asset('uploads/'.$slide) }}"/>
                    </a>
                </div>
        @endforeach

        <!--额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="{{ asset('uploads/'.$end) }}">
                </a>
            </div>
        </div>
        <div class="mui-slider-indicator">
            @for ($i = 0; $i < $count; $i++)
                <div class="mui-indicator {{ $i==0 ? 'mui-active' : '' }}" ></div>
            @endfor
        </div>
    @endif
</div>
<div class="mui-content">
    <ul class="mui-table-view mui-unfold" style="margin-top:0; padding:10px 0">
        <li class="mui-table-view-cell mui-media mui-media-icon">
            <a href="javascript:;">
                <div class="mui-media-object mui-pull-left"><span class="mui-icon mui-icon-extra mui-icon-extra-outline grey"></span>
                </div>
                <div class="mui-media-body">
                    <div>报名开始时间:<span>{{ $voteProject->start }}</span></div>
                    <div>报名结束时间:<span>{{ $voteProject->end }}</span></div>
                </div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-media-icon">
            <a href="javascript:;">
                <div class="mui-media-object mui-pull-left"><span class="mui-icon mui-icon-compose grey"></span>
                </div>
                <div class="mui-media-body">
                    当前报名状态：<span style="color:#dfb58f">{{$status}}</span>
                </div>
            </a>
        </li>
    </ul>
    <div style="width:100%;padding:14px 0;background-color:#fff;"><a type="button" class="mui-btn mui-btn-block" href="{{ action("VoteProjectsController@index", [ $voteProject->id ]) }}">查看竞争对手</a></div>
    <p>图片上传(可最多上传3张照片)</p>
    <form id="upBox">
        <div id="image-list" class="row image-list">
            @foreach ($voteItem->images as $v)
                <div id='imgBox'>
                    <div class="image-item" style="float:left">
                        <img title='' alt='' src='{{asset('uploads/'.$v)}}' onclick="imgDisplay(this)" style="width: 100%;height: 100%;">
                    </div>
                </div>
            @endforeach

            <div id='imgBox'></div>
            <div class="image-item space" id="inputBox">
                <input type="file" title="请选择图片" id="file" multiple="" accept="image/png,image/jpg,image/gif,image/JPEG">
                <div class="image-up"></div>
            </div>


        </div>
        <p>照片主题</p>
        <div class="mui-input-row">
            <input id='contact' type="text" name="name" class="mui-input-clear contact" placeholder="照片主题" value="{!! $voteItem->name !!}" />
        </div>
        <div class="mui-content-padded">
            <div class="mui-inline">照片主题</div>
        </div>
        <div class="row mui-input-row">
            <textarea id='question' name="desc" class="mui-input-clear question" placeholder="请详细描述你的照片...">{!! $voteItem->desc !!}</textarea>
        </div>
    </form>
    <div style="width:100%;padding:14px 10px;background-color:#fff;"><button id="btn" class="mui-btn mui-btn-blue mui-btn-block3 mui-btn-link">修改</button></div>

</div>
<script src="{{ asset('/js/mui.min.js') }}"></script>
<script src="{{ asset('/js/baoming.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    mui.init();
    mui('.mui-scroll-wrapper').scroll();

    imgUpload({
        inputId:'file', //input框id
        imgBox:'imgBox', //图片容器id
        buttonId:'btn', //提交按钮id
        upUrl:'{{url()->current()}}',  //提交地址
        data:'images', //参数名
        num:"3"//上传个数
    })

</script>
</body>

</html>