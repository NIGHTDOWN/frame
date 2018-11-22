<?php /* "ngtpl[start]:/tpl/user//pframe.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:18:02 */ ?>

<html xmlns="http://www.w3.org/1999/xhtml"><style type="text/css" ></style><head>
<title>我的钱包 － 钱包</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo $this->_vars['staticjs']; ?>
jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js"></script>
<link href="<?php echo $this->_vars['usertpl']; ?>
res/pay.css" rel="stylesheet" type="text/css">
<style type="text/css">object,embed{                -webkit-animation-duration:.001s;-webkit-animation-name:playerInserted;                -ms-animation-duration:.001s;-ms-animation-name:playerInserted;                -o-animation-duration:.001s;-o-animation-name:playerInserted;                animation-duration:.001s;animation-name:playerInserted;}                @-webkit-keyframes playerInserted{from{opacity:0.99;}to{opacity:1;}}                @-ms-keyframes playerInserted{from{opacity:0.99;}to{opacity:1;}}                @-o-keyframes playerInserted{from{opacity:0.99;}to{opacity:1;}}                @keyframes playerInserted{from{opacity:0.99;}to{opacity:1;}}</style></head>
<body>
<div class="top">
	<div class="w fn-clear">
		<div class="top-a fn-clear">
            <ul class="fn-left">
                <li>你好, <?php echo $this->_vars['user']['username']; ?>
</li>
                <li><a href="<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'user'), $this);?>">买家中心</a></li>
			</ul>
            <ul class="fn-right">
            <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetxfz!@ mod=@!index!@ type=@!im!@ ")); ?>
                <li><a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "alias:about",'group' => 'index'), $this);?>">帮助中心</a></li>
            </ul>
        </div>
		<div class="top-b fn-clear">
        	<h2><a style="position: relative" href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>"><img  src="<?php echo $this->_vars['static']; ?>
logo/logo.png" style="width: 150px;position: absolute;top: -15px;"></a></h2>
              	<ul class="nav">
            	<li class="current">
                	<a href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>">我的钱包</a>
                </li>
            	<li>
                	<a href="<?php echo \ng169\hook\url(array('mod' => 'log','action' => 'order'), $this);?>">交易记录</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="banner w">
	<div class="user">
	<?php if ($this->_vars['user']['headimg']): ?>
	<div class="img"><img height="72" src="<?php echo $this->_vars['user']['headimg']; ?>
"></div>
	<?php else: ?>
    	<div class="img"><img height="72" src="<?php echo $this->_vars['usertpl']; ?>
res/avatar.png"></div>
    	<?php endif; ?>
        <div class="img-cover"></div>
        <div class="info">
        	<div class="user_info">
            <p>个人账户：</p>
            <p>
                <span><?php echo $this->_vars['user']['username']; ?>
</span>
              <?php if (! $this->_vars['user']['userrz']): ?>  <a href="<?php echo \ng169\hook\url(array('mod' => 'rz'), $this);?>"></a><?php endif; ?>
            </p>
            </div>
            <div class="user_account">账户余额：<em><?php echo $this->_vars['user']['cash']/100; ?>
</em>元</div>
        </div>
    </div>
    <div class="greeting">
    	<span>您好，</span>
    	 <?php $this->assign('text', \ng169\hook\vo_list("fun=@!get!@ mod=@!paytext!@ type=@!im!@ ")); ?>
        <p><?php echo $this->_vars['text']; ?>
</p>
    </div>
</div>
<div class="container w fn-clear">
	<div class="fn-left">
        <div class="sidenav">
            <div class="m fore1">
            	<div class="mt">资金管理</div>
            	<div class="mc fn-clear">
                	<a class="btncz" href="<?php echo \ng169\hook\url(array('mod' => 'recharge'), $this);?>">充值</a>
                    <a class="btntx" href="<?php echo \ng169\hook\url(array('mod' => 'withdraw'), $this);?>">提现</a>
                  
                </div>
            </div>
            <div class="m fore2">
            	<div class="mt">交易查询</div>
            	<div class="mc fn-clear">
            	 <a  href="<?php echo \ng169\hook\url(array('mod' => 'log','action' => 'glide'), $this);?>">余额流水</a>
                <a  href="<?php echo \ng169\hook\url(array('mod' => 'log','action' => 'order'), $this);?>">交易记录</a>
                    <a  href="<?php echo \ng169\hook\url(array('mod' => 'log','action' => 'recharge'), $this);?>">充值记录</a>
                    <a  href="<?php echo \ng169\hook\url(array('mod' => 'log','action' => 'withdraw'), $this);?>">提现记录</a>
                </div>
            </div>
            <div class="m fore3">
            	<div class="mt">账户管理</div>
            	<div class="mc fn-clear">
                	<a href="<?php echo \ng169\hook\url(array('mod' => 'set','group' => 'user'), $this);?>">账户信息</a>
                	<a href="<?php echo \ng169\hook\url(array('mod' => 'card','group' => 'pay'), $this);?>">银行卡</a>
                    <a href="<?php echo \ng169\hook\url(array('mod' => 'payset','action' => 'pwd'), $this);?>">支付密码</a>
                    <?php if (! $this->_vars['user']['userrz']): ?>
                    <a href="<?php echo \ng169\hook\url(array('mod' => 'rz'), $this);?>">实名认证</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="m1">
            <div class="mt"><a  href="#">常见问题</a></div>
            <div class="mc">
                <ul>
                <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetxfz!@ mod=@!index!@ type=@!im!@ ")); ?>
                  <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
                	                    <li><a href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_vars['volist']['title']; ?>
</a></li>
                	                    <?php endforeach; endif; ?>
                                       
                                    </ul>
            </div>
        </div>
    </div>