@include('/home/common/head_info')
<link href="/home/css/stepstyle.css" rel="stylesheet" type="text/css">
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">反馈留言</strong> / <small>Feedback</small></div>
					</div>
					<hr/>
					<form style="margin-top:100px;" class="am-form am-form-horizontal" action="/home/feedback/add" method="post">
						{{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-email" class="am-form-label">用户名</label>
							<div class="am-form-content">
								<input type="text" name="uname" id="user-email" placeholder="请输入用户名">
							</div>
						</div>
						<div class="am-form-group">
                            <label for="user-email" class="am-form-label">反馈留言</label>
							<div class="am-form-content">
								<textarea name="feedback_info" id="" cols="30" rows="10" placeholder="请输入反馈留言..."></textarea>
							</div>
						</div>
						<div class="info-btn">
							<div class="am-btn am-btn-danger" style="margin-top:140px;"><input type="submit" value="提交反馈" style="background:#dd514c;border:none;padding:3px;" /></div>
						</div>
					</form>

				</div>
				<!--底部-->
@include('/home/common/foot_info')
@include('/home/common/sidebar_info')
@include('/home/common/navcir')
