<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
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
<script type="text/javascript" src="js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="pages/userInfo/main.js"></script>
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
                <div class="yui3-u-5-6">
                    <div class="body userAddress">

                        <div class="address-title">
                            <span class="title">地址管理</span>
                            <a data-toggle="modal" data-target=".edit" data-keyboard="false"   class="sui-btn  btn-info add-new">添加新地址</a>
                            <span class="clearfix"></span>
                        </div>

						<!-- 用户地址 start -->
                        <div class="address-detail">
                            <table class="sui-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>姓名</th>
                                        <th>地址</th>
                                        <th>联系电话</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($address as $k => $v)
                                    <tr>
                                        <td>{{$v['name']}}</td>
                                        <td>{{$v['address']}}</td>
                                        <td>{{$v['phone']}}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target=".edit_{{$v['id']}}" data-keyboard="false" >编辑</a>
                                            
											<form action="{{route('home_address_delete')}}" method="post" style="float:left;maring-right:20px;" >
												@csrf()
												<input type="hidden" name="id" value="{{$v['id']}}">
												<input type="submit" value="删除" class="sui-btn btn-primary btn-large">
											</form>
											&nbsp;

											@if($v['is_use']==0)
											<form action="{{route('home_address_use')}}" method="post" style="float:left;maring-right:20px;" >
												@csrf()
												<input type="hidden" name="id" value="{{$v['id']}}">
												<input type="submit" value="设为默认" >
											</form>
											@else
											默认地址
											@endif
                                            
                                        </td>
                                    </tr>
									@endforeach
                                </tbody>
                            </table>                          
                        </div>
						
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
														<div class="form-group area">
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
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
	@include('home.layout.bottom')



undefined

</html>
@include('layouts.app')