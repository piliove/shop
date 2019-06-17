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
        <h4 class="card-title">栏目管理</h4>
        <p class="card-description">
        message manage
        </p>
        <form class="forms-sample" action="/admin/cate" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">栏目名</label>
                <input type="text" class="form-control" name="cname" id="exampleInputName1" required="required" placeholder="请输入栏目名">
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">栏目分类</label>
                <select class="form-control" name="pid" id="exampleSelectGender"  title="未选择分类,默认一级分类">
                    <option value="0">--请选择分类--</option>
                @foreach($cates_data as $k=>$v)
                    <option value="{{ $v->id }}" {{ $v->id == $id ? 'selected' : '' }}  {{ substr_count($v->path,',') >= 2 ? 'disabled="disabled"' : '' }}>{{ $v->cname }}</option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')
<script>
    $(document).ready(function(){
        @if( !empty(session('cate_msg')) )
            layer.msg("{{session('cate_msg')}}");
            $.get("/admin/changecatemsg",{msg:true});
        @endif
    });
    
</script>