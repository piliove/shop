@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">反馈管理</h4>
        <p class="card-description">
        message manage
        </p>
        <form class="forms-sample">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">用户名</label>
                <input type="text" class="form-control" name="uname" value="{{ $feedbacks->uname }}" id="exampleInputName1" disabled>
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">反馈信息</label>
                <textarea class="form-control" name="feedback_info" id="exampleTextarea1" rows="4" disabled>{{ $feedbacks->feedback_info }}</textarea>
            </div>
        </form>
        <a href="/admin/feedback"><button type="submit" id="submit" class="btn btn-gradient-light mr-2">返回</button></a>
        
    </div>
</div>
@include('/admin/common/foot')