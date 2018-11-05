
/*
 * 会员信息处理js
 * Author LiChuanJiang
 * Date 2016-04-05
 */
 
 
//发送手机验证码
var mobile_code_timer = "";
var mobile_code_count = 60;
$("#send_mobile_code").click(function(){
	$_this = $(this);
	var mobile = $.trim($("#mobile").val());
	var type = $_this.data("type");
	if(mobile != ""){
		var reg = /^[1]\d{10}$/;
		if(reg.test(mobile)){
			$_this.attr("disabled","true");
			$.post("/?m=User&c=Register&a=sendMobileCode",{"mobile":mobile,"type":type},function(data){
				if(data == "success"){
                    show_msg_box("发送成功！");
					$_this.css({"background":"grey","color":"#eee"});
					mobile_code_timer = setInterval(mobile_code_send, 1000);
				}else{
                    show_msg_box(data);
					$_this.removeAttr("disabled");
				}
			});
		}else{ show_msg_box("手机号码格式错误！");}
	}else{ show_msg_box("手机号码不能为空！"); }
});
function mobile_code_send(){
	mobile_code_count--;
	if(mobile_code_count<0){
		mobile_code_count = 60;
		$("#send_mobile_code").removeAttr("disabled").css({"background":"#dddddd","color":"#000"}).val("获取验证码");
		clearInterval(mobile_code_timer);
	}else{
		$("#send_mobile_code").val("已发送（"+mobile_code_count+"）");
	}
}
 
 
// 会员注册处理
$("#register_btn").click(function(){
	var serialize = $("form").serialize();
	$.post("/index.php/User/Register/register",{"serialize":serialize,"actype":"register"},function(data){
		if(data == "success"){
            show_msg_box("注册成功！",'/index.php/Home/Index/index');
		}else{
            show_msg_box(data);
		}
	});
});

// 会员登录处理
$("#login_btn").click(function(){
    userLogin();
});
function userLogin(){
    var serialize = $("form").serialize();
    $.post("/index.php/Login/Index/login",{"serialize":serialize},function(data){
        if(data == "success"){
            show_msg_box("登录成功！",'/index.php/Home/Index/index');
        }else{
            show_msg_box(data);
            $("#captchaImg").attr("src", "/User/Login/verify");
        }
    });
}

// 找回密码处理
$("#forgot1_btn").click(function(){
	var serialize = $("form").serialize();
	$.post("/index.php/User/Forgot/toForgot1",{"serialize":serialize,"actype":"forgot1"},function(data){
		if(data == "success"){
            show_msg_box("验证成功，立即去重置密码！",'/index.php/User/Forgot/forgot2');
		}else{ show_msg_box(data);}
	});
});

// 重置密码处理
$("#forgot2_btn").click(function(){
	var serialize = $("form").serialize();
	$.post("/index.php/User/Forgot/toForgot2",{"serialize":serialize,"actype":"forgot2"},function(data){
		if(data == "success"){
            show_msg_box("重置成功，立即去登录！",'/index.php/Login/Index/index');
		}else{ show_msg_box(data); }
	});
});

//退出登录
$("#loginOut").click(function(){
	$.post("/index.php/Login/Index/loginOut",function(data){
		if(data == "success"){
            show_msg_box("退出成功！",'/index.php/Login/Index/index');
		}else{
            show_msg_box("遇到错误，退出失败！");
        }
	});
});