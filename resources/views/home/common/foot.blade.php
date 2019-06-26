<div class="footer">
    <div class="footer-hd ">
        <p>
            <a href="javascript:; ">友情链接</a>
            <b>:</b>
           @foreach($links_data as $k=>$v) 
            <a href="{{ $v->title }}">{{ $v->lname }}</a>
            <b>|</b>
           @endforeach
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="# ">关于恒望</a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>