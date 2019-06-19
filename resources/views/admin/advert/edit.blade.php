@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">活动管理</h4>
        <p class="card-description">
        活动信息修改
        </p>
        <form class="forms-sample" action="/admin/advert/{{ $advert->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="exampleInputName1">广告标题</label>
                <input type="text" class="form-control" name="advert_title" value="{{ $advert->advert_title }}" id="exampleInputName1" placeholder="请输入标题">
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">广告描述</label>
                <textarea class="form-control" name="activity_desc" value="{{ $advert->activity_desc }}" id="exampleTextarea1" placeholder="请输入描述信息" rows="4"></textarea>
            </div>
            <img src="/uploads/{{ $advert->url }}" style="width:150px;border-radius:50%;">
            <input type="hidden" name="old_profile" value="{{ $advert->url }}">
            <div class="form-group">
                <label  for="exampleTextarea1">广告图片</label>
                <div class="col-sm-12">
                    <input id="exampleTextarea1" type="file" name="url" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
            <button type="reset" class="btn btn-light">取消</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')