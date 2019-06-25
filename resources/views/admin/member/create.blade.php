@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">会员管理</h4>
        <p class="card-description">
        </p>
        <form class="forms-sample" action="/admin/member" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleSelectGender">用户</label>
                <select class="form-control" name="uid" id="exampleSelectGender" >
                    <option value="0">--请选择用户--</option>
                @foreach($users as $k=>$v)
                    <option value="{{ $v->id }}" {{ $v->id == $id ? 'selected' : '' }}  {{ substr_count($v->path,',') >= 2 ? 'disabled="disabled"' : '' }}>{{ $v->uname }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>会员</label>
                <select class="form-control" name="mname">
                    <option>--请选择会员--</option>
                    <option type="radio" name="mname" value="1">Vip会员</option>
                    <option type="radio" name="mname" value="2">SVip会员</option>
                </select>
            </div>
            
        </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">添加</button>
    </div>
</div>
@include('/admin/common/foot')
<script>
    //提交表单
    $("#submit").click(function () {
        var cont = $("form").serialize();
        layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "/admin/member",
            type: 'post',
            dataType: 'html',
            data: cont,
            success: function (res) {
                layer.closeAll();
                if (res == '添加成功') {
                    layer.alert(res, {icon: 6}, function () {
                        location.href = "/admin/member";
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
