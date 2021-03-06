<div class="hmtop">
    <!--顶部导航条 -->
    <div class="am-container header">
        <ul class="message-l">
            <div class="topMessage">
                <div class="menu-hd">
                    @if(session('IndexLogin'))
                        <a href="/home/person/index" target="_top"
                           class="h">欢迎您,尊敬的用户：{{session('IndexUser')->name}}</a>
                    @else
                        <a href="/login" target="_top" class="h">亲，请登录</a>
                        <a href="/reg" target="_top">免费注册</a>
                    @endif
                </div>
            </div>
        </ul>
        <ul class="message-r">
            <div class="topMessage home">
                <div class="menu-hd"><a href="/" target="_top" class="h">首页</a></div>
            </div>
            <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="/home/person/index" target="_top"><i
                                class="am-icon-user am-icon-fw"></i>个人中心</a>
                </div>
            </div>
            <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="/home/cart/index" target="_top"><i
                                class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum"
                                                                                                      class="h">({{ $countCart }}
                            )</strong></a>
                </div>
            </div>
            <div class="topMessage favorite">
                <div class="menu-hd"><a href="/home/collect/index" target="_top"><i
                                class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
                </div>
            </div>
            @if(session('IndexLogin'))
                <div class="topMessage favorite">
                    <div class="menu-hd"><a href="/logout" target="_top"><span>退出登录</span></a>
                    </div>
                </div>
            @endif
        </ul>
    </div>
    <!--悬浮搜索框-->
    <div class="nav white">
        <div class="logo"><img src="/home/images/logo.png"></div>
        <div class="logoBig">
            <li class=""><img src="/home/images/logobig.png"></li>
        </div>

        <div class="search-bar pr">
            <a name="index_none_header_sysc" href="#"></a>
            <form action="/home/search/index" method="get">
                <input id="searchInput" name="search" type="text" placeholder="搜索" autocomplete="off">
                <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
            </form>
        </div>
    </div>

    <div class="clear"></div>
</div>