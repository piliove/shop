@include('admin.common.head')
@include('admin.common.sidebar')
<div class="page-header">
    <h3 class="page-title">
        添加活动商品
    </h3>
</div>
<div class="card">
    <div class="card-body">
        <form action="/admin/activity/createactgoods" method="get" style="width:100%">
            <div class="input-group" style="width:30%">
                <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
                <input style="height:30px;" type="text" class="form-control" name="search_key" placeholder="输入商品名">
                <div class="input-group-append">
                    <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
                </div>
            </div>
        </form>

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
               @foreach($goods_data as $k=>$v)
                <tr>
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->gname }}</td>
                    <td>{{ $v->gdesc }}</td>
                    <td>{{ $v->gtitle }}</td>
                    <td>{{ $v->gnum }}</td>
                    <td>{{ $v->gprice }}</td>
                    <td class="c_idp">
                        <input class="c_id" type="checkbox" value="{{ $v->id }}" {{ $v->activity_id !=0 ? 'checked' : '' }} />
                    </td>   
                </tr>
                </tr>
               @endforeach
            </tbody>
        </table>
         <!-- 分页 开始 -->
         <div style="margin-top:10px;">{{ $goods_data->appends(['search_key'=>$search_key, 'aid'=>$aid])->links('common.paginator') }}</div>
         <!-- 分页 结束 -->
            <a href="/admin/activity/actgoods?id={{ $aid }}" onclick="self.location=document.referrer;" class="btn btn-gradient-primary btn-rounded btn-fw">确认添加</a>
            <a href="/admin/activity/actgoods?id={{ $aid }}" class="btn btn-gradient-dark btn-rounded btn-fw">返回</a>
    </div>
</div>
        
       

@include('admin.common.foot')
<script>
    $('.c_idp>.c_id').on('click',function(){
        var id = $(this).closest('tr').children()[0].innerHTML;
               
        if($(this).is(':checked')) {            
            $.get('/admin/activity/addactgoods',{'add':1,'id':id,'aid':{{ $aid }}},(res)=>{
                 console.log(res);
            },'json')
        } else {
            $.get('/admin/activity/addactgoods',{'add':0,'id':id,'aid':{{ $aid }}},(res)=>{
                console.log(res);
            },'json')
        }
    });

    
    
</script>