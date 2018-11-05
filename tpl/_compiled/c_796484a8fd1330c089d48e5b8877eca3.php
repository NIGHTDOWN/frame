<?php /* "tpl/muser/index_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 03:32:28 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/user.css" rel="stylesheet" type="text/css" />

<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="history.back();" class="jd-header-icon-back ">
									<span></span>
								</div>
								<form action="<?php echo url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">会员中心</span>

										</div>
									</div>
								</form>
								<div onclick="_go_url('<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>



					
					<section class="my_section">
							<div class="user">
									<div class="set-btn">
										<p onclick="_go_url('<?php echo url(array('mod' => 'set'), $this);?>')">设置</p>
									</div>
									<div class="user-photo" onclick="_go_url('<?php echo url(array('mod' => 'set'), $this);?>')">
<?php if ($this->_vars['user']['headimg']): ?>
										<img src="<?php echo $this->_vars['user']['headimg']; ?>
"><?php else: ?>
										
										<img src="<?php echo $this->_vars['static']; ?>
/images/head.png">
										<?php endif; ?>
									
									</div>
									<div class="user-nick">
										<p class="nick" id="J_myNick"><?php echo $this->_vars['user']['username']; ?>
</p>
										<p class="level "><img src="<?php  echo vo_list("fun=@!getlevelimg1!@ mod=@!userlevel!@ type=@!am!@ param1=@!{$this->_vars['user']['uid']}!@"); ?>">
											
										</p>
									</div>
								</div>
						<div class="my_lnks">
							<a id="goodsFavItem" href="<?php echo url(array('mod' => 'collect','action' => 'product'), $this);?>"  class="my_lnks_item">
								<span id="goodsFav" class="my_lnks_num"><?php  echo vo_list("fun=@!get_productsum!@ mod=@!collect!@ type=@!im!@"); ?></span>关注的商品
							</a>
							<a href="<?php echo url(array('mod' => 'collect','action' => 'shop'), $this);?>"  class="my_lnks_item">
								<i class="dot" id="favDot" style="display: none"></i>
								<span class="my_lnks_num" id="shopFav"><?php  echo vo_list("fun=@!get_shopsum!@ mod=@!collect!@ type=@!im!@"); ?></span>关注的店铺
							</a>
							<a href="<?php echo url(array('mod' => 'collect','action' => 'history'), $this);?>" class="my_lnks_item">
								<span class="my_lnks_num" id="recent"><?php  echo vo_list("fun=@!get_history!@ mod=@!collect!@ type=@!im!@"); ?></span>浏览记录
							</a>
						</div>

					</section>
					<section class="order-act" data-spm="2" data-spm-max-idx="6">
						<ul class=" orderAct" id="orderAct3">
							<li>
								<a href="<?php echo url(array('mod' => 'order','action' => "waitpay"), $this);?>" >
									<p>
										<span class="order-icons icon-pay"></span>
									</p>
									<p class="sub">待付款</p>
									
									<?php $this->assign('vv', vo_list("fun=@!getwaitpay!@ mod=@!order!@ type=@!im!@")); ?>
									<?php if ($this->_vars['vv']): ?>
									<p class="number"><?php echo $this->_vars['vv']; ?>
</p>
									<?php endif; ?>
								</a>
							</li>
							<li>
								<a href="<?php echo url(array('mod' => 'order','args' => "status:1"), $this);?>" >
									<p>
										<span class="order-icons icon-send"></span>
									</p>
									<p class="sub">待发货</p>
									
									<?php $this->assign('vv', vo_list("fun=@!getwaitfh!@ mod=@!order!@ type=@!im!@")); ?>
									<?php if ($this->_vars['vv']): ?>
									<p class="number"><?php echo $this->_vars['vv']; ?>
</p>
									<?php endif; ?>
								</a>
							</li>
							<li>
								<a href="<?php echo url(array('mod' => 'order','action' => "waitsure"), $this);?>" >
									<p>
										<span class="order-icons icon-deliver"></span>
									</p>
									<p class="sub">待收货</p>
								
									<?php $this->assign('vv', vo_list("fun=@!getwaitsure!@ mod=@!order!@ type=@!im!@")); ?>
									<?php if ($this->_vars['vv']): ?>
									<p class="number"><?php echo $this->_vars['vv']; ?>
</p>
									<?php endif; ?>
								</a>
							</li>
							<li>
								<a href="<?php echo url(array('mod' => 'order','action' => "waitcomment"), $this);?>" >
									<p>
										<span class="order-icons icon-evaluate"></span>
									</p>
									<p class="sub">待评价</p>
								
									<?php $this->assign('vv', vo_list("fun=@!getwaitcomment!@ mod=@!order!@ type=@!im!@")); ?>
									<?php if ($this->_vars['vv']): ?>
									<p class="number"><?php echo $this->_vars['vv']; ?>
</p>
									<?php endif; ?>
								</a>
							</li>
							<li>
								<a href="<?php echo url(array('mod' => 'order','args' => "status:5"), $this);?>" >
									<p>
										<span class="order-icons icon-refund"></span>
									</p>
									<p class="sub">退款/售后</p>
									<?php $this->assign('vv', vo_list("fun=@!getwaittk!@ mod=@!order!@ type=@!im!@")); ?>
									<?php if ($this->_vars['vv']): ?>
									<p class="number"><?php echo $this->_vars['vv']; ?>
</p>
									<?php endif; ?>
								</a>
							</li>
						</ul>
						<div class="label-act">
							<a href="<?php echo url(array('mod' => 'order'), $this);?>">
								<div class="ico">
									<p class="ico-cont">
										<span class="icon-form"></span>
									</p>
								</div>
								<div class="title">
									<h1>全部订单</h1>
								</div>
								<div class="sub">查看全部订单</div>
								<div class="arrow">
									<span class="icon-right"></span>
								</div>
							</a>
						</div>
					</section>

					<section class="core-entry">
						<div class="label-act">
							<a href="<?php echo url(array('mod' => 'cart'), $this);?>">
								<div class="ico">
									<p class="ico-cont ico-cart">
										<span class="icon-cart"></span>
									</p>
								</div>
								<div class="title">
									<h1>购物车</h1>
								</div>
								<div class="arrow">
									<span class="icon-right"></span>
								</div>
							</a>
						</div>
						
						<div class="label-act">
							<a href="<?php echo url(array('group' => 'pay','mod' => 'index'), $this);?>" >
								<div class="ico">
									<p class="ico-cont ico-alipay">
										<span class="icon-pay2"></span>
									</p>
								</div>
								<div class="title">
									<h1>钱包</h1>
								</div>
								<div class="arrow">
									<span class="icon-right"></span>
								</div>
							</a>
						</div>
						
					</section>
					<section class="core-entry" >
						
							
							<div class="label-act">
								<a href="<?php echo url(array('mod' => 'message'), $this);?>" >
									<div class="ico">
										<p class="ico-cont ico-msg">
											<span class="icon-message"></span>
										</p>
									</div>
									<div class="title">
										<h1>消息</h1>
									</div>
									<div class="arrow">
										<span class="icon-right"></span>
									</div>
								</a>
							</div>
							<div class="label-act">
								<a href="<?php echo url(array('mod' => 'set','action' => 'address'), $this);?>" >
									<div class="ico">
										<p class="ico-cont ico-caipiao">
											<span class="icon-address"></span>
										</p>
									</div>
									<div class="title">
										<h1>地址</h1>
									</div>
									<div class="arrow">
										<span class="icon-right"></span>
									</div>
								</a>
							</div>
						</section>
					
						<a class='btn ' href="<?php echo url(array('mod' => 'login','action' => 'logout','group' => 'index'), $this);?>">注销</a>
						<div style="clear:both;margin-bottom:1rem"></div>

				</div>







			</div>











		</div>












	</div>

	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>