@include('/admin/common/head')
@include('/admin/common/sidebar')
{{--标题start--}}
<div class="page-header">
    <h3 class="page-title">
        管理员列表
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <a href="/admin/admin/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加用户</a>
        <table class="table">
            <thead>
            <tr>
                <th>用户ID</th>
                <th>用户名</th>
                <th>职位</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($admin_user as $k=>$v)
            <tr>
                <td>{{$v->aid}}</td>
                <td>{{$v->uname}}</td>
                <td>{{$v->name}}</td>
                <td>
                    <a href="/admin/admin/{{$v->aid}}/edit" type="button" class="btn btn-info btn-sm">详情</a>
                    <a href="JavaScript:;" onclick="del({{$v->aid}},this)"
                       class="btn btn-gradient-danger btn-sm">删除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $admin_user->links('common.paginator') }}</div>
        <!-- 分页 结束 -->
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
                $.get('/admin/admin/del?id=' + id, function (res) {
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