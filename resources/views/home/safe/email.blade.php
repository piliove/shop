@include('/home/common/head_info')
<div class="nav-table">
    <div class="long-title"><span class="all-goods">全部分类</span></div>
    <div class="nav-cont">
        <ul>
            <li class="index"><a href="#">首页</a></li>
            <li class="qc"><a href="#">闪购</a></li>
            <li class="qc"><a href="#">限时抢</a></li>
            <li class="qc"><a href="#">团购</a></li>
            <li class="qc last"><a href="#">大包装</a></li>
        </ul>
        <div class="nav-extra">
            <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
            <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
        </div>
    </div>
</div>
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">绑定邮箱</strong> /
                    <small>Email</small>
                </div>
            </div>
            <hr/>
            <!--进度条-->
            <div class="m-progress">
                <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">验证邮箱</p>
                            </span>
                    <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                    <span class="u-progress-placeholder"></span>
                </div>
                <div class="u-progress-bar total-steps-2">
                    <div class="u-progress-bar-inner"></div>
                </div>
            </div>
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label for="user-email" class="am-form-label">验证邮箱</label>
                    <div class="am-form-content">
                        <input type="email" name="email" id="user-email" placeholder="请输入邮箱地址">
                    </div>
                </div>
                <div class="am-form-group code">
                    <label for="user-code" class="am-form-label">验证码</label>
                    <div class="am-form-content">
                        <input type="tel" name="code" id="user-code" placeholder="验证码">
                    </div>
                    <a class="btn" href="javascript:void(0);" onClick="code();" id="code">
                        <div id="div_code" class="am-btn am-btn-danger">验证码</div>
                    </a>
                </div>
                <div class="info-btn">
                    <div id="submit" class="am-btn am-btn-danger">保存修改</div>
                </div>

            </form>

        </div>
        <!--底部-->
        <div class="footer">
            <div class="footer-hd">
                <p>
                    <a href="#">恒望科技</a>
                    <b>|</b>
                    <a href="#">商城首页</a>
                    <b>|</b>
                    <a href="#">支付宝</a>
                    <b>|</b>
                    <a href="#">物流</a>
                </p>
            </div>
            <div class="footer-bd">
                <p>
                    <a href="#">关于恒望</a>
                    <a href="#">合作伙伴</a>
                    <a href="#">联系我们</a>
                    <a href="#">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>
    </div>

    @include('/home/common/sidebar_info')
    <script>
        function code() {
            if ($('#code').attr('disabled')) {
                return false;
            }
            $('#code').attr('disabled', true);
            $('#div_code').css('backgroundColor', 'gray');
            if ($('#code').attr('disabled')) {
                let i = 60;
                let list = setInterval(function () {
                    i--;
                    $('#div_code').html(i);
                    if (i < 0) {
                        $('#code').removeAttr('disabled');
                        $('#div_code').css('backgroundColor', '#dd514c');
                        $('#div_code').html('重新获取');
                        clearInterval(list);
                    }
                }, 1000);
                let email = $('#user-email').val();
                $.post('/home/safe/email/code', {email: email}, function (res) {
                    if (res == '发送成功') {
                        layer.alert('验证码发送成功,十分钟内有效', {icon: 6});
                    } else {
                        layer.msg(res, {icon: 5});
                        $('#code').removeAttr('disabled');
                        $('#div_code').css('backgroundColor', '#dd514c');
                        $('#div_code').html('重新获取');
                        clearInterval(list);
                    }
                }, 'html')
            }
        }
    </script>
    <script>
        $('#submit').click(function () {
            let cont = $('form').serialize();
            $.post('/home/safe/email/update', cont, function (res) {
                if(res=='修改成功'){
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/home/safe/index";
                    });
                }else{
                    layer.msg(res, {icon: 5});
                }
            }, 'html')
        })
    </script>