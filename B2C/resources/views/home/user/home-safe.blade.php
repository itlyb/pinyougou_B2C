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
                <div class="yui3-u-5-6">
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">密码设置</a></li>
                            <li><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane active">


								<!-- 修改密码 start -->
                                <form action="{{route('home_safe_password')}}" method="post" class="sui-form form-horizontal "  id="commentForm" >
									@csrf()
                                    
                                    <div class="control-group">
                                        <label  class="control-label">密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required  id="password" >
                                        </div>
                                    </div>
									
                                    <div class="control-group">
                                        <label  class="control-label">重复密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="confirm_password" value="" placeholder="确认新密码" required equalTo="#password">
                                        </div>
                                    </div>
									
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
											<input type="submit" id="sub1" onclick="sub1()"  class="sui-btn btn-primary" value="提交">
                                        </div>
                                    </div>
                                </form>
								<!-- 修改密码 end -->




                            </div>
                            <div id="two" class="tab-pane">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">2</span><span>第二步 绑定新手机号</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">3</span><span>第三步 完成</span></label>
                                        </div>
                                    </div>
                                </div>

                                <!--表单-->

                                <form action="{{route('home_safe_first')}}" method="post" class="sui-form form-horizontal " >
									@csrf()
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">验证方式：</label>
                                        <div class="controls fixed">手机验证（{{session('user_phone')}}）</div>                            
                                    </div>
                                     <div class="control-group">
                                        <label for="inputcode" class="control-label">滑块证码：</label>
                                        <div class="controls">
										{!! Geetest::render('popup') !!}
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">短信验证码：</label>
                                        <div class="controls">
                                            <input name="msgcode" type="text" id="msgcode">
                                        </div>
                                        <div class="controls">
                                            <input type="button" value="发送" id="mobile">
                                        </div>
                                    </div>
                                    <div class="control-group next-btn">
										<input class="sui-btn btn-primary" type="submit" value="下一步">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
	@include('home.layout.bottom')
<!-- 表单验证 -->
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>
<script>
	jQuery.validator.addMethod("isMobile", function(value, element) {
	var length = value.length;
	var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
	return this.optional(element) || (length == 11 && mobile.test(value));
}, "请正确填写您的手机号码呢");
jQuery.validator.addMethod("specialCharFilter", function(value, element) {
    var pattern = new RegExp("[`~!@#$^&*()=|{}':;,.<>/?~！@#￥……&*（）——|【】‘；：”“'。，、？%+ 　\"\\\\]");
    var specialStr = "";
    for(var i=0;i<value.length;i++){
         specialStr += value.substr(i, 1).replace(pattern, '');
    }
    
    if( specialStr == value){
        return true;
    }
    
    return false;
},"内容含有非法字符例如'空格'");

$().ready(function() {
	$("#commentForm").validate({
		rules:{

			password:{
				required: true,
				minlength: 6,
				maxlength: 18,
				specialCharFilter: true,

		    },
		    confirm_password:{
				required: true,
			    equalTo:"#password"
			},

		},
		messages: {

			password:{
				required: "请输入密码",
				minlength: "最少六位",
				maxlength: "最大18位",
			},
			confirm_password:{
			    required: "请确认密码",
				equalTo:"密码不一致",
			},

									    
		}
	});
});

</script>
<script>
	var seconds = 60;
	var si;
	$('#mobile').click(function(){
		var phone = "{{session('user_phone')}}";
		// alert(phone);
		$.ajax({
			url:"{{route('duanxin')}}",
			type: 'GET',
			data: {phone:phone},
			dataType: "json",
			success: function(data)
			{	
				console.log(data,data.result);
				if(data.result == 0)
				{
					$('#mobile').attr('disabled',true);
					si = setInterval(function(){
						if(seconds == 0)
						{	
							clearTimeout(si);
							$('#mobile').attr('disabled',false);
							seconds = 10;
							
							$('#mobile').val('发送验证码');	
						}
						else
						{
							$('#mobile').val('还剩'+(seconds));	
						}
						seconds--;
					},1000);
				}
			}

		});
	});
</script>
undefined

</html>
@include('layouts.app')