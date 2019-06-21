@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">添加角色权限</h4>
            <form class="forms-sample">
                <div class="form-group">
                    <label>权限名</label>
                    <input type="text" class="form-control" name="name" placeholder="权限名称">
                </div>
                @foreach($list as $k=>$v)
                    <div style="display:inline-block;width:40%">
                        <h1>{{$k}}</h1>
                        @foreach($v as $kk=>$vv)
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="control[]" value="{{$vv['id']}}"> {{$vv['desc']}}
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </form>
            <button onclick="crea()" class="btn btn-gradient-primary mr-2">添加</button>
        </div>
    </div>
</div>
@include('/admin/common/foot')
<script>
    function crea() {
        let cont = $('form').serialize();
        $.post('/admin/nodes', cont, function (res) {
            if (res == '添加成功') {
                layer.alert(res, {icon: 6}, function () {
                    location.href = "/admin/nodes";
                });
            } else {
                layer.msg(res, {icon: 5});
            }
        }, 'html')
    }
</script>