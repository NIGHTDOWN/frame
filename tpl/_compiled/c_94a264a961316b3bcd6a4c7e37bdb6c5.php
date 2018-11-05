<?php /* "tpl/mtpl/reg_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:20:11 �й���׼ʱ�� */ ?>

<!DOCTYPE html>

<html class=" js rgba borderradius boxshadow textshadow opacity cssgradients"><!-- <![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css3/style_1.css" type="text/css">
	
		<script type="text/javascript" src="<?php echo $this->_vars['staticjs']; ?>
/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->_vars['staticjs']; ?>
/night_Trad.v1.0.js"></script>
		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css2/bootstrap.min.css" type="text/css">

		<title><?php echo $this->_vars['config']['site_name']; ?>
--注册</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">

		<!-- Favicons -->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">


		

	</head>
	<body class="login">



		<div class="loginContainer">
			<div class="loginBox" style="padding-top: 5%">
				<div class="sLogo">
					<a href="<?php echo url(array('action' => 'run','mod' => 'index'), $this);?>">
						<img src="<?php echo $this->_vars['static']; ?>
logo/logo.png" >
					</a>
				</div>
			<form class="form-horizontal margin-none" name="register_form"  method="post">                 
                
							<div class="widget widget-body-white padding-none">
								
								<div class="widget-body">
								
								
									
								<div class="form-group">
										<label class="col-md-3 control-label">手机号码<span class="ast">*</span></label>
										<div class="col-md-9"><input placeholder="请输入用户手机" tag='notnull ismobile'  class="form-control" id="account" name="mobile" value="" type="text"></div>
									</div>
			    <?php if ($this->_vars['config']['smsflag']): ?>
									<div class="form-group">
										<label class="col-md-3 control-label">短信验证码<span class="ast">*</span></label>
										<div class="col-md-9">
											<div class="input-group">
												<input class="form-control" name="code" tag='fixnum' value="" type="text" placeholder="请输入您收到的短信验证码">
												<span class="input-group-btn"> <input name="sendsms" id="sendsms" type="button" class="btn btn-primary pemailcheck" value="获取短信验证码"></span>
											</div>
										</div>
									</div>
								<?php endif; ?>
									<div class="form-group">
									<label class="col-md-3 control-label">新密码<span class="ast">*</span></label>
									<div class="col-md-9"><input class="form-control" placeholder="请输入新密码" tag='notnull iscomplex'  id="password" name="password" type="password"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">确认新密码<span class="ast">*</span></label>
										<div class="col-md-9"><input class="form-control" placeholder="确认新密码"  id="cpassword" tag='notnull isequal' name="cpassword" type="password"></div>
									</div>
									<div class="form-group">
											<label class="col-md-3 control-label">图片验证码<span class="ast">*</span></label>
											<div class="col-md-9">
												<div class="input-group">
													<input class="form-control" name="yzm" value="" type="text" placeholder="图片验证码">
													<span class="input-group-btn"> <img height="30" onclick="this.src='<?php echo url(array('action' => 'verify','mod' => 'login'), $this);?>'" id="myHeader" name="myHeader" src="<?php echo url(array('action' => 'verify','mod' => 'login'), $this);?>" class="col-md-3"></span>
												</div>
											</div>
										</div>
								
                            
								</div>    
                                        
							</div>

							<div class="widget widget-body-white padding-none">                     
								<div class="data-footer innerAll half text-right clearfix" style="text-align:center; padding:10px;">
									<input type="submit" class="btn btn-block btn-primary" value="注册">                         
									
								</div>
							</div>
						</form>
			</div>
		</div>
	
		<script>
			$(function(){
				
		

					var intDiff =0;
					$('#sendsms').click(function() {
							if(intDiff<=0){
								var $mobile = $('[name=mobile]').val();
								var $action = '<?php echo url(array('action' => 'send'), $this);?>';
								$.post($action,{mobile:$mobile},function(data){
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

data=jta(data);
										if(data.flag ){
											alert(data.data);
										}else{
											
											showd(data.error.errormsg);
										}
									});
							}

						});
				});
		</script>


	</body></html>


