$().ready(function() {
	$("#commentForm").validate({
		rules:{
			name:{
			    required: true,
			},
			password:{
				required: true,
		    },
		    
		},
		messages: {
			name: {
				required: "请输入用户名",
			
			},
			password:{
				required: "请输入密码",
			},							    
        }
        
	});
});