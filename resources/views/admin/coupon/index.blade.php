@include('/admin/common/head')
@include('/admin/common/sidebar')
{{--标题start--}}
<div class="page-header">
    <h3 class="page-title">
        查看反馈
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <form action="/admin/feedback" method="get" style="width:100%">
        <div class="input-group" style="width:30%">
            <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
            <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入用户名或ID搜索">
            <div class="input-group-append">
                <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit">Search</button>
            </div>
        </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>反馈留言</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks as $k=>$v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->uname}}</td>
                    <td>{{$v->feedback_info}}</td>
                    <td>{{$v->created_at}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm">详情</button>
                        <a href="JavaScript:;" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                    </td>
                </tr>    
            @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        {{ $feedbacks->appends(['search'=>$search])->links() }}
        <!-- 分页 结束 -->
    </div>
</div>
{{--表格end--}}
@include('admin/common/foot')
<!-- script 脚本 开始 -->
<script>
    function del(id,obj)
        {
            // 添加token属性
            let token = $(obj).attr('token');

            // 弹出提示信息框
            if ( !window.confirm('您确定要删除吗?') ) {
                return false;
            }

            // ajax删除html dom节点
            $.post('/admin/feedback/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'},function(res){
            if(res != 'err'){
                // 对a标签的父节点进行操作
                $(obj).closest('tr').remove();
            } else {
                alert('删除失败!');
            }
            },'html');

        }
</script>
<!-- script 脚本 结束 -->