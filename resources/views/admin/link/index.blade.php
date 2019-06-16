@include('admin.common.head')
@include('admin.common.sidebar')
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
        友情链接列表
    </h3>
</div>
<div class="card">
    <div class="card-body">
      <!-- <h4 class="card-title">友情链接列表</h4> -->
      <p class="card-description">
      <!-- 搜索 开始 -->
        <div>
            <a href="javascript:;" onclick="create()" class="btn btn-gradient-info btn-fw" style="float:right;">添加友情链接</a>
            <div class="form-group" style="width:350px">
                <form action="/admin/link" method="GET">
                  <div class="input-group">          
                        <input type="text" class="form-control" placeholder="请输入链接标题" name="lname" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-primary" type="submit"><i class="mdi mdi-account-search"></i></button>              
                        </div>            
                  </div>
                </form>
            </div>
        </div>
      <!-- 搜索 结束 -->
      </p>
      <table class="table table-bordered table-hover" style="text-align:center;">
        <thead>
          <tr>
            <th>
              ID
            </th>
            <th>
              友情链接标题
            </th>
            <th>
              友情链接地址
            </th>
            <th>
             友情链接图片
            </th>
            <th>
             操作
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach($links_data as $k=>$v)
          <tr>
            <td>
              {{ $v->id }}
            </td>
            <td>
              {{ $v->lname }}
            </td>
            <td>
              {{ $v->title }}
            </td>
            <td>
              <img src="/uploads/{{ $v->thumb }}" style="border-radius:5px;">
            </td>
            <td>
             <a href="javascript:;" onclick="update({{ $v->id }},this)" class="btn btn-info btn-sm">修改</a>
             <a href="javascript:;" onclick="del({{ $v->id }}, this)" class="btn btn-gradient-danger btn-sm">删除</a>
            </td>
          </tr>
         @endforeach 
        </tbody>
      </table>
      <!-- 分页 开始 -->
      <div style="margin-top:10px;">{{ $links_data->appends(['lname' => $search_key])->links('common.paginator') }}</div>
      <!-- 分页 结束 -->
    </div>   
</div>




@include('admin.common.foot')

<script>

    $(document).ready(function(){

     @if( !empty(session('link_msg')) )
        layer.msg('{{ session('link_msg') }}');
        $.get("/admin/changelinkmsg",{msg:true});
     @endif
    
    });
    
    function del(id,dom) {

        // 弹出提示信息框
        if ( !window.confirm('您确定要删除吗?') ) {
                return false;
        }

        //ajax post 传输
        $.post("/admin/link/"+id, {'_method':'DELETE','_token':'{{ csrf_token() }}'},
            (msg) => {
                $(dom).closest('tr').remove();
                layer.msg(msg.info);
               
            },
            "json"
        );

    }

    function create() {
      //内容
      let content = `
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">添加友情链接</h4>
          <p class="card-description">
           
          </p>
          <form action="/admin/link" class="forms-sample" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">链接标题</label>
              <div class="col-sm-9">
                <input type="text" name="lname" class="form-control" id="exampleInputUsername2" placeholder="百度">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">链接URL</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" id="exampleInputEmail2" placeholder="www.baidu.com">
              </div>
            </div>
            <div class="form-group row">
            <label  class="col-sm-3 col-form-label">图片</label>
              <input type="file" name="thumb" class="file-upload-default" id="upload_input" />
              <div class="input-group col-sm-9">
                <input type="text" id="upload_text"  class="form-control file-upload-info" disabled="disabled" placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-gradient-primary" id="upload_button" type="button">Upload</button>
                </span>
              </div>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
            <button type="reset" class="btn btn-light">重置</button>
          </form>
        </div>
      </div>
      `;

      //弹出层
      layer.open({
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area:['500px','auto'], //宽高
        content: content,
      });

      //上传文件添加
      $('button#upload_button').click(()=>{
       $('input#upload_input').click();
      });
      //上传文件添加
      $('input#upload_input').change((e)=>{
        let value = e.target.value.split('\\').pop();
        $('input#upload_text').attr('value',value);
      })

    }

    function update(id,dom) {

      //html内容
      let content = `
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">添加友情链接</h4>
          <p class="card-description">
           
          </p>
          <form action="/admin/link/${id}" class="forms-sample" method="POST" enctype="multipart/form-data">
          {{ method_field('PUT') }}
          {{ csrf_field() }}
            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">链接标题</label>
              <div class="col-sm-9">
                <input type="text" name="lname" class="form-control" id="exampleInputUsername2" placeholder="百度">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">链接URL</label>
              <div class="col-sm-9">
                <input type="text" name="title" class="form-control" id="exampleInputEmail2" placeholder="www.baidu.com">
              </div>
            </div>
            <img class="uimg" style="width:75px;border-radius:5px;border:1px solid black" />
            <div class="form-group row">
            <label  class="col-sm-3 col-form-label">图片</label>
              <input type="file" name="thumb" class="file-upload-default" id="upload_input" />
              <div class="input-group col-sm-9">
                <input type="text" id="upload_text"  class="form-control file-upload-info" disabled="disabled" placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-gradient-primary" id="upload_button" type="button">Upload</button>
                </span>
              </div>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
            <button type="reset" class="btn btn-light">重置</button>
          </form>
        </div>
      </div>
      `;

      $.get("/admin/link/"+id+"/edit", 
        (data)=>{
          $('input[name="lname"]').val(data.lname);
          $('input[name="title"').val(data.title);
          $('img.uimg').attr('src','/uploads/'+data.thumb);
        },
        "json"
      );

      //弹出层
      layer.open({
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area:['500px','auto'], //宽高
        content: content,
      });
      
      //上传文件添加
      $('button#upload_button').click(()=>{
       $('input#upload_input').click();
      });
      //上传文件添加
      $('input#upload_input').change((e)=>{
        let value = e.target.value.split('\\').pop();
        $('input#upload_text').attr('value',value);
      });
      
      
    }
</script>