/**
 * Created by houlingyun on 2018/1/16.
 */
var imgSrc = []; //图片链接
var imgFile = []; //文件
var imgName = []; //图片名称

function imgUpload(obj) {
    var oInput = '#' + obj.inputId;
    var imgBox = '#' + obj.imgBox;
    var btn = '#' + obj.buttonId;
    $(oInput).on("change", function() {
        var fileImg = $(oInput)[0];
        var fileList = fileImg.files;
        for(var i = 0; i < fileList.length; i++) {
            var imgSrcI = getObjectURL(fileList[i]);
            imgName.push(fileList[i].name);
            imgSrc.push(imgSrcI);
            imgFile.push(fileList[i]);
        }
        addNewContent(imgBox);
    })
    $(btn).on('click', function() {
        if(!limitNum(obj.num)){
            alert("只可以上传三个图片");
            return false;
        }

        var fd = new FormData($('#upBox')[0]);
        for(var i=0;i<imgFile.length;i++){
            fd.append(obj.data+"[]",imgFile[i]);
        }
        submitPicture(obj.upUrl, fd);
    })
}
//添加图片
function addNewContent(obj) {
    $(imgBox).html("");
    for(var a = 0; a < imgSrc.length; a++) {
        if(imgSrc.length>2){
            $('.space').hide();
        }
        var oldBox = $(obj).html();
        $(obj).html(oldBox+'<div class="image-item" style="float:left"><img title=' + imgName[a] + ' alt=' + imgName[a] + ' src=' + imgSrc[a] + ' onclick="imgDisplay(this)" style="width: 100%;height: 100%;"><div class="image-close" onclick="removeImg(this,' + a + ')">X</div> </div>');
    }
}
//图片删除
function removeImg(obj, index) {
    imgSrc.splice(index, 1);
    imgFile.splice(index, 1);
    imgName.splice(index, 1);
    var boxId = "#" + $(obj).parent('.image-item').parent().attr("id");
    addNewContent(boxId);
    if(imgSrc.length<3){
        $('.space').show();
    }
}
//闄愬埗鍥剧墖涓暟
function limitNum(num){
    if(!num){
        return true;
    }else if(imgFile.length>num){
        return false;
    }
}

//
function submitPicture(url,data) {
   /* for (var p of data) {*/
        console.log(data);
    /*}*/
    if(url&&data){
        $.ajax({
            type: "post",
            url: url,
            async: true,
            data: data,
            processData: false,
            contentType: false,
            success: function(dat) {
                console.log(dat);
            }
        });
    }else{
        alert('');
    }
}
//显示大图
function imgDisplay(obj) {
    var src = $(obj).attr("src");
    var imgHtml = '<div style="width: 100%;height: 100vh;overflow: auto;background: rgba(0,0,0,0.5);text-align: center;position: fixed;top: 0;left: 0;z-index: 1000;"><img src=' + src + ' style="margin-top: 100px;width: 70%;margin-bottom: 100px;"/><p style="font-size: 16px;position: fixed;top: 30px;right: 30px;color: white;cursor: pointer;" onclick="closePicture(this)">X</p></div>'
    $('body').append(imgHtml);
}
//清除图片
function closePicture(obj) {
    $(obj).parent("div").remove();
}


function getObjectURL(file) {
    var url = null;
    if(window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if(window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if(window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}