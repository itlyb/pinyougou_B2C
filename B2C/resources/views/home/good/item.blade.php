<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>产品详情页</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">
	
    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-item.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-zoom.css" />
    <link rel="stylesheet" type="text/css" href="/css/widget-cartPanelView.css" />

</head>

<body>

	<!-- 头部栏位 -->
	@include('home.layout.home_nav')




	<!-- 页面内容 start -->
	<div class="py-container">
		<div id="item">
		
			<!-- 分类指向 -->
			<div class="crumb-wrap">
				<ul class="sui-breadcrumb">
					<li>
						<a href="#">{{$type}}</a>
					</li>
					<li class="active">{{$good['name']}}</li>
				</ul>
			</div>

			<!--product-info-->
			<div class="product-info">
				<div class="fl preview-wrap">
					<!--放大镜效果-->
					<div class="zoom">
						<!--默认第一个预览-->
						<div id="preview" class="spec-preview">
							<span class="jqzoom"><img width="400px" jqimg="img/_/b1.png" src="/img/_/s1.png" /></span>
						</div>
						<!--下方的缩略图-->
						<div class="spec-scroll">
							<a class="prev">&lt;</a>
							<!--左右按钮-->
							<div class="items">
								<ul> 
									@foreach($img as $v)
									<li><img src="/uploads/{{$v['img']}}" bimg="/uploads/{{$v['img']}}" onmousemove="preview(this)" /></li>
									@endforeach
								</ul>
							</div>
							<a class="next">&gt;</a>
						</div>
					</div>
				</div>




				<!-- 商品基本信息 -->
				<div class="fr itemInfo-wrap">
					<div class="sku-name">
						<h4>
							{{$good['name']}}
							<form action="{{route('home_do_collect')}}" method="post" style="float:right" >
								@csrf()
								<input type="hidden" name="good_id" value="{{$good['id']}}">
								<input type="submit" value="收藏" class="btn small-btn btn-danger">
							</form>
						</h4>
					</div>
					<div class="news"><span>{{$good['little_name']}}</span></div>

					<!-- 商品活动 start -->
					<div class="summary">
						<div class="summary-wrap">
							<div class="fl title">
								<i>价　　格</i>
							</div>
							<div class="fl price">
								<i>¥</i>
								<em>{{$spu['num'] != 0? $spu['price']:'卖光了'}}</em>
								<span>降价通知</span>
							</div>
							<div class="fr remark">
								<i>累计评价</i><em>612188</em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>促　　销</i>
							</div>
							<div class="fl fix-width">
								<i class="red-bg">加价购</i>
								<em class="t-gray">
									满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品
								</em>
							</div>
						</div>
					</div>
					<!-- 商品活动 end -->

					<!-- 支持服务 start-->
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
					<!-- 支持服务 end -->


					<div class="clearfix choose">



						<form action="{{route('spus')}}" method="post" id="spus" >
							@csrf()
							<input type="hidden" name="good_id" value="{{$good['id']}}">
							<div id="specification" class="summary-wrap clearfix">
								@foreach($attr as $v)
								<dl>
									<dt>
										<div class="fl title">
											<i>{{$v['name']}}</i>
										</div>
									</dt>
									@foreach($spec[$v['name']] as $k1 => $v1)
									<dd>
										<a href="javascript:;" target="{{$v['name']}}" name="{{$v1['id']}}" @if(in_array($v1['id'],$spus)) class="selected" @endif   @if(!in_array($v1['id'],$specs)) class='locked'  @else  onclick="haha(this)" @endif >
											{{$v1['name']}}
											@if(in_array($v1['id'],$spus)) <input id="{{$v['name']}}" type="hidden" name="spus[]" value="{{$v1['id']}}">  @endif
											<span title="点击取消选择">&nbsp;</span>
										</a>
									</dd>
									@endforeach
									<!-- <dd><a href="javascript:;">银色</a></dd>
									<dd><a href="javascript:;" class="locked">黑色</a></dd> @if($k1==0) class="selected" @endif-->
								</dl>
								@endforeach
							</div>
						</form>


						<!-- 加入购物车 start-->
						<form action="{{route('good_car')}}" method="post">
						@csrf()
						<div class="summary-wrap">
							<div class="fl title">
								<div class="control-group">
									<div class="controls">
										<!-- 数量 start -->
										<input type="hidden" id="all_num"  value="{{$spu['num']}}">
										<input type="hidden" name="spu_id" value="{{$spu['id']}}">
										<input type="text"   name="num"    value="1" id="num" autocomplete="off" minnum="1" class="itxt" />
										<a id="add" href="javascript:void(0)" class="increment plus">+</a>
										<a id="delete" href="javascript:void(0)" class="increment mins">-</a>
										<!-- 数量 end -->
									</div>
								</div>
							</div>
							<div class="fl">
								<ul class="btn-choose unstyled">
									<li>
										<!-- <a href="cart.html" target="_blank" class="sui-btn  btn-danger addshopcar">加入购物车</a> -->
										<input id='sub' type="submit" class="sui-btn  btn-danger addshopcar" value="加入购物车">
									</li>
								</ul>
							</div>
						</div>
						</form>
						<!-- 加入购物车 end -->
						
					</div>
				</div>
			</div>
			<!--product-detail-->



			<div class="clearfix product-detail">
				<div class="fl aside">
				
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

					<!-- 推荐 start -->
					<div class="tab-content tab-wraped">

						<!-- 分类商品推荐 -->
						<div id="index" class="tab-pane active">

							<!-- 分类推荐 start -->
							<ul class="part-list unstyled">
								@foreach($good_type as $v)
								<li>{{$v['name']}}</li>
								@endforeach
							</ul>
							<!-- 分类推荐 end -->
							
							<!-- 商品推荐 start -->
							<ul class="goods-list unstyled">
								<li>
									<div class="list-wrap">
										<div class="p-img">
											<img src="/img/_/part01.png" />
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
							<!-- 商品推荐 end -->
						</div>

						<!-- 品牌推荐 -->
						<div id="profile" class="tab-pane">
							@foreach($brand as $v)
								<img src="/uploads/{{$v['img']}}" style="border:2px solid #ccc;margin-bottom:10px;" >
							@endforeach
						</div>

					</div>
					<!-- 推荐 end -->
				</div>


				<!-- 选择搭配 start -->
				<div class="fr detail">
					<div class="clearfix fitting">


					<!-- 四个选项卡 start -->
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
								{!!$good['description']!!}
							</div>



							<div id="two" class="tab-pane">
								{!!$good['spec']!!}
							</div>

							<div id="three" class="tab-pane">
								{!!$good['after_sale']!!}
							</div>

							<div id="four" class="tab-pane">
								@foreach($comment as $v)
								<div>
									<img src="/uploads/{{$v['head_img']}}" width="50px" height="50px" style="float:left;border-radius:100px;" alt="">
									<p>{{$v['user_name']}}</p>
									<p>{{$v['content']}}asdfasdfasdfasdfasdfasdfasdfasdfsadfasdfsdfadfasdfasdfasdfsadf</p>
									<p style="color:red;font-size:15px;" >
										@php
											echo str_repeat('☆',$v['star']);
										@endphp
									</p>
									<p>{{$v['created_at']}}</p>
								</div>
								@endforeach
								
							</div>
							<div id="five" class="tab-pane">
								<p>手机社区</p>
							</div>
						</div>
					</div>
					<!-- 四个选项卡 end -->

				</div>
			</div>


			
			<div class="clearfix"></div>



			<!--like 猜你喜欢 start-->
			<div class="like">
				<h4 class="kt">猜你喜欢</h4>
				<div class="like-list">
					<ul class="yui3-g">
						@foreach($like_good as $v)
						<li class="yui3-u-1-6">
							<a href="item?id={{$v['id']}}">
								<div class="list-wrap">
									<div class="p-img">
										<img src="/uploads/{{$v['img']}}" />
									</div>
									<div class="attr">
										<em>{{$v['name']}}</em>
									</div>
									<div class="price">
										<strong>
											<em>¥</em>
											<i>{{$v['price']}}</i>
										</strong>
									</div>
								</div>
							</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<!-- 猜你喜欢 end -->


		</div>
	</div>
	<!-- 底部栏位 -->
	
