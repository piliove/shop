@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">用户详情</h4>
            <form class="form-sample">
                <input type="hidden" name="token" value="{{$user->_token}}">
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">用户名</label>
                            <div class="col-sm-9">
                                <input type="text" name="uname" value="{{$user->uname}}" class="form-control"
                                       placeholder="用户账号">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">用户昵称</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{$userinfo->name}}" class="form-control"
                                       @if(empty($userinfo->name)) placeholder="未填" @else placeholder="用户昵称" @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">邮箱</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="{{$userinfo->email}}" class="form-control"
                                       @if(empty($userinfo->email)) placeholder="未填" @else placeholder="用户邮箱" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">手机号码</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" value="{{$userinfo->phone}}" class="form-control"
                                       @if(empty($userinfo->email)) placeholder="未填" @else placeholder="手机号码" @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">性别</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="sex" value="w"
                                               @if($userinfo->sex=='w') checked @endif>
                                        男
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="sex" value="m"
                                               @if($userinfo->sex=='m') checked @endif>
                                        女
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>上传头像</label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="file" id="file" class="form-control">
                                <input type="hidden" id="hidden_uface" name="uface">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img id="img_start" style="width:80px; height:80px;" src="/uploads/{{$user->uface}}" id="uface" alt="">
                        <img style="width:80px; height:80px;" src="" id="uface" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">年龄</label>
                            <div class="col-sm-9">
                                <input type="text" name="age" value="{{$userinfo->age}}" class="form-control"
                                       @if(empty($userinfo->age)) placeholder="未填" @else placeholder="用户年龄" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">QQ号码</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="qq" value="{{$userinfo->qq}}"
                                       @if(empty($userinfo->qq)) placeholder="未填" @else placeholder="用户QQ" @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">现居地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addr" value="{{$userinfo->addr}}"
                                       @if(empty($userinfo->addr)) placeholder="未填" @else placeholder="用户现居地址" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">注册时间</label>
                            <div class="col-sm-9">
                                <input type="text" disabled value="{{$userinfo->created_at}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">注册地址IP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" disabled value="{{$user->uip}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">用户状态</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option @if($user->status==0) selected @endif value="0">锁定用户</option>
                                    <option @if($user->status==1) selected @endif value="1">激活用户</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">立即修改</button>
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
                //隐藏原始头像
                $('#img_start').hide();
            }
        });
    });
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/user/update",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '修改成功') {
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