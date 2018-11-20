<?php /* "ngtpl[start]:tpl/templets/default/login_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 09:59:58 */ ?>


<!DOCTYPE html>
<html lang="en" >

    <head>

        <meta charset="utf-8">
        <title>登录</title>
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
            <h1>会员登录</h1>
            <form action="<?php echo \ng169\hook\url(array('action' => 'login','mod' => 'login'), $this);?>" method="post">
                <input type="text" name="username" class="input" placeholder="输入邮箱">
                <input type="password" name="password" class="input" placeholder="输入密码">
                <div>
                	 <input type="text" name="yzm" class="input" placeholder="输入验证码"  style="width: 57.5%;float: left">
                <img src="<?php echo \ng169\hook\url(array('args' => "",'action' => 'verify','mod' => 'login','group' => 'index'), $this);?>" class="input" style="width: 40%;float:right" onclick="this.src=this.src" />
                	
                </div>
               
                <input type="submit" name="button" id="button" value="立即登入">
<div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>忘记密码？<a href="<?php echo \ng169\hook\url(array('action' => 'forget','mod' => 'login'), $this);?>">点击这里找回>></a></p>
               
            </div>
        </div>
        <!-- Javascript -->
        <script src="<?php echo $this->_vars['indextpl']; ?>
js/jquery-1.8.2.min.js"></script>
       
    </body>

</html>

