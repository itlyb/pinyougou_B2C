<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>微信支付页</title>
        <link rel="icon" href="/img/bitbug_favicon.ico">
		
	
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-weixinpay.css" />
</head>

	<body>
		<!--head-->
		<div class="top">
			<div class="py-container">
				<div class="shortcut">
					<ul class="fl">
						<li class="f-item">品优购欢迎您！</li>
						<li class="f-item">请登录　<span><a href="#">免费注册</a></span></li>
					</ul>
					<ul class="fr">
						<li class="f-item">我的订单</li>
						<li class="f-item space"></li>
						<li class="f-item">我的品优购</li>
						<li class="f-item space"></li>
						<li class="f-item">品优购会员</li>
						<li class="f-item space"></li>
						<li class="f-item">企业采购</li>
						<li class="f-item space"></li>
						<li class="f-item">关注品优购</li>
						<li class="f-item space"></li>
						<li class="f-item">客户服务</li>
						<li class="f-item space"></li>
						<li class="f-item">网站导航</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="cart py-container">
			<!--logoArea-->
			<div class="logoArea">
				<div class="fl logo"><span class="title">收银台</span></div>

			</div>
			<!--主内容-->
			<div class="checkout py-container  pay">
				<div class="checkout-tit">
					<h4 class="fl tit-txt"><span class="success-icon"></span><span  class="success-info">订单提交成功，请您及时付款！订单组号：{{$pay['sns']}}</span></h4>
                    <span class="fr"><em class="sui-lead">应付金额：</em><em  class="orange money">￥{{$pay['money']}}</em>元</span>
					<div class="clearfix"></div>
				</div>				
				<div class="checkout-steps">
					<div class="fl weixin">微信支付</div>
                    <div class="fl sao"> 
                        <!-- <p class="red">二维码已过期，刷新页面重新获取二维码。</p>                       -->
                        <div class="fl code">
                            <img src="/qrcode?code={{$pay['code']}}" alt="">
                            <div class="saosao">
                                <p>请使用微信扫一扫</p>
                                <p>扫描二维码支付</p>
                            </div>
                        </div>
                        <div class="fl phone">
                            
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
				    <p><a href="pay.html" target="_blank">> 其他支付方式</a></p>
				</div>
			</div>

		</div>
		<!-- 底部栏位 -->
		
		@include('home.layout.bottom')
		
	
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script type="text/javascript">
			$(function(){
				$("ul.payType li").click(function(){
					$(this).css("border","2px solid #E4393C").siblings().css("border-color","#ddd");
				})
			})
			
</script>
</body>

</html>
<script>

	function check()
	{
		$.ajax({
			type:"GET",
			url:"{{route('orderStatus')}}?sn={{$pay['sns']}}",
			success:function(data)
			{
				if(data == 1)
				{
					alert("支付成功！");
					// 关闭页面
					window.close();
				}
				else
				{
					// 1秒之后执行一次
					setTimeout(check, 1000);
				}
			}
		}); 
	}
// 1秒之后执行一次
setTimeout(check, 1000);
</script>
<script type="text/javascript"> 
$(function() {
　　if (window.history && window.history.pushState) {
　　$(window).on('popstate', function () {
　　window.history.pushState('forward', null, '#');
　　window.history.forward(1);
　　});
　　}
　　window.history.pushState('forward', null, '#'); //在IE中必须得有这两行
　　window.history.forward(1);
　　})
</script> 