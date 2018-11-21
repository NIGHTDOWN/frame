<?php /* "ngtpl[start]:tpl/admin/login_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 11:49:43 */ ?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->_vars['config']['site_name']; ?>
-管理登入</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit"> 
    <meta name="author" content="llm" /> 
		
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
		
		<link rel="stylesheet" href="<?php echo $this->_vars['admintpl']; ?>
res/css/b2.css">
		<link rel="stylesheet" href="<?php echo $this->_vars['admintpl']; ?>
res/css/style.css">
		
		<style>
			
		</style>
		
		</head>
<body style="">
    
    <div class="container wrap1" style="height:450px;">
            <h2 class="mg-b20 text-center"><?php echo $this->_vars['config']['site_name']; ?>
</h2>
            <div class="col-sm-8 col-md-5 center-auto pd-sm-50 pd-xs-20 main_content">
                <p class="text-center font16">管理登入</p>
                <form action="<?php echo \ng169\hook\url(array('action' => 'login'), $this);?>" id="lg-form" name="lg-form" method="post">
                    <div class="form-group mg-t20">
                        <i class="icon-user icon_font"></i>
                        <input type="text" class="login_input" id="Email1" name="username" placeholder="请输入用户名">
                    </div>
                    <div class="form-group mg-t20">
                        <i class="icon-lock icon_font"></i>
                        <input type="password" class="login_input" id="Password1" name="password" placeholder="请输入密码">
					</div>
					<div class="form-group mg-t20">
							<i class="icon-configure icon_font"></i>
							<input type="text" class="login_input-50" id="Password1" name="checkcode" placeholder="验证码">
							<img class="login_code" src="<?php echo \ng169\hook\url(array('action' => 'verify','mod' => 'login','group' => 'index'), $this);?>" onclick="this.src=this.src" />
						</div>
                  
                    <button style="submit" class="login_btn">登 录</button>
               </form>
        </div><!--row end-->
    </div><!--container end-->
           


</body>



<style>
	.oe_trap_ok{
		position: absolute;
	}
	.oe_trap_error{
		position: absolute;
	}
</style>

</html>