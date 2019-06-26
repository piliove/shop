<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>购物车页面</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/home/css/optstyle.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script src="/home/layer/layer.js"></script>
	</head>

	<body>
			<!-- 导航信息栏 开始 -->
			@include('/home/common/nav')
			<!-- 导航信息栏 结束 -->

			<!--购物车 -->
			<div class="concent">
                <div id="h1" style="margin-top:20px;margin-bottom:5px;border-bottom:2px solid #FF5400;width:100%;">
                    <h1 style="font-size:22px;margin-bottom:2px;color:#F40;cursor:pointer;">我的购物车</h1>
                </div>
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						@if( count($data)>1 )
						<div class="bundle  bundle-last ">

							<div class="clear"></div>
                            @foreach($data as $k => $v) 
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input goodscheck="goods" oid="{{ $v->id }}" checked class="check" id="J_CheckBox_170037950254" name="items[]" value="170037950254" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="{{ $v->sub->gdesc }}" class="J_MakePoint" data-point="tbcart.8.12">
												<img style="width:80px;" src="/uploads/{{ $v->sub->gthumb_1 }}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="/home/info/index/{{ $v->gid }}" target="_blank" title="{{ $v->sub->gtitle }}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $v->sub->gtitle }}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">颜色：12#川南玛瑙</span>
											<span class="sku-line">包装：裸装</span>
											<span tabindex="0" class="btn-edit-sku theme-login">修改</span>
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original">{{ $v->sub->gprice/0.8 }}</em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0">{{ $v->sub->gprice }}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
                                                    <a href="javascript:;"><input class="min am-btn" onclick="descNum(this,{{ $v->id }},{{ $v->sub->gprice }})" name="" type="button" value="-" /></a>
													<input  class="text_box goodNum" name="" type="text" value="{{ $v->num }}" style="width:30px;height:28px;" />
													<a href="javascript:;"><input class="add am-btn" onclick="addNum(this,{{ $v->id }},{{ $v->sub->gprice }})" name="" type="button" value="+" /></a>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{ $v->num * $v->sub->gprice }}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="javascript:;" onclick="collect( $v->id )" title="移入收藏夹" class="btn-fav">
                                            移入收藏夹</a>
											<a href="javascript:;" onclick="down({{$v->id}})" data-point-url="#" class="delete">
                                            删除</a>
										</div>
									</li>
									<!-- ajax脚本 删除 开始 -->
									<script>
										// 加入购物车
										function down(id) {
											layer.msg('确定删除?', {
												time: 0 //不自动关闭
												, btn: ['确定', '取消']
												, yes: function () {
													$.get('/home/cart/delete?id='+id, function (res) {
														if (res == '删除成功') {
															layer.alert(res);
															location.href="/home/cart/index";
														} else {
															layer.msg(res);
														}
													}, 'html')
												}
											});
										}
									</script>
									<!-- ajax脚本 删除 结束 -->
									<!-- ajax脚本 移入收藏  开始 -->
									<script>
										// 移入收藏
										function collect(id) {
											layer.msg('确定加入收藏?', {
												time: 0 //不自动关闭
												, btn: ['确定', '取消']
												, yes: function () {
													$.get('/home/collect/add/?id='+id, function (res) {
														if (res == '加入收藏成功') {
															layer.alert(res);
															// location.href="/home/cart/index";
														} else {
															layer.msg(res);
														}
													}, 'html')
												}
											});
										}
									</script>
									<!-- ajax脚本 移入收藏 结束 -->
								</ul>
							</div>
                            @endforeach
						</div>
						@else
						<p style="text-align:center;font-size:24px;margin:5px;">您的购物车为空,快去添加商品啦 !</p>
						<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1561949642&di=0ff7c484fc63caec9fa482b5f24ba183&imgtype=jpg&er=1&src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2Fe1b1467beea0a9c7d6a56b32bac6d7e5dcd914f7c3e6-YTwUd6_fw658" alt="">
						@endif
					</tr>
					<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">{{ $allNum }}</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">{{ $allPrice }}</em></strong>
						</div>
						<div class="btn-area">
							<a href="#" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<form action="/home/orders/indexcart" method="get">
									<span><input style="background:#F40;width:80px;height:49px;border:1px solid #F40;color:#fff;" type="submit" value="结&nbsp;算"></span>
									<input type="hidden" name="o" value="">
								</form>
								<!-- ajax脚本 结算 开始 -->
								<!-- <script>
									// 领取优惠券
									function go(id) {
										layer.msg('确定去结算?', {
											time: 0 //不自动关闭
											, btn: ['确定', '取消']
											, yes: function () {
												$.get('/home/orders/index/?id='+id, function (res) {
													if (res == '跳转成功') {
														// layer.msg(res);
														location.href="/home/orders/index";
													} else {
														layer.msg(res);
													}
												}, 'html')
											}
										});
									}
								</script> -->
								<!-- ajax脚本 结算 结束 -->	
							</a>
						</div>
					</div>

				</div>

				@include('/home/common/foot')

			</div>

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

			<div class="theme-popover">
				<div class="theme-span"></div>
				<div class="theme-poptit h-title">
					<a href="javascript:;" title="关闭" class="close">×</a>
				</div>
				<div class="theme-popbod dform">
					<form class="theme-signin" name="loginform" action="" method="post">

						<div class="theme-signin-left">

							<li class="theme-options">
								<div class="cart-title">颜色：</div>
								<ul>
									<li class="sku-line selected">12#川南玛瑙<i></i></li>
									<li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
								</ul>
							</li>
							<li class="theme-options">
								<div class="cart-title">包装：</div>
								<ul>
									<li class="sku-line selected">包装：裸装<i></i></li>
									<li class="sku-line">两支手袋装（送彩带）<i></i></li>
								</ul>
							</li>
							<div class="theme-options">
								<div class="cart-title number">数量</div>
								<dd>
									<input class="min am-btn am-btn-default" name="" type="button" value="-" />
									<input class="text_box" name="" type="text" value="0" style="width:30px;" />
									<input class="add am-btn am-btn-default" name="" type="button" value="+" />
									<span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
								</dd>

							</div>
							<div class="clear"></div>
							<div class="btn-op">
								<div class="btn am-btn am-btn-warning">确认</div>
								<div class="btn close am-btn am-btn-warning">取消</div>
							</div>

						</div>
						<div class="theme-signin-right">
							<div class="img-info">
								<img src="/home/images/kouhong.jpg_80x80.jpg" />
							</div>
							<div class="text-info">
								<span class="J_Price price-now">¥39.00</span>
								<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
							</div>
						</div>

					</form>
				</div>
			</div>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>
	
