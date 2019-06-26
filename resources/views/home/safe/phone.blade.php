@include('/home/common/head_info')
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">手机号码修改</strong> /
                    <small>Bind&nbsp;Phone</small>
                </div>
            </div>
            <hr/>
            <!--进度条-->
            <div class="m-progress">
                <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">@if(empty($user->phone))绑定手机@else 换绑手机 @endif</p>
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
                <div class="am-form-group bind">
                    <label for="user-phone" class="am-form-label">验证手机</label>
                    <div class="am-form-content">
                        <span id="user-phone">{{$phone}}</span>
                    </div>
                </div>
                @if(!empty($user->phone))
                    <div class="am-form-group code">
                        <label for="user-code" class="am-form-label">验证码</label>
                        <div class="am-form-content">
                            <input type="tel" name="code" id="user-code" placeholder="短信验证码">
                        </div>
                        <a class="btn" href="javascript:void(0);" onClick="code();" id="code">
                            <div class="am-btn am-btn-danger" id="div_code">验证码</div>
                        </a>
                    </div>
                @endif
                <div class="am-form-group">
                    <label for="user-new-phone" class="am-form-label">验证手机</label>
                    <div class="am-form-content">
                        <input type="tel" name="phone" id="user-new-phone" placeholder="绑定新手机号">
                    </div>
                </div>
                <div class="am-form-group code">
                    <label for="user-new-code" class="am-form-label">验证码</label>
                    <div class="am-form-content">
                        <input type="tel" name="code2" id="user-new-code" placeholder="短信验证码">
                    </div>
                    <a class="btn" href="javascript:void(0);" onClick="code1();" id="code1">
                        <div class="am-btn am-btn-danger" id="div_code1">验证码</div>
                    </a>
                </div>
                <div class="info-btn">
                    <div class="am-btn am-btn-danger" id="submit">保存修改</div>
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
    @include('/home/common/navcir')
    @include('/home/common/sidebar_info')
    <script>
        function code() {
            //判断disabled是否存在
            if ($('#code').attr('disabled')) {
                return false;
            }
            $('#code').attr('disabled', true);
            $('#div_code').css('backgroundColor', 'gray');
            if ($('#code').attr('disabled')) {
                let i = 60;
                let list = setInterval(function () {
                    $('#div_code').html(i--);
                    if (i < 0) {
                        $('#div_code').html('重新获取');
                        $('#div_code').css('backgroundColor', '#dd514c');
                        $('#code').removeAttr('disabled');
                        clearInterval(list);
                    }
                }, 1000);
                $.post('/home/safe/phone/code', function (res) {
                    if (res.error_code == 0) {
                        layer.alert('验证码发送成功,十分钟内有效', {icon: 6});
                    } else {
                        layer.msg(res, {icon: 5});
                        $('#div_code').html('重新获取');
                        $('#div_code').css('backgroundColor', '#dd514c');
                        $('#code').removeAttr('disabled');
                        clearInterval(list);
                    }
                }, 'json')
            }
        }
    </script>
    <script>
        function code1() {
            if ($('#code1').attr('disabled')) {
                return false;
            }
            let code_testing = $('#user-code').val();
            $.post('/home/safe/phone/testing', {code: code_testing}, function (res) {
                if (res == '验证成功') {
                    $('#code1').attr('disabled', true);
                    $('#div_code1').css('backgroundColor', 'gray');
                    if ($('#code1').attr('disabled')) {
                        let i = 60;
                        let list = setInterval(function () {
                            i--;
                            $('#div_code1').html(i);
                            if (i < 0) {
                                $('#div_code1').css('backgroundColor', '#dd514c');
                                $('#code1').removeAttr('disabled');
                                $('#div_code1').html('重新获取');
                                clearInterval(list);
                            }
                        }, 1000);
                        let phone = $('#user-new-phone').val();
                        $.post('/home/safe/phone/code1', {phone: phone}, function (res) {
                            if (res.error_code == 0) {
                                layer.alert('验证码发送成功,十分钟内有效', {icon: 6});
                            } else {
                                $('#div_code1').html('获取');
                                $('#div_code1').css('backgroundColor', '#dd514c');
                                $('#code1').removeAttr('disabled');
                                clearInterval(list);
                                layer.msg(res, {icon: 5});
                            }
                        }, 'json')
                    }
                } else {
                    layer.msg(res, {icon: 5});
                }
            }, 'html');
        }
    </script>
    <script>
        $('#submit').click(function () {
            let cont = $('form').serialize();
            $.post('/home/safe/phone/update', cont, function (res) {
                if (res == '修改成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/home/safe/phone";
                    });
                } else {
                    layer.msg(res, {icon: 5});
                }
            }, 'html')
        })
    </script>