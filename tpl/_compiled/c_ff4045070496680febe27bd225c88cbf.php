<?php /* "/tpl/user//top.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 23:59:05 �й���׼ʱ�� */ ?>

<!DOCTYPE html>
<html ><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


		<title>会员中心<?php echo $this->_vars['seo']['title']; ?>
</title>
		<meta name="description" content="<?php echo $this->_vars['seo']['desc']; ?>
">
		<meta name="keywords" content="<?php echo $this->_vars['seo']['keyword']; ?>
">
		
		<link href="<?php echo $this->_vars['usertpl']; ?>
res/buyer.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $this->_vars['usertpl']; ?>
res/skin.css" rel="stylesheet" type="text/css">
		
		<script src="<?php echo $this->_vars['staticjs']; ?>
jquery.min.js" type="text/javascript"></script>
		<script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ajaxfileupload.js'>
    </script>
 <script src="<?php echo $this->_vars['staticjs']; ?>
data2.js" type="text/javascript"></script>
    <link href="<?php echo $this->_vars['staticjs']; ?>
data2.css" rel="stylesheet" type="text/css">
<script src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js" type="text/javascript"></script>
	  <style>
		.oe_trap_error{
			color:red;
		}
			#msgbox .mggbox_1{background:#fff;border:1px solid #f5d5ac; border-top:none;}
#msgbox .msgtitle{background:none; background:#FDDBB1 top left repeat-x;  line-height:35px; position:relative; font-weight:bold; border-top:1px solid #f5d5ac; border-bottom:1px solid #f5d5ac; color:#ff6000; margin-bottom:10px;  cursor:move;}
#msgbox .msgtitle #boxtitle{font-size:16px; padding-left:20px;}
#msgbox .msgtitle #boxclose{position:absolute; right:10px; top:8px; width:20px; height:20px; line-height:18px; font-size:18px; cursor:pointer;text-align:center;}
#msgbox .msgtitle #boxclose:hover{background:#ff6000; color:#fff;}
#msgbox .mggbox_1 #boxbody{margin:15px;  }
#msgbox .mggbox_1 #boxbody td,#msgbox .mggbox_1 #boxbody th{font-size:14px;}
#msgbox .mggbox_1 #boxbody .box_input{ padding-left:8px; border:1px solid #e3e3e3; background:#fff;box-shadow: 2px 2px 2px #f5f5f5 inset; width:200px; height:25px;}
#msgbox .mggbox_1 #boxbody input[type="text"]{background:#fff; border:1px solid #e3e3e3;box-shadow: 2px 2px 2px #f5f5f5 inset;}
#msgbox .mggbox_1 #boxbody select{border:1px solid #e0e0e0; padding:2px;}
#msgbox .mggbox_1 #boxbody .modify_input{width:350px; background:#fff; border:1px solid #e3e3e3;box-shadow: 2px 2px 2px #f5f5f5 inset; padding-left:8px;}
#msgbox .mggbox_1 #boxbody .notnull{ border:1px solid #e3e3e3; background:#fff;box-shadow: 2px 2px 2px #f5f5f5 inset; width:120px; height:25px; margin-right:5px;}
#msgbox .mggbox_1 #boxbody .w1hover{border: 1px solid #07f; box-shadow: 0 0 3px #8cddff; outline: 0 none;}
#msgbox .mggbox_1 #boxbody  input.oe_boxbut{ width:85px; height:32px; background:#FDDBB1 no-repeat; border:none; text-align:center; color:#fff; font-size:16px; font-weight:normal; cursor:pointer;font-family:"Microsoft Yahei",arial,"Hiragino Sans GB","Hiragino Sans GB W3",宋体;}

			
		</style>
		
	</head>
	<body class="member">
		<div id="append_parent"></div>
		<div id="ajaxwaitid"></div>

		<div id="shortcut">
			<div class="w">
				<div class="fl"> 
					欢迎<a class="name" href="<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>"><?php echo $this->_vars['user']['username']; ?>
</a> ！&nbsp;<a href="<?php echo url(array('mod' => 'login','action' => 'logout','group' => 'index'), $this);?>">退出</a> 
					<a href="<?php echo url(array('mod' => 'index','group' => 'index'), $this);?>">首页</a>
				</div>
				<div class="fr">
				<?php if ($this->_vars['user']['muid'] && ( $this->_vars['user']['rzflag'] == 1 || $this->_vars['user']['rzflag'] == 2 )): ?>
					<a href="<?php echo url(array('mod' => 'shop','group' => 'shop'), $this);?>" style="font-weight: bold;">卖家中心</a>
					<?php else: ?>
						<a href="<?php echo url(array('mod' => 'shop'), $this);?>" style="font-weight: bold;">免费开店</a>
						<?php endif; ?>
					<a target="_blank" href="<?php echo url(array('mod' => 'cart'), $this);?>">我的购物车</a> 
					<a href="<?php echo url(array('mod' => 'collect'), $this);?>">我的收藏</a>
					<a href="<?php echo url(array('mod' => 'message'), $this);?>">站内消息</a>
				</div>
			</div>
		</div>
		
		
		
		
		
		<div id="main">
			<div class="header">
				<h1 >
					<a href="<?php echo url(array('mod' => 'index','group' => 'index'), $this);?>" title="<?php echo $this->_vars['config']['site_name']; ?>
"> <img title="<?php echo $this->_vars['config']['site_name']; ?>
" alt="<?php echo $this->_vars['config']['site_name']; ?>
" src="<?php echo $this->_vars['static']; ?>
logo/logo.png"></a>
				</h1>
				<div id="nav">
					<ul>
						<li class="<?php if ($this->_vars['c'] != 'order' && $this->_vars['c'] != 'set' && $this->_vars['c'] != 'message'): ?>frist<?php endif; ?>"><a href="<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>">首页</a></li>
						<li class="<?php if ($this->_vars['c'] == 'order'): ?>frist<?php endif; ?>"><a href="<?php echo url(array('mod' => 'order'), $this);?>">我的订单 </a></li>	
						<li class="<?php if ($this->_vars['c'] == 'set'): ?>frist<?php endif; ?>"><a href="<?php echo url(array('mod' => 'set'), $this);?>">账户设置</a></li>
						
						<li class="<?php if ($this->_vars['c'] == 'message'): ?>frist<?php endif; ?>"><a href="<?php echo url(array('mod' => 'message'), $this);?>">信息</a></li>
						<li class="<?php if ($this->_vars['c'] == 'pay'): ?>frist<?php endif; ?>"><a href="<?php echo url(array('group' => 'pay','mod' => 'index'), $this);?>">钱包</a></li>
					</ul>
					<div class="search_box">
						<form target="_blank" action="<?php echo url(array('group' => 'index','mod' => 'search'), $this);?>" method="post">
							<input type="text" maxlength="200" class="text" id="key" name="word">
							<input type="submit" class="submit" value="" name="">
	</form>
					</div>
				</div>
			</div>
		
		
		<div class="layout buyer clearfix">	
		
		
		
		
		
		
		