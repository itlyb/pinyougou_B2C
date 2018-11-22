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
                            <h4>收藏的商品</h4>
                            <div class="goods-list">
                                <ul class="yui3-g"  id="goods-list">
									@foreach($collect as $k => $v)
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img">
												<a href="/item?id={{$good[$k]['id']}}">
													<img src="uploads/{{$good[$k]['img']}}" alt=''>
												</a>	
											</div>
                                            <div class="price"><strong><em>¥</em> <i>{{$good[$k]['price']}}</i></strong></div>
                                            <div class="attr"><em>{{$good[$k]['name']}}</em></div>
                                            <div class="cu"><em>{{$good[$k]['little_name']}}</em></div>
                                            <div class="operate">
												<form action="{{route('good_car')}}" method="post">
													@csrf()
													<input type="hidden" name="spu_id" value="{{$sku[$k]}}">
													<input type="submit" value="加入购物车" class="sui-btn btn-bordered btn-danger">
												</form>
												<form action="{{route('home_collect_delete')}}" method="post">
													@csrf()
													<input type="hidden" name="id" value="{{$v['id']}}">
													<input type="submit" value="取消收藏" class="sui-btn btn-bordered btn-danger">
												</form>
                                                <!-- <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a> -->
                                            </div>
                                        </div>
                                    </li >
									@endforeach
                                </ul>
                            </div>
                      
                        
						<div class="like-title">
                            <div class="mt">
                                <span class="fl"><strong>热卖单品</strong></span>
                            </div>
                        </div>
                        <div class="like-list">
                            <ul class="yui3-g">
                                @foreach($hot_good as $k => $v)
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <a href="/item?id={{$v['id']}}">
                                                <img src="/uploads/{{$v['img']}}" style="height:200px;width:200px;" />
                                            </a>
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
                                </li>
                                @endforeach
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
@include('layouts.app')