@include('/home/common/head_info')
@include('home.common.head_nav')
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
					<!--标题 -->
					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
					</div>
					<hr/>
					<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
                    @foreach($addres as $k=>$v)
						<li onclick="defaultAddr({{$v->id}})" class="user-addresslist 
						 @if($v->status == 1)
                            defaultAddr
                        @endif
						 "  style="margin-bottom:10px;margin-left:15px;">
						
							<span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
				
							<p class="new-tit new-p-re">
								<span class="new-txt">{{ $v->name }}</span>
								<span class="new-txt-rd2">{{ $v->aphone }}</span>
							</p>
							<div class="new-mu_l2a new-p-re">
								<p class="new-mu_l2cw">
									<span class="title">地址：</span>
									<span class="province">{{ $v->aname }}</span>
									
									<span class="street">{{ $v->dname }}</span></p>
							</div>
							<div class="new-addr-btn">
								<a href="/home/addres/{{$v->id}}/edit">编辑</a>
								<span class="new-addr-bar">|</span>
								<a href="JavaScript:;"  onclick="del({{$v->id}},this)"><i class="am-icon-trash"></i>删除</a>
							</div>
						</li>
						@endforeach
						<script>
    						
						</script>
						<script>
					    function del(id, obj) {
					        layer.msg('确定删除?', {
					            time: 0 //不自动关闭
					            , btn: ['确定', '取消']
					            , yes: function () {
					                $.get('/home/addres/del?id=' + id, function (res) {
					                    if (res == '删除成功') {
					                        layer.alert(res, {icon: 6});
					                        $(obj).parent().parent().remove();
					                    } else {
					                        layer.msg(res, {icon: 5});
					                    }
					                }, 'html')
					            }
					        });
					    }
					     function defaultAddr(id){
                            let url = '/home/addres/defaultaddres/'+id;
                                $.get(url,function(res){
                                    if (res == 0) {
                                        layer.msg('设置成功');
                                    }else if(res == 1000){
                                        layer.msg('设置失败,请稍后重试', function(){
                                        //关闭后的操作
                                        });
                                    }
                                })
                         }
						</script>
						</ul>
					<div class="clear"></div>
					<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
					<!--例子-->
					<div class="am-modal am-modal-no-btn" id="doc-modal-1">

						<div class="add-dress">

							<!--标题 -->
							<div class="am-cf am-padding">
								<div class="am-fl am-cf"><strong id="address" class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
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
								<form class="am-form am-form-horizontal"  action="/home/addres" method="post">
                                         {{ csrf_field() }}
									<div class="am-form-group">
										<label for="user-name" class="am-form-label">收货人</label>
										<div class="am-form-content">
											<input type="text" name="name" id="user-name" placeholder="收货人">
										</div>
									</div>

									<div class="am-form-group">
										<label for="user-phone" class="am-form-label">手机号码</label>
										<div class="am-form-content">
											<input id="user-phone" name="aphone" placeholder="手机号必填" type="text">
										</div>
									</div>
									<div class="am-form-group">
										<label for="user-address" class="am-form-label">所在地</label>
										<div class="am-form-content address">
											<div class="info">
													<div>
													<select id="s_province" name="aname[]"></select>&nbsp;&nbsp;
												    <select id="s_city" name="aname[]" ></select>&nbsp;&nbsp;
												    <select id="s_county" name="aname[]"></select>
												    <script type="text/javascript">_init_area();</script>
												    </div>
												    <div id="show"></div>
												</div>
											</div>
									    </div>

									<div class="am-form-group">
										<label for="user-intro" class="am-form-label">详细地址</label>
										<div class="am-form-content">
											<textarea class="" name="dname" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
											<small>100字以内写出你的详细地址...</small>
										</div>
                 					</div>
                                    <div class="am-form-group">
										<div class="am-u-sm-9 am-u-sm-push-3">
											<button id="submit" class="am-btn am-btn-danger">添加</button>
											<a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
										</div>
								    </div>
								</form>
								
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
<<<<<<< HEAD

=======
>>>>>>> origin/muyinya
		    @include('/home/common/sidebar_info')
		    