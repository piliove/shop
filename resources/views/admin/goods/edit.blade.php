@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">商品详情</h4>
            <form class="form-sample">
                <input type="hidden" name="token" value="{{$goods->_token}}">
                <input type="hidden" name="id" value="{{$goods->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">商品名称</label>
                            <div class="col-sm-9">
                                <input type="text" name="gname" value="{{ $goods->gname }}" class="form-control"
                                       placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">商品价格</label>
                            <div class="col-sm-9">
                                <input type="number" name="gprice" value="{{ $goods->gprice }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">商品描述</label>
                            <div class="col-sm-9">
                                <input type="text" name="gdesc" value="{{ $goods->gdesc }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">商品标题</label>
                            <div class="col-sm-9">
                                <input type="text" name="gtitle" value="{{ $goods->gtitle }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">商品数量</label>
                            <div class="col-sm-9">
                                <input type="number" name="gnum" value="{{ $goods->gnum }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">所属商家</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="gid">
                                    @if($business->id == $goods->gid)
                                    <option value="{{ $business->id }}">{{ $business->bname }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">促销价</label>
                            <div class="col-sm-9">
                                <input type="number" name="gprices" value="{{ $goods->gprices }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">所属栏目</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="cid">
                                    @foreach($cate as $k => $v)
                                        @if($v->pid == 0)
                                        <option value="{{ $v->cid }}" disabled>{{ $v->cname }}</option>
                                        @else
                                        <option value="{{ $v->cid }}">{{ $v->cname }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>上传缩略图</label>
                    <div class="input-group col-xs-12">
                        <input type="file" name="file" id="file" class="form-control">
                            <input type="hidden" value="{{ $goods->gthumb_1 }}" id="hidden_uface" name="uface">
                    </div>
                    <img style="width:100px; height:100px;" src="/uploads/{{$goods->gthumb_1}}" id="uface" alt="">
                </div>

            </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">修改</button>
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
            url: "/admin/goods/updatefile",
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
                //隐藏上传按钮
                $('#file').hide();
            }
        });
    });
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/goods/update",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '修改成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/goods";
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