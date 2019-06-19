@include('admin.common.head')
@include('admin.common.sidebar')
<div class="page-header">
    <h3 class="page-title">
        活动列表
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="/admin/activity" method="get" style="width:100%">
            <div class="input-group" style="width:30%">
                <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
                <input style="height:30px;" type="text" class="form-control" name="atitle" placeholder="输入栏目名">
                <div class="input-group-append">
                    <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
                </div>
            </div>
        </form>
        <a href="/admin/activity/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-chart-gantt"></i>添加分类
        </a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>活动标题</th>
                <th>活动描述</th>
                <th>活动标签</th>
                <th>活动图</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
               @foreach($activities_data as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->activity_title }}</td>
                    <td>{{ $v->activity_desc }}</td>
                    <td>{{ $v->activity_tag }}</td>
                    <td>
                        <img src="/uploads/{{ $v->activity_path }}" alt="">
                    </td>
                    <td>{{ $v->start_time }}</td>
                    <td>{{ $v->end_time }}</td>
                    <td>{{ $v->activity_status == 0 ? '未开启' : '开启' }}</td>
                    <td>  
                            <a href="/admin/activity/{{ $v->id }}/edit" class="btn btn-info btn-sm">修改</a>                
                            <a href="javascript:;" onclick="del({{ $v->id }}, this)" class="btn btn-gradient-danger btn-sm">删除</a>
                        
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
         <!-- 分页 开始 -->
         <div style="margin-top:10px;">{{ $activities_data->appends(['atitle'=>$search_key])->links('common.paginator') }}</div>
         <!-- 分页 结束 -->
    </div>
</div>
        
       

@include('admin.common.foot')

<script>
    $(document).ready(function(){
        @if( !empty(session('activity_msg')) )
            layer.msg("{{session('activity_msg')}}");
            $.get("/admin/changeactivitymsg",{msg:true});
        @endif
    });

    function del(id,dom) {

        // 弹出提示信息框
        if ( !window.confirm('您确定要删除吗?') ) {
                return false;
        }

        //ajax post 传输
        $.post("/admin/activity/"+id, {'_method':'DELETE','_token':'{{ csrf_token() }}'},
            (msg) => {
                $(dom).closest('tr').remove();
                layer.msg(msg.info);
            
            },
            "json"
        );

    }
</script>