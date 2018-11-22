<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购秒杀-正品秒杀！</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">


    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/widget-jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-seckill-index.css" />
</head>

<body>
	<!-- 头部栏位 -->
	@include('home.layout.home_nav')

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#service").hover(function(){
		$(".service").show();
	},function(){
		$(".service").hide();
	});
	$("#shopcar").hover(function(){
		$("#shopcarlist").show();
	},function(){
		$("#shopcarlist").hide();
	});

})
</script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script type="text/javascript" src="js/pages/seckill-index.js"></script>
<script>
	   $(function(){
		   $("#code").hover(function(){
			   $(".erweima").show();
		   },function(){
			   $(".erweima").hide();
		   });
	   })
	</script>
</body>

	<div class="py-container index">
		<!--banner-->
		<div class="banner">
			<img src="img/_/banner.png" class="img-responsive" alt="">
		</div>

		<!--商品列表-->
		<div class="goods-list">
			<ul class="seckill" id="seckill">

			
				@foreach($sec_good as $k => $v)
				<li class="seckill-item" >
					<div class="pic" >
						<img src="/uploads/{{$good[$k]['img']}}" alt=''  >
					</div>
					<div class="intro"><span>{{$good[$k]['name']}}</span></div>
					<div class='price'><b class='sec-price'>￥{{$v['price']}}</b><b class='ever-price'>￥{{$good[$k]['price']}}</b></div>
					<div class='num'>
						<!-- <div>已售87%</div>
						<div class='progress'>
							<div class='sui-progress progress-danger'><span style='width: 70%;' class='bar'></span></div>
						</div> -->
						<div>剩余<b class='owned'>{{$v['num']}}</b>件</div>
					</div>
					<a class='sui-btn btn-block btn-buy' href='/seckill?seck_id={{$v['id']}}' target='_blank'>立即抢购</a>
				</li>
				@endforeach


			</ul>
		</div>
		<div class="cd-top">
			<div class="top">
				<img src="img/_/gotop.png" />
				<b>TOP</b>
			</div>
			<div class="code" id="code">
				<span><img src="img/_/code.png"/></span>
			</div>
			<div class="erweima">
				<img src="img/_/erweima.jpg" alt="">
				<s></s>
			</div>
		</div>
	</div>

	<!--回到顶部-->

	<!-- 底部栏位 -->
@include('home.layout.bottom')

undefined

</html>
@include('layouts.app')