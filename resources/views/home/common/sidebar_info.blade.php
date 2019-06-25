<aside class="menu">
    <ul>
        <li class="person">
            <a href="/home/person/index">个人中心</a>
        </li>
        <li class="person">
            <a href="/home/person/infos">个人资料</a>
            <ul>
                <li><a href="information.html">个人信息</a></li>
                <li><a href="/home/safe/index">安全设置</a></li>
                <li><a href="address.html">收货地址</a></li>
            </ul>
        </li>
        <li class="person">
            <a href="#">我的交易</a>
            <ul>
                <li><a href="order.html">订单管理</a></li>
                <li><a href="change.html">退款售后</a></li>
            </ul>
        </li>
        <li class="person">
            <a href="#">我的资产</a>
            <ul>
                <li><a href="coupon.html">优惠券 </a></li>
                <li><a href="bonus.html">红包</a></li>
                <li><a href="bill.html">账单明细</a></li>
            </ul>
        </li>

        <li class="person">
            <a href="#">我的小窝</a>
            <ul>
                <li><a href="collection.html">收藏</a></li>
                <li><a href="/home/footprint/index">足迹</a></li>
                <li><a href="comment.html">评价</a></li>
                <li><a href="news.html">消息</a></li>
            </ul>
        </li>
    </ul>
</aside>
</div>
</body>
<script>
    $.ajaxSetup({    headers: {        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')    } });
</script>
</html>