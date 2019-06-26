<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>首页</title>
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css"/>
    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css"/>
    <link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/home/css/skin.css" rel="stylesheet" type="text/css"/>
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
</head>

<body>
<!-- 导航信息栏 开始 -->
@include('/home/common/nav')
<!-- 导航信息栏 结束 -->
<div class="banner">
    <!--轮播 -->
    <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
        <ul class="am-slides">
            @foreach($banners as $k=>$v)
                @if($v->status != 0)
                    <li class="banner1"><a href="/"><img src="/uploads/{{ $v->url }}"/></a></li>
                @else

                @endif
            @endforeach
        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="shopNav">
    <div class="slideall">

        <div class="long-title"><span class="all-goods">全部分类</span></div>
        <div class="nav-cont">
            <ul>
                <li class="index"><a href="/">首页</a></li>
                <li class="qc"><a href="#">闪购</a></li>
                <li class="qc"><a href="#">限时抢</a></li>
                <li class="qc"><a href="#">团购</a></li>
                <li class="qc last"><a href="#">大包装</a></li>
            </ul>

        </div>
    @include('/home/common/sidebar')
    <!--小导航 -->
        <div class="am-g am-g-fixed smallnav">
            <div class="am-u-sm-3">
                <a href="sort.html"><img src="/home/images/navsmall.jpg"/>
                    <div class="title">商品分类</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/huismall.jpg"/>
                    <div class="title">大聚惠</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/mansmall.jpg"/>
                    <div class="title">个人中心</div>
                </a>
            </div>
            <div class="am-u-sm-3">
                <a href="#"><img src="/home/images/moneysmall.jpg"/>
                    <div class="title">投资理财</div>
                </a>
            </div>
        </div>

        <!--走马灯 -->

        <div class="marqueen">
            <span class="marqueen-title">商城头条</span>
            <div class="demo">
                @foreach($blog as $k=>$v)
                    <ul>
                        <li class="title-first"><a target="_blank" href="#">
                                <img src="/home/images/TJ2.jpg"></img>
                                <span>[特惠]</span>{{$v->bname }}
                            </a></li>
                        <li class="title-first"><a target="_blank" href="#">
                                <span>[公告]</span>商城与广州市签署战略合作协议
                                <img src="/home/images/TJ.jpg"></img>
                                <p>XXXXXXXXXXXXXXXXXX</p>
                            </a></li>

                        <div class="mod-vip">
                            <div class="m-baseinfo">
                                <a href="person/index.html">
                                    @if(session('IndexLogin'))
                                        <img src="/uploads/{{session('IndexUser')->uface}}">
                                    @else
                                        <img src="/home/images/getAvatar.do.jpg">
                                    @endif
                                </a>
                                <em>
                                    Hi,<span
                                            class="s-name">@if(session('IndexLogin')){{session('IndexUser')->name}}@else
                                            你好!@endif</span>
                                    <a href="#"><p>点击更多优惠活动</p></a>
                                </em>
                            </div>
                            <div class="member-logout">
                                @if(session('IndexLogin'))
                                    <a class="am-btn-warning btn" href="/home/person/index">进入用户中心</a>
                                @else
                                    <a class="am-btn-warning btn" href="login.html">登录</a>
                                    <a class="am-btn-warning btn" href="register.html">注册</a>
                                @endif
                            </div>
                            <div class="member-login">
                                <a href="#"><strong>0</strong>待收货</a>
                                <a href="#"><strong>0</strong>待发货</a>
                                <a href="#"><strong>0</strong>待付款</a>
                                <a href="#"><strong>0</strong>待评价</a>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <li><a target="_blank" href="#"><span>[特惠]</span>{{$v->bname }}</a></li>


                    </ul>
                @endforeach
                <div class="advTip"><img src="/home/images/advTip.jpg"/></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="shopMainbg">
    <div class="shopMain" id="shopmain">

        <!--今日推荐 -->

        <div class="am-g am-g-fixed recommendation">
            <div class="clock am-u-sm-3">
                <img src="/home/images/2016.png ">
                <p>今日<br>推荐</p>
            </div>
            @foreach($rec_data as $k=>$v)
                <div class="am-u-sm-4 am-u-lg-3 ">
                    <div class="info ">
                        <h3>{{ $v->rec_title }}</h3>
                        <h4>{{ $v->rec_desc}}</h4>
                    </div>
                    <div class="recommendationMain one">
                        <a href="introduction.html"><img src="/uploads/{{ $v->sub }}"></img></a>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="clear "></div>
        <!--热门活动 -->

        <div class="am-container activity ">
            <div class="shopTitle ">
                <h4>活动</h4>
                <h3>每期活动 优惠享不停 </h3>
                <span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;"></i></a>
                        </span>
            </div>
            <div class="am-g am-g-fixed ">
                @foreach($activity_data as $k=>$v)
                    <div class="am-u-sm-3 ">
                        <div class="icon-sale one "></div>
                        <h4>{{ $v->activity_tag }}</h4>
                        <div class="activityMain ">
                            <img src="/uploads/{{ $v->activity_path }}" height="300"></img>
                        </div>
                        <div class="info ">
                            <h3>{{ $v->activity_title }}</h3>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        {{--        <div class="clear "></div>--}}

        @foreach($goods_pid as $k=>$v)
            <div id="f1">
                <!--甜点-->
                <div class="am-container ">
                    <div class="shopTitle ">
                        <h4>{{$v->cname}}</h4>
                        <h3>{{$v->cname}}</h3>
                        <div class="today-brands ">
                            @foreach($v->sub as $kk=>$vv)
                                <a href="/list?cid={{$vv->id}}">{{$vv->cname}}</a>
                            @endforeach
                        </div>
                        <span class="more ">
                    <a href="/list?cid={{$v->id}}">更多分类<i class="am-icon-angle-right"
                                                          style="padding-left:10px ;"></i></a>
                        </span>
                    </div>
                </div>
                <div class="am-g am-g-fixed floodFour">
                    <div class="am-u-sm-5 am-u-md-4 text-one list ">
                        <div class="word">
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                            <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                        </div>
                        {{--                            <a href="/home/info/index/{{ $art->id }}">--}}
                        <div class="outer-con ">
                            <div class="title ">
                                {{--                                        {{$art->advert_title}}--}}
                            </div>
                            <div class="sub-title ">
                                {{--                                        {{$art->activity_desc}}--}}
                            </div>
                        </div>
                        {{--                                <img style="width:200px;height:212px;margin: 20px -110px;" src="/uploads/{{$art->url}} "/>--}}
                        </a>
                        <div class="triangle-topright"></div>
                    </div>
                    @foreach($v->sub as $kk=>$vv)
                        @foreach($vv->sub as $kkk=>$vvv)
                            <div class="am-u-sm-7 am-u-md-4 text-two">
                                <div class="outer-con ">
                                    <div class="title ">
                                        {{$vvv->gname}}
                                    </div>
                                    <div class="sub-title ">
                                        ¥{{$vvv->gprice}}
                                    </div>
                                    <i class="am-icon-shopping-basket am-icon-md  seprate"
                                       onclick="coll({{$vvv->id}})"></i></
                                >
                            </div>
                            <a href="/home/info/index/{{$vvv->id}}"><img src="/uploads/{{$vvv->gthumb_1}}"/></a>
                </div>
                @endforeach
                @endforeach
            </div>
            <div class="clear "></div>
    </div>
    @endforeach

    <div class="clear "></div>
    @include('/home/common/foot')
