@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">反馈管理</h4>
        <p class="card-description">
        message manage
        </p>
        <form class="forms-sample" action="/admin/feedback" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">用户名</label>
                <input type="text" class="form-control" name="uname" id="exampleInputName1" placeholder="请输入用户名">
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">反馈信息</label>
                <textarea class="form-control" name="feedback_info" id="exampleTextarea1" placeholder="请输入反馈信息" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')