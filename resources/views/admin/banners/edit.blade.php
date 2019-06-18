@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">轮播图修改</h4>
        <p class="card-description">
        </p>
        <form class="forms-sample" action="/admin/banners/{{ $banners->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="exampleInputName1">轮播图标题</label>
                <input type="text" class="form-control" name="title" value="{{ $banners->title  }}" id="exampleInputName1" placeholder="请输入标题">
            </div>
            <img src="/uploads/{{ $banners->url }}" style="width:150px;border-radius:50%;">
            <input type="hidden" name="old_profile" value="{{ $banners->url }}">
            <div class="form-group">
                <label for="exampleInputName1">图片</label>
                <div class="col-sm-12">
                    <input id="file" type="file" name="url" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">提交</button>
            <button type="reset" class="btn btn-light">取消</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')
