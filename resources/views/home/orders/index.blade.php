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
							<div class="cart-table-th">
								<div class="wp">

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
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
							</div>
							
							@foreach($data as $k => $v)
							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img style="width:80px;" src="/uploads/{{ $v->gthumb_1 }}" class="itempic J_ItemImg"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" target="_blank" title="{{ $v->gtitle }}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $v->gtitle }}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">颜色：10#蜜橘色+17#樱花粉</span>
														<span class="sku-line">包装：两支手袋装（送彩带）</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{ $v->gprices }}</em>
														</div>
													</div>
												</li>
											</div>

											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															<input class="min am-btn" name="" type="button" value="-" />
															<input class="text_box" name="" type="text" value="{{ $v->num }}" style="width:30px;height:32px;" />
															<input class="add am-btn" name="" type="button" value="+" />
														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{ $v->num * $v->gprices }}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														包邮
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							@endforeach

							</div>
							<div class="clear"></div>
							<div class="pay-total">
							<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<!--优惠券 -->
							<div class="buy-agio">
								<li class="td td-coupon">

									<span class="coupon-title">优惠券</span>
									
									<select data-am-selected>
										@foreach($coupon as $k => $v)
										<option value="a">
											<div class="c-price">
												<strong>￥{{ $v->cprice }}</strong>
											</div>				
											<div class="c-limit">
												【{{ $v->cname }}】
											</div>
										</option>
										@endforeach
									</select>
									
								</li>

								<li class="td td-bonus">

									<span class="bonus-title">红包</span>
									<select data-am-selected>
										<option value="a">
											<div class="item-info">
												¥00.00<span>元</span>
											</div>
											<div class="item-remainderprice">
												<span>还剩</span>00.00<span>元</span>
											</div>
										</option>
									</select>

								</li>

							</div>
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">{{ $countPrice }}</em>
								</p>
							</div>

							<!--信息 -->
							<form action="/home/orders/pay" method="post">
								{{ csrf_field() }}
								<div class="order-go clearfix">
									<div class="pay-confirm clearfix">
										<div class="box">
											<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
												<span class="price g_price ">
												<span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{ $countPrice - $coupon_price }}</em>
												<!-- 商品总的数量 -->
												<input type="hidden" name="num" value="{{ $countCart }}">
												<!-- 商品实付款的价格 -->
												<input type="hidden" name="price" value="{{ $countPrice - $coupon_price }}">
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