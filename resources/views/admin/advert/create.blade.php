@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">广告管理</h4>
        <p class="card-description">
        </p>
        <form class="forms-sample" action="/admin/advert" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">广告标题</label>
                <input type="text" class="form-control" name="advert_title" id="exampleInputName1" placeholder="请输入标题">
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">广告描述</label>
                <textarea class="form-control" name="activity_desc" id="exampleTextarea1" placeholder="请输入描述信息" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label>上传图片</label>
                <div class="input-group col-xs-12">
                    <input type="file" name="file" id="file" class="form-control">
                    <input type="hidden" id="hidden_url" name="url" class="form-control">
                </div>
                <img style="width:100px; height:100px; " src="" id="url" alt="">
            </div>
            <div class="form-group"> 
                 <label class="col-sm-2 control-label">广告状态</label> 
                      未开启:<input type="radio" name="activity_status" value="0" checked>
                      &nbsp;&nbsp;&nbsp;
                      开启:<input type="radio" name="activity_status" value="1"> 
                </div>
        </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">添加</button>
    </div>
</div>
@include('/admin/common/foot')

<script>
    //当input框name为file选择图片(发生改变时)触发函数
    $('input[name="file"]').change(function (event) {
        //显示ajax动画
        var ii = layer.msg("上传中，请稍等...", {
            icon: 16,
            shade: 0.1,
            time: false
        });
        //new一个fromdata
        var formData = new FormData();
        //构造表单name名为rface
        formData.append('url', $('#file').get(0).files[0]);
        //ajax请求上传
        $.ajax({
            url: "/admin/advert/updatefile",
            type: "post",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            //异步
            async: true,
            dataType: "html",
            success: function (img) {
                //关闭所有弹框
                layer.close(ii);
                //弹出上传完成
                layer.msg("上传完成");
                //更改img里面的src值为图片链接
                $('#url').attr('src', '/uploads/' + img);
                //更改隐藏input里面的value值为图片链接
                $('#hidden_url').attr('value', img);
                //隐藏上传按钮
                $('#file').hide();
            }
        });
    });
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/advert",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '添加成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/advert";
                    });
                } else {
                    layer.msg(res, {icon: 5});
                }
            },
            timeout: 10000,
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.closeAll();
                if (textStatus == "timeout") {
                    layer.msg('请求超时！');
                } else {
                    layer.msg('服务器错误！');
                }
            }
        });
    });
</script>