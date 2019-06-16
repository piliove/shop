@include('/admin/common/head')
@include('/admin/common/sidebar')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">优惠券管理</h4>
        <p class="card-description">
        coupon manage
        </p>
        <form class="forms-sample" action="/admin/coupon/{{ $coupons->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="exampleInputName1">优惠券名称</label>
                <input type="text" class="form-control" name="cname" id="exampleInputName1" value="{{ $coupons->cname }}" placeholder="请输入优惠券名称">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">优惠券价格</label>
                <input type="number" class="form-control" name="cprice" id="exampleInputName2" value="{{ $coupons->cprice }}" placeholder="请输入...">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">优惠券数量</label>
                <input type="number" class="form-control" name="cnum" id="exampleInputName3" value="{{ $coupons->cnum }}" placeholder="请输入...">
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">修改</button>
        </form>
    </div>
</div>
@include('/admin/common/foot')