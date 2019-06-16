<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/admins/js/jquery-3.4.1.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
    <link rel="stylesheet" href="/admins/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admins/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admins/css/style.css">
    <link rel="shortcut icon" href="/admins/images/favicon.png"/>
    <script src="/admins/js/jquery-3.4.1.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
    <script src="/admins/vendors/js/vendor.bundle.base.js"></script>
    <script src="/admins/vendors/js/vendor.bundle.addons.js"></script>
    <script src="/admins/js/off-canvas.js"></script>
    <script src="/admins/js/misc.js"></script>
    <script src="/admins/js/dashboard.js"></script>
</head>
<body>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">修改密码</h4>
            <form class="forms-sample">
                {{csrf_field()}}
                <div class="form-group">
                    <label>用户ID</label>
                    <input type="text" class="form-control" name="id" placeholder="用户ID">
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="password" name="upwd" class="form-control" placeholder="用户密码">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" name="upwd1" class="form-control" placeholder="和用户密码一致">
                </div>
            </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">立即修改</button>
        </div>
    </div>
</div>
</body>
<script>
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/user/upwd/cpwd",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '修改成功') {
                    layer.alert(res, {icon: 6}, function () {
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
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
</html>