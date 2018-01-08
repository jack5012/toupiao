@if (count($slides = $voteProject->slide))
    @foreach ($slides as $slide)
        <p>滚动图 {{ $slide }}</p>
    @endforeach
@endif
{{ $voteProject->start }}
{{ $voteProject->end }}
@if (count($voteItems = $voteProject->voteItem))
    @foreach ($voteItems as $voteItem)
        <p> {{ $voteItem->main_image }}</p>
        <p> {{ $voteItem->name }}</p>
        <p> {{ $voteItem->desc }}</p>
        <p> {{ $voteItem->voted }}</p>
    @endforeach
@else
    我没有任何记录！
@endif
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
<form class="form-horizontal" action="{{ URL('/admin/banner/create') }}" method="POST" enctype="multipart/form-data" class="banner-upload">

    {{ csrf_field() }}

    <div class="box-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">主题</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="" name="theme" placeholder="设置轮播主题">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <input type="radio" value="1" name="status">启用
                <input type="radio" value="0" name="status">禁用
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">上传图片</label>
            <div class="col-sm-10">
                <input type="file" name="photo" value="" placeholder="">

                <div class="img-wrap">
                    <img src="" alt="">
                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <button type="submit" class="btn btn-info pull-right" id="img-upload">提交</button>
    </div>
</form>
<script type="text/javascript">
    $("#img-upload").on('submit',function(e){
        e.preventDefault();
        var formData = new FormData($(".banner-upload"));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/banner/create' ,
            data: formData ,
            processData:false,
            //mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            success:function(data){
                console.log(data);
                if(data.status){
                    console.log(data.message);
                }
            },
            error:function(err){
                console.log(err);
            }
        });
</script>