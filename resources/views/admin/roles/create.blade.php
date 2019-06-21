@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">添加控制器</h4>
            <form class="forms-sample">
                <div class="form-group">
                    <label>控制器名</label>
                    <input type="text" class="form-control" name="control" placeholder="控制器名称">
                </div>
                <div class="form-group">
                    <label>方法名</label>
                    <input type="text" class="form-control" name="method" placeholder="方法名称">
                </div>
                <div class="form-group">
                    <label>权限名称</label>
                    <input type="text" class="form-control" name="desc" placeholder="权限名称">
                </div>
            </form>
            <button id="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </div>
    </div>
</div>
@include('/admin/common/foot')
<script>
    $('#submit').click(function () {
        let cont = $('form').serialize();
        $.post('/admin/roles', cont, function (res) {
            if (res == '添加成功') {
                layer.alert(res, {icon: 6});
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    })
</script>