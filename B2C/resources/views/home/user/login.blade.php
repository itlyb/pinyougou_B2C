<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，欢迎登录</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">
    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-login.css" />
</head>

<body>
	<div class="login-box">
		<!--head-->
		<div class="py-container logoArea">
			<a href="/" class="logo"></a>
		</div>
		<!--loginArea-->
		<div class="loginArea">
			<div class="py-container login">
				<div class="loginform">
					<ul class="sui-nav nav-tabs tab-wraped">
						<li>
							<!-- <a href="/#index" data-toggle="tab">
								<h3>扫描登录</h3>
							</a> -->
						</li>
						<li class="active">
							<a href="/#profile" data-toggle="tab">
								<h3>账户登录</h3>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane">
							<p>二维码登录，暂为官网二维码</p>
							<img src="/img/wx_cz.jpg" />
						</div>
						<div id="profile" class="tab-pane  active">





						

							<!-- 登录表单 start -->
							<form class="sui-form" id="commentForm" action="{{route('do_login')}}" method="post">
								@csrf()
								<div class="input-prepend"><span class="add-on loginname"></span>
									<input id="prependedInput" name="name" type="text" required placeholder="用户名/手机号" class="span2 input-xfat">
								</div>

								<div class="input-prepend"><span class="add-on loginpwd"></span>
									<input id="prependedInput" name="password" type="password" required placeholder="请输入密码" class="span2 input-xfat">
								</div>

								<div class="input-prepend">
									{!! Geetest::render('popup') !!}
								</div>

								<div class="setting">
									<label class="checkbox inline">
										<input name="m1" type="checkbox" value="2" checked=""> 
										自动登录
									</label>
									<span class="forget">忘记密码？</span>
								</div>

								<div class="logined">
									<!-- <a class="sui-btn btn-block btn-xlarge btn-danger" href="/home-index.html" >登&nbsp;&nbsp;录</a> -->
									<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" value="登&nbsp;&nbsp;录">
								</div>
							</form>
							<!-- 用户登录表单 end -->









							<div class="otherlogin">
								<div class="types">
									<ul>
										<li><img src="/img/qq.png" width="35px" height="35px" /></li>
										<li><img src="/img/sina.png" /></li>
										<li><img src="/img/ali.png" /></li>
										<li><img src="/img/weixin.png" /></li>
									</ul>
								</div>
								<span class="register"><a href="{{route('register_before')}}" target="_blank">立即注册</a></span>
							</div>
						</div>
					</div>
				</div>
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
<script type="text/javascript" src="/js/pages/login.js"></script>
<!-- 表单验证 -->
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
<script src="/js/login.js"></script>
</body>
</html>

@include('layouts.app')