</html>
<script>

	$(document).ready(function(){
		if( $('input.goodNum').val()<2 ){
			
			$('input.min').hide()
		}
	});




	$('input[goodscheck="goods"]').click(function(){
		if( $(this).attr('checked') == 'checked' ){
			add(this);
			
			$.get("/home/cart/changestatus",{'id':$(this).attr('oid'),'flag':'on'});
		} else {
			min(this);
			$.get("/home/cart/changestatus",{'id':$(this).attr('oid'),'flag':'off'});
		}
	});

	let add = (that)=>{
		$('em#J_Total').html(parseInt($('em#J_Total').html())+parseInt($(that).closest('ul.item-content').find('em.J_ItemSum').html()));
		$('em#J_SelectedItemsCount').html(parseInt($('em#J_SelectedItemsCount').html())+parseInt($(that).closest('ul.item-content').find('input.goodNum').val()));
	}

	let min = (that)=>{
		$('em#J_Total').html(parseInt($('em#J_Total').html())-parseInt($(that).closest('ul.item-content').find('em.J_ItemSum').html()))
		$('em#J_SelectedItemsCount').html(parseInt($('em#J_SelectedItemsCount').html())-parseInt($(that).closest('ul.item-content').find('input.goodNum').val()));
	}

	//增加函数
	function addNum(obj,id,gprice){
		$.get("/home/cart/addnum", {'id':id},
			function (res) {
				
				var checked = $(obj).closest('ul.item-content').find('input[goodscheck="goods"]').attr('checked') == 'checked' ? true : false;
				if(res == 'ok'){
					$(obj).closest('ul.item-content').find('em.J_ItemSum').html(parseInt($(obj).closest('ul.item-content').find('em.J_ItemSum').html())+gprice);
					$(obj).closest('ul.item-content').find('input.goodNum').val(parseInt($(obj).closest('ul.item-content').find('input.goodNum').val())+1);
					if($(obj).closest('ul.item-content').find('input.goodNum').val()>1){
						$(obj).closest('ul.item-content').find('input.min').show();
					}
					if(checked == true){
						$('em#J_SelectedItemsCount').html(parseInt($('em#J_SelectedItemsCount').html())+1);
						$('em#J_Total').html(parseInt($('em#J_Total').html())+gprice);
					}

				}
			},
			"html"
		);
	}

	//减少函数
	function descNum(obj,id,gprice){
		$.get("/home/cart/descnum", {'id':id},
			function (res) {
				
				var checked = $(obj).closest('ul.item-content').find('input[goodscheck="goods"]').attr('checked') == 'checked' ? true : false;		
				if(res == 'ok'){		
					$(obj).closest('ul.item-content').find('em.J_ItemSum').html(parseInt($(obj).closest('ul.item-content').find('em.J_ItemSum').html())-gprice);
					$(obj).closest('ul.item-content').find('input.goodNum').val(parseInt($(obj).closest('ul.item-content').find('input.goodNum').val())-1);
					if($(obj).closest('ul.item-content').find('input.goodNum').val()<2){
						$(obj).hide();
					}
					if(checked == true){
						$('em#J_SelectedItemsCount').html(parseInt($('em#J_SelectedItemsCount').html())-1);
						$('em#J_Total').html(parseInt($('em#J_Total').html())-gprice);
					}

				}
			},
			"html"
		);
	}

	
	
</script>