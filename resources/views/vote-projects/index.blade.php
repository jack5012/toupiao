<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$voteProject->name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/mui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icons-extra.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/mescroll.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mescroll-option.css') }}">

    <style>
        .mui-control-content {
            background-color: white;
            /*min-height: 215px;*/
        }
        .mui-control-content .mui-loading {
            margin-top: 50px;
        }
        #slider1,#slider1 img{
            height: 220px;
        }
        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body.blue{
            color:#00B0F0;
        }
        .mui-search .mui-placeholder{
            line-height: 40px;
        }
        .mui-grid-view.mui-grid-9 .mui-media .mui-icon{
            font-size:1.4rem;
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
        .mui-btn-block2 {
            font-size: 14px;
            display: block;
            width: 100%;
            margin: 0 auto;
            padding: 6px 0;
            background-color:#00B0F0;
            color: #fff;
        }
        .mui-segmented-control.mui-segmented-control-inverted~.mui-slider-progress-bar{
            background-color:#00B0F0;
        }
        .mui-segmented-control.mui-segmented-control-inverted .mui-control-item.mui-active{
            color:#00B0F0;

        }
        .mui-slider .mui-segmented-control.mui-segmented-control-inverted .mui-control-item.mui-active {
            border-bottom: 2px solid #00B0F0;
        }
        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-object{
            height: 140px;
        }
        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body2{
            background-color:#f8f8f8;text-align:left;height:34px;line-height:34px;padding:0 4px;margin-top:0;
        }
        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body3{
            background-color:#f8f8f8;height:30px;line-height:30px;padding:0 4px;margin-top:0;
        }
        .mui-bar-tab .mui-tab-item.mui-active {
            color: #00B0F0;
        }
    </style>
</head>

<body>
<div id="mescroll"  class=" mescroll">
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

    <div class="mui-content" style="">
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="margin-top:0;background-color: #fff">
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
                <a href="#" style="padding:0;">
                    <span class="mui-media-body blue">{{ $voteProject->involved }}</span>
                    <div class="mui-media-body">参与选手</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
                <a href="#" style="padding:0;">
                    <span class="mui-media-body blue voted">{{ $voteProject->voted }}</span>
                    <div class="mui-media-body">累计投票</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-4" style="border-bottom:none;">
                <a href="#" style="padding:0;">
                    <span class="mui-media-body blue"> {{ $voteProject->visitd }}</span>
                    <div class="mui-media-body">访问量</div>
                </a>
            </li>
        </ul>
        <div class="mui-content-padded" style="margin: 10px 0 0 0;">
            <div class="mui-input-row mui-search" style="line-height:40px;">
                <input type="search" class="mui-input-clear" placeholder="搜索选项编号或名称" style="height: 40px;border-radius:0;background-color:#fff;margin-bottom:0;">
            </div>
        </div>
        <ul class="mui-table-view mui-grid-view mui-grid-9" style="margin-top:0;border:0;">
            <li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3" style="border:none;background-color:#f0f0f0">
                <a href="{{ action("VoteProjectsController@info", [ $voteProject->id ]) }}" style="padding:0;">
                    <span class="mui-icon mui-icon-help" style="color:#00B0F0;"></span>
                    <div class="mui-media-body blue">活动介绍</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-9 mui-col-sm-9" style="border:none;background-color:#f8f8f8;">
                <a href="#" style="padding:0;">
                    <span class="mui-media-body">距离活动截止还有</span>
                    <div class="mui-media-body">
                        <span id="day_show">0天</span>
                        <span id="hour_show">0时</span>
                        <span id="minute_show">0分</span>
                        <span id="second_show">0秒</span>
                    </div>
                </a>
            </li>
        </ul>
        @if($voteProject->voteItem->isEmpty())
        <div style="width:100%;padding:14px 0;background-color:#fff;"><a type="button" class="mui-btn mui-btn-block" href="{{ action("VoteProjectsController@register", [ $voteProject->id ]) }}">我要报名</a></div>
        @elseif($voteProject->voteItem->first()->status ==1 )
            <div style="width:100%;padding:14px 0;background-color:#fff;"><a type="button" class="mui-btn mui-btn-block" href="{{ action("VoteItemsController@show", [ $voteProject->voteItem->first()->id ]) }}">我的报名</a></div>
        @endif

        <div style="margin: 10px 0 0 0">
            <div id="slider" class="mui-slider tab1">
                <div  class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted " style="background-color:#fff;height:40px;">
                    <div class="tabBox" style="width:100%;">
                        <div class="mui-control-item mui-active" i="default">
                            默认排序
                        </div>
                        <div class="mui-control-item" i="time">
                            最新参与
                        </div>
                        <div class="mui-control-item" i="voted">
                            人气排行
                        </div>
                    </div>
                </div>
                <div class="mui-slider-group" style="height:auto">
                    <div id="item1mobile" class="mui-slider-item mui-control-content mui-active">
                        <div class="xiala">
                            <div class="">
                                <ul id="dataList" class="mui-table-view mui-grid-view la data-list">
                                   {{-- @if (count($voteItems))
                                        @foreach ($voteItems as $voteItem)
                                            <li class="mui-table-view-cell mui-media mui-col-xs-6">
                                                <div>
                                                    <a href="details.html"><img class="mui-media-object" src="{{ asset($voteItem->main_image) }}"></a>
                                                    <div class="mui-media-body mui-media-body2">
                                                        <span class="mui-badge" style="font-size:14px;margin-right:4px;">{{ $voteItem->id }}</span>
                                                        {{ $voteItem->name }}
                                                    </div>
                                                    <div style="width:100%;padding:0 4px;background-color:#f8f8f8;"class="voteBox">
                                                        <span type="button" class="mui-btn mui-btn-block mui-btn-block2" onclick="vote(this)">我要投票<i style="display:none">0</i></span>
                                                    </div>
                                                    <div class="mui-media-body mui-media-body3 blue num"><span>{{ $voteItem->voted }}</span>票</div></div>
                                            </li>
                                        @endforeach
                                    @endif--}}
                                </ul>
                            </div>
                            <div id="empty_id"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="mui-bar mui-bar-tab" style="background-color: #fff;">
    <a class="mui-tab-item mui-active" href="{{ action("VoteProjectsController@index", [ $voteProject->id ]) }}">
        <span class="mui-icon mui-icon-home"></span>
        <span class="mui-tab-label">首页</span>
    </a>
    <a class="mui-tab-item" href="{{ action("VoteProjectsController@ranking", [ $voteProject->id ]) }}">
        <span class="mui-icon mui-icon-extra mui-icon-extra-rank"></span>
        <span class="mui-tab-label">排行</span>
    </a>
    <a class="mui-tab-item" href="{{ action("VoteProjectsController@search", [ $voteProject->id ]) }}">
        <span class="mui-icon mui-icon-search"></span>
        <span class="mui-tab-label">搜索</span>
    </a>
    <a class="mui-tab-item" href="{{ action("VoteProjectsController@register", [ $voteProject->id ]) }}" target="_blank">
        <span class="mui-icon mui-icon-compose"></span>
        <span class="mui-tab-label">报名</span>
    </a>
</nav>
<script src="{{ asset('js/mui.min.js') }}"></script>
<script src="{{ asset('js/mescroll.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/mescroll-option.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('js/layer.js') }}"></script>
<script type="text/javascript" charset="utf-8">
    mui('body').on('tap', 'a', function () { document.location.href = this.href; });
    //获得slider插件对象
    var gallery = mui('.mui-slider1');
    gallery.slider({
        interval:5000//自动轮播周期，若为0则不自动播放，默认为0；
    });

    $(function(){
        //创建MeScroll对象
        var mescroll = initMeScroll("mescroll", {
            down:{
                use : false,
                auto:false,//是否在初始化完毕之后自动执行下拉回调callback; 默认true
            },
            up: {
                auto:true,//初始化完毕,是否自动触发上拉加载的回调
                isBoth: false, //上拉加载时,如果滑动到列表顶部是否可以同时触发下拉刷新;默认false,两者不可同时触发; 这里为了演示改为true,不必等列表加载完毕才可下拉;
                callback: upCallback, //上拉加载的回调
                isBounce: false, //此处禁止ios回弹,解析(务必认真阅读,特别是最后一点): http://www.mescroll.com/qa.html#q10
                toTop:{ //配置回到顶部按钮
                    src : "{{asset('images/mescroll-totop.png')}}", //默认滚动到1000px显示,可配置offset修改
                    //offset : 1000
                },
                offset:500,
                page:{
                    num : 0 ,
                    size : 10 ,
                    time : null
                },
                clearEmptyId:'dataList'
            }
        });
        var pdType='default';

        mui('.tabBox').on('tap', 'div', function(){
            var i=$(this).attr("i");
            if(pdType!=i) {
                //更改列表条件
                pdType=i;
                $(".tabBox .mui-active").removeClass("mui-active");
                $(this).addClass("mui-active");
                //重置列表数据
                mescroll.resetUpScroll();
            }
        })

        function upCallback(page){
            getListDataFromNet(page.num ,function(curPageData){
                mescroll.endBySize(curPageData.data.length, curPageData.data.total); //必传参数(当前页的数据个数, 总数据量)
                setListData(curPageData.data, true);
            }, function(){
                mescroll.endErr();
            });
        }

        function setListData(curPageData,isAppend){
            var listDom=document.getElementById("dataList");
            for (var i = 0; i < curPageData.length; i++) {
                var pd=curPageData[i];

                var str=' <div> <a href="/vote-item/'+pd.id+'"><img class="mui-media-object" src="/uploads/'+pd.main_image+'"></a>';
                str+='<div class="mui-media-body mui-media-body2"><span class="mui-badge" style="font-size:14px;margin-right:4px;">'+pd.item_no+'</span>'+pd.name+'</div>';
                str+='<div style="width:100%;padding:0 4px;background-color:#f8f8f8;"class="voteBox"><span type="button" class="mui-btn mui-btn-block mui-btn-block2" onclick="vote('+pd.id+',$(this))">我要投票</span></div>';
                str+='<div class="mui-media-body mui-media-body3 blue num"><span>'+pd.voted+'</span>票</div></div>';

                var liDom=document.createElement("li");
                liDom.className = 'mui-table-view-cell mui-media mui-col-xs-6';
                liDom.innerHTML=str;

                if (isAppend) {
                    listDom.appendChild(liDom);//加在列表的后面,上拉加载
                } else{
                    listDom.insertBefore(liDom, listDom.firstChild);//加在列表的前面,下拉刷新
                }
            }
        }

        /*联网加载列表数据
         在您的实际项目中,请参考官方写法: http://www.mescroll.com/api.html#tagUpCallback
         请忽略getListDataFromNet的逻辑,这里仅仅是在本地模拟分页数据,本地演示用
         实际项目以您服务器接口返回的数据为准,无需本地处理分页.
         * */
        function getListDataFromNet(pageNum,successCallback,errorCallback) {
            $.ajax({
                type: 'POST',
                url: '{{ url("vote-project", [ $voteProject->id ]) }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {"sortBy": pdType,"page":pageNum},
//		                url: '../res/pdlist1.json?num='+pageNum+'&size='+pageSize,
                dataType: 'json',
                success: function(data){
                    successCallback(JSON.parse(data.voteItems));
                },
                error: errorCallback
            });

        }

    });

    function vote(id,that){
        $.ajax({
            type: 'POST',
            url: '/vote-item/vote',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"id": id},
            dataType: 'json',
            success: function(data){
                if(!data.error){
                    that.parent('.voteBox').siblings('.num').find("span").text(function(index, text){
                        return 1+ parseInt(text);
                    });
                    $('.voted').text(function(index, text){
                        return 1+ parseInt(text);
                    });
                }
                layer.open({
                    content: data.message
                    ,skin: 'msg'
                    ,time: 1 //2秒后自动关闭
                });
            },
        });
    }
</script>
<script type="text/javascript">
    var intDiff = parseInt(1123200);//倒计时总秒数量
    function timer(intDiff){
        window.setInterval(function(){
            var day=0,
                hour=0,
                minute=0,
                second=0;//时间默认值
            if(intDiff > 0){
                day = Math.floor(intDiff / (60 * 60 * 24));
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            $('#day_show').html(day+"天");
            $('#hour_show').html('<s id="h"></s>'+hour+'时');
            $('#minute_show').html('<s></s>'+minute+'分');
            $('#second_show').html('<s></s>'+second+'秒');
            intDiff--;
        }, 1000);
    }
    $(function(){
        timer(intDiff);
    });
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo EasyWeChat::officialAccount()->jssdk->buildConfig(array('onMenuShareAppMessage'), false) ?>);
    wx.onMenuShareAppMessage({
        title: '{!! $voteProject->name !!}', // 分享标题
        desc: '{!! $voteProject->desc !!}', // 分享描述
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
</script>

</body>

</html>




