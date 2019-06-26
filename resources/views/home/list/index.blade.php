<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>搜索页面</title>
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />   
		<link href="/home/css/seastyle.css" rel="stylesheet" type="text/css" />
        <link href="/home/css/page.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/js/script.js"></script>

	</head>

	<body>
			<!-- 导航信息栏 开始 -->
			@include('/home/common/nav')
			<!-- 导航信息栏 结束 -->
			
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			@include('home.common.head_nav')	
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">														
							<div class="searchAbout">
								<span class="font-pale">当前位置:</span>
								<span>{{ $cate_title }}</span>

							</div>
							<ul class="select">
								<p class="title font-normal">
									<span class="fl">{{ $cate_title }}</span>
									<span class="total fl">搜索到<strong class="num">{{ $cate_good_count }}</strong>件相关商品</span>
								</p>
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>
                            
                                
                                    <li class="select-list">
                                        <dl id="select1">
                                            <dt class="am-badge am-round">分类</dt>									
                                            <div class="dd-conent">	
                                            @foreach($cates_data as $k=>$v)									   
                                                <dd><a href="/list?cid={{ $v->id }}" style="color:{{ $v->id == $cid ? 'red' : '' }}">{{ $v->cname }}</a></dd>
                                            @endforeach	                                                                                              								
                                            </div>
                                        </dl>
                                    </li>
                                
								        
                                    
							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<li class="big"><a title="评价" href="#">评价为主</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                                    @foreach($cates_goods as $k=>$v)
									    <li>
									    	<div class="i-pic limit">
									    		<a href="/home/info/index/{{ $v->id }}"><img src="/uploads/{{ $v->gthumb_1 }}" /></a>											
									    		<p class="title fl">{{ $v->gtitle }}</p>
									    		<p class="price fl">
									    			<b>¥</b>
									    			<strong>{{ $v->gprice }}</strong>
									    		</p>
									    		<p class="number fl">
									    			销量<span>1110</span>
									    		</p>
									    	</div>
									    </li>
                                    @endforeach
								</ul>
                               
							</div>
							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="/home/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/home/images/cp2.jpg" />
										<p class="check-title">ZEK 原味海苔</p>
										<p class="price fl">
											<b>¥</b>
											<strong>8.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/home/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>

							</div>
							<div class="clear"></div>
							<!--分页 -->
                            {{ $cates_goods->appends(['cid'=>$cid ])->links() }}

						</div>
					</div>
					@include('/home/common/foot')
				</div>

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>

		<!--菜单 -->
		@include('home.common.tip')
		<script>
			window.jQuery || document.write('<script src="/home/basic/js/jquery-1.9.min.js"><\/script>');
		</script>
		<script type="text/javascript" src="/home/basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

	</body>

</html>