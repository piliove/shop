<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    <link href="/home/css/systyle.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/addstyle.css" rel="stylesheet" type="text/css">
    <link href="/home/css/stepstyle.css" rel="stylesheet" type="text/css">
    <link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <script src="/home/layer/layer.js"></script>
    <script class="resources library" src="/home/js/area.js" type="text/javascript"></script>
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
                            <a href="/login" target="_top" class="h">亲，请登录</a>
                            <a href="/reg" target="_top">免费注册</a>
                        </div>
                    </div>
                </ul>
                <ul class="message-r">
                    <div class="topMessage home">
                        <div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
                    </div>
                    <div class="topMessage my-shangcheng">
                        <div class="menu-hd MyShangcheng"><a href="/home/person/index" target="_top"><i
                                        class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                    </div>
                    <div class="topMessage mini-cart">
                        <div class="menu-hd"><a id="mc-menu-hd" href="/home/cart/index" target="_top"><i
                                        class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong
                                        id="J_MiniCartNum" class="h">({{ $countCart }})</strong></a></div>
                    </div>
                    <div class="topMessage favorite">
                        <div class="menu-hd"><a href="#" target="_top"><i
                                        class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                </ul>
            </div>
            <!--悬浮搜索框-->
            <div class="nav white">
                <div class="logoBig">
                    <li><img src="/home/images/logobig.png"/></li>
                </div>
                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form>
                        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索"
                               autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
