@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">轮播图管理</h4>
        <p class="card-description">
        </p>
        <form class="forms-sample" action="/admin/banners" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">轮播图标题</label>
                <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="请输入标题">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">上传图片</label>
                <div class="input-group col-xs-12">
                    <input id="file" type="file" name="url" class="form-control">
                </div>
            </div>
            <div class="form-group"> 
                 <label for="exampleInputName1">轮播图状态</label> 
                      &nbsp;&nbsp;&nbsp;
                      未开启:<input type="radio" name="status" value="0" checked>
                      &nbsp;&nbsp;&nbsp;
                      开启:<input type="radio" name="status" value="1"> 
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')
