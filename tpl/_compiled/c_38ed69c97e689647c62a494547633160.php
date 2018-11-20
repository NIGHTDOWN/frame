<?php /* "ngtpl[start]:tpl/templets/default/login_forget.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 10:42:10 */ ?>


<!DOCTYPE html>
<html lang="en" >

	<head>

		<meta charset="utf-8">
		<title>找回密码</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- CSS -->
        
		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css/supersized.css">
		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css/style.css">

      

	</head>

	<body>
		<div class="logo"><img src="<?php echo $this->_vars['static']; ?>
logo/logo.png" width="200" ></div>
		<div class="page-container">
			<h1>手机找回密码</h1>
			<form action="<?php echo \ng169\hook\url(array('action' => 'cgpwd'), $this);?>" method="post">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="2"><input type="text" name="username" class="input" placeholder="输入手机号码" ></td>
					</tr>
					<tr>
						<td><input type="text" name="code" class="input" placeholder="输入手机验证码"></td>
						<td><input name="sendsms" id="sendsms" type="button" class="btn btn-primary pemailcheck" id='button' value="获取短信验证码"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="password" name="password" class="input" placeholder="输入新密码"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="password" name="cpassword" class="input" placeholder="确认新密码"></td>
					</tr>
					<tr>
						<td>
							<input type="text" name="yzm" class="input" placeholder="输入验证码"  style="float: left"></td><td>
							<img src="<?php echo \ng169\hook\url(array('args' => "",'action' => 'verify','mod' => 'login','group' => 'index'), $this);?>" class="input" style="float:right" onclick="this.src=this.src" />
						</td>	
					</tr>
					
					
					<tr>
						<td colspan="2"><input type="submit" name="button" id="button" value="确认修改"></td>
					</tr>
					
					
				</table>
                
			</form>
			<div class="connect">
				<p><a href="<?php echo \ng169\hook\url(array('mod' => 'login'), $this);?>">返回登录</a></p>
               
			</div>
		</div>
      

		<!-- Javascript -->
		<script src="<?php echo $this->_vars['indextpl']; ?>
js/jquery-1.8.2.min.js"></script>
		
		<script
			src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js" type="text/javascript">
		</script>
		<script>
			
				
       	
		
			$(function(){
					var intDiff =0;
					$('#sendsms').click(function() {
							if(intDiff<=0){

								var $mobile = $('[name=username]').val();
								var $action = '<?php echo \ng169\hook\url(array('action' => 'forget','mod' => 'login'), $this);?>';
								yAjax($action,{username:$mobile},function(data){
										
										intDiff = parseInt(60);//倒计时总秒数量
										var timer = window.setInterval(function(){
												$("#sendsms").attr("disabled", true);
												$("#sendsms").val(''+intDiff+'秒后重新获取');
												intDiff--;
												if(intDiff<0){
													clearInterval(timer);
													$("#sendsms").removeAttr("disabled");
													$("#sendsms").val('获取短信验证码');
												}
											}, 1000);
										if(!data.flag ){
										
											alert(data.error.errormsg);
										}
									});
							}

						});
				});
		</script>

	</body>

</html>

