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
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> /
                    <small>Password</small>
                </div>
            </div>
            <hr/>
            <!--进度条-->
            <div class="m-progress">
                <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
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
                    <label for="user-old-password" class="am-form-label">原密码</label>
                    <div class="am-form-content">
                        <input type="password" name="start_upwd" id="user-old-password" placeholder="请输入原登录密码">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-new-password" class="am-form-label">新密码</label>
                    <div class="am-form-content">
                        <input type="password" name="upwd" id="user-new-password" placeholder="须包含大小写字母和数字，且长度在6-12之间">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user-confirm-password" class="am-form-label">确认密码</label>
                    <div class="am-form-content">
                        <input type="password" name="upwd1" id="user-confirm-password" placeholder="请再次输入上面的密码">
                    </div>
                </div>
            </form>
            <div class="info-btn">
                <div id="submit" class="am-btn am-btn-danger">保存修改</div>
            </div>

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
</div>
<script>
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/home/safe/updateupwd",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '修改成功') {
                    layer.alert(res, {icon: 6});
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