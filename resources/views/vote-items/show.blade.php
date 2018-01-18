<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $voteItem->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/mui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icons-extra.css') }}" />
    <style type="text/css">
        body{background-color: #fff;}

        #slider1,#slider1 img{
            height: 300px;
        }
        .mui-preview-image.mui-fullscreen {
            position: fixed;
            z-index: 20;
            background-color: #000;
        }
        .mui-preview-header,
        .mui-preview-footer {
            position: absolute;
            width: 100%;
            left: 0;
            z-index: 10;
        }
        .mui-preview-header {
            height: 44px;
            top: 0;
        }
        .mui-preview-footer {
            height: 50px;
            bottom: 0px;
        }
        .mui-preview-header .mui-preview-indicator {
            display: block;
            line-height: 25px;
            color: #fff;
            text-align: center;
            margin: 15px auto 4px;
            width: 70px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 12px;
            font-size: 16px;
        }
        .mui-preview-image {
            display: none;
            -webkit-animation-duration: 0.5s;
            animation-duration: 0.5s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
        .mui-preview-image.mui-preview-in {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }
        .mui-preview-image.mui-preview-out {
            background: none;
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }
        .mui-preview-image.mui-preview-out .mui-preview-header,
        .mui-preview-image.mui-preview-out .mui-preview-footer {
            display: none;
        }
        .mui-zoom-scroller {
            position: absolute;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            -webkit-backface-visibility: hidden;
        }
        .mui-zoom {
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }
        /*.mui-slider .mui-slider-group .mui-slider-item img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
        }*/
        /* .mui-android-4-1 .mui-slider .mui-slider-group .mui-slider-item img {
             width: 100%;
         }
         .mui-android-4-1 .mui-slider.mui-preview-image .mui-slider-group .mui-slider-item {
             display: inline-table;
         }
         .mui-android-4-1 .mui-slider.mui-preview-image .mui-zoom-scroller img {
             display: table-cell;
             vertical-align: middle;
         }*/
        .mui-preview-loading {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: none;
        }
        .mui-preview-loading.mui-active {
            display: block;
        }
        .mui-preview-loading .mui-spinner-white {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -25px;
            margin-top: -25px;
            height: 50px;
            width: 50px;
        }
        .mui-preview-image img.mui-transitioning {
            -webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @-webkit-keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        p img {
            max-width: 100%;
            height: auto;
        }
        .grey{color: #929292;}
        .mui-bar .mui-table-view .mui-table-view-cell .mui-active{
            color:#00B0F0;
        }
    </style>
</head>
<body>
<div class="mui-content">
    <div id="slider1" class="mui-content mui-slider mui-slider1" >
        @if ($count = count($images = $voteItem->images))
        <div class="mui-slider-group mui-slider-loop">
            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    @php
                        $first = current($images);
                        $end = end($images);
                        reset($images);
                    @endphp
                    <img src="{{ asset('uploads/'.$first) }}" data-preview-src="" data-preview-group="1">
                </a>
            </div>


                @foreach ($images as $image)
                    <div class="mui-slider-item mui-slider-item-duplicate">
                        <a href="#">
                            <img src="{{ asset('uploads/'.$image) }}" data-preview-src="" data-preview-group="1">
                        </a>
                    </div>
                @endforeach


            <!--额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->

            <div class="mui-slider-item mui-slider-item-duplicate">
                <a href="#">
                    <img src="{{ asset('uploads/'.$end) }}" data-preview-src="" data-preview-group="1">
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
    <div class="mui-content-padded" style="background-color: #fff;margin:0;padding:20px;">
        <div>
            <div class="mui-media-body mui-media-body2"><span class="mui-badge" style="font-size:14px;margin: 0 4px 10px 0;">{{ $voteItem->item_no }}</span>{{ $voteItem->name }}</div>
            <p class="">{!! $voteItem->desc !!}</p>
        </div>
    </div>
    <ul class="mui-table-view mui-grid-view mui-grid-9" style="margin-top:0;background-color: #fff;border-top:0;border-bottom: 1px solid #eee;">
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
            <a href="#" style="padding:0;">
                <span class="mui-media-body voted">{{ $voteItem->voted }}</span>
                <div class="mui-media-body">当前票数</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
            <a href="#" style="padding:0;">
                <span class="mui-media-body current_rank">{{ $counta }}</span>
                <div class="mui-media-body">当前排名</div>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
            <a href="#" style="padding:0;">
                <span class="mui-media-body current_low diff">{{ $diff }}</span>
                <div class="mui-media-body">距离上一名还差</div>
            </a>
        </li>
    </ul>
    <div class="mui-table-view-cell" style="background-color: #fff;">
        <a class=" mui-navigate-right" style="font-size:15px;color:#333;" href="{{ action("VoteProjectsController@info", [ $voteItem->voteProject->id ]) }}">
            <span class="mui-media mui-media-icon mui-icon-extra mui-icon-extra-notice grey" style="font-size:18px;"></span>
            投票须知
        </a>
    </div>
</div>
<nav class="mui-bar mui-bar-tab" style="background-color: #fff;height:auto;">
    <ul class="mui-table-view mui-grid-view mui-grid-9" style="margin-top:0;background-color: #fff;border-top:0;border-bottom: 1px solid #eee;">
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;padding:0;">
            <a href="{{ action("VoteProjectsController@index", [ $voteItem->voteProject->id ]) }}" style="padding:0;">
                <span class="mui-icon mui-icon-home" style="font-size:24px"></span>
                <span style="font-size: 15px;">首页</span>
            </a>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;padding:0;">
            <div onclick="vote({{$voteItem->id}})" style="padding:0;" class="mui-active">
                <span class="mui-icon mui-icon-extra mui-icon-extra-heart" style="font-size:24px"></span>
                <span style="font-size: 15px;">投票</span>
            </div>
        </li>
        <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;padding:0;">
            <a href="{{ action("VoteProjectsController@register", [ $voteItem->voteProject->id ]) }}" style="padding:0;">
                <span class="mui-icon mui-icon-extra mui-icon-extra-people" style="font-size:24px"></span>
                <span style="font-size: 15px;">我要参与</span>
            </a>
        </li>
    </ul>
</nav>

<script src="{{ asset('js/mui.min.js') }}"></script>
<script src="{{ asset('js/mui.zoom.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/mui.previewimage.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/layer.js') }}"></script>

<script>
    mui.previewImage();
    mui('body').on('tap', 'a', function () { document.location.href = this.href; });
    //获得slider插件对象
    var gallery = mui('.mui-slider1');
    gallery.slider({
        interval:5000//自动轮播周期，若为0则不自动播放，默认为0；
    });
    var n=0;


    function vote(id){
        $.ajax({
            type: 'POST',
            url: '/vote-item/vote',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"id": id},
//		                url: '../res/pdlist1.json?num='+pageNum+'&size='+pageSize,
            dataType: 'json',
            success: function(data){
                if(!data.error){
                   $('.voted').text(function(index, text){
                        return 1+ parseInt(text);
                    });
                    $('.diff').text(function(index, text){
                        var num = parseInt(text);
                        return num>0 ? num-1:0;
                    });
                }
                layer.open({
                    content: data.message
                    ,skin: 'msg'
                    ,time: 1 //2秒后自动关闭
                });
            },
        });
        /*if(n<2){
            num++;
            n++;
            current_num.text(num);
            layer.open({
                content: '感谢您的投票'
                ,skin: 'msg'
                ,time: 1 //2秒后自动关闭
            });
        }else{
            layer.open({
                content: '您只能投两票'
                ,skin: 'msg'
                ,time: 1 //2秒后自动关闭
            });
        }*/
    }
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo EasyWeChat::officialAccount()->jssdk->buildConfig(array('onMenuShareAppMessage','onMenuShareTimeline'), false) ?>);
    wx.ready(function(){
        wx.onMenuShareAppMessage({
            title: '{{ $voteItem->name }}', // 分享标题
            desc: '{!!  strip_tags( str_replace(PHP_EOL, ' ', $voteItem->desc))!!}', // 分享描述
            link: '{{url()->current()}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{ asset('uploads/'.$first) }}', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
// 用户确认分享后执行的回调函数
            },
            cancel: function () {
// 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareTimeline({
            title: '{{ $voteItem->name }}', // 分享标题
            link: '{{url()->current()}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{ asset('uploads/'.$first) }}', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });

</script>

</body>
</html>





