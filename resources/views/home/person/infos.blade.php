@include('home.common.head_info')
@include('home.common.head_nav')
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="user-info">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> /
                        <small>Personal&nbsp;information</small>
                    </div>
                </div>
                <hr/>

                <!--头像 -->
                <div class="user-infoPic">

                    <div class="filePic">
                        <input type="file" id="file" class="inputPic" name="file" allowexts="gif,jpeg,jpg,png,bmp"
                               accept="image/*">
                        <img class="am-circle am-img-thumbnail" id="uface-img" src="/uploads/{{$user->uface}}" alt=""/>
                        <img class="am-circle am-img-thumbnail" id="uface" src="" alt=""/>
                    </div>
                    <p class="am-form-help">头像</p>
                    <div class="info-m">
                        <div><b>用户名：<i>@if(empty($user->name))未设置@else{{$user->name}}@endif</i></b></div>
                        <div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
						            </span>
                        </div>
                        <div class="u-safety">
                            <a href="safety.html">
                                账户安全
                                <span class="u-profile"><i class="bc_ee0000" style="width: 60px;"
                                                           width="0">60分</i></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!--个人信息 -->
                <div class="info-main">
                    <form class="am-form am-form-horizontal">
                        <input type="hidden" id="uface-hide" name="uface">
                        {{csrf_field()}}
                        <input type="hidden" name="token" value="{{$user->_token}}">
                        <div class="am-form-group">
                            <label for="user-name2" class="am-form-label">用户名</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="uname"
                                       @if(empty($user->uname))placeholder="字母,数字,下划线组成,字母开头,4-16位"
                                       @else value="{{$user->uname}}" @endif>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">昵称</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="name"
                                       @if(empty($user->name)) placeholder="昵称"
                                       @else value="{{$user->name}}" @endif>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-form-label">QQ</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="qq"
                                       @if(empty($user->qq)) placeholder="QQ号码"
                                       @else value="{{$user->qq}}"@endif>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-form-label">性别</label>
                            <div class="am-form-content sex">
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" @if($user->sex=='w') checked @endif value="w"
                                           data-am-ucheck> 男
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" @if($user->sex=='m') checked @endif value="m"
                                           data-am-ucheck> 女
                                </label>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">年龄</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="age"
                                       @if(empty($user->age)) placeholder="年龄"
                                       @else value="{{$user->age}}"@endif>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-form-label">现居地址</label>
                            <div class="am-form-content">
                                <textarea name="addr">@if(empty($user->addr))未设置@else{{$user->addr}}@endif</textarea>
                            </div>
                        </div>
                    </form>
                    <div class="info-btn">
                        <div id="submit" class="am-btn am-btn-danger">保存修改</div>
                    </div>
                </div>
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
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
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
                $('#uface-hide').attr('value', img);
                //隐藏上传按钮
                $('#uface-img').hide();
            }
        });
    });
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/home/person/updateinfos",
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