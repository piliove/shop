@include('admin.common.head')
@include('admin.common.sidebar')
<div class="page-header">
    <h3 class="page-title">
        栏目列表
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="/admin/cate" method="get" style="width:100%">
            <div class="input-group" style="width:30%">
                <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
                <input style="height:30px;" type="text" class="form-control" name="search_key" placeholder="输入栏目名">
                <div class="input-group-append">
                    <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
                </div>
            </div>
        </form>
        <a href="/admin/cate/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-chart-gantt"></i>添加分类
        </a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>栏目标题</th>
                <th>PID</th>
                <th>路径</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
               @foreach( $cates_data as $k=>$v ) 
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->cname }}</td>
                    <td>{{ $v->pid }}</td>
                    <td>{{ $v->path }}</td>
                    <td>  
                        @if(substr_count($v->path,',')<2)                     
                            <a href="/admin/cate/create?id={{ $v->id }}" class="btn btn-gradient-danger btn-sm">添加子栏目</a>
                        @endif
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
        
       

@include('admin.common.foot')
<script>
    $(document).ready(function(){
        @if( !empty(session('cate_msg')) )
            layer.msg("{{session('cate_msg')}}");
            $.get("/admin/changecatemsg",{msg:true});
        @endif
    });
</script>
