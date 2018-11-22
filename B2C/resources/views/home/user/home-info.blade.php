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
<script type="text/javascript" src="js/plugins/birthday/birthday.js"></script>
<script type="text/javascript" src="js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="js/plugins/upload/uploadPreview.js"></script>
<script type="text/javascript" src="js/pages/main.js"></script>
<script>
            $(function() {               
                $.ms_DatePicker({
                    YearSelector: "#select_year2",
                    MonthSelector: "#select_month2",
                    DaySelector: "#select_day2"
                });
            });
        </script>
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
                    <div class="body userInfo">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">基本资料</a></li>
                            <li><a href="#two" data-toggle="tab">头像照片</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane active">


								<!--  用户基本信息修改 start-->
                                <form action="{{route('home_info_base')}}" method="post" id="form-msg" class="sui-form form-horizontal">
									@csrf()
                                    <div class="control-group">
                                        <label for="inputName" class="control-label">昵称：</label>
                                        <div class="controls">
                                            <input type="text" id="inputName" name="name" value="{{$info['name']}}" placeholder="昵称">
                                        </div>
									</div>
									
                                    <div class="control-group">
										<label for="inputGender" class="control-label">性别：</label>
										<input type="radio" @if($info['sex'] == 1) checked="checked" @endif name="sex" value="1"><span>男</span>&nbsp;
										<input type="radio" @if($info['sex'] == 2) checked="checked" @endif name="sex" value="2"><span>女</span>
                                        <!--  -->
									</div>
									
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">生日：</label>
                                        <div class="controls">
											@php 
											 $date = explode('-',$info['birthday']);
											@endphp
                                            <select name="year" id="select_year2"  rel="{{isset($date[0])?$date[0]:1999}}"></select>年
                                            <select name="month" id="select_month2" rel="{{isset($date[1])?$date[1]:9}}"></select>月
                                            <select name="day" id="select_day2" rel="{{isset($date[2])?$date[2]:9}}"></select>日
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">所在地：</label>
                                        <div class="controls">
                                            <div data-toggle="distpicker">
												@php 
													 $address = explode('-',$info['address']);
		
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
                                        <label for="sanwei" class="control-label"></label>
                                        <div class="controls">
											<input type="submit" class="sui-btn btn-primary" value="点击修改">
                                        </div>
                                    </div>
								</form>
								<!-- 用户基本信息修改 end -->



                            </div>
                            <div id="two" class="tab-pane">

                                <div class="new-photo">
                                    <p>当前头像：</p>
                                    <div class="upload">
										<!-- 头像 start -->
										<form action="{{route('home_info_img')}}" method="post" enctype="multipart/form-data">
											@csrf()
											<img id="imgShow_WU_FILE_0" width="100" height="100" src="{{isset($info['img'])?'uploads/'.$info['img']:'img/_/photo_icon.png'}}" alt="">
											<input type="file" name="img" id="up_img_WU_FILE_0" class="sui-btn btn-primary" />
											<input type="submit" value="点击确认" class="sui-btn btn-primary">	
										</form>
                                        <!-- 头像 end -->
                                    </div>

                                </div>
                            </div>
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
@include('layouts.app');