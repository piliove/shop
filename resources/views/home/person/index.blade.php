@include('home.common.head_info')   

<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">
            <div class="wrap-left">
                <div class="wrap-list">
                    <div class="m-user">
                        <!--个人信息 -->
                        <div class="m-bg"></div>
                        <div class="m-userinfo">
                            <div class="m-baseinfo">
                                <a href="/home/person/infos">
                                    <img src="/home/images/getAvatar.do.jpg">
                                </a>
                                <em class="s-name">{{$user->name}}<span class="vip1"></em>
                                <div class="s-prestige am-btn am-round">
                                    </span>@if($member->mname==1)普通会员@elseif($member->mname==2)超级会员@else普通用户@endif
                                </div>
                            </div>
                            <div class="m-right">
                                <div class="m-new">
                                    <a href="news.html"><i class="am-icon-bell-o"></i>消息</a>
                                </div>
                                <div class="m-address">
                                    <a href="/home/addres/index" class="i-trigger">我的收货地址</a>
                                </div>
                            </div>
                        </div>

                        <!--个人资产-->
                        <div class="m-userproperty">
                            <div class="s-bar">
                                <i class="s-icon"></i>个人资产
                            </div>
                            <p class="m-bonus">
                                <a href="bonus.html">
                                    <i><img src="/home/images/bonus.png"/></i>
                                    <span class="m-title">红包</span>
                                    <em class="m-num">2</em>
                                </a>
                            </p>
                            <p class="m-coupon">
                                <a href="coupon.html">
                                    <i><img src="/home/images/coupon.png"/></i>
                                    <span class="m-title">优惠券</span>
                                    <em class="m-num">2</em>
                                </a>
                            </p>
                            <p class="m-bill">
                                <a href="bill.html">
                                    <i><img src="/home/images/wallet.png"/></i>
                                    <span class="m-title">钱包</span>
                                    <em class="m-num">{{ $fund }}</em>
                                </a>
                            </p>
                            <p class="m-big">
                                <a href="#">
                                    <i><img src="/home/images/day-to.png"/></i>
                                    <span class="m-title">签到有礼</span>
                                </a>
                            </p>
                            <p class="m-big">
                                <a href="#">
                                    <i><img src="/home/images/72h.png"/></i>
                                    <span class="m-title">72小时发货</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="box-container-bottom"></div>

                    <!--订单 -->
                    <div class="m-order">
                        <div class="s-bar">
                            <i class="s-icon"></i>我的订单
                            <a class="i-load-more-item-shadow" href="order.html">全部订单</a>
                        </div>
                        <ul>
                            <li><a href="order.html"><i><img src="/home/images/pay.png"/></i><span>待付款</span></a></li>
                            <li><a href="order.html"><i><img src="/home/images/send.png"/></i><span>待发货<em
                                                class="m-num">1</em></span></a></li>
                            <li><a href="order.html"><i><img src="/home/images/receive.png"/></i><span>待收货</span></a>
                            </li>
                            <li><a href="order.html"><i><img src="/home/images/comment.png"/></i><span>待评价<em
                                                class="m-num">3</em></span></a></li>
                            <li><a href="change.html"><i><img src="/home/images/refund.png"/></i><span>退换货</span></a>
                            </li>
                        </ul>
                    </div>
                    <!--九宫格-->
                    <div class="user-patternIcon">
                        <div class="s-bar">
                            <i class="s-icon"></i>我的常用
                        </div>
                        <ul>

                            <a href="/home//cart/index">
                                <li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img
                                            src="/home/images/iconbig.png"/>
                                    <p>购物车</p></li>
                            </a>
                            <a href="/home/collect/index">
                                <li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img
                                            src="/home/images/iconsmall1.png"/>
                                    <p>我的收藏</p></li>
                            </a>
                            <a href="home/home.html">
                                <li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img
                                            src="/home/images/iconsmall0.png"/>
                                    <p>为你推荐</p></li>
                            </a>
                            <a href="comment.html">
                                <li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img
                                            src="/home/images/iconsmall3.png"/>
                                    <p>好评宝贝</p></li>
                            </a>
                            <a href="/home/footprint/index">
                                <li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img
                                            src="/home/images/iconsmall2.png"/>
                                    <p>我的足迹</p></li>
                            </a>
                        </ul>
                    </div>
                    <!--物流 -->
                    <div class="m-logistics">

                        <div class="s-bar">
                            <i class="s-icon"></i>我的物流
                        </div>
                        <div class="s-content">
                            <ul class="lg-list">

                                <li class="lg-item">
                                    <div class="item-info">
                                        <a href="#">
                                            <img src="/home/images/65.jpg_120x120xz.jpg"
                                                 alt="抗严寒冬天保暖隔凉羊毛毡底鞋垫超薄0.35厘米厚吸汗排湿气舒适">
                                        </a>

                                    </div>
                                    <div class="lg-info">

                                        <p>快件已从 义乌 发出</p>
                                        <time>2015-12-20 17:58:05</time>

                                        <div class="lg-detail-wrap">
                                            <a class="lg-detail i-tip-trigger" href="logistics.html">查看物流明细</a>
                                            <div class="J_TipsCon hide">
                                                <div class="s-tip-bar">中通快递&nbsp;&nbsp;&nbsp;&nbsp;运单号：373269427686
                                                </div>
                                                <div class="s-tip-content">
                                                    <ul>
                                                        <li>快件已从 义乌 发出2015-12-20 17:58:05</li>
                                                        <li>义乌 的 义乌总部直发车 已揽件2015-12-20 17:54:49</li>
                                                        <li class="s-omit"><a data-spm-anchor-id="a1z02.1.1998049142.3"
                                                                              target="_blank" href="#">··· 查看全部</a></li>
                                                        <li>您的订单开始处理2015-12-20 08:13:48</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lg-confirm">
                                        <a class="i-btn-typical" href="#">确认收货</a>
                                    </div>
                                </li>
                                <div class="clear"></div>

                                <li class="lg-item">
                                    <div class="item-info">
                                        <a href="#">
                                            <img src="/home/images/88.jpg_120x120xz.jpg"
                                                 alt="礼盒袜子女秋冬 纯棉袜加厚 女式中筒袜子 韩国可爱 女袜 女棉袜">
                                        </a>

                                    </div>
                                    <div class="lg-info">

                                        <p>已签收,签收人是青年城签收</p>
                                        <time>2015-12-19 15:35:42</time>

                                        <div class="lg-detail-wrap">
                                            <a class="lg-detail i-tip-trigger" href="logistics.html">查看物流明细</a>
                                            <div class="J_TipsCon hide">
                                                <div class="s-tip-bar">天天快递&nbsp;&nbsp;&nbsp;&nbsp;运单号：666287461069
                                                </div>
                                                <div class="s-tip-content">
                                                    <ul>

                                                        <li>已签收,签收人是青年城签收2015-12-19 15:35:42</li>
                                                        <li>【光谷关山分部】的派件员【关山代派】正在派件 电话:*2015-12-19 14:27:28</li>
                                                        <li class="s-omit"><a data-spm-anchor-id="a1z02.1.1998049142.7"
                                                                              target="_blank"
                                                                              href="//wuliu.taobao.com/user/order_detail_new.htm?spm=a1z02.1.1998049142.7.8BJBiJ&amp;trade_id=1479374251166800&amp;seller_id=1651462988&amp;tracelog=yimaidaologistics">···
                                                                查看全部</a></li>
                                                        <li>您的订单开始处理2015-12-17 14:27:50</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lg-confirm">
                                        <a class="i-btn-typical" href="#">确认收货</a>
                                    </div>
                                </li>

                            </ul>

                        </div>

                    </div>

                    <!--收藏夹 -->
                    <div class="you-like">
                        <div class="s-bar">我的收藏
                            <a class="i-load-more-item-shadow" name="collect" href="/home/person/index/#collect"><i
                                        class="am-icon-refresh am-icon-fw"></i>换一组</a>
                        </div>
                        <div class="s-content">
                            @foreach($collects as $k=>$v)
                                <div class="s-item-wrap">
                                    <div class="s-item">

                                        <div class="s-pic">
                                            <a href="/home/info/index/{{$v->gid}}" class="s-pic-link">
                                                <img src="/uploads/{{$v->cthumb}}"
                                                     alt="{{$v->ctitle}}"
                                                     title="{{$v->ctitle}}"
                                                     class="s-pic-img s-guess-item-img">
                                            </a>
                                        </div>
                                        <div class="s-price-box">
                                        <span class="s-price"><em class="s-price-sign">¥</em><em
                                                    class="s-value">{{$v->cprices}}</em></span>
                                            <span class="s-history-price"><em class="s-price-sign">¥</em><em
                                                        class="s-value">{{$v->cprice}}</em></span>
                                        </div>
                                        <div class="s-title"><a href="/home/info/index/{{$v->gid}}"
                                                                title="{{$v->ctitle}}">{{$v->ctitle}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-right">
                <!-- 日历-->
                <div class="day-list">
                    <div class="s-bar">
                        <a class="i-history-trigger s-icon" href="#"></a>我的日历
                        <a class="i-setting-trigger s-icon" href="#"></a>
                    </div>
                    <div class="s-care s-care-noweather">
                        <div class="s-date">
                            <em>{{date('d',time())}}</em>
                            @if(date('w',time())==0)
                                <span>星期日</span>
                            @elseif(date('w',time())==1)
                                <span>星期一</span>
                            @elseif(date('w',time())==2)
                                <span>星期二</span>
                            @elseif(date('w',time())==3)
                                <span>星期三</span>
                            @elseif(date('w',time())==4)
                                <span>星期四</span>
                            @elseif(date('w',time())==5)
                                <span>星期五</span>
                            @else
                                <span>星期六</span>
                            @endif
                            <span>{{date('Y.m'),time()}}</span>
                        </div>
                    </div>
                </div>
                <!--新品 -->
                <div class="new-goods">
                    <div class="s-bar">
                        <i class="s-icon"></i>今日新品
                        <a class="i-load-more-item-shadow">最新上架</a>
                    </div>
                    <div class="new-goods-info">
                        <a class="shop-info" href="/home/info/index/{{$goods_1->id}}">
                            <div class="face-img-panel">
                                <img src="/uploads/{{$goods_1->gthumb_1}}" alt="">
                            </div>
                            <span class="new-goods-num ">1</span>
                            <span class="shop-title">{{$goods_1->gname}}</span>
                        </a>
                        <a class="follow" href="/home/info/index/{{$goods_1->id}}">详情</a>
                    </div>
                </div>

                <!--热卖推荐 -->
                <div class="new-goods">
                    <div class="s-bar">
                        <i class="s-icon"></i>热卖推荐
                    </div>
                    <div class="new-goods-info">
                        <a class="shop-info" href="/home/info/index/{{$goods_page->id}}" target="_blank">
                            <div>
                                <img src="/uploads/{{$goods_page->gthumb_1}}" alt="">
                            </div>
                            <span class="one-hot-goods">￥{{$goods_page->gprices}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--底部-->
        <div class="footer">
            <div class="footer-hd">
                <p>
                    <a href="#">恒望科技</a>
                    <b>|</b>
                    <a href="#">商城首页</a>
                    <b>|</b>
                    <a href="#">支付宝</a>
                    <b>|</b>
                    <a href="#">物流</a>
                </p>
            </div>
            <div class="footer-bd">
                <p>
                    <a href="#">关于恒望</a>
                    <a href="#">合作伙伴</a>
                    <a href="#">联系我们</a>
                    <a href="#">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>
    </div>
@include('/home/common/navcir')
@include('home.common.sidebar_info')
