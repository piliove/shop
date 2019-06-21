@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">优惠券管理</h4>
        <p class="card-description">
        coupon manage
        </p>
        <form class="forms-sample">
            <input type="hidden" name="id" value="{{$coupons->id}}">
            <div class="form-group">
                <label for="exampleInputName1">优惠券名称</label>
                <input type="text" class="form-control" name="cname" id="exampleInputName1" value="{{ $coupons->cname }}" placeholder="请输入优惠券名称">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">优惠券价格</label>
                <input type="number" class="form-control" name="cprice" id="exampleInputName2" value="{{ $coupons->cprice }}" placeholder="请输入...">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">优惠券数量</label>
                <input type="number" class="form-control" name="cnum" id="exampleInputName3" value="{{ $coupons->cnum }}" placeholder="请输入...">
            </div>
        </form>
        <button type="submit" id="submit" class="btn btn-gradient-primary mr-2">修改</button>
    </div>
</div>
@include('/admin/common/foot')
<!-- js 脚本文件 -->
<script type="text/javascript">
//提交表单
$("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/coupon/update",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '修改成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/coupon";
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