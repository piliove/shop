<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>结算页面</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/home/css/jsstyle.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/home/js/address.js"></script>
	</head>

	<body>
			<!-- 导航信息栏 开始 -->
			@include('/home/common/nav')
			<!-- 导航信息栏 结束 -->
			
			<div class="concent">
					<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
                            <a href="/home/addres"><div class="tc-btn am-btn am-btn-danger">新增地址</div></a>
						</div>
						<div class="clear"></div>
						<ul>
							<div class="per-border"></div>
							@foreach($addres as $k => $v)
							@if($v->status == 1)
							<li class="user-addresslist defaultAddr uaddr" onclick="changeAddr(this)">
							@else
							<li class="user-addresslist uaddr" onclick="changeAddr(this)">
							@endif
								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   						<span class="buy-user">{{ $v->name }}</span>
										<span class="buy-phone">{{ $v->aphone }}</span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
										<span class="dist">{{ $v->aname }}</span>
										<span class="street">{{ $v->dname }}</span>
										</span>

										</span>
									</div>
									@if($v->status == 1)
									<ins class="deftip">默认地址</ins>
									@endif
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" class="hidden">设为默认</a>
									<span class="new-addr-bar hidden">|</span>
									<a href="/home/addres">编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
								</div>
							</li>
							@endforeach
						</ul>

					<div class="clear"></div>
					</div>
					<!--物流 -->
					<div class="logistics">
						<h3>选择物流方式</h3>
						<ul class="op_express_delivery_hot">
							<li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
							<li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
							<li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
							<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
							<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--支付方式-->
					<div class="logistics">
						<h3>选择支付方式</h3>
						<ul class="pay-list">
							<li class="pay card"><img src="/home/images/wangyin.jpg" />银联<span></span></li>
							<li class="pay qq"><img src="/home/images/weizhifu.jpg" />微信<span></span></li>
							<li class="pay taobao"><img src="/home/images/zhifubao.jpg" />支付宝<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>

							<div class="clear"></div>
							</div>
							
							
							</div>
							<div class="clear"></div>
							<div class="pay-total">


							<div class="clear"></div>
							</div>	
							<!--信息 -->
							<form action="/home/orders/indexpay" method="post">
								{{ csrf_field() }}
								<div class="order-go clearfix">
									<div class="pay-confirm clearfix">
										<div class="box">
											<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
												<span class="price g_price ">
												<span>¥</span>{{ $allPrice }}<em class="style-large-bold-red " id="J_ActualFee"></em>
												<!-- 商品总的数量 -->
												<input type="hidden" class="sn" name="num" value="{{ $allNum }}">
												<!-- 商品实付款的价格 -->
												<input type="hidden" class="sp" name="price" value="{{ $allPrice }}">

												</span>
											</div>

											@foreach($addres as $k => $v)
											@if($v->status == 1)
											<input putaddr="aname" type="hidden" name="aname" value="{{ $v->aname }}">
											<input putaddr="dname" type="hidden" name="dname" value="{{ $v->dname }}">
											<input putaddr="name" type="hidden" name="name" value="{{ $v->name }}">
											<input putaddr="aphone" type="hidden" name="aphone" value="{{ $v->aphone }}">
											<div id="holyshit268" class="pay-address">
												<p class="buy-footer-address">
													<span class="buy-line-title buy-line-title-type">寄送至：</span>
													<span class="buy--address-detail">
													<span spanaddr="dist" class="dist">{{ $v->aname }}</span>
													<span spanaddr="street" class="street">{{ $v->dname }}</span>
													</span>
													</span>
												</p>
												<p class="buy-footer-address">
													<span class="buy-line-title">收货人：</span>
													<span class="buy-address-detail">   
													<span spanaddr="user" class="buy-user">{{ $v->name }}</span>
													<span spanaddr="phone" class="buy-phone">{{ $v->aphone }}</span>
													</span>
												</p>
											</div>
											@endif
											@endforeach

										</div>

										<div id="holyshit269" class="submitOrder">
											<div class="go-btn-wrap">
												<input style="width:130px;height:38px;border:1px solid #fff;background:#f40;color:#fff;font-size:18px;" type="submit" value="提交订单">
											</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</form>
							
						</div>

						<div class="clear"></div>
					</div>
				</div>
				@include('/home/common/foot')
			</div>
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

			</div>

			<div class="clear"></div>
	</body>

	<script>
		$(document).ready(function(){
			if($('input.countNum').val() < 2){
				$('input.min').hide();
			}
		});
	</script>

	<script>
		let changeAddr = (obj)=>{
			
			$('span[spanaddr="user"]').text($(obj).find('span.buy-user').text());
			$('span[spanaddr="phone"]').text($(obj).find('span.buy-phone').text());
			$('span[spanaddr="dist"]').text($(obj).find('span.dist').text());
			$('span[spanaddr="street"]').text($(obj).find('span.street').text());

			$('input[putaddr="name"]').val($(obj).find('span.buy-user').text());
			$('input[putaddr="aname"]').val($(obj).find('span.dist').text());
			$('input[putaddr="dname"]').val($(obj).find('span.street').text());
			$('input[putaddr="aphone"]').val($(obj).find('span.buy-phone').text());



		}
	

	</script>
</html>