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
        <form action="/admin/banners" method="get" style="width:100%">
        <div class="input-group" style="width:30%">
            <h4 style="font-size:25px;">搜索:&nbsp;&nbsp;</h4>
            <input style="height:30px;" name="search" type="text" class="form-control" placeholder="输入用户名或ID搜索">
            <div class="input-group-append">
                <button style="height:30px;" class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>
            </div>
        </div>
        </form>
        <a href="/admin/banners/create" style="margin-top:10px;" class="badge badge-info">
            <i class="mdi mdi-account-multiple-plus"></i>添加轮播图</a>
        <table class="table">
            <thead>
             <tr>
                <th>ID</th>
                <th>轮播图标题</th>
                <th>图片</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
           <tbody>
                @foreach($banners as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->title }}</td>
                        <td>
                        <img src="/uploads/{{ $v->url }}" style="width:150px;">
                        </td>
                        <td>
                            @if($v->status == 0)
                            <kbd>未激活</kbd>
                            @else
                            <kbd style="background: #52A052;">激活</kbd>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/banners/{{$v->id}}/edit" class="btn btn-info btn-sm">修改</a>
                            <a href="JavaScript:;" onclick="del({{$v->id}},this)"
                           class="btn btn-gradient-danger btn-sm">删除</a>
                            @if( $v->status == 0 )
                            <a href="javascript:;" class="btn btn-gradient-primary btn-sm" onclick="changeStatus({{ $v->id }},1)">激活</a>
                            @else
                            <a href="javascript:;" class="btn btn-gradient-warning btn-sm" onclick="changeStatus({{ $v->id }},0)">停止</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <!-- 分页 开始 -->
        <div style="margin-top:10px;">{{ $banners->appends(['search'=>$search])->links('common.paginator') }}</div>
        <!-- 分页 结束 -->
    </div>
</div>
        <script type="text/javascript">
                            function changeStatus(id,sta)
                            {
                                if(sta == 1){
                                    $('#myModal form input[type=radio]').eq(1).attr('checked',true);
                                }else{
                                    $('#myModal form input[type=radio]').eq(0).attr('checked',true);    
                                }
                                $('#myModal form input[type=hidden]').eq(0).val(id);
                                $('#myModal').modal('show')
                            }
                       </script>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">轮播图状态</h4>
                              </div>
                              <div class="modal-body">
                                <form action="/admin/banners/changeStatus" method="get">
                                    <input type="hidden" name="id" value="">
                                    <div class="form-group"> 
                                       <br>
                                          未开启:<input type="radio" name="status" value="0">
                                          &nbsp;&nbsp;&nbsp;
                                          开启:<input type="radio" name="status" value="1"> 
                                    </div>
                                    <input type="submit" class="btn btn-success">
                                </form>
                              </div>
                            
                            </div>
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
                $.get('/admin/banners/del?id=' + id, function (res) {
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
