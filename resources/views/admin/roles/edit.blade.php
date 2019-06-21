@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">修改控制器</h4>
            <form class="forms-sample">
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>控制器名</label>
                    <input type="text" class="form-control" name="control" placeholder="控制器名称"
                           value="{{$roles->control}}">
                </div>
                <div class="form-group">
                    <label>方法名</label>
                    <input type="text" class="form-control" name="method" placeholder="方法名称" value="{{$roles->method}}">
                </div>
                <div class="form-group">
                    <label>权限名称</label>
                    <input type="text" class="form-control" name="desc" placeholder="权限名称" value="{{$roles->desc}}">
                </div>
            </form>
            <button onclick="edit({{$roles->id}})" class="btn btn-gradient-primary mr-2">修改</button>
        </div>
    </div>
</div>
@include('/admin/common/foot')
<script>
    function edit(id) {
        let cont = $('form').serialize();
        $.post('/admin/roles/' + id, cont, function (res) {
            if (res == '修改成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/admin/roles";
                });
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    }
</script>