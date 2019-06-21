@include('/home/common/head_info')
		<div class="nav-table">
			<div class="long-title"><span class="all-goods">全部分类</span></div>
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="#">首页</a></li>
					<li class="qc"><a href="#">闪购</a></li>
					<li class="qc"><a href="#">限时抢</a></li>
					<li class="qc"><a href="#">团购</a></li>
					<li class="qc last"><a href="#">大包装</a></li>
				</ul>
				<div class="nav-extra">
					<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
					<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
				</div>
			</div>
		</div>
		<b class="line"></b>
        <style type="text/css">
        a{ color:#006600; text-decoration:none;}
		a:hover{color:#990000;}
		.info select{ border:1px #ccc solid; background:#FFFFFF;}
		.info{ margin:5px; text-align:center;}
		.info #show{ color:#3399FF; }
		.bottom{ text-align:right; font-size:12px; color:#CCCCCC; width:1000px;}
		</style>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-address">
						
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong id="address" class="am-text-danger am-text-lg">修改地址</strong> / <small>Add&nbsp;addres</small></div>
								</div>
								<hr/>
                                 @if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif
								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<form class="am-form am-form-horizontal"> 
									    <input type="hidden" name="token" value="{{$addres->_token}}">
                                        <input type="hidden" name="id" value="{{$addres->id}}">   
                          				<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" name="name" value="{{ $addres->name }}" id="user-name" placeholder="收货人">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" name="aphone" value="{{ $addres->aphone }}" placeholder="手机号必填" type="text">
											</div>
										</div>
										<div class="am-form-group">
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">
												<div class="info">
														<div>
														<select id="s_province"  name="aname[]"></select>&nbsp;&nbsp;
													    <select id="s_city"  name="aname[]" ></select>&nbsp;&nbsp;
													    <select id="s_county"  name="aname[]"></select>
													    <script type="text/javascript">_init_area();</script>
													    </div>
													    <div id="show"></div>
													</div>
												</div>
										    </div>

										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<textarea class="" name="dname" value="{{ $addres->dname }}" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
												<small>100字以内写出你的详细地址...</small>
											</div>
	                 					</div>
                                        
									</form>
									<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<button id="submit" class="am-btn am-btn-danger">修改</button>
												<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
											</div>
									    </div>
								</div>
							</div>

						</div>

					</div>
  
					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>
                    
                    <script type="text/javascript">
						var Gid  = document.getElementById ;
						var showArea = function(){
							Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + 	
							Gid('s_city').value + " - 县/区" + 
							Gid('s_county').value + "</h3>"
							}
					
						</script>
					<div class="clear"></div>

				</div>
				@include('/home/common/foot_info')

			    @include('/home/common/sidebar_info')
			    <script>
			       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
				    //提交表单
				    $("#submit").click(function () {
				        var cont = $("form").serialize();
				        layer.load(2, {shade: [0.1, '#fff']});
				        $.ajax({
				            url: "/home/addres/update",
				            type: 'post',
				            dataType: 'html',
				            data: cont,
				            success: function (res) {
				                layer.closeAll();
				                if (res == '修改成功') {
				                    layer.alert(res, {icon: 6}, function () {
				                        location.href = "/home/addres";
				                    });
				                } else {
				                    layer.msg(res, {icon: 5});
				                }
				            },
				            timeout: 10000,
				            error: function (XMLHttpRequest, textStatus, errorThrown) {
				                layer.closeAll();
				                if (textStatus == "timeout") {
				                    layer.msg('请求超时！');
				                } else {
				                    layer.msg('服务器错误！');
				                }
				            }
				        });
				    });
				</script>