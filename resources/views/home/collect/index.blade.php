@include('/home/common/head_info')
<link href="/home/css/colstyle.css" rel="stylesheet" type="text/css">
<b class="line"></b>
<div class="center">
    <div class="col-main">
        <div class="main-wrap">

            <div class="user-collection">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> /
                        <small>My&nbsp;Collection</small>
                    </div>
                </div>
                <hr/>

                <div class="you-like">
                    <div class="s-bar">
                        我的收藏
                    </div>
                    <div class="s-content">
                        @if( session('IndexLogin') == true )
                            @foreach($data as $k => $v)
                                <div class="s-item-wrap">
                                    <div class="s-item">

                                        <div class="s-pic">
                                            <a href="/home/info/index/{{ $v->gid }}" class="s-pic-link">
                                                <img src="/uploads/{{ $v->cthumb }}" alt="{{ $v->ctitle }}"
                                                     title="{{ $v->ctitle }}" class="s-pic-img s-guess-item-img">
                                            </a>
                                        </div>
                                        <div class="s-info">
                                            <div class="s-title"><a href=""
                                                                    title="{{ $v->ctitle }}">{{ $v->ctitle }}</a></div>
                                            <div class="s-price-box">
                                                <span class="s-price"><em class="s-price-sign">¥</em><em
                                                            class="s-value">{{ $v->cprices }}</em></span>
                                                <span class="s-history-price"><em class="s-price-sign">¥</em><em
                                                            class="s-value">{{ $v->cprice }}</em></span>
                                            </div>
                                            <div class="s-extra-box">
                                                <span class="s-comment">好评: 00.00%</span>
                                                <span class="s-sales">月销: 0</span>
                                            </div>
                                        </div>
                                        <div class="s-tp">
                                            <span class="ui-btn-loading-before"><a
                                                        href="JavaScript:;"
                                                        onclick="del({{$v->id}},this)">取消收藏</a></span>
                                            <i class="am-icon-shopping-cart"></i>
                                            <span class="ui-btn-loading-before buy"><a
                                                        href="/home/info/index/{{ $v->gid }}">加入购物车</a></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多
                    </div>

                </div>

            </div>

        </div>
        <!--底部-->
        <script>
            function del(id, obj) {
                layer.msg('确定取消收藏吗？', {
                    time: 0 //不自动关闭
                    , btn: ['确定', '取消']
                    , yes: function () {
                        $.get('/home/collect/del?id=' + id, function (res) {
                            if (res == '取消成功') {
                                layer.alert(res, {icon: 6});
                                $(obj).parent().parent().parent().remove();
                            } else {
                                layer.msg(res, {icon: 5});
                            }
                        }, 'html')
                    }
                });
            }
        </script>
@include('/home/common/foot_info')
@include('/home/common/sidebar_info')
@include('/home/common/navcir')
