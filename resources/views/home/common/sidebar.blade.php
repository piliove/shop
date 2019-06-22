<!--侧边导航 -->
<div id="nav" class="navfull">
    <div class="area clearfix">
        <div class="category-content" id="guide_2">
            <div class="category">
                <ul class="category-list" id="js_climit_li">
                @foreach($cate_data as $k=>$v)
                    <li class="appliance js_toggle relative first">
                        <div class="category-info">
                            <h3 class="category-name b-category-name">
                            <i>
                            @switch($v->id)
                                @case(1)
                                    <img src="/home/images/icons/jiadian.png">
                                    @break
                                @case(5)
                                    <img src="/home/images/icons/fuzhuang.png">
                                    @break
                                @case(13)
                                    <img src="/home/images/icons/jiaju.png">
                                    @break
                                @case(18)
                                    <img src="/home/images/icons/food.png">
                                    @break
                                @case(24)
                                    <img src="/home/images/icons/diannao.png">
                                    @break
                                @case(29)
                                    <img src="/home/images/icons/yundong.png">
                                    @break
                                @case(32)
                                    <img src="/home/images/icons/qiche.png">
                                    @break
                                @case(33)
                                    <img src="/home/images/icons/hua.png">
                                    @break
                                @case(34)
                                    <img src="/home/images/icons/yiyaobaojian.png">
                                    @break
                            @endswitch
                            

                            </i><a
                                        class="ml-22" title="点心">{{ $v->cname }}</a></h3>
                            <em>&gt;</em></div>
                        <div class="menu-item menu-in top">
                            <div class="area-in">
                                <div class="area-bg">
                                    <div class="menu-srot">
                                        <div class="sort-side">
                                        @foreach($v->sub as $kk=>$vv)
                                            <dl class="dl-sort">
                                                <dt><span title="{{ $vv->cname }}">{{ $vv->cname }}</span></dt>
                                            @foreach($vv->sub as $kkk=>$vvv)
                                                <dd><a title="{{ $vvv->cname }}" href="#"><span>{{ $vvv->cname }}</span></a></dd>
                                            @endforeach    
                                            </dl>
                                        @endforeach
                                            

                                        </div>
                                        <div class="brand-side">
                                            <dl class="dl-sort">
                                                <dt><span>实力商家</span></dt>
                                                <dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#"
                                                       rel="nofollow"><span class="red">呵官方旗舰店</span></a></dd>
                                                <dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#"
                                                       rel="nofollow"><span>格瑞旗舰店</span></a></dd>
                                                <dd><a rel="nofollow" title="飞彦大厂直供" target="_blank" href="#"
                                                       rel="nofollow"><span class="red">飞彦大厂直供</span></a></dd>
                                                <dd><a rel="nofollow" title="红e·艾菲妮" target="_blank" href="#"
                                                       rel="nofollow"><span>红e·艾菲妮</span></a></dd>
                                                <dd><a rel="nofollow" title="本真旗舰店" target="_blank" href="#"
                                                       rel="nofollow"><span class="red">本真旗舰店</span></a></dd>
                                                <dd><a rel="nofollow" title="杭派女装批发网" target="_blank" href="#"
                                                       rel="nofollow"><span class="red">杭派女装批发网</span></a></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <b class="arrow"></b>
                    </li>
                @endforeach
   
                </ul>
            </div>
        </div>

    </div>
</div>