<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
		<title>我的收藏</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/colstyle.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									<a href="#" target="_top" class="h">亲，请登录</a>
									<a href="#" target="_top">免费注册</a>
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/" target="_top" class="h">首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/cart/index" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">({{ $countCart }})</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/home/collect/index" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
					</div>

					<!--悬浮搜索框-->
					<div class="nav white">
							<div class="logoBig">
								<li><img src="/home/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href=""></a>
								<form action="/home/search/index" method="get">
									<input id="searchInput" name="search" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
					</div>

					<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">
							<div class="s-bar">
								我的收藏
								<a class="am-badge am-badge-danger am-round">降价</a>
								<a class="am-badge am-badge-danger am-round">下架</a>
							</div>
							<div class="s-content">
								@if( session('IndexLogin') == true )
								@foreach($data as $k => $v)
								<div class="s-item-wrap">
									<div class="s-item">

										<div class="s-pic">
											<a href="/home/info/index/{{ $v->gid }}" class="s-pic-link">
												<img src="/uploads/{{ $v->cthumb }}" alt="{{ $v->ctitle }}" title="{{ $v->ctitle }}" class="s-pic-img s-guess-item-img">
											</a>
										</div>
										<div class="s-info">
											<div class="s-title"><a href="" title="{{ $v->ctitle }}">{{ $v->ctitle }}</a></div>
											<div class="s-price-box">
												<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $v->cprices }}</em></span>
												<span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $v->cprice }}</em></span>
											</div>
											<div class="s-extra-box">
												<span class="s-comment">好评: 00.00%</span>
												<span class="s-sales">月销: 0</span>
											</div>
										</div>
										<div class="s-tp">
											<span class="ui-btn-loading-before"><a href="/home/search/index?search={{ $v->ctitle }}">找相似</a></span>
											<i class="am-icon-shopping-cart"></i>
											<span class="ui-btn-loading-before buy"><a href="/home/info/index/{{ $v->gid }}">加入购物车</a></span>
											<p>
												<a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
											</p>
										</div>
									</div>
								</div>
								@endforeach
								@endif
							</div>

							<div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

						</div>

					</div>

				</div>
				<!--底部-->
				@include('/home/common/foot')
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="/">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="information.html">个人信息</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="address.html">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="/home/ordersinfo/index">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="/home/coupon/index">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="bill.html">账单明细</a></li>
							<li> <a href="/home/feedback/index">我的反馈</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li class="active"> <a href="/home/collect/index">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>
							<li> <a href="comment.html">评价</a></li>
							<li> <a href="news.html">消息</a></li>
						</ul>
					</li>

				</ul>

			</aside>
		</div>

	</body>

</html>