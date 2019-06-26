@include('/home/common/head_info')
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="user-foot">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> /
                        <small>Browser&nbsp;History</small>
                    </div>
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
                                    <a class="goods-delete" href="Javascript:;"><i class="am-icon-trash"></i></a>
                                    <div class="goods-status goods-status-show"><span class="desc">宝贝已下架</span></div>
                                @else
                                    <a class="goods-delete" href="Javascript:;"><i class="am-icon-trash"></i></a>
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
