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
			name:{
				specialCharFilter: true,
			    required: true,
				minlength: 3,
			},
			password:{
				required: true,
				minlength: 6,
				maxlength: 18,
				specialCharFilter: true,

		    },
		    repassword:{
				required: true,
			    equalTo:"#password"
			},
			checkbox: {
				required: true,
			},
			phone: {
				required: true,
				isMobile: true,
			},
			phone_code: {
				required: true,
			}
		},
		messages: {
			name: {
				required: "请输入用户名",
				minlength: "至少添加3个字符呢",	
			},
			password:{
				required: "请输入密码",
				minlength: "最少六位",
				maxlength: "最大18位",
			},
			repassword:{
			    required: "请确认密码",
				equalTo:"密码不一致",
			},
			checkbox:{
				required: "请同意协议后再点击注册",
			},
			phone: {
				required: '请输入手机号',
				isMobile: '请输入正确手机号',
			},
			phone_code: {
				required: '请输入手机验证码',
			}
									    
		}
	});
});
	