<!--页面底部  开始 -->
<div class="clearfix footer">
	<div class="py-container">
		<div class="footlink">
			<div class="Mod-service">
				<ul class="Mod-Service-list">
					<li class="grid-service-item intro  intro1">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro2">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro  intro3">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro4">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro intro5">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
				</ul>
			</div>
			<div class="clearfix Mod-list">
				<div class="yui3-g">
					<div class="yui3-u-1-6">
						<h4>购物指南</h4>
						<ul class="unstyled">
							<li>购物流程</li>
							<li>会员介绍</li>
							<li>生活旅行/团购</li>
							<li>常见问题</li>
							<li>购物指南</li>
						</ul>

					</div>
					<div class="yui3-u-1-6">
						<h4>配送方式</h4>
						<ul class="unstyled">
							<li>上门自提</li>
							<li>211限时达</li>
							<li>配送服务查询</li>
							<li>配送费收取标准</li>
							<li>海外配送</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>支付方式</h4>
						<ul class="unstyled">
							<li>货到付款</li>
							<li>在线支付</li>
							<li>分期付款</li>
							<li>邮局汇款</li>
							<li>公司转账</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>售后服务</h4>
						<ul class="unstyled">
							<li>售后政策</li>
							<li>价格保护</li>
							<li>退款说明</li>
							<li>返修/退换货</li>
							<li>取消订单</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>特色服务</h4>
						<ul class="unstyled">
							<li>夺宝岛</li>
							<li>DIY装机</li>
							<li>延保服务</li>
							<li>品优购E卡</li>
							<li>品优购通信</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>帮助中心</h4>
						<img src="/img/wx_cz.jpg">
					</div>
				</div>
			</div>
			<div class="Mod-copyright">
				<ul class="helpLink">
					<li>关于我们<span class="space"></span></li>
					<li>联系我们<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>商家入驻<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们</li>
				</ul>
				<p>地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</p>
				<p>京ICP备08001421号京公网安备110108007702</p>
			</div>
		</div>
	</div>