</div>
</div>
<!--引导 -->
@include('/home/common/navcir')


<!--菜单 -->
<div class=tip>
    <div id="sidebar">
        <div id="wrap">
            <div id="prof" class="item ">
                <a href="# ">
                    <span class="setting "></span>
                </a>
                <div class="ibar_login_box status_login ">
                    <div class="avatar_box ">
                        @if(empty($user))
                            <p class="avatar_imgbox "><img src="/home/images/no-img_mid_.jpg "/></p>
                        @else
                            <p class="avatar_imgbox "><img src="uploads/{{$user->uface}} "/></p>
                        @endif
                        <ul class="user_info ">
                            @if(empty($user))
                                <li>未登录</li>
                                <li>级别:未登录</li>
                            @else
                                <li>用户名{{$user->name}}</li>
                                @if($member->mname==1)
                                    <li>级别:普通会员</li>
                                @elseif($member->mname==2)
                                    <li>级别:超级会员</li>
                                @else
                                    <li>普通用户</li>
                                @endif

                            @endif
                        </ul>
                    </div>
                    @if(session('IndexLogin'))
                        <div class="login_btnbox ">
                            <a href="# " class="login_order ">我的订单</a>
                            <a href="# " class="login_favorite ">我的收藏</a>
                        </div>
                    @else
                        <div class="login_btnbox ">
                            <a href="/login" class="login_order ">立即登录</a>
                            <a href="/reg" class="login_favorite ">立即注册</a>
                        </div>
                    @endif
                    <i class="icon_arrow_white "></i>
                </div>

            </div>
            <div id="shopCart " class="item ">
                <a href="/home/cart/index">
                    <span class="message "></span>
                </a>
                <p>购物车</p>
                <p class="cart_num ">{{$countCart}}</p>
            </div>
            <div id="asset " class="item ">
                <a href="# ">
                    <span class="view "></span>
                </a>
                <div class="mp_tooltip ">
                    我的资产
                    <i class="icon_arrow_right_black "></i>
                </div>
            </div>

            <div id="foot " class="item ">
                <a href="/home/footprint/index">
                    <span class="zuji "></span>
                </a>
                <div class="mp_tooltip ">
                    我的足迹
                    <i class="icon_arrow_right_black "></i>
                </div>
            </div>

            <div id="brand " class="item ">
                <a href="#">
                    <span class="wdsc "><img src="/home/images/wdsc.png "/></span>
                </a>
                <div class="mp_tooltip ">
                    我的收藏
                    <i class="icon_arrow_right_black "></i>
                </div>
            </div>

            <div id="broadcast " class="item ">
                <a href="# ">
                    <span class="chongzhi "><img src="/home/images/chongzhi.png "/></span>
                </a>
                <div class="mp_tooltip ">
                    我要充值
                    <i class="icon_arrow_right_black "></i>
                </div>
            </div>

            <div class="quick_toggle ">
                <li class="qtitem ">
                    <a href="# "><span class="kfzx "></span></a>
                    <div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
                </li>
                <!--二维码 -->
                <li class="qtitem ">
                    <a href="#none "><span class="mpbtn_qrcode "></span></a>
                    <div class="mp_qrcode " style="display:none; "><img src="/home/images/weixin_code_145.png "/><i
                                class="icon_arrow_white "></i></div>
                </li>
                <li class="qtitem ">
                    <a href="#top " class="return_top "><span class="top "></span></a>
                </li>
            </div>

            <!--回到顶部 -->
            <div id="quick_links_pop " class="quick_links_pop hide "></div>

        </div>

    </div>
    <div id="prof-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            我
        </div>
    </div>
    <div id="shopCart-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            购物车
        </div>
    </div>
    <div id="asset-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            资产
        </div>

        <div class="ia-head-list ">
            <a href="# " target="_blank " class="pl ">
                <div class="num ">0</div>
                <div class="text ">优惠券</div>
            </a>
            <a href="# " target="_blank " class="pl ">
                <div class="num ">0</div>
                <div class="text ">红包</div>
            </a>
            <a href="# " target="_blank " class="pl money ">
                <div class="num ">￥0</div>
                <div class="text ">余额</div>
            </a>
        </div>

    </div>
    <div id="foot-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            足迹
        </div>
    </div>
    <div id="brand-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            收藏
        </div>
    </div>
    <div id="broadcast-content " class="nav-content ">
        <div class="nav-con-close ">
            <i class="am-icon-angle-right am-icon-fw "></i>
        </div>
        <div>
            充值
        </div>
    </div>
</div>
<script type="text/javascript " src="/home/basic/js/quick_links.js "></script>
</body>
<script type="text/javascript">
    // 轮播
    (function () {
        $('.am-slider').flexslider();
    });
    $(document).ready(function () {
        $("li").hover(function () {
            $(".category-content .category-list li.first .menu-in").css("display", "none");
            $(".category-content .category-list li.first").removeClass("hover");
            $(this).addClass("hover");
            $(this).children("div.menu-in").css("display", "block")
        }, function () {
            $(this).removeClass("hover")
            $(this).children("div.menu-in").css("display", "none")
        });
    })
</script>
<script type="text/javascript">
    if ($(window).width() < 640) {
        function autoScroll(obj) {
            $(obj).find("ul").animate({
                marginTop: "-39px"
            }, 500, function () {
                $(this).css({
                    marginTop: "0px"
                }).find("li:first").appendTo(this);
            })
        }

        $(function () {
            setInterval('autoScroll(".demo")', 3000);
        })
    }
</script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
<script>
    function coll(id) {
        $.get('/home/collect/add', {id: id}, function (res) {
            if(res=='加入收藏成功'){
                layer.msg(res);
            }else{
                layer.msg(res, {icon: 5});
            }
        },'html')
    }
</script>
</html>