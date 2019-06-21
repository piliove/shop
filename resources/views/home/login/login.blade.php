<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="stylesheet" href="/home/AmazeUI-2.4.2/assets/css/amazeui.css"/>
    <link href="/home/css/dlstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="login-boxtitle">
    <a href="/"><img alt="logo" src="/home/images/logobig.png"/></a>
</div>
<div class="login-banner">
    <div class="login-main">
        <div class="login-banner-bg"><span></span><img src="/home/images/big.jpg"/></div>
        <div class="login-box">

            <h3 class="title">登录商城</h3>

            <div class="clear"></div>

            <div class="login-form">
                <form>
                    {{csrf_field()}}
                    <select onclick="c_email(this)" id="choice" name="choice" class="form-control"
                            style="margin-bottom:10px;">
                        <option value="c_email">邮箱</option>
                        <option value="c_phone">手机号码</option>
                        <option value="c_uname">用户名</option>
                    </select>
                    <div class="user-name">
                        <label for="user"><i class="am-icon-user"></i></label>
                        <input type="text" name="number" id="user" placeholder="请选择登录方式">
                    </div>
                    <div class="user-pass">
                        <label for="password"><i class="am-icon-lock"></i></label>
                        <input type="password" name="upwd" id="password" placeholder="请输入密码">
                    </div>
                </form>
            </div>
            <div class="login-links">
                <a href="#" class="am-fr">忘记密码</a>
                <a href="/reg" class="zcnext am-fr am-btn-default">注册</a>
                <br/>
            </div>
            <div class="am-cf">
                <input type="submit" id="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm">
            </div>
        </div>
    </div>
</div>
<div class="footer ">
    <div class="footer-hd ">
        <p>
            <a href="# ">恒望科技</a>
            <b>|</b>
            <a href="# ">商城首页</a>
            <b>|</b>
            <a href="# ">支付宝</a>
            <b>|</b>
            <a href="# ">物流</a>
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="# ">关于恒望</a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>
</body>
<script src="/home/js/jquery-1.7.2.min.js"></script>
<script src="/admins/layer/layer.js"></script>
<script>
    function c_email(obj) {
        if ($(obj).val() == 'c_email') {
            $('#user').attr('placeholder', '邮箱号码');
        } else if ($(obj).val() == 'c_phone') {
            $('#user').attr('placeholder', '手机号码');
        } else {
            $('#user').attr('placeholder', '用户名');
        }
    }

    $('#submit').click(function () {
        let cont = $('form').serialize();
        $.post('/login/dologin', cont, function (res) {
            if (res == '登录成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/user";
                })
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    })
</script>
</html>