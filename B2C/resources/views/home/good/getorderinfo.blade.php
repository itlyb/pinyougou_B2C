<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>结算页</title>
	<link rel="icon" href="/img/bitbug_favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-getOrderInfo.css" />
	<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
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
			<div class="fl logo"><span class="title">结算页</span></div>
			 
		</div>
		<!--主内容-->
		<div class="checkout py-container">
			<div class="checkout-tit">
				<h4 class="tit-txt">填写并核对订单信息</h4>
			</div>
			<div class="checkout-steps">
				<!--收件人信息-->
				<div class="step-tit">
					<h5>收件人信息<span><a data-toggle="modal" data-target=".edit" data-keyboard="false" class="newadd">新增收货地址</a></span></h5>
				</div>
				<div class="step-cont">
					<div class="addressInfo">
						<ul class="addr-detail">
							<li class="addr-item">
							@foreach($address as $k => $v)
							  <div>
								<div class="con name"><a href="">{{$v['name']}}</a></div>
								<div class="con address">{{$v['address']}} <span>{{$v['phone']}}</span>
									@if($v['is_use']==0)
										<form action="{{route('home_address_use')}}" method="post" style="float:left;maring-right:20px;" >
											@csrf()
											<input type="hidden" name="id" value="{{$v['id']}}">
											<input type="submit" value="选择地址" >
										</form>
									@else
										<span class="base">已选</span>
									@endif
									
									<span class="edittext">
										<a href="#" data-toggle="modal" data-target=".edit_{{$v['id']}}" data-keyboard="false" >编辑</a>
											&nbsp;&nbsp;
										<form action="{{route('home_address_delete')}}" method="post" style="float:right;maring-right:20px;" >
											@csrf()
											<input type="hidden" name="id" value="{{$v['id']}}">
											<input type="submit" value="删除" class="sui-btn btn-primary btn-large">
										</form>
									</span>
								</div>
								<div class="clearfix"></div>
							  </div>
							@endforeach  
							</li>
							
							
						</ul>
						<!--新增地址弹出层-->
						<div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit" style="width:580px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                        <h4 id="myModalLabel" class="modal-title">新增地址</h4>
                                    </div>
									
									<form action="{{route('home_address_set')}}" method="post" class="sui-form form-horizontal">
										<div class="modal-body">
												@csrf()
												<div class="control-group">
													<label class="control-label">收货人：</label>
													<div class="controls">
														<input required name="name" type="text" class="input-medium">
													</div>
												</div>
												<div class="control-group">
													<label for="inputPassword" class="control-label">所在地区：</label>
													<div class="controls">
														<div data-toggle="distpicker">
														<div class="form-group area" >
															<select required name="province" class="form-control" id="province1"></select>
														</div>
														<div class="form-group area">
															<select required name="city" class="form-control" id="city1"></select>
														</div>
														<div class="form-group area">
															<select required name="district" class="form-control" id="district1"></select>
														</div>
													</div>
													</div>									 
												</div>
												<div class="control-group">
													<label class="control-label">详细地址：</label>
													<div class="controls">
														<input required name="address" type="text" class="input-large">
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">联系电话：</label>
													<div class="controls">
														<input required name="phone" type="text" class="input-medium">
													</div>
												</div>
										</div>
										
										<div class="modal-footer">
											<input type="submit"  class="sui-btn btn-primary btn-large" value="确定">
											<button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">取消</button>
										</div>
									</form>
								

                                </div>
                            </div>
						</div>
						<!-- 弹出 end -->
						@foreach($address as $v)
						<!--新增地址弹出层-->
						<div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit_{{$v['id']}}" style="width:580px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                        <h4 id="myModalLabel" class="modal-title">修改地址</h4>
                                    </div>
									
									<form action="{{route('home_address_edit')}}" method="post" class="sui-form form-horizontal">
										<div class="modal-body">
												@csrf()
												<div class="control-group">
													<label class="control-label">收货人：</label>
													<div class="controls">
														<input required name="name" value="{{$v['name']}}" type="text" class="input-medium">
													</div>
												</div>
												<div class="control-group">
													<label for="inputPassword" class="control-label">所在地：</label>
													<div class="controls">
														<div data-toggle="distpicker">
															@php 
																$address = explode('-',$v['address']);
					
															@endphp
															<div class="form-group area">
																<select name="province"  data-province="{{isset($address[0])?$address[0]:'北京市'}}"   class="form-control" id="province1"></select>
															</div>
															<div class="form-group area">
																<select name="city"   data-city="{{isset($address[1])?$address[1]:'朝阳区'}}"  class="form-control" id="city1"></select>
															</div>
															<div class="form-group area">
																<select name="district"  data-district="{{isset($address[2])?$address[2]:'小胡同'}}"  class="form-control" id="district1"></select>
															</div>
														</div>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">详细地址：</label>
													<div class="controls">
														<input required name="address" value="{{$v['address_more']}}" type="text" class="input-large">
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">联系电话：</label>
													<div class="controls">
														<input required name="phone" value="{{$v['phone']}}" type="text" class="input-medium">
													</div>
												</div>
										</div>
										
										<div class="modal-footer">
											<input type="hidden" name="id" value="{{$v['id']}}">
											<input type="submit"  class="sui-btn btn-primary btn-large" value="确定">
											<button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">取消</button>
										</div>
									</form>
								

                                </div>
                            </div>
						</div>
						@endforeach
					</div>
					<div class="hr"></div>
					
				</div>
				<div class="hr"></div>
				<!--支付和送货-->
				<div class="payshipInfo">
					<div class="step-tit">
						<h5>支付方式</h5>
					</div>
					<div class="step-cont">
						<ul class="payType">
							<li class="selected">微信付款<span title="点击取消选择"></span></li>
							<!-- <li>货到付款<span title="点击取消选择"></span></li> -->
						</ul>
					</div>
					<div class="hr"></div>
					<div class="step-tit">
						<h5>送货清单</h5>
					</div>
					<div class="step-cont">
						<ul class="send-detail">
							@foreach($sku_good_has as $k => $v)
							<li>
								<div class="sendGoods">
									<ul class="yui3-g">
										<li class="yui3-u-1-6">
											<span><img src="/uploads/{{$good[$k]['img']}}" style="width:100px;height:100px;"/></span>
										</li>
										<li class="yui3-u-7-12">
											<div class="desc">{{$good[$k]['name']}}</div>
											<div class="seven">7天无理由退货</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="price">￥{{$good_cart[$k]['money']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="num">X{{$good_cart[$k]['good_num']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="exit">有货</div>
										</li>
									</ul>
								</div>
							</li>
							@endforeach
							@foreach($sku_good_no as $k => $v)
							<li>
								<div class="sendGoods">
									<ul class="yui3-g">
										<li class="yui3-u-1-6">
											<span><img src="/uploads/{{$good[$k]['img']}}" style="width:100px;height:100px;"/></span>
										</li>
										<li class="yui3-u-7-12">
											<div class="desc">{{$good[$k]['name']}}</div>
											<div class="seven">7天无理由退货</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="price">￥{{$good_cart[$k]['money']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="num">X{{$good_cart[$k]['good_num']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="exit">卖光了</div>
										</li>
									</ul>
								</div>
							</li>
							@endforeach
							@foreach($sku_good_num as $k => $v)
							<li>
								<div class="sendGoods">
									<ul class="yui3-g">
										<li class="yui3-u-1-6">
											<span><img src="/uploads/{{$good[$k]['img']}}" style="width:100px;height:100px;"/></span>
										</li>
										<li class="yui3-u-7-12">
											<div class="desc">{{$good[$k]['name']}}</div>
											<div class="seven">7天无理由退货</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="price">￥{{$good_cart[$k]['money']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="num">X{{$good_cart[$k]['good_num']}}</div>
										</li>
										<li class="yui3-u-1-12">
											<div class="exit">数量不足</div>
										</li>
									</ul>
								</div>
							</li>
							@endforeach
							
						</ul>
					</div>
					<div class="hr"></div>
				</div>
				<div class="linkInfo">
					<div class="step-tit">
						<h5>发票信息</h5>
					</div>
					<div class="step-cont">
						<span>普通发票（电子）</span>
						<span>个人</span>
						<span>明细</span>
					</div>
				</div>
				<div class="cardInfo">
					<div class="step-tit">
						<h5>注意：数量不足和卖光的商品将不会算作有效订单商品当中！</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="order-summary">
			<div class="static fr">
				<div class="list">
					<span><i class="number"></i>总商品金额</span>
					<em class="allprice">¥
						{{$money}}
					</em>
				</div>
				<div class="list">
					<span>返现：</span>
					<em class="money">0.00</em>
				</div>
				<div class="list">
					<span>运费：</span>
					<em class="transport">0.00</em>
				</div>
			</div>
		</div>
		<div class="clearfix trade">
			<div class="fc-price">应付金额:　<span class="price">¥{{$money}}</span></div>
			<div class="fc-receiverInfo"></div>
		</div>
		<div class="submit">
		    <form action="{{route('pay')}}" method="post">
				@csrf()
				@foreach($sku_good_has as $k => $v)
					<input type="hidden" name="cart_id[]"  value="{{$good_cart[$k]['id']}}" >
				@endforeach
				<input type="submit" value="提交订单"  class="sui-btn btn-danger btn-xlarge">
			</form>
		</div>
	</div>
	<!-- 底部栏位 -->
	@include('home.layout.bottom')

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="components/ui-modules/nav/nav-portal-top.js"></script>
<script type="text/javascript" src="js/pages/getOrderInfo.js"></script>
<script type="text/javascript" src="js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="pages/userInfo/main.js"></script>

</body>

</html>
@include('layouts.app');