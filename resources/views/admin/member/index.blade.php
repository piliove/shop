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
        <form action="/admin/member" method="get" style="width:100%">
        <div class="input-group" style="width:30%">
            <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
            <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入用户名或ID搜索">
            <div class="input-group-append">
                <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
            </div>
        </div>
        </form>
        <a href="/admin/member/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加会员</a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>会员等级</th>
                <th>时间</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
                @foreach($member as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->uname }}</td>
                        <td>
                        @if($v->mname == 1)
                        <kbd class="badge badge-gradient-warning">Vip会员</kbd>
                        @else
                        <kbd class="badge badge-gradient-info">SVip会员</kbd>
                        @endif
                        </td>
                        <td>{{$v->created_at }}</td>
                        <td>
                            <a href="JavaScript:;" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $member->appends(['search'=>$search])->links('common.paginator') }}</div>
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
                $.get('/admin/member/del?id=' + id, function (res) {
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
