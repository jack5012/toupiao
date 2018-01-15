<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>搜索页面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="{{ asset('/css/mui.min.css') }}">
    <link href="{{ asset('/css/mui.indexedlist.css') }}" rel="stylesheet" />
    <style>
        .mui-bar {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        body{
            padding: 15px;
            background-color: #fff;
        }
        .mui-table-view-cell {
            position: relative;
            overflow: hidden;
            padding: 10px 15px;
            -webkit-touch-callout: none;
            margin-bottom: 10px;
        }
        .mui-table-view-cell .mui-badge{
            position: static;
            top: 50%;
            left: 15px;
            -webkit-transform: translateY(0);
            transform: translateY(0);
            background-color: #efeff4;
            color: #555;

        }
        .mui-table-view-cell:after{
            height:0;
        }
        .mui-table-view.mui-unfold .mui-table-view-cell.mui-media-icon.mui-collapse .mui-media-body:after{
            height:0;
        }
        .mui-table-view .mui-table-view-cell .mui-media-body{
            font-size: 15px;
            color: #333;
            line-height: 40px;
        }
        .mui-table-view .mui-table-view-cell .mui-media-body.blue{
            color:#00B0F0;
            text-align: right;
        }
        .mui-table-view .mui-table-view-cell.mui-media-icon .mui-media-object img{
            line-height: 40px;
            max-width: 40px;
            height: 40px;
        }
        .mui-table-view .mui-table-view-cell.mui-media-icon .mui-media-object {
            line-height: 40px;
            max-width: 40px;
            height: 40px;
            margin: 0;}
        .margin{
            margin-top: 9px;
        }
        .mui-btn{
            border:0;
            padding: 0 10px;
            height: 20px;
            line-height: 20px;
            margin-top: 7px;
        }
        .mui-search .mui-placeholder{
            font-size: 14px;
        }
        .mui-indexed-list{
            background-color: #fff;
            border: 0;
        }

    </style>
</head>
<body>

<div class="">
    <div id='list' class="mui-indexed-list" style="height:auto">
        <form action="{{ url()->current() }}" method="post">
            {{ csrf_field() }}
        <div class="mui-row">

            <div class="mui-input-row mui-search mui-col-xs-8 mui-col-sm-8" style="height:34px;line-height:34px;">

                <input type="search" name="search_txt" class="mui-input-clear mui-indexed-list-search-input" placeholder="搜索选项编号或名称" style="line-height: 34px;height: 34px;margin-bottom:0;background-color: #f8f8f8">

            </div>

            <div class="mui-col-xs-4 mui-col-sm-4 btn-box">
               <input type="submit" value="搜索" class="submit mui-btn" style=" margin-top: 7px;line-height: 20px;height: 20px;padding:0 10px;border:none;border-right: 1px solid #eee; color:#00B0F0;background-color: #fff;">
                <a class="mui-btn" href="{{ action("VoteProjectsController@index", [ $voteProject->id ]) }}">取消</a>
            </div>
        </div>
        </form>

        <div class="mui-indexed-list-alert"></div>
        <div class="mui-indexed-list-inner" style="background-color: #fff">
            @if (count($voteItems))

                <ul class="mui-table-view mui-unfold">
                    @foreach ($voteItems as $voteItem)
                        <li data-value="1" class="mui-table-view-cell mui-collapse mui-media mui-media-icon">
                            <a href="{{ action('VoteItemsController@show',[$voteItem->id]) }}" class="mui-row">
                                <div class="mui-col-xs-2 mui-col-sm-2 margin">
                                    <span class="mui-badge " style="font-size:14px;margin-right:4px;">{{ $voteItem->id }}</span>
                                </div>
                                <div class="mui-col-xs-6 mui-col-sm-6">
                                    <div class="mui-media-object mui-pull-left">
                                        <img src="{{ asset('uploads/'.$voteItem->main_image) }}"/>
                                    </div>
                                    <div class="mui-media-body mui-ellipsis">
                                        {{ $voteItem->name }}
                                    </div>
                                </div>
                                <div class="mui-col-xs-4 mui-col-sm-4 mui-media-body blue">
                                    {{ $voteItem->voted }}票
                                </div>
                            </a>

                        </li>
                    @endforeach

                </ul>

            @else
                <div class="mui-indexed-list-empty-alert" style="display: block">没有数据</div>
            @endif
            @if (count($errors) > 0)
                <div class="mui-indexed-list-empty-alert" style="display: block">{{$errors->first('search_txt')}}</div>
            @endif

        </div>
    </div>
</div>

<script src="{{ asset('/js/mui.min.js') }}"></script>
<script>
    mui('body').on('tap', 'a', function () { document.location.href = this.href; });
</script>

</body>
</html>

{{--
@if (count($voteItems))
    @foreach ($voteItems as $voteItem)
        <p> {{ $voteItem->main_image }}</p>
        <p> {{ $voteItem->name }}</p>
        <p> {{ $voteItem->desc }}</p>
        <p> {{ $voteItem->voted }}</p>
    @endforeach
@else
    没有找到匹配的搜索结果！
@endif--}}
