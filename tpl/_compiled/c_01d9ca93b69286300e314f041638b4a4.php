<?php /* "tpl/mtpl/login_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 03:32:39 �й���׼ʱ�� */ ?>

<!DOCTYPE html>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<title><?php echo $this->_vars['config']['site_name']; ?>
--登录</title>
		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css3/public_1.css" type="text/css">
		<link rel="stylesheet" href="<?php echo $this->_vars['indextpl']; ?>
css3/style_1.css" type="text/css">
	
	
		
		
		</head>
	<body>
		<div class="loginContainer">
			<div class="loginBox">
				<div class="sLogo">
					<a href="<?php echo url(array('action' => 'run','mod' => 'index'), $this);?>">
						<img src="<?php echo $this->_vars['static']; ?>
logo/logo.png"  alt="">
					</a>
				</div>
				<form action="<?php echo url(array('action' => 'login','mod' => 'login'), $this);?>" method="post">
						<input name="password" type="password" class=" feile" placeholder="请输入密码" value="">
					<ul>
						<li>
							<input name="username" type="text" class=" w100" placeholder="请输入用户账号" value="">
						</li>
						<li>
							<input name="password" type="password" class=" w100" placeholder="请输入密码" value="">
						</li>
<li>
							
												<input class=" w50" name="yzm" value="" type="text" placeholder="验证码" >
												  <img src="<?php echo url(array('args' => "",'action' => 'verify','mod' => 'login','group' => 'index'), $this);?>" class="w50" style="float:right" onclick="this.src=this.src" />
												
						</li>
						<li>
							<label>
									<a href="<?php echo url(array('action' => '','mod' => 'reg'), $this);?>" class="forget" style="display:none">免费注册</a>
							</label>
							<a href="<?php echo url(array('action' => 'forget','mod' => 'login'), $this);?>" class="forget">忘记密码</a>
						</li>

						<li class="firtLi">
							<input id="login_btn" class="subBtn" type="submit" value="登 录">
							<a href="<?php echo url(array('action' => '','mod' => 'reg'), $this);?>" class="subBtn">免费注册</a>
						</li>
					
					</ul>
				</form>
			</div>
		</div>
		
	</body></html>