@include('admin.common.head')
<style>
    p.web-p{
        
        line-height:100%;
        
    }
</style>
@include('admin.common.sidebar')
<div class="page-header">
    <h3 class="page-title">
        网站配置列表
    </h3>
</div>

<div class="card">
    <div class="card-body">
      <h4 class="card-title">网站信息一览</h4>
      <p class="card-description">
       
      </p>
      <form action="/admin/website/update" method="POST" class="forms-sample" id="myform" enctype="multipart/form-data">   
      {{ csrf_field() }}
        <div class="form-group row">
          <label for="exampleInputUsername2" class="col-sm-2 col-form-label">网站标题</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title"  disabled id="exampleInputUsername2" value="{{ $ws_data->ws_title }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="exampleInputUsername2" class="col-sm-2 col-form-label">网站底部</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="footMsg"  disabled id="exampleInputUsername2" value="{{ $ws_data->ws_footMsg }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="exampleInputUsername2"  class="col-sm-2 col-form-label">网站图标</label>
          <div class="wz-path" class="col-sm-10">
            <img id="profile_pic"   src="/uploads/{{ $ws_data->ws_path }}" style="width:50px;position:relative;left:20px" alt="网站图标">
            
          </div>
        </div>
        <div class="form-group">
          <label for="exampleTextarea1">网站描述</label>
          <textarea disabled class="form-control" name="desc" id="exampleTextarea1" rows="4">{{ $ws_data->ws_desc }}</textarea>
        </div>
        
        
      </form>
      <button onclick="changeMsg(this)"  class="btn btn-gradient-primary mr-2">修改信息</button>
      <button  style="display:none;" form="myform" type="submit"  class="btn btn-gradient-primary mr-2 form-sub">确认更改</button>
    </div>
</div>


@include('admin.common.foot')
<script src="/AjaxFileUpload/ajaxfileupload.js"></script>
<script>
    //开场验证返回路由
    $(document).ready(function(){
        @if( !empty(session('site_msg')) )
            layer.msg("{{session('site_msg')}}");
            $.get("/admin/changesitemsg",{msg:true});
        @endif
    });


    //改变表单逻辑
    function changeMsg(dom){
        $('input').attr('disabled',false);
        $('textarea').attr('disabled',false);
        let ifile = '<input type="file" class="form-control" id="fileUpload" onclick="asyncUploadProfile()" name="profile"  />';
        $('div.wz-path').after(ifile);
        $(dom).hide();
        $('button.form-sub').show();
        
    }

    // 异步上传办法
    function asyncUploadProfile(){
        $('input[name="profile"]').on("change",function(e){
           
            //开始判断是否上传的是图片       
            if ( !/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/i.test($(this).val()) ) {
                $('img#profile_pic').attr('src','/uploads/{{ $ws_data->ws_path }}');
                layer.msg('图片类型必须是.gif,jpeg,jpg,png中的一种');
                
                return false;
                
            } 
              
            //调用主方法
            ajaxFileUpload();
          
        });
    }
    //主方法
    function ajaxFileUpload() {
        $.ajaxFileUpload
        (
            {
                url: "/admin/getprofile", //用于文件上传的服务器端请求地址
                type: "post",
                data: {'_token':'{{ csrf_token() }}'},
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'fileUpload', //文件上传域的ID
                dataType: 'text', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {   //转化为json数组对象
                    let datar = JSON.parse(data);
                    //开始装填图片
                    $('img#profile_pic').attr('src','/uploads/'+datar.path);   
                    layer.msg(datar.info);        
                },
                error: function (data)//服务器响应失败处理函数
                {
                    layer.msg(datar.info);
                }
            }
        );
        
    }


</script>