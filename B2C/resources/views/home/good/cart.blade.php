<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>我的购物车</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-cart.css" />
	<style>
		img {
			max-width: 70%;
			width: auto\9;
			height: 90%;
			vertical-align: middle;
			border: 0;
			-ms-interpolation-mode: bicubic;
		}
		.item ul li {
			text-align: center;
			list-style-type: none;
			display: inline-block;
			margin-right: -7px;
			border: 1px dashed #ddd;
			padding: 10px;
			position: relative;
			zoom: 1;
		}
	</style>
</head>

<body>
	<!--head-->
	<div class="top">
		<div class="py-container">
			<div class="shortcut">
				<ul class="fl">
					<li class="f-item">品优购欢迎您！</li>
				</ul>
				<ul class="fr">
					<li class="f-item"><a href="{{route('home_index')}}"> 我的订单</a></li>
				</ul>
			</div>
		</div>
	</div>


	<!-- 购物车 start -->
	<div class="cart py-container">
		<!--logoArea-->
		<div class="logoArea">
			<a href="/"><div class="fl logo"><span class="title">购物车</span></div></a>
			<div class="fr search">
				<form class="sui-form form-inline">
					<div class="input-append">
						<!-- 购物车搜索 start -->
						<form action="{{route('good_cart')}}" method="" >
							<input name="keyword" type="text" type="text" class="input-error input-xxlarge" placeholder="品优购自营" />
							<input type="submit" class="sui-btn btn-xlarge btn-danger" value="搜索">
						</form>
						<!-- 购物车搜素 end -->
					</div>
				</form>
			</div>
		</div>
		<!--All goods-->
		<!-- 订单表单 start -->
		<form action="{{route('get_order_info')}}" method="post" id="carts">
		@csrf()
		<div class="allgoods">
			<h4>全部商品<span>11</span></h4>
			<div class="cart-main">
				<div class="yui3-g cart-th">

					<div class="yui3-u-1-4">
						<input type="checkbox" name="" id="selAll" value="" />
						 全部
					</div>

					<div class="yui3-u-1-4">商品</div>
					<div class="yui3-u-1-8">单价（元）</div>
					<div class="yui3-u-1-8">数量</div>
					<div class="yui3-u-1-8">小计（元）</div>
					<div class="yui3-u-1-8">操作</div>
				</div>
				<div class="cart-item-list">
					<div class="cart-body">
						<!-- 单个商品 start -->
						@foreach($good_cart as $k => $v)
						<div class="cart-list">
							<ul class="goods-list yui3-g">
								<li class="yui3-u-1-24">
									<input type="checkbox"  name="good_carts[]" id="{{$v['id']}}_check"  onclick="check(this)" value="{{$v['id']}}" />
								</li>
								<li class="yui3-u-11-24">
									<div class="good-item">
										<div class="item-img" ><img src="/uploads/{{$good[$k]['img']}}" style="width='100px';height='50px'"  /></div>
										<div class="item-msg">
											<p>{{$good[$k]['name']}}</p>
											规格：{{$spec[$k]}}</div>
									</div>
								</li>
								
								<li class="yui3-u-1-8"><span class="price">{{$sku[$k]['price']}}</span></li>
								<li class="yui3-u-1-8">
									<a href="javascript:void(0)" target="{{$sku[$k]['price']}}" name="{{$v['id']}}" onclick="delete_num(this)" class="increment mins">-</a>
									<input id="{{$v['id']}}_num" target="{{$sku[$k]['price']}}" name="good_cart_num[]" autocomplete="off"  value="{{$v['good_num']}}" minnum="1" class="itxt" />
									<a href="javascript:void(0)" target="{{$sku[$k]['price']}}" name="{{$v['id']}}" onclick="add_num(this)" class="increment plus">+</a>
								</li>
								<li class="yui3-u-1-8"><span class="sum" name="sums" id="{{$v['id']}}_sum">{{$v['money']}}</span></li>
								<li class="yui3-u-1-8">
									<form action="{{route('good_cart_delete')}}" method="post" id="delete_{{$v['id']}}">
										@csrf()
										<input type="hidden" name="cart_id" value="{{$v['id']}}" >
										<!-- <a onclick="delete_cart(this)" href="javascript:;" class="btn btn-lg btn-danger" name="{{$v['id']}}" >删除</a> -->
										<input onclick="delete_cart(this)" class="btn btn-lg btn-danger" name="{{$v['id']}}" type="button" value="删除"/>
									</form>
									
									<!-- <a href="#none">移到我的关注</a> -->
								</li>
							</ul>
						</div>
						@endforeach
						<!-- 单个商品 end -->

					</div>
				</div>
				
			</div>
			<div class="cart-tool">
				<!-- <div class="select-all">
					<input type="checkbox" name="" id="" value="" />
					<span>全选</span>
				</div>
				<div class="option">
					<a href="#none">删除选中的商品</a>
					<a href="#none">移到我的关注</a>
					<a href="#none">清除下柜商品</a>
				</div> -->
				<div class="toolbar">
					<div class="chosed">已选择<span id="good_num"></span>件商品</div>
					<div class="sumprice">
						<span><em>总价（不含运费） ：</em>￥<i class="summoney">00.00</i></span>
					</div>
					<div class="sumbtn">
						
						<a href="javascript:;" class="sum-btn"  onclick="sum_money()">结算</a>
						
					</div>
				</div>
			</div>
		</form>
		<!-- 订单表单 end -->



			<div class="clearfix"></div>
			<div class="liked">
				<ul class="sui-nav nav-tabs">
					<li class="active">
						<a href="#index" data-toggle="tab">猜你喜欢</a>
					</li>
				</ul>
				<div class="clearfix"></div>


				<!-- 猜你喜欢 start -->
				<div class="tab-content">
					<div id="index" class="tab-pane active">
						<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
							<div class="carousel-inner">
								<div class="active item">
									<ul>
										@foreach($good_you_like as $k => $v)
										<li>
											<a href="/item?id={{$v['id']}}">
												<img src="/uploads/{{$v['img']}}" style="width:250px;height:100px;" />
											</a>
											<div class="intro">
												<i>{{$v['name']}}</i>
											</div>
											<div class="money">
												<span>￥{{$v['price']}}</span>
											</div>
										
										</li>
										@endforeach
									</ul>
								</div>
								<!-- <div class="item">
									<ul>
										<li>
											<img src="img/like1.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										
									</ul>
								</div> -->
							</div>
							<a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a>
							<a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
						</div>
					</div>
					
				</div>
				<!-- 猜你喜欢 end -->



			</div>
		</div>
	</div>
	<!-- 购物车 end -->


	<!-- 底部栏位 -->
	@include('home.layout.bottom')

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script src="/js/cart.js"></script>
</body>

</html>
@include('layouts.app');