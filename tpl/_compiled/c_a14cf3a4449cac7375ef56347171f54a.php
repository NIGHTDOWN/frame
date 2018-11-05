<?php /* "tpl/muser/set_address.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 00:44:12 �й���׼ʱ�� */ ?>

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
											<span class="header-title">收货地址管理</span>

										</div>
									</div>
								</form>
								<div onclick="_go_url('<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>





					

					<section class="core-entry">
						<ul id="addressList" >
							<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
							<li  class="address-row <?php if ($this->_vars['volist']['mflag']): ?>active<?php endif; ?>" onclick="_go_url('<?php echo url(array('mod' => 'address','action' => 'edit','args' => "addid:" . $this->_vars['volist']['addid'] . ""), $this);?>')">
							 <span="">
								<div class="font-32">
									<label>收货人:</label>
									<label name="user-name"><?php echo $this->_vars['volist']['realname']; ?>
</label>
									<label name="phone-num" style="float: right"><?php echo $this->_vars['volist']['recvmobile']; ?>
</label>
								</div>
								<div class="font-24">
									<label>收货地址:</label>
									<label name="address"><?php echo $this->_run_modifier($this->_vars['volist']['provinceid'], 'getprovince', 'PHP', 1);  echo $this->_run_modifier($this->_vars['volist']['cityid'], 'getcity', 'PHP', 1); ?>
 <?php echo $this->_run_modifier($this->_vars['volist']['areaid'], 'getarea', 'PHP', 1); ?>
 <?php echo $this->_vars['volist']['address']; ?>
</label>
								</div>
								<span class="right-icons">
									<i class="iconfont icon-check"></i>
									
								</span>
							</li>
								<?php endforeach; endif; ?>
						
						
						</ul>

					</section>





					<a class='btn' href="<?php echo url(array('action' => 'addaddress'), $this);?>">	<span><i class=" icon-add"></i>新增收货地址</span></a>
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