@include('admin.common.head')
@include('admin.common.sidebar')
<div class="page-header">
    <h3 class="page-title">
        活动列表
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="/admin/activity/actgoods" method="get" style="width:100%">
            <div class="input-group" style="width:30%">
                <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
                <input style="height:30px;" type="text" class="form-control" name="search_key" placeholder="输入商品名">
                <div class="input-group-append">
                    <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
                </div>
            </div>
        </form>
        <a href="/admin/activity/createactgoods?aid={{ $aid }}"  style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-chart-gantt"></i>添加活动商品
        </a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>商品名</th>                
                <th>商品描述</th>
                <th>商品标题</th>
                <th>商品数量</th>
                <th>商品价格</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
               @foreach($act_goods_data as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->gname }}</td>
                    <td>{{ $v->gdesc }}</td>
                    <td>{{ $v->gtitle }}</td>
                    <td>{{ $v->gnum }}</td>
                    <td>{{ $v->gprice }}</td>
                    <td>                               
                        <a href="javascript:;" onclick="del({{ $v->id }}, this)" class="btn btn-gradient-danger btn-sm">删除</a>    
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
         <!-- 分页 开始 -->
         <div style="margin-top:10px;">{{ $act_goods_data->appends(['search_key'=>$search_key])->links('common.paginator') }}</div>
         <!-- 分页 结束 -->
         <a href="/admin/activity" class="btn btn-gradient-dark btn-rounded btn-fw">返回</a>
    </div>
</div>
        
       

@include('admin.common.foot')
<script>
     function del(id,dom) {

        // 弹出提示信息框
        if ( !window.confirm('确定取消活动商品资格吗?') ) {
                return false;
        }

        //ajax post 传输
        $.post("/admin/activity/delactgoods", {'id':id,'_token':'{{ csrf_token() }}'},
            (msg) => {
                $(dom).closest('tr').remove();
                layer.msg(msg);       
            },
            "html"
        );

    }
</script>