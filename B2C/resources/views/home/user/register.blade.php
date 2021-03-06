<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">

    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="/css/pages-register.css" />
	<!-- <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script> -->
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">

			<h3>注册新用户<span class="go">我有账号，去<a href="{{route('login_before')}}" target="_blank">登陆</a></span></h3>

			<div class="info">

				@if ($errors->any())
				<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
				</ul>
				</div>
				@endif

				<!-- 注册表单 start -->
				<form action="{{route('do_register')}}" method="post" id="commentForm" class="sui-form form-horizontal">
					@csrf()
					<div class="control-group">	
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input name="name"  type="text" placeholder="请输入你的用户名" value="{{old('name')}}" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input name="password" id="password" type="password" value="{{old('password')}}" placeholder="设置登录密码" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input name="repassword"   type="password" value="{{old('repassword')}}" placeholder="再次确认密码" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">滑块验证：</label>
						<div class="controls">
							 {!! Geetest::render('popup') !!}	 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input name="phone" type="text" placeholder="请输入你的手机号" id="phone" value="{{old('phone')}}" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input name="phone_code"   type="text" placeholder="短信验证码" class="input-xfat input-xlarge">
						    <!-- <a href="#">获取短信验证码</a> -->
							<input style="height:38px;font-size:12px;" type="button" id="mobile" value="获取短信验证码">
						</div>
					</div>
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="checkbox" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<input class="sui-btn btn-block btn-xlarge btn-danger" type="submit" value="完成注册">
						</div>
					</div>

				</form>
				<!-- 注册表单 end -->



				<div class="clearfix"></div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/js/pages/register.js"></script>
<!-- 表单验证 -->
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
<script src="/js/register.js"></script>
</body>
</html>
<script>
	var seconds = 60;
	var si;
	$('#mobile').click(function(){
		var phone = $('#phone').val();
		
		$.ajax({
			url:"{{route('duanxin')}}",
			type: 'GET',
			data: {phone:phone},
			dataType: "json",
			success: function(data)
			{	
				console.log(data,data.result);
				if(data.result == 0)
				{
					$('#mobile').attr('disabled',true);
					si = setInterval(function(){
						if(seconds == 0)
						{	
							clearTimeout(si);
							$('#mobile').attr('disabled',false);
							seconds = 10;
							
							$('#mobile').val('发送验证码');	
						}
						else
						{
							$('#mobile').val('还剩'+(seconds));	
						}
						seconds--;
					},1000);
				}
			}

		});
	});
</script>
@include('layouts.app')