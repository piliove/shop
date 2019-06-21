@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="page-header">
    <h3 class="page-title">
        用户列表
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <a href="/admin/roles/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加权限</a>
        <table class="table">
            <thead>
            <tr>
                <th>权限ID</th>
                <th>权限名称</th>
                <th>控制器名</th>
                <th>方法名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $k=>$v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->desc}}</td>
                    <td>{{$v->control}}</td>
                    <td>{{$v->method}}</td>
                    <td>
                        <a href="/admin/roles/{{$v->id}}/edit" type="button" class="btn btn-info btn-sm">修改</a>
                        <a href="JavaScript:;" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $roles->appends(['desc'=>$desc])->links('common.paginator') }}</div>
        <!-- 分页 结束 -->
    </div>
</div>
@include('/admin/common/foot')
<script>
    function del(id, obj) {
        layer.msg('确定删除?', {
            time: 0 //不自动关闭
            , btn: ['确定', '取消']
            , yes: function () {
                $.get('/admin/roles/del?id=' + id, function (res) {
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