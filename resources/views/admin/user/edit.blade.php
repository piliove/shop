@include('/admin/common/head')
@include('/admin/common/sidebar')
<div id="top" style="text-align:center">
    <div class="col-md-12">
        <div class="panel panel-headline">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <div id="title"><h1>用户详情</h1></div>
                <div id="user-form">
                    <form class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="uname" class="form-control" value="{{$user->uname}}"
                                       placeholder="用户账号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户昵称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$userinfo->name}}"
                                       @if(!empty($userinfo)) placeholder="未填" @else placeholder="用户昵称" @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="upwd1" placeholder="用户密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-10">
                                <input id="file" type="file" name="file" class="form-control">
                                <img style="width:100px; left:0px;" src="" id="uface" alt="">
                                <input type="hidden" id="hidden_uface" name="uface">
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button style="width:100%" type="button" id="submit" class="btn btn-success">添加用户</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/admin/common/foot')