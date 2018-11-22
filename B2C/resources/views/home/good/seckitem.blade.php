<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>秒杀详细页</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">
	

    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-zoom.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-seckill-item.css" />
    <link rel="stylesheet" type="text/css" href="css/widget-cartPanelView.css" />
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
<script type="text/javascript" src="js/widget/cartPanelView.js"></script>
<script type="text/javascript" src="js/model/cartModel.js"></script>
<script type="text/javascript" src="js/czFunction.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.jqzoom/jquery.jqzoom.js"></script>
<script type="text/javascript" src="js/plugins/jquery.jqzoom/zoom.js"></script>
<script type="text/javascript">
			$(function(){
				$("ul.btn-choose li a.btn-xlarge").click(function(){
					alert("钻中");
				});
				$("#star").click(function(){
					alert("关注成功");
				})
			})
		</script>
</body>
	<div class="py-container">
		<div id="item">
			<div class="crumb-wrap">
				<ul class="sui-breadcrumb">
					
				</ul>
			</div>
			<!--product-info-->
			<div class="product-info">
				<div class="fl preview-wrap">
					<!--放大镜效果-->
					<div class="zoom">
						<!--默认第一个预览-->
						<div id="preview" class="spec-preview">
							<span class="jqzoom"><img style="width:100%;" jqimg="/uploads/{{$good['img']}}" src="/uploads/{{$good['img']}}" /></span>
						</div>						
					</div>
					
				</div>
				<div class="fr itemInfo-wrap">
					<div class="sku-name">
						<h4>{{$good['name']}}</h4>
					</div>
					<div class="news">
						<span><img src=""/>品优秒杀</span>
						<span class="overtime">距离结束：<span id="time"></span></span>
						</div>
					<div class="summary">
						<div class="summary-wrap">
							
							<div class="fl title">
								<i>秒杀价</i>
							</div>
							<div class="fl price">
								<i>¥</i>
								<em>{{$seck_good['price']}}</em>
								<span>原价：{{$good['price']}}</span>
							</div>
							<div class="fr remark">
								剩余库存：{{$seck_good['num']}}
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>促　　销</i>
							</div>
							<div class="fl fix-width">
								<i class="red-bg">加价购</i>
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
							</div>
						</div>
					</div>
					<div class="support">
						<div class="summary-wrap">
							<div class="fl title">
								<i>支　　持</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">以旧换新，闲置手机回收  4G套餐超值抢  礼品购</em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>配 送 至</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
							</div>
						</div>
					</div>
					<div class="clearfix choose">
						

						<div class="summary-wrap">
							<div class="fl title">
								
							</div>
							<div class="fl">
								<ul class="btn-choose unstyled">
									<li>
										<a href="cart.html" target="_blank" class="sui-btn  btn-danger addshopcar">立即抢购</a>
										
										<form action="">

										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--product-detail-->
			<div class="clearfix product-detail">
				<div class="fl aside">
					<div class="shop">
						<span class="fl">三星旗舰店</span><span class="fr"><a href="shop.html" target="_blank" class="sui-btn btn-bordered btn-danger">进入店铺</a></span>
					</div>
					<div class="clearfix"></div>
					<ul class="sui-nav nav-tabs tab-wraped">
						<li class="active">
							<a href="#index" data-toggle="tab">
								<span>相关分类</span>
							</a>
						</li>
						<li>
							<a href="#profile" data-toggle="tab">
								<span>推荐品牌</span>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane active">
							<ul class="part-list unstyled">
								<li>手机</li>
								<li>手机壳</li>
								<li>内存卡</li>
								<li>Iphone配件</li>
								<li>贴膜</li>
								<li>手机耳机</li>
								<li>移动电源</li>
								<li>平板电脑</li>
							</ul>
							<ul class="goods-list unstyled">
								<li>
									<div class="list-wrap">
										<div class="p-img">
											<img src="img/_/part01.png" />
										</div>
										<div class="attr">
											<em>Apple苹果iPhone 6s (A1699)</em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i>6088.00</i>
										</strong>
										</div>
										<div class="operate">
											<a href="javascript:void(0);" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
								</li>
								
							</ul>
						</div>
						<div id="profile" class="tab-pane">
							<p>推荐品牌</p>
						</div>
					</div>
				</div>
				<div class="fr detail">
					
					<div class="tab-main intro">
						<ul class="sui-nav nav-tabs tab-wraped">
							<li class="active">
								<a href="#one" data-toggle="tab">
									<span>商品介绍</span>
								</a>
							</li>
							<li>
								<a href="#two" data-toggle="tab">
									<span>规格与包装</span>
								</a>
							</li>
							<li>
								<a href="#three" data-toggle="tab">
									<span>售后保障</span>
								</a>
							</li>
							<li>
								<a href="#four" data-toggle="tab">
									<span>商品评价</span>
								</a>
							</li>

						</ul>
						<div class="clearfix"></div>
						<div class="tab-content tab-wraped">
							<div id="one" class="tab-pane active">
								<p>产品介绍</p>
							</div>
							<div id="two" class="tab-pane">
								<p>规格与包装</p>
							</div>
							<div id="three" class="tab-pane">
								<p>售后保障</p>
							</div>
							<div id="four" class="tab-pane">
								<p>商品评价</p>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- 底部栏位 -->




@include('home.layout.bottom')





@include('home.layout.right_nav')



undefined

</html>

@include('layouts.app')

<script>

	window.onload = function(){
   
		var endTime = new Date("{{$seck_good['end_time']}}"); // 最终时间
		var timeclock = setInterval(clock,1000); // 开启定时器
		function clock(){
			var nowTime = new Date(); // 一定是要获取最新的时间
			// console.log(nowTime.getTime()); 获得自己的毫秒
			var second = parseInt((endTime.getTime() - nowTime.getTime()) / 1000);
			// 用将来的时间毫秒 - 现在的毫秒 / 1000 得到的 还剩下的秒 可能处不断 取整
			// console.log(second);
			// 一小时 3600 秒
			// second / 3600 一共的小时数 /24 天数
			var d = parseInt(second / 3600 / 24); //天数
			//console.log(d);
			var h = parseInt(second / 3600 % 24) // 小时
			// console.log(h);
			var m = parseInt(second / 60 );
			//console.log(m);
			var s = parseInt(second ); // 当前的秒
			console.log(s);
			/* if(d<10)
			{
			d = "0" + d;
			}*/
			d<10 ? d="0"+d : d;
			h<10 ? h="0"+h : h;
			m<10 ? m="0"+m : m;
			s<10 ? s="0"+s : s;
			// demo.innerHTML = "距离抢购时间还剩: "+d+"天 "+h+"小时 "+m+"分钟 "+s+"秒";
			$('#time').html("距离抢购时间还剩: "+d+"天 "+h+"小时 "+m+"分钟 "+s+"秒");
			if(s == 0)
			{
				clearInterval(timeclock);
				window.close();
			}
		}
  	}

</script>