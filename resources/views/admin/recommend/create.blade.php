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
<div class="card">
                <div class="card-body">
                  <h4 class="card-title">推荐设置</h4>
                  <p class="card-description">
                    设置推荐信息
                  </p>
                  <form class="forms-sample" action="/admin/recommend/{{ $gs_data->id }}" method="POST">
                  {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">推荐标题</label>
                      <input type="text" required class="form-control" id="exampleInputUsername1" name="title" placeholder="不能超过8个字">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">推荐描述</label>
                      <input type="text" required class="form-control" id="exampleInputEmail1" name="desc" placeholder="不能超过8个字">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">推荐商品</label>
                      <input type="text" disabled class="form-control" id="exampleInputPassword1" value="{{ $gs_data->gtitle }}">
                    </div>                   
                     
                    <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
                    <a href="javascript:history.go(-1)" class="btn btn-light">返回</a>
                  </form>
                </div>
              </div>


@include('admin.common.foot')
<script>
  $(document).ready(function(){
          @if( !empty(session('rec_msg')) )
              layer.msg("{{session('rec_msg')}}");
              $.get("/admin/changerecmsg",{msg:true});
          @endif
      });
</script>