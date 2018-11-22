<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>我的订单</title>
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
            <div class="yui3-g home">
                <!--左侧列表-->
                <div class="yui3-u-1-6 list">

                    

                    
                    <!-- 左侧导航栏 start -->
                    @include('home.layout.left_nav');
                    <!-- 左侧导航栏 end -->


                </div>
                <!--右侧主内容-->
                <div class="yui3-u-5-6 order-pay">
                    <div class="body">
                        <div class="table-title">
                            <table class="sui-table  order-table">
                                <tr>
                                    <thead>
                                        <th width="35%">宝贝</th>
                                        <th width="5%">单价</th>
                                        <th width="5%">数量</th>
                                        <th width="8%">商品操作</th>
                                        <th width="10%">实付款</th>
                                        <th width="10%">交易状态</th>
                                        <th width="10%">交易操作</th>
                                    </thead>
                                </tr>
                            </table>
                        </div>
                        <div class="order-detail">
                            <div class="orders">
                                <!-- <div class="choose-order">
                                    <div class="sui-pagination pagination-large top-pages">
                                        <ul>
                                            <li class="prev disabled"><a href="#">上一页</a></li>

                                            <li class="next"><a href="#">下一页</a></li>
                                        </ul>
                                    </div>
                                </div> -->





                                @foreach($order as $k => $v)
								<!--order1-->
                                <div class="choose-title">
                                &nbsp;&nbsp;&nbsp;<span>{{$v['created_at']}}　订单编号：{{$v['sn']}}<a>和我联系</a></span>
                                </div>
                                <table class="sui-table table-bordered order-datatable">
                                    <tbody>
                                        <tr>
                                            <td width="35%">
                                                <div class="typographic"><img src="img/goods.png" />
                                                    <a href="#" class="block-text">{{$good[$k]['name']}}</a>
                                                    <br>
                                                    <span class="guige">规格： {{$spec[$k]}}</span>
                                                </div>
                                            </td>
                                            <td width="5%" class="center">
                                                <ul class="unstyled">
                                                    <!-- <li class="o-price">¥ {{$v['money']}}</li> -->
                                                    <li>¥{{$sku[$k]['price']}}</li>
                                                </ul>
                                            </td>
                                            <td width="5%" class="center">1</td>
                                            <td width="8%" class="center">
												<!-- <a href="#" class="sui-btn btn-info" >退款</a> -->
                                            </td>
                                            <td width="10%" class="center" >
                                                <ul class="unstyled">
                                                    <li>¥{{$v['money']}}</li>
                                                    <li>（含运费：￥0.00）</li>
                                                </ul>
                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                    <li>已发货</li>
                                                    <li><a href="javascript:;" class="btn" data-toggle="modal" data-target=".order_{{$v['id']}}">订单详情 </a></li>
                                                </ul>
                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
													<li><a href="#" class="sui-btn btn-info" >物流信息</a></li>
                                                    <!-- <li>取消订单</li> -->
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endforeach
                            </div>

                            <!-- 分页 start -->
                            <div class="choose-order">
                                <div class="sui-pagination pagination-large top-pages">
                                    {{$order->links()}}
                                </div>
                            </div>
                            <!-- 分页 end -->


                            <div class="clearfix"></div>
                        </div>
                        @foreach($order as $k => $v)
                        <!--新增地址弹出层-->
                        <div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit order_{{$v['id']}}" style="width:580px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                        <h4 id="myModalLabel" class="modal-title">订单详情</h4>
                                    </div>

                                    <div class="modal-header">
                                        
                                        <h4 id="myModalLabel" class="modal-title">订单编号</h4>
                                        <h6>{{$v['sn']}}</h5>
                                    </div>
                                    

                                    <div class="modal-header">
                                        
                                        <h4 id="myModalLabel" class="modal-title">商品名称</h4>
                                        <h6>{{$good[$k]['name']}}</h5>
                                    </div>

                                    <div class="modal-header">
                                        
                                        <h4 id="myModalLabel" class="modal-title">属性规格</h4>
                                        <h6>{{$spec[$k]}}</h5>
                                    </div>

                                    <div class="modal-header">
                                        
                                        <h4 id="myModalLabel" class="modal-title">花费金额</h4>
                                        <h6>¥{{$v['money']}}</h5>
                                    </div>

									<div class="modal-footer">	
										<button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">确定</button>
									</div>
									
								

                                </div>
                            </div>
						</div>
						<!-- 弹出 end -->
                        @endforeach
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