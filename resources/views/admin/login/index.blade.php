<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>后台登录</title>
    <link rel="stylesheet" href="/admins/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admins/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admins/css/style.css">
    <link rel="shortcut icon" href="/admins/images/favicon.png"/>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="/admins/images/logo.svg">
                        </div>
                        <h4>后台登录</h4>
                        <form class="pt-3">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="uname" class="form-control form-control-lg" placeholder="用户名">
                            </div>
                            <div class="form-group">
                                <input type="password" name="upwd" class="form-control form-control-lg"
                                       placeholder="密码">
                            </div>
                        </form>
                        <div class="mt-3">
                            <a href="JavaScript:;" id="submit"
                               class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">立即登录</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/admins/vendors/js/vendor.bundle.base.js"></script>
<script src="/admins/vendors/js/vendor.bundle.addons.js"></script>
<script src="/admins/js/off-canvas.js"></script>
<script src="/admins/js/misc.js"></script>
<script src="/admins/js/jquery-3.4.1.min.js"></script>
<script src="/admins/layer/layer.js"></script>
</body>
<script>
    $('#submit').click(function () {
        let cont = $('form').serialize();
        $.post('/admin/dologin', cont, function (res) {
            if (res == '登录成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/admin/index";
                });
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    })
</script>
</html>