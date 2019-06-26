<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>我的足迹</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
        <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/footstyle.css" rel="stylesheet" type="text/css">
		<script src="/home/layer/layer.js"></script>
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
								<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/home/person/index" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/cart/index" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">({{ $countCart }})</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/home/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
		@include('home.common.head_nav')
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-foot">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> / <small>Browser&nbsp;History</small></div>
						</div>
						<hr/>

						<!--足迹列表 -->
           				@foreach($data as $K=>$v)
						<div class="goods">
							<div class="goods-date" data-date="2015-12-21">
								<span><i class="month-lite">{{ $v->created_at }}</i><i class="date-desc"></i></span>
								<!-- <del class="am-icon-trash"></del> -->
								<!-- <s class="line"></s> -->
							</div>

							<div class="goods-box first-box">
								<div class="goods-pic">
									<div class="goods-pic-box">
										<a class="goods-pic-link" target="_blank" href="#" title="{{$v->gdesc}}">
											<img src="/uploads/{{ $v->gthumb_1 }}" class="goods-img"></a>
									</div>
									@if($v->gid == 0)
                                    <a class="goods-delete" href="Javascript:;" ><i class="am-icon-trash"></i></a>
									<div class="goods-status goods-status-show"><span class="desc">宝贝已下架</span></div>
									@else
									<a class="goods-delete" href="Javascript:;" ><i class="am-icon-trash"></i></a>
									<div class="goods-status goods-status-show"><span class="desc"></span></div>
									@endif
								</div>

								<div class="goods-attr">
									<div class="good-title">
										<a class="title" href="#" target="_blank">{{ $v->gtitle }}</a>
									</div>
									<div class="goods-price">
										<span class="g_price">                                    
                                        <span>¥</span><strong>{{ $v->gprices }}</strong>
										</span>
										<span class="g_price g_price-original">                                    
                                        <span>¥</span><strong>{{ $v->gprice }}</strong>
										</span>
									</div>
									<div class="clear"></div>
									<div class="goods-num">
										<div class="match-recom">
											<a href="#" class="match-recom-item">找相似</a>
											<a href="#" class="match-recom-item">找搭配</a>
											<i><em></em><span></span></i>
										</div>
									</div>
								</div>
							</div>
						</div>	
						@endforeach				
						<div class="clear"></div>
						
					</div>
				</div>

				<!--底部-->
				@include('/home/common/foot_info')

			    @include('/home/common/sidebar_info')