</div>
<!-- 页面底部 结束 -->
	
	<!--侧栏面板开始-->
<div class="J-global-toolbar">
	<div class="toolbar-wrap J-wrap">
		<div class="toolbar">
			<div class="toolbar-panels J-panel">

				<!-- 购物车 -->
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="" class="title"><i></i><em class="title">购物车</em></a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('cart');" ></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div id="J-cart-tips" class="tbar-tipbox hide">
								<div class="tip-inner">
									<span class="tip-text">还没有登录，登录后商品将被保存</span>
									<a href="#none" class="tip-btn J-login">登录</a>
								</div>
							</div>
							<div id="J-cart-render">
								<!-- 列表 -->
								<div id="cart-list" class="tbar-cart-list">
								</div>
							</div>
						</div>
					</div>
					<!-- 小计 -->
					<div id="cart-footer" class="tbar-panel-footer J-panel-footer">
						<div class="tbar-checkout">
							<div class="jtc-number"> <strong class="J-count" id="cart-number">0</strong>件商品 </div>
							<div class="jtc-sum"> 共计：<strong class="J-total" id="cart-sum">¥0</strong> </div>
							<a class="jtc-btn J-btn" href="#none" target="_blank">去购物车结算</a>
						</div>
					</div>
				</div>

				<!-- 我的关注 -->
				<div style="visibility: hidden;" data-name="follow" class="J-content toolbar-panel tbar-panel-follow">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="#" target="_blank" class="title"> <i></i> <em class="title">我的关注</em> </a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('follow');"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div class="tbar-tipbox2">
								<div class="tip-inner"> <i class="i-loading"></i> </div>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>

				<!-- 我的足迹 -->
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-history toolbar-animate-in">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="#" target="_blank" class="title"> <i></i> <em class="title">我的足迹</em> </a>
						<span class="close-panel J-close" onclick="cartPanelView.tbar_panel_close('history');"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div class="jt-history-wrap">
								<ul>
									<!--<li class="jth-item">
										<a href="#" class="img-wrap"> <img src="/.portal/img/like_03.png" height="100" width="100" /> </a>
										<a class="add-cart-button" href="#" target="_blank">加入购物车</a>
										<a href="#" target="_blank" class="price">￥498.00</a>
									</li>
									<li class="jth-item">
										<a href="#" class="img-wrap"> <img src="/portal/img/like_02.png" height="100" width="100" /></a>
										<a class="add-cart-button" href="#" target="_blank">加入购物车</a>
										<a href="#" target="_blank" class="price">￥498.00</a>
									</li>-->
								</ul>
								<a href="#" class="history-bottom-more" target="_blank">查看更多足迹商品 &gt;&gt;</a>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>

			</div>

			<div class="toolbar-header"></div>

			<!-- 侧栏按钮 -->
			<div class="toolbar-tabs J-tab">
				<div onclick="cartPanelView.tabItemClick('cart')" class="toolbar-tab tbar-tab-cart" data="购物车" tag="cart" >
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count " id="tab-sub-cart-count">0</span>
				</div>
				<div onclick="cartPanelView.tabItemClick('follow')" class="toolbar-tab tbar-tab-follow" data="我的关注" tag="follow" >
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count hide">0</span>
				</div>
				<div onclick="cartPanelView.tabItemClick('history')" class="toolbar-tab tbar-tab-history" data="我的足迹" tag="history" >
					<i class="tab-ico"></i>
					<em class="tab-text"></em>
					<span class="tab-sub J-count hide">0</span>
				</div>
			</div>

			<div class="toolbar-footer">
				<div class="toolbar-tab tbar-tab-top" > <a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a> </div>
				<div class="toolbar-tab tbar-tab-feedback" > <a href="#" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a> </div>
			</div>

			<div class="toolbar-mini"></div>

		</div>

		<div id="J-toolbar-load-hook"></div>

	</div>
</div>

<script type="text/template" id="tbar-cart-item-template">
	<div class="tbar-cart-item" >
		<div class="jtc-item-promo">
			<em class="promo-tag promo-mz">满赠<i class="arrow"></i></em>
			<div class="promo-text">已购满600元，您可领赠品</div>
		</div>
		<div class="jtc-item-goods">
			<span class="p-img"><a href="#" target="_blank"><img src="/{2}" alt="{1}" height="50" width="50" /></a></span>
			<div class="p-name">
				<a href="#">{1}</a>
			</div>
			<div class="p-price"><strong>¥{3}</strong>×{4} </div>
			<a href="#none" class="p-del J-del">删除</a>
		</div>
	</div>
</script>

	

<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
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
<script type="text/javascript" src="/js/model/cartModel.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.jqzoom/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.jqzoom/zoom.js"></script>
<script type="text/javascript" src="/index/index.js"></script>


<!--页面底部  结束 -->
</body>

</html>


@include('layouts.app');
<script src="/js/item.js"></script>