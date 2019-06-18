@include('/admin/common/head')
@include('/admin/common/sidebar')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <h4 class="card-title">活动管理</h4>
        <p class="card-description">
       活动添加
        </p>
        <form class="forms-sample" action="/admin/activity" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">活动标题</label>
                <input type="text" required="required" class="form-control" name="atitle" id="exampleInputName1" required="required" placeholder="请输入活动标题" value="{{ old('atitle') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputName2">活动描述</label>
                <input type="text" required="required" class="form-control" name="desc" id="exampleInputName2" required="required" placeholder="请输入活动描述" value="{{ old('desc') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputName3">活动标签</label>
                <input type="text" required="required" class="form-control" name="tag" id="exampleInputName3" required="required" placeholder="请输入活动标签(最高支持3个中文)" value="{{ old('tag') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputName3">开始时间</label>
                <input type="date" required="required" class="form-control" name="stime_date" id="exampleInputName3" required="required" value="{{ old('stime_date') }}">  
                <input type="time" required="required" class="form-control" name="stime_time" id="exampleInputName3" required="required" value="{{ old('stime_time') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputName3">结束时间</label>
                <input type="date" required="required" class="form-control" name="etime_date" id="exampleInputName3" required="required"  value="{{ old('etime') }}">
                <input type="time" required="required" class="form-control" name="etime_time" id="exampleInputName3" required="required"  value="{{ old('etime') }}">
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">活动当前状态</label>
                <div class="col-sm-4">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0" checked="checked">
                      未开启
                    <i class="input-helper"></i></label>
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="1">
                      开启
                    <i class="input-helper"></i></label>
                  </div>
                </div>
            </div>
            <div class="form-group">
                    <label>上传活动图</label>
                    <div class="input-group col-xs-12">
                        <input type="file" required="required" name="profile" onclick="asyncUploadProfile()" id="fileUpload" class="form-control">
                                       
                    </div>
                    <img style="width:200px; height:200px;" src="" id="profile_pic" alt="">
                </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
        
    </div>
</div>
@include('admin/common/foot')
<script src="/AjaxFileUpload/AjaxFileUpload.js"></script>
<script>

$(document).ready(function(){
        @if( !empty(session('activity_msg')) )
            layer.msg("{{session('activity_msg')}}");
            $.get("/admin/changeactivitymsg",{msg:true});
        @endif
    });


    
// 异步上传办法
function asyncUploadProfile(){
    $('input[name="profile"]').on("change",function(e){

        //开始判断是否上传的是图片       
         if ( !/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/i.test($(this).val()) ) {
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