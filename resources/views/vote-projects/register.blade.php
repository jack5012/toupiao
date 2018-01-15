<!DOCTYPE html>
<html lang="ch" class="feedback">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
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
                    当前报名状态：<span style="color:#dfb58f">还未报名</span>
                </div>
            </a>
        </li>
    </ul>
    <div style="width:100%;padding:14px 0;background-color:#fff;"><a type="button" class="mui-btn mui-btn-block" href="{{ action("VoteProjectsController@index", [ $voteProject->id ]) }}">查看竞争对手</a></div>
    <p>图片上传(可最多上传3张照片)</p>
    <div id='image-list' class="row image-list">

    </div>

    <p>图片主题</p>
    <div class="mui-input-row">
        <input id='contact' type="text" name="name" class="mui-input-clear contact" placeholder="" />
    </div>
    <div class="mui-content-padded">
        <div class="mui-inline">图片介绍</div>
        {{--<a class="mui-pull-right mui-inline" href="#popover">
            快捷输入
            <span class="mui-icon mui-icon-arrowdown"></span>
        </a>--}}
        <!--快捷输入具体内容，开发者可自己替换常用语-->
        <div id="popover" class="mui-popover">
            <div class="mui-popover-arrow"></div>
            <div class="mui-scroll-wrapper">
                <div class="mui-scroll">
                    <ul class="mui-table-view">
                        <!--仅流应用环境下显示-->
                        <li class="mui-table-view-cell stream">
                            <a href="#"></a>
                        </li>
                        <li class="mui-table-view-cell"><a href="#">快乐</a></li>
                        <li class="mui-table-view-cell"><a href="#">拍拍手</a></li>
                        <li class="mui-table-view-cell"><a href="#">hello</a></li>
                        <li class="mui-table-view-cell"><a href="#">哟西</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="row mui-input-row">
        <textarea id='question' name="desc" class="mui-input-clear question" placeholder="请填写你的简单描述..."></textarea>
    </div>

    <div style="width:100%;padding:14px 10px;background-color:#fff;"><button id="submit" class="mui-btn mui-btn-blue mui-btn-block3 mui-btn-link">立即报名</button></div>

</div>
<script src="{{ asset('/js/mui.min.js') }}"></script>
<script src="{{ asset('/js/feedback.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    mui.init();
    mui('.mui-scroll-wrapper').scroll();
</script>
</body>

</html>
<script type="text/javascript">
    $(".form-horizontal").on('submit',function(e) {
        e.preventDefault();
        var formData = new FormData($(".form-horizontal")[0]);
        console.log(formData)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/vote-project/1/register',
            data: formData,
            processData: false,
            //mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            success: function (data) {
                console.log(1);

            },
            error: function (error) {
               console.log(error)
            }
        });
    })
</script>