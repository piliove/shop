<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>新闻页面</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  
   <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
   <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
   <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
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
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>	
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist">
  <div class="am-u-md-9">
   @foreach($blog as $k=>$v)
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#">{{ $v->bname }}</a>
      </h3>
      <h4 class="am-article-meta blog-meta">{{ $v->created_at }}</h4>

      <div class="am-g blog-content">
        <div class="am-u-sm-12">
          <p>{{$v->title}}</p>
          <strong class="blog-tit"><p>一张毛爷爷<span>丨</span>基础护肤</p></strong>
          <div class="Row">
            <li><a href="/home/info/index/{{ $v->id }}"> <img src="/uploads/{{ $v->ufate }}"></a></li>
            <li><a href="/home/info/index/{{ $v->id }}"> <img src="/uploads/{{ $v->ufate }}"></a></li>
          	<li><a href="/home/info/index/{{ $v->id }}"> <img src="/uploads/{{ $v->ufate }}"></a></li>
          </div>
          <p>{{ $v->bdesc }}</p>
        
        </div>
  
      </div>

    </article>
         @endforeach


    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination">
       <!-- 分页 开始 -->
        <div style="margin-top:10px; margin:20px 333px;">{{ $blog->appends(['search'=>$search])->links('common.paginator') }}</div>
        <!-- 分页 结束 -->
    </ul>
  </div>

  <div class="am-u-md-3 blog-sidebar">
    <div class="am-panel-group">

      <section class="am-panel am-panel-default">
        <div class="am-panel-hd">热门话题</div>
        <ul class="am-list blog-list">
          <li><a href="#"><p>[特惠]闺蜜喊你来囤国货啦</p></a></li>  
          <li><a href="#"><p>[公告]华北、华中部分地区配送延迟</p></a></li>
          <li><a href="#"><p>[特惠]家电狂欢千亿礼券 买1送1！</p></a></li>
          <li><a href="#"><p>[公告]商城与广州市签署战略合作协议</p></a></li>
          <li><a href="#"><p>[特惠]洋河年末大促，低至两件五折</p></a></li>      
        </ul>
      </section>

    </div>
  </div>

</div>

@include('home.common.foot_info')

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

</body>
</html>
