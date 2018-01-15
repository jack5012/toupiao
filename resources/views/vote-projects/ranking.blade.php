<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投票排行榜</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="{{ asset('/css/mui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icons-extra.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/mescroll.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/mescroll-option.css') }}">

    <style>
        body{
            background-color: #fff;
        }
        .mui-table-view-cell {
            position: relative;
            overflow: hidden;
            padding: 14px 15px;
            -webkit-touch-callout: none;
            margin-bottom: 10px;
            background-color: #f8f8f8;
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
        .mui-bar-tab .mui-tab-item.mui-active {
            color: #00B0F0;
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
<div class="mescroll"  id="mescroll">
    <p class="title">投票排行榜</p>
    <div class="mui-content" style="background-color: #fff;">
        <div class="margin: 10px 0 0 0">
            <div class="m xiala" style="overflow: visible;z-index: 0;">
                <div class="">
                    <ul id="dataList" class="mui-table-view mui-unfold dataList">
                        <!--<li class="mui-table-view-cell mui-collapse mui-media mui-media-icon">
                            <a href="details.html" class="mui-row">
                                <div class="mui-col-xs-2 mui-col-sm-2 margin">
                                    <span class="mui-badge " style="font-size:14px;margin-right:4px;">1</span>
                                </div>
                                <div class="mui-col-xs-6 mui-col-sm-6">
                                    <div class="mui-media-object mui-pull-left">
                                        <img src="./img/2.jpg">
                                    </div>
                                    <div class="mui-media-body mui-ellipsis">
                                        新奶奶快乐新奶奶快乐新奶奶快乐新奶奶快乐新奶奶快乐
                                    </div>
                                </div>
                                <div class="mui-col-xs-4 mui-col-sm-4 mui-media-body blue">
                                    2314票
                                </div>
                            </a>

                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="mui-bar mui-bar-tab" style="background-color: #fff;">
        <a class="mui-tab-item mui-active" href="{{ action("VoteProjectsController@index", [ $voteProject->id ]) }}">
            <span class="mui-tab-label" style="">返回首页</span>
        </a>
    </nav>

    <script src="{{ asset('js/mui.min.js') }}"></script>
    <script src="{{ asset('js/mescroll.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/mescroll-option.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        mui('body').on('tap', 'a', function () { document.location.href = this.href; });

        $(function(){
            var sort = 0;
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
                    offset:200,
                    page:{
                        num : 0 ,
                        size : 10 ,
                        time : null
                    },
                    clearEmptyId:'dataList'
                }
            });


            function upCallback(page){
                getListDataFromNet(page.num ,function(curPageData){
                    mescroll.endBySize(curPageData.data.length, curPageData.data.total); //必传参数(当前页的数据个数, 总数据量)
                    setListData(curPageData.data, true);
                }, function(){
                    mescroll.endErr();
                });
            }

            /*设置列表数据*/
            function setListData(curPageData,isAppend){
                var listDom=document.getElementById("dataList");
                for (var i = 0; i < curPageData.length; i++) {
                    var pd=curPageData[i];
                    sort++;
                    var str='<a href="/vote-item/'+pd.id+'" class="mui-row">';
                    str+='<div class="mui-col-xs-2 mui-col-sm-2 margin"><span class="mui-badge" style="font-size:14px;margin-right:4px;">'+sort+'</span></div>';
                    str+='<div class="mui-col-xs-6 mui-col-sm-6"> <div class="mui-media-object mui-pull-left"> <img src="/uploads/'+pd.main_image+'"> </div> ';
                    str+='<div class="mui-media-body mui-ellipsis">'+pd.name+' </div></div>';
                    str+='<div class="mui-col-xs-4 mui-col-sm-4 mui-media-body blue">'+pd.voted+'票 </div></a>';

                    var liDom=document.createElement("li");
                    liDom.className = 'mui-table-view-cell mui-collapse mui-media mui-media-icon';
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
                    type: 'GET',
                    url: '{{ action("VoteProjectsController@ranking", [ $voteProject->id ]) }}',
                    data: {"page":pageNum},
//		                url: '../res/pdlist1.json?num='+pageNum+'&size='+pageSize,
                    dataType: 'json',
                    success: function(data){
                        successCallback(JSON.parse(data.voteItems));
                    },
                    error: errorCallback
                });
            }

        });
    </script>
</body>
</html>


