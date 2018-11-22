<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，优质！优质！</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">

    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-JD-index.css" />
    <link rel="stylesheet" type="text/css" href="css/widget-jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="css/widget-cartPanelView.css" />
	<link rel="stylesheet" type="text/css" href="css/pages-seckillOrder.css" />
</head>

<body>
	<!-- 头部栏位 -->
	@include('home.layout.home_nav');


	<!--列表-->
	<div class="sort">
		<div class="py-container">
			<div class="yui3-g SortList ">
				<div class="yui3-u Left all-sort-list">
					<div class="all-sort-list2">

						@foreach($type as $k => $v)
						<div class="item bo">
							<h3><a href="javascript:;" name="{{$v['name']}}" onclick="search_type(this)" >{{$v['name']}}</a></h3>
							<div class="item-list clearfix">
								<div class="subitem">
									@foreach($type1[$k] as $k1 => $v1)
									<dl class="fore1">
										<dt><a href="javascript:;" name="{{$v1['name']}}" onclick="search_type(this)">{{$v1['name']}}</a></dt>
										<dd>
											@foreach($type2[$k][$k1] as $k2 => $v2)
											<a href="javascript:;" name="{{$v2['name']}}" onclick="search_type(this)" >{{$v2['name']}}</a></em>
											@endforeach
										</dd>
									</dl>
									@endforeach
								</div>
							</div>
						</div>
						@endforeach
						 
						<form action="{{route('search')}}" id="search_type"  style="display:none;" method="post" >
							@csrf()
							<input name="keyword" id="type" value="" type="text"  type="text"  />
					   </form>
					</div>
				</div>
				<div class="yui3-u Center banerArea">



					<!--banner轮播 start-->
					<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
					  <ol class="carousel-indicators">
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					    <li data-target="#myCarousel" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
						@foreach($article as $k => $v)
					    <div class="item @if($k==0) active @endif">
					    	<a href="/article?id={{$v['id']}}">
					    		<img src="uploads/{{$v['img']}}"  />
					      	</a>
					    </div>
					    @endforeach
					  </div><a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a><a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
					</div>
					<!-- 轮播 end -->



				</div>
				<div class="yui3-u Right">
					<div class="news">
						<h4>
							<em class="fl">品优购快报</em>
							<!-- <span class="fr tip">更多 ></span> -->
						</h4>
						<div class="clearix"></div>
						<ul class="news-list unstyled">
							@foreach($quick_article as $v)
							<li>
								<span class="bold">[特惠]</span><a href="/article?id={{$v['id']}}">{{$v['title']}}</a>
							</li>
							@endforeach	
						</ul>
					</div>
					
					<div class="ads" style="position:absolute;bottom:0px;">
						<img src="img/ad1.png" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--推荐-->
	<div class="show">
		<div class="py-container">
			<ul class="yui3-g Recommend">
				<li class="yui3-u-1-6  clock">
					<div class="time">
						<img src="img/clock.png" />
						<h3>今日推荐</h3>
					</div>
				</li>
				@foreach($article_today as $v)
				<li class="yui3-u-5-24">
					<a href="/article?id={{$v['id']}}" target="_blank"><img src="/uploads/{{$v['img']}}" /></a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>




	<!--喜欢-->
	<div class="like">
		<div class="py-container">
			<div class="title">
				<h3 class="fl">猜你喜欢</h3>
				<b class="border"></b>
				<a href="javascript:;" class="fr tip changeBnt" id="xxlChg"><i></i>换一换</a>
			</div>
			<div class="bd">
				<ul class="clearfix yui3-g Favourate picLB" id="picLBxxl">

					@foreach($like_good as $k => $v)
					<li class="yui3-u-1-6">
						<dl class="picDl huozhe">
							<dd>
								<a href="/item?id={{$v['id']}}" class="pic"><img src="/uploads/{{$v['img']}}" alt="" /></a>
								<div class="like-text">
									<p>{{$v['name']}}</p>
									<h3>¥{{$v['price']}}</h3>
								</div>
							</dd>
							<dd>
								<a href="" class="pic"><img src="img/like_01.png" alt="" /></a>
								<div class="like-text">
									<p>爱仕达 30CM炒锅不粘锅NWG8330E电磁炉炒</p>
									<h3>¥116.00</h3>
								</div>
							</dd>
						</dl>
					</li>
					@endforeach
					
				</ul>
			</div>
		</div>
	</div>


	<!--有趣-->
	<div class="fun">
		<div class="py-container">
			<div class="title">
				<h3 class="fl">品优购：快来看看！</h3>
			</div>
			<!-- <div class="clearfix yui3-g Interest"> -->

				<div class="goods-list">
                    <ul class="yui3-g"  id="goods-list">
						@foreach($look_good as $k => $v)
                        <li class="yui3-u-1-4">
                            <div class="list-wrap">
								<div class="p-img">
									<img src="uploads/{{$v['img']}}" alt=''>
								</div>
									<div class="price"><strong><em>¥</em> <i>{{$v['price']}}</i></strong></div>
									<div class="attr"><em>{{$v['title']}}</em></div>
									<div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
									<div class="operate">
										
									<a href="/item?id={{$v['id']}}"  class="sui-btn btn-bordered btn-danger">查看详情</a>

                                </div>
                            </div>
                        </li >
						@endforeach
					</ul>
				</div>

			<!-- </div> -->
		</div>
	</div>
	<!--楼层-->
	<div id="floor-1" class="floor">
		<div class="py-container">
			<div class="title floors">
				<h3 class="fl">家用电器</h3>
				<div class="fr">
					<ul class="sui-nav nav-tabs">
						<!-- <li class="active">
							<a href="#tab1" data-toggle="tab">热门</a>
						</li>
						<li>
							<a href="#tab2" data-toggle="tab">大家电</a>
						</li>
						<li>
							<a href="#tab3" data-toggle="tab">生活电器</a>
						</li>
						<li>
							<a href="#tab4" data-toggle="tab">厨房电器</a>
						</li>
						<li>
							<a href="#tab5" data-toggle="tab">应季电器</a>
						</li>
						<li>
							<a href="#tab6" data-toggle="tab">空气/净水</a>
						</li>
						<li>
							<a href="#tab7" data-toggle="tab">高端电器</a>
						</li> -->
					</ul>
				</div>
			</div>
			<div class="clearfix  tab-content floor-content">
				<div id="tab1" class="tab-pane active">
					<!-- <div class="yui3-g Floor-1"> -->
					<div class="goods-list">
                    <ul class="yui3-g"  id="goods-list">
						
						@foreach($home_elc as $k => $v)
                        <li class="yui3-u-1-4">
                            <div class="list-wrap">
								<div class="p-img">
									<img src="uploads/{{$v['img']}}" alt=''>
								</div>
									<div class="price"><strong><em>¥</em> <i>{{$v['price']}}</i></strong></div>
									<div class="attr"><em>{{$v['title']}}</em></div>
									<div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
									<div class="operate">
										
									<a href="/item?id={{$v['id']}}"  class="sui-btn btn-bordered btn-danger">查看详情</a>

                                </div>
                            </div>
                        </li >
						@endforeach

					</ul>
				</div>
					<!-- </div> -->
				</div>
				<div id="tab2" class="tab-pane">
					<p>第二个</p>
				</div>
				<div id="tab3" class="tab-pane">
					<p>第三个</p>
				</div>
				<div id="tab4" class="tab-pane">
					<p>第4个</p>
				</div>
				<div id="tab5" class="tab-pane">
					<p>第5个</p>
				</div>
				<div id="tab6" class="tab-pane">
					<p>第6个</p>
				</div>
				<div id="tab7" class="tab-pane">
					<p>第7个</p>
				</div>
			</div>
		</div>
	</div>
	<div id="floor-2" class="floor">
		<div class="py-container">
			<div class="title floors">
				<h3 class="fl">手机通讯</h3>
				<div class="fr">
					<ul class="sui-nav nav-tabs">
						<!-- <li class="active">
							<a href="#tab8" data-toggle="tab">热门</a>
						</li>
						<li>
							<a href="#tab9" data-toggle="tab">品质优选</a>
						</li>
						<li>
							<a href="#tab10" data-toggle="tab">新机尝鲜</a>
						</li>
						<li>
							<a href="#tab11" data-toggle="tab">高性价比</a>
						</li>
						<li>
							<a href="#tab12" data-toggle="tab">合约机</a>
						</li>
						<li>
							<a href="#tab13" data-toggle="tab">手机卡</a>
						</li>
						<li>
							<a href="#tab14" data-toggle="tab">手机配件</a>
						</li> -->
					</ul>
				</div>
			</div>
			<div class="clearfix  tab-content floor-content">
				<div id="tab8" class="tab-pane active">
				<div class="goods-list">
                    <ul class="yui3-g"  id="goods-list">
						@foreach($phone_mes as $k => $v)
                        <li class="yui3-u-1-4">
                            <div class="list-wrap">
								<div class="p-img">
									<img src="uploads/{{$v['img']}}" alt=''>
								</div>
									<div class="price"><strong><em>¥</em> <i>{{$v['price']}}</i></strong></div>
									<div class="attr"><em>{{$v['title']}}</em></div>
									<div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
									<div class="operate">
										
									<a href="/item?id={{$v['id']}}"  class="sui-btn btn-bordered btn-danger">查看详情</a>

                                </div>
                            </div>
                        </li >
						@endforeach
					</ul>
				</div>
				</div>
				<div id="tab2" class="tab-pane">
					<p>第二个</p>
				</div>
				<div id="tab9" class="tab-pane">
					<p>第三个</p>
				</div>
				<div id="tab10" class="tab-pane">
					<p>第4个</p>
				</div>
				<div id="tab11" class="tab-pane">
					<p>第5个</p>
				</div>
				<div id="tab12" class="tab-pane">
					<p>第6个</p>
				</div>
				<div id="tab13" class="tab-pane">
					<p>第7个</p>
				</div>
				<div id="tab14" class="tab-pane">
					<p>第8个</p>
				</div>
			</div>
		</div>
	</div>
	<!--商标-->
	<div class="brand">
		<div class="py-container">
			<ul class="Brand-list blockgary">
				<li class="Brand-item">
					<img src="img/brand_21.png" />
				</li>
				<li class="Brand-item"><img src="img/brand_03.png" /></li>
				<li class="Brand-item"><img src="img/brand_05.png" /></li>
				<li class="Brand-item"><img src="img/brand_07.png" /></li>
				<li class="Brand-item"><img src="img/brand_09.png" /></li>
				<li class="Brand-item"><img src="img/brand_11.png" /></li>
				<li class="Brand-item"><img src="img/brand_13.png" /></li>
				<li class="Brand-item"><img src="img/brand_15.png" /></li>
				<li class="Brand-item"><img src="img/brand_17.png" /></li>
				<li class="Brand-item"><img src="img/brand_19.png" /></li>
			</ul>
		</div>
	</div>
	<!-- 底部栏位 -->
	<!--页面底部-->
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
						<img src="img/wx_cz.jpg">
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
<!--页面底部END-->
	<!-- 楼层位置 -->
	<div id="floor-index" class="floor-index">
		<ul>
			<li>
				<a class="num" href="javascript:;" style="display: none;">1F</a>
				<a class="word" href="javascript;;" style="display: block;">家用电器</a>
			</li>
			<li>
				<a class="num" href="javascript:;" style="display: none;">2F</a>
				<a class="word" href="javascript;;" style="display: block;">手机通讯</a>
			</li>
			<li>
				<a class="num" href="javascript:;" style="display: none;">3F</a>
				<a class="word" href="javascript;;" style="display: block;">电脑办公</a>
			</li>
			<li>
				<a class="num" href="javascript:;" style="display: none;">4F</a>
				<a class="word" href="javascript;;" style="display: block;">家居家具</a>
			</li>
			<li>
				<a class="num" href="javascript:;" style="display: none;">5F</a>
				<a class="word" href="javascript;;" style="display: block;">运动户外</a>
			</li>
		</ul>
	</div>
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
										<a href="#" class="img-wrap"> <img src=".portal/img/like_03.png" height="100" width="100" /> </a>
										<a class="add-cart-button" href="#" target="_blank">加入购物车</a>
										<a href="#" target="_blank" class="price">￥498.00</a>
									</li>
									<li class="jth-item">
										<a href="#" class="img-wrap"> <img src="portal/img/like_02.png" height="100" width="100" /></a>
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
<!--购物车单元格 模板-->
<script type="text/template" id="tbar-cart-item-template">
	<div class="tbar-cart-item" >
		<div class="jtc-item-promo">
			<em class="promo-tag promo-mz">满赠<i class="arrow"></i></em>
			<div class="promo-text">已购满600元，您可领赠品</div>
		</div>
		<div class="jtc-item-goods">
			<span class="p-img"><a href="#" target="_blank"><img src="{2}" alt="{1}" height="50" width="50" /></a></span>
			<div class="p-name">
				<a href="#">{1}</a>
			</div>
			<div class="p-price"><strong>¥{3}</strong>×{4} </div>
			<a href="#none" class="p-del J-del">删除</a>
		</div>
	</div>
</script>
<!--侧栏面板结束-->
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
<script type="text/javascript" src="js/model/cartModel.js"></script>
<script type="text/javascript" src="js/czFunction.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/pages/index.js"></script>
<script type="text/javascript" src="js/widget/cartPanelView.js"></script>
<script type="text/javascript" src="js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script src="js/index.js"></script>
</body>


</html>
@include('layouts.app')