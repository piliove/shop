@include('/admin/common/head')
@include('/admin/common/sidebar')
<div id="top" style="text-align:center">
    <div class="col-md-12">
        <div class="panel panel-headline">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <div id="title"><h1>添加用户</h1></div>
                <div id="user-form">
                    <form class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-12">
                                <input type="text" name="uname" class="form-control" placeholder="用户账号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="upwd" placeholder="用户密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="upwd1" placeholder="用户密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-12">
                                <input id="file" type="file" name="file" class="form-control">
                                <img style="width:100px; left:0px;" src="" id="uface" alt="">
                                <input type="hidden" id="hidden_uface" name="uface">
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <button style="width:100%" type="button" id="submit" class="btn btn-success">添加用户</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        formData.append('uface', $('#file').get(0).files[0]);
        //ajax请求上传
        $.ajax({
            url: "/admin/user/updatefile",
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
                $('#uface').attr('src', '/uploads/' + img);
                //更改隐藏input里面的value值为图片链接
                $('#hidden_uface').attr('value', img);
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
            url: "/admin/user",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '添加成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/user";
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