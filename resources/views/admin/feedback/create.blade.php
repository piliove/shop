@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">反馈管理</h4>
        <p class="card-description">
        message manage
        </p>
        <form class="forms-sample">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">用户名</label>
                <input type="text" class="form-control" name="uname" id="exampleInputName1" placeholder="请输入用户名">
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">反馈信息</label>
                <textarea class="form-control" name="feedback_info" id="exampleTextarea1" placeholder="请输入反馈信息(200个字符以内)" rows="4"></textarea>
            </div>
        </form>
        <button type="submit" id="submit" class="btn btn-gradient-primary mr-2">添加</button>
        
    </div>
</div>
@include('/admin/common/foot')
<!-- js 脚本文件 -->
<script type="text/javascript">
//提交表单
$("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/feedback",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '添加成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/feedback";
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