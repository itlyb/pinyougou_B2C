<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>我的收藏</title>
    <link rel="icon" href="/img/bitbug_favicon.ico">

    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-seckillOrder.css" />
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
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g collect">
                <!--左侧列表-->
                <div class="yui3-u-1-6 list">


                    <!-- 左侧导航栏 start -->
                    @include('home.layout.left_nav');
                    <!-- 左侧导航栏 end -->
                </div>
                <!--右侧主内容-->
                <div class="yui3-u-5-6 goods">
                    <div class="body">
                        <h4>我的足迹</h4>
                        <div class="goods-list">
                            <ul class="yui3-g" id="goods-list">
								@foreach($foot as $k => $v)
                                <li class="yui3-u-1-4">
									<a href="/item?id={{$good[$k]['id']}}">
										<div class="list-wrap">
											<div class="p-img"><img src="/uploads/{{$good[$k]['img']}}" alt=''></div>
											<div class="price"><strong><em>¥</em> <i>{{$good[$k]['price']}}</i></strong></div>
											<div class="attr"><em>{{$good[$k]['name']}}</em></div>
											<div class="cu"><em>{{$good[$k]['little_name']}}</em></div>
											<div class="operate">
												<!-- <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a> -->
												<!-- <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
												<a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a> -->
											</div>
										</div>	
									</a>   
								</li >
								@endforeach
                            </ul>
                        </div>


                        <!--猜你喜欢-->
                        <div class="like-title">
                            <div class="mt">
                                <span class="fl"><strong>猜你喜欢</strong></span>
                            </div>
                        </div>
                        <div class="like-list">
                            <ul class="yui3-g">
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike01.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>3699.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有6人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike02.png" />
                                        </div>
                                        <div class="attr">
                                            <em>Apple苹果iPhone 6s/6s Plus 16G 64G 128G</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4388.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike03.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike04.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
	@include('home.layout.bottom')

	
undefined

</html>