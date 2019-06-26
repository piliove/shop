@include('/admin/common/head')
@include('admin/common/sidebar')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="page-header">
    <h3 class="page-title">
        轮播图列表
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="/admin/blog" method="get" style="width:100%">
        <div class="input-group" style="width:30%">
            <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
            <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入用户名或ID搜索">
            <div class="input-group-append">
                <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
            </div>
        </div>
        </form>
        <a href="/admin/blog/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加新闻</a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>新闻标题</th>
                <th>新闻描述</th>
                <th>新闻内容</th>
                <th>新闻图片</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
            @foreach($blog as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td><p title="{{ $v->bname }}" style="width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $v->bname }}</p></td>
                    <td><p title="{{ $v->title }}" style="width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $v->title }}</p></td>
                    <td><p title="{{ $v->bdesc }}" style="width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $v->bdesc }}</p></td>
                    <td>
                    <img src="/uploads/{{ $v->ufate }}" style="width:150px;">
                    </td>
                    
                    <td>
                        <a href="/admin/blog/{{$v->id}}/edit" class="btn btn-info btn-sm">修改</a>
                        <a href="JavaScript:;" onclick="del({{$v->id}},this)" class="btn btn-gradient-danger btn-sm">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $blog->appends(['search'=>$search])->links('common.paginator') }}</div>
        <!-- 分页 结束 -->
    </div>
</div>

        <!-- END PANEL HEADLINE -->
    </div>
</div>
@include('/admin/common/foot')
<script>
    function del(id, obj) {
        layer.msg('确定删除?', {
            time: 0 //不自动关闭
            , btn: ['确定', '取消']
            , yes: function () {
                $.get('/admin/blog/del?id=' + id, function (res) {
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
