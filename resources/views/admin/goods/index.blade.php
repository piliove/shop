@include('/admin/common/head')
@include('/admin/common/sidebar')
{{--标题start--}}
<div class="page-header">
    <h3 class="page-title">
        商品列表
    </h3>
</div>
{{--标题end--}}
{{--表格start--}}
<div class="card">
    <div class="card-body">
        <form action="/admin/feedback" method="get" style="width:100%">
        <div class="input-group" style="width:30%">
            <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
            <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入商品名称">
            <div class="input-group-append">
                <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
            </div>
        </div>
        </form>
        <a href="/admin/goods/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加商品</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>商家名称</th>
                <th>商品价格</th>
                <th>商品标题</th>
                <th>商品描述</th>
                <th>商品数量</th>
                <th>推荐状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                @foreach($goods as $k => $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->gname }}</td>
                    <td>{{ $v->gprice }}</td>
                    <td>
                        <p style="width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $v->gtitle }}</p>                 
                    </td>
                    <td>
                    <p style="width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $v->gdesc }}</p>
                    </td>
                    <td>{{ $v->gnum }}</td>
                    <td class="rec_status">
                        @if($v->rec_status == 1)
                            <label status="{{ $v->rec_status }}" title="切换推荐" onclick="rec_change({{ $v->id }}, this)" class="badge badge-success">推荐中</label>
                        @else 
                            <label status="{{ $v->rec_status }}" title="切换推荐" onclick="rec_change({{ $v->id }}, this)" class="badge badge-danger">未推荐</label>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/goods/{{ $v->id }}/edit"><button type="button" class="btn btn-info btn-sm">修改</button></a>
                        <a href="JavaScript:;" token="" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $goods->appends(['search'=>$search])->links('common.paginator') }}</div>
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
            $.post('/admin/goods/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'},function(res){
            if(res != 'err'){
                // 对a标签的父节点进行操作
                $(obj).closest('tr').remove();
            } else {
                alert('删除失败!');
            }
            },'html');

        }

        //利用ajax改变商品推荐状态
        function rec_change(id,dom) 
        {   
            //获得当前状态
            var status = $(dom).attr("status");
            
            
            $.ajax({
                type: "get",
                url: "/admin/recommendchange",
                data: {"status":status,"id":id},
                dataType: "html",
                success: function (res) {
                     //开始赋值(相反值)
                     $(dom).attr({"status":res});
                    if (res == 1) {
                        //变成推荐位
                        $(dom).html('推荐中');
                        $(dom).attr('class','badge badge-success');
                                            
                    } else {

                        //非推荐
                        $(dom).html('未推荐');
                        $(dom).attr('class','badge badge-danger');
                    }

                    layer.msg('切换成功');
                    //查看推荐的商品数多少个
                    let len = $('.rec_status>label[status="1"]').length;
                    //超过3个不允许推荐
                    if (len>=3) {
                        layer.msg('推荐位只能有3个');
                        $('.rec_status>label[status="0"]').attr('onclick','');
                    } else {
                        $('.rec_status>label[status="0"]').attr('onclick','rec_change({{ $v->id }}, this)');
                    }

                    
                }
            });
        }

        //小tips
        layer.tips('点击切换推荐位','.rec_status',{
            tips: [1, '#3595CC'],
            time: 4000
        });
</script>
<!-- script 脚本 结束 -->
