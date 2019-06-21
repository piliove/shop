@include('/admin/common/head')
@include('/admin/common/sidebar')
{{--标题start--}}
<div class="page-header">
    <h3 class="page-title">
        角色列表
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <a href="/admin/nodes/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加角色</a>
        <table class="table">
            <thead>
            <tr>
                <th>角色名</th>
                <th>控制器</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $k=>$v)
                <tr>
                    <td>{{$k}}</td>
                    @foreach($v as $kk=>$vv)
                        <td><p>
                                @foreach($vv as $kkk=>$vvv)
                                    {{$vvv['desc']}}
                                @endforeach
                            </p>
                        </td>
                        <td>
                            <a href="/admin/nodes/{{$kk}}/edit" type="button" class="btn btn-info btn-sm">修改</a>
                            <a href="JavaScript:;" onclick="del({{$kk}},this)"
                               class="btn btn-gradient-danger btn-sm">删除</a>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--表格end--}}
@include('admin/common/foot')
<script>
    function del(id, obj) {
        layer.msg('确定删除?', {
            time: 0 //不自动关闭
            , btn: ['确定', '取消']
            , yes: function () {
                $.get('/admin/nodes/del?id=' + id, function (res) {
                    if (res == '删除成功') {
                        layer.alert(res, {icon: 6});
                        $(obj).parent().parent().remove();
                    } else {
                        layer.msg(res, {icon: 5});
                    }
                }, 'html')
            }
        });
    }
</script>