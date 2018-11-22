<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>品优推荐</title>
        <link rel="icon" href="/img/bitbug_favicon.ico">
		
	
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-weixinpay.css" />
</head>

	<body>
		<!--head-->
		<div class="top">
			<div class="py-container">
                <div class="yui3-u Left logoArea">
				        <a class="logo-bd" title="品优购" href="/" ></a>
			    </div>
			</div>
		</div>
		<div class="cart py-container">
			{!!$article['content']!!}
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