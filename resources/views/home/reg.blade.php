<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="/home/AmazeUI-2.4.2/assets/css/amazeui.min.css"/>
    <link href="/home/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
</head>
<body>
<div class="login-boxtitle">
    <a href="home/demo.html"><img alt="" src="/home/images/logobig.png"/></a>
</div>

<div class="res-banner">
    <div class="res-main">
        <div class="login-banner-bg"><span></span><img src="/home/images/big.jpg"/></div>
        <div class="login-box">

            <div class="am-tabs" id="doc-my-tabs">
                <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                    <li class="am-active"><a href="">邮箱注册</a></li>
                    <li><a href="">手机号注册</a></li>
                </ul>

                <div class="am-tabs-bd">
                    {{--邮箱注册--}}
                    <div class="am-tab-panel am-active">
                        <form method="post" id="form_email">
                            {{csrf_field()}}
                            <div class="user-email">
                                <label for="email"><i class="am-icon-envelope-o"></i></label>
                                <input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input style="font-size:12px;" type="password" name="email_upwd" id="password"
                                       placeholder="须包含大小写字母和数字，且长度在6-12之间">
                            </div>
                            <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                <input style="font-size:12px;" type="password" name="email_upwd1" id="passwordRepeat" placeholder="确认密码">
                            </div>
                            <input type="text" class="form-control {{$errors->has('captcha')?'parsleyerror':''}}" name="captcha" placeholder="请输入验证码">
                            <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                        </form>
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" name="agree1" type="checkbox" value="1"> 点击表示您同意商城《服务协议》
                            </label>
                        </div>
                        <div class="am-cf">
                            <input type="submit" id="email_submit" value="注册"
                                   class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>
                    </div>
                    {{--短信注册--}}
                    <div class="am-tab-panel">
                        <form method="post">
                            {{csrf_field()}}
                            <div class="user-phone">
                                <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                                <input type="tel" name="phone" id="phone" placeholder="请输入手机号">
                            </div>
                            <div class="verification">
                                <label for="code"><i class="am-icon-code-fork"></i></label>
                                <input type="tel" name="code" id="code" placeholder="请输入验证码">
                                <a class="btn" href="javascript:;" onClick="sendMobileCode(this);"
                                   id="sendMobileCode">
                                    <span id="dyMobileButton">获取</span></a>
                            </div>
                            <div class="user-pass">
                                <label for="password"><i class="am-icon-lock"></i></label>
                                <input style="font-size:12px;" type="password" name="upwd" id="password"
                                       placeholder="须包含大小写字母和数字，且长度在6-12之间">
                            </div>
                            <div class="user-pass">
                                <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                                <input style="font-size:12px;" type="password" name="upwd1" id="passwordRepeat" placeholder="确认密码">
                            </div>
                        </form>
                        <div class="login-links">
                            <label for="reader-me">
                                <input id="reader-me" name="agree" type="checkbox" value="1"> 点击表示您同意商城《服务协议》
                            </label>
                        </div>
                        <div class="am-cf">
                            <input type="submit" id="phone_submit" value="注册"
                                   class="am-btn am-btn-primary am-btn-sm am-fl">
                        </div>

                        <hr>
                    </div>

                    <script>
                        $(function () {
                            $('#doc-my-tabs').tabs();
                        })
                    </script>

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
</div>
</body>
{{--发送短信注册ajax--}}
<script>
    function sendMobileCode(obj) {
        if ($(obj).attr('disabled')) {
            return false;
        }
        $(obj).attr('disabled', true);
        $(obj).css('cursor', 'no-drop');
        $('#dyMobileButton').css('color', '#ccc');
        if ($(obj).attr) {
            let time = null;
            let i = 60;
            time = setInterval(function () {
                i--;
                $('#dyMobileButton').html(i + '秒后重试');
                if (i < 1) {
                    $(obj).removeAttr('disabled');
                    $('#dyMobileButton').css('color', '#333');
                    $('#dyMobileButton').html('重发');
                    $('#dyMobileButton').css('cursor', 'pointer');
                    clearInterval(time);
                }
            }, 1000);
            //发送数据到控制器
            let cont = $('input').serialize();
            $.post('/reg/upphone', cont, function (res) {
                if (res.error_code == 0) {
                    layer.alert('发送成功,验证码十分钟内有效', {icon: 6});
                } else {
                    layer.msg('发送失败', {icon: 5});
                }
            }, 'json')
        }
    }

    $('#phone_submit').click(function () {
        let cont = $('input').serialize();
        $.post('/reg/regphone', cont, function (res) {
            if (res == '注册成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/login";
                });
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    })
</script>
{{--发送邮箱注册ajax--}}
<script>
    $('#email_submit').click(function () {
        // let cont = $('#form_email').serialize();
        let cont = $('input').serialize();
        $.post('/reg/upemail', cont, function (res) {
            if (res == '注册成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/login";
                });
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    })
</script>
</html>