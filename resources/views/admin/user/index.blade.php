@include('/admin/common/head')
@include('/admin/common/sidebar')
{{--标题start--}}
<div class="page-header">
    <h3 class="page-title">
        用户列表
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <form action="/admin/user" method="get" style="width:100%">
            <div class="input-group" style="width:30%">
                <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
                <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入用户名搜索">
                <div class="input-group-append">
                    <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i
                                class="mdi mdi-account-search"></i></button>
                </div>
            </div>
        </form>
        <a href="/admin/user/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加用户</a>
        <table class="table">
            <thead>
            <tr>
                <th>用户ID</th>
                <th>用户名</th>
                <th>用户权限</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $k=>$v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->uname}}</td>
                    @if($v->power==0)
                        <td><label class="badge badge-success">普通用户</label></td>
                    @elseif($v->power==1)
                        <td><label class="badge badge-danger">会员用户</label></td>
                    @elseif($v->power==2)
                        <td><label class="badge badge-info">管理员</label></td>
                    @else
                        <td><label class="badge badge-warning">超级管理员</label></td>
                    @endif
                    <td>
                        <a href="/admin/user/{{$v->id}}/edit" type="button" class="btn btn-info btn-sm">详情</a>
                        <a href="JavaScript:;" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $users->appends(['search'=>$search])->links('common.paginator') }}</div>
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
                $.get('/admin/user/del?id=' + id, function (res) {
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