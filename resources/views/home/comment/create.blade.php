<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>发表评论</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/appstyle.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
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
								<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
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
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-comment">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
						</div>
						<hr/>

						<div class="comment-main">
						<form action="/home/comment" method="post" enctype="multipart/form-data">
						   {{ csrf_field() }}
							<div class="comment-list">
								<div class="item-pic">
									<a href="#" class="J_MakePoint">
										<img src="/home/images/comment.jpg_400x400.jpg" class="itempic">
									</a>
								</div>

								<div class="item-title">

									<div class="item-name">
										<a href="#">
											<p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
										</a>
									</div>
									<div class="item-info">
										<div class="info-little">
											<span>颜色：洛阳牡丹</span>
											<span>包装：裸装</span>
										</div>
										<div class="item-price">
											价格：<strong>19.88元</strong>
										</div>										
									</div>
								</div>
								<div class="clear"></div>
								<div class="item-comment">
									<textarea name="content" placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
								</div>
								<div class="filePic">
									<input  class="inputPic" type="file" name="file" id="file" >
                    				<input type="hidden" id="hidden_cfate" name="cfate" class="inputPic">
									<span>晒照片(0/5)</span>
									<img style="width:100px; height:100px; " src="" id="cfate" alt="" src="/home/images/image.jpg">
									
								</div>
								<div class="item-opinion">
									<li><i class="op1" name="op"  value="1"></i>好评</li>
									<li><i class="op2" name="op"  value="2"></i>中评</li>
									<li><i class="op3" name="op"  value="3" checked></i>差评</li>
								</div>
							</div>
						    </form>					
								<div class="info-btn">
									<div id="submit" class="am-btn am-btn-danger">发表评论</div>
								</div>							
					<script type="text/javascript">
						$(document).ready(function() {
							$(".comment-list .item-opinion li").click(function() {	
								$(this).prevAll().children('i').removeClass("active");
								$(this).nextAll().children('i').removeClass("active");
								$(this).children('i').addClass("active");
								
							});
				     })
					</script>					
					
					<script>
				    //当input框name为file选择图片(发生改变时)触发函数
				    $('input[name="file"]').change(function (event) {
				        //显示ajax动画
				        var ii = layer.msg("上传中，请稍等...", {
				            icon: 16,
				            shade: 0.1,
				            time: false
				        });
				        //new一个fromdata
				        var formData = new FormData();
				        //构造表单name名为rface
				        formData.append('cfate', $('#file').get(0).files[0]);
				        //ajax请求上传
				        $.ajax({
				            url: "/home/comment/updatefile",
				            type: "post",
				            data: formData,
				            cache: false,
				            processData: false,
				            contentType: false,
				            //异步
				            async: true,
				            dataType: "html",
				            success: function (img) {
				                //关闭所有弹框
				                layer.close(ii);
				                //弹出上传完成
				                layer.msg("上传完成");
				                //更改img里面的src值为图片链接
				                $('#cfate').attr('src', '/uploads/' + img);
				                //更改隐藏input里面的value值为图片链接
				                $('#hidden_cfate').attr('value', img);
				                //隐藏上传按钮
				                $('#file').hide();
				            }
				        });
				    });
				    //提交表单
				    $("#submit").click(function () {
				        var cont = $("form").serialize();
				        layer.load(2, {shade: [0.1, '#fff']});
				        $.ajax({
				            url: "/home/comment",
				            type: 'post',
				            dataType: 'html',
				            data: cont,
				            success: function (res) {
				                layer.closeAll();
				                if (res == '添加成功') {
				                    layer.alert(res, {icon: 6}, function () {
				                        location.href = "/home/comment";
				                    });
				                } else {
				                    layer.msg(res, {icon: 5});
				                }
				            },
				            timeout: 10000,
				            error: function (XMLHttpRequest, textStatus, errorThrown) {
				                layer.closeAll();
				                if (textStatus == "timeout") {
				                    layer.msg('请求超时！');
				                } else {
				                    layer.msg('服务器错误！');
				                }
				            }
				        });
				    });
				</script>
							
							
						</div>

					</div>

				</div>
				<!--底部-->
				@include('/home/common/foot_info')

			    @include('/home/common/sidebar_info')