@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">添加用户</h4>
            <form class="forms-sample">
                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" class="form-control" name="uname" placeholder="用户账号">
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="password" name="upwd" class="form-control" placeholder="用户密码">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" name="upwd1" class="form-control" placeholder="和用户密码一致">
                </div>
                <div class="form-group">
                    <label>上传头像</label>
                    <div class="input-group col-xs-12">
                        <input type="file" name="file" id="file" class="form-control">
                            <input type="hidden" id="hidden_uface" name="uface">
                    </div>
                    <img style="width:100px; height:100px;" src="" id="uface" alt="">
                </div>
            </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">添加</button>
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