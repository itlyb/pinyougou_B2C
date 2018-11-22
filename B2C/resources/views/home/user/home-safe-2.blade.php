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
<script type="text/javascript" src="plugins/jquery.validate/jquery.validate.js"></script>
<script>
        $(function(){
            //jquery.validate
            $("#phone-form").validate({
            submitHandler: function() {
                //验证通过后 的js代码写在这里
            }
        })		
        })
    
        //下面是一些常用的验证规则扩展

        /*-------------验证插件配置 懒人建站http://www.51xuediannao.com/-------------*/

        //配置错误提示的节点，默认为label，这里配置成 span （errorElement:'span'）
        $.validator.setDefaults({
        errorElement:'span'
        });

        //配置通用的默认提示语
        $.extend($.validator.messages, {
        required: '必填',
        equalTo: "请再次输入相同的值"
        });

        /*-------------扩展验证规则使用-------------*/
        //邮箱 
        jQuery.validator.addMethod("mail", function (value, element) {
        var mail = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$/;
        return this.optional(element) || (mail.test(value));
        }, "邮箱格式不对");

        //电话验证规则
        jQuery.validator.addMethod("phone", function (value, element) {
        var phone = /^0\d{2,3}-\d{7,8}$/;
        return this.optional(element) || (phone.test(value));
        }, "电话格式如：0371-68787027");

        //区号验证规则  
        jQuery.validator.addMethod("ac", function (value, element) {
        var ac = /^0\d{2,3}$/;
        return this.optional(element) || (ac.test(value));
        }, "区号如：010或0371");

        //无区号电话验证规则  
        jQuery.validator.addMethod("noactel", function (value, element) {
        var noactel = /^\d{7,8}$/;
        return this.optional(element) || (noactel.test(value));
        }, "电话格式如：68787027");

        //手机验证规则  
        jQuery.validator.addMethod("mobile", function (value, element) {
        var mobile = /^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mobile.test(value));
        }, "手机格式不对");

        //邮箱或手机验证规则  
        jQuery.validator.addMethod("mm", function (value, element) {
        var mm = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mm.test(value));
        }, "格式不对");

        //电话或手机验证规则  
        jQuery.validator.addMethod("tm", function (value, element) {
        var tm=/(^1[3|4|5|7|8]\d{9}$)|(^\d{3,4}-\d{7,8}$)|(^\d{7,8}$)|(^\d{3,4}-\d{7,8}-\d{1,4}$)|(^\d{7,8}-\d{1,4}$)/;
        return this.optional(element) || (tm.test(value));
        }, "格式不对");

        //年龄
        jQuery.validator.addMethod("age", function(value, element) {   
        var age = /^(?:[1-9][0-9]?|1[01][0-9]|120)$/;
        return this.optional(element) || (age.test(value));
        }, "不能超过120岁"); 
        ///// 20-60   /^([2-5]\d)|60$/

        //传真
        jQuery.validator.addMethod("fax",function(value,element){
        var fax = /^(\d{3,4})?[-]?\d{7,8}$/;
        return this.optional(element) || (fax.test(value));
        },"传真格式如：0371-68787027");

        //验证当前值和目标val的值相等 相等返回为 false
        jQuery.validator.addMethod("equalTo2",function(value, element){
        var returnVal = true;
        var id = $(element).attr("data-rule-equalto2");
        var targetVal = $(id).val();
        if(value === targetVal){
            returnVal = false;
        }
        return returnVal;
        },"不能和原始密码相同");

        //大于指定数
        jQuery.validator.addMethod("gt",function(value, element){
        var returnVal = false;
        var gt = $(element).data("gt");
        if(value > gt && value != ""){
            returnVal = true;
        }
        return returnVal;
        },"不能小于0 或空");

        //汉字
        jQuery.validator.addMethod("chinese", function (value, element) {
        var chinese = /^[\u4E00-\u9FFF]+$/;
        return this.optional(element) || (chinese.test(value));
        }, "格式不对");

        //指定数字的整数倍
        jQuery.validator.addMethod("times", function (value, element) {
        var returnVal = true;
        var base=$(element).attr('data-rule-times');
        if(value%base!=0){
            returnVal=false;
        }
        return returnVal;
        }, "必须是发布赏金的整数倍");

        //身份证
        jQuery.validator.addMethod("idCard", function (value, element) {
        var isIDCard1=/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/;//(15位)
        var isIDCard2=/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;//(18位)

        return this.optional(element) || (isIDCard1.test(value)) || (isIDCard2.test(value));
        }, "格式不对");
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
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <!-- <li><a href="#one" data-toggle="tab">密码设置</a></li> -->
                            <li class="active"><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">
                            
                                
                            <div id="two" class="tab-pane active">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="current">
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

                                <form action="{{route('home_safe_second_sub')}}" id="commentForm" method="post" class="sui-form form-horizontal " >
									@csrf()
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">手机号：</label>
                                        <div class="controls">
                                            <input name="phone" type="text" id="phone" placeholder="请输入新手机号">
                                        </div>                            
                                    </div>
                                    <div class="control-group">
                                        <label for="inputcode" class="control-label">滑块验证：</label>
                                        
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
                                        <input type="submit" class="sui-btn btn-primary" value="下一步">
                        
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


undefined

</html>
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
			phone:{
				required: true,
				isMobile: true,
		    },
		    

		},

		messages: {
			phone:{
				required: "请输入手机号",
			},
										    
		}
	});
});

</script>
<script>
	var seconds = 60;
	var si;
	$('#mobile').click(function(){
		var phone = $('#phone').val();
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



@include('layouts.app')