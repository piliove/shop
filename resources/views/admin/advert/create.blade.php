@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">广告管理</h4>
        <p class="card-description">
        </p>
        <form class="forms-sample" action="/admin/advert" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputName1">广告标题</label>
                <input type="text" class="form-control" name="advert_title" id="exampleInputName1" placeholder="请输入标题">
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">广告描述</label>
                <textarea class="form-control" name="activity_desc" id="exampleTextarea1" placeholder="请输入描述信息" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label  for="exampleTextarea1">广告图片</label>
                <div class="input-group col-xs-12">
                    <input id="exampleTextarea1" type="file" name="url" class="form-control">
                </div>
            </div>
            <div class="form-group"> 
                 <label class="col-sm-2 control-label">广告状态</label> 
                      未开启:<input type="radio" name="activity_status" value="0" checked>
                      &nbsp;&nbsp;&nbsp;
                      开启:<input type="radio" name="activity_status" value="1"> 
                </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">添加</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')
