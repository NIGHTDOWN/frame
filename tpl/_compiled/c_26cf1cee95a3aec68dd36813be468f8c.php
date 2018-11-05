<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/mtpl/shop_intro.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:57:42 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['indextpl']; ?>
css/shop.css" rel="stylesheet" type="text/css" />

<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div id="mallPage" class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">



						<header id="mp-header" class="tm-mdv" >

							<section class="tm-shop-header">

								<div class="shop-back-img">
									<img src="<?php echo $this->_vars['data']['mstorepic']; ?>
" class="back">
								</div>

								<div class="tm-shop-header-info">
									<a class="shop_logo logo" href="#">
										<img src="<?php echo $this->_vars['data']['logo']; ?>
" alt="logo">
									</a>
									<div class="collect-wrapper">

										<div class="collect-btn collect-item">收藏</div>



										<!-- <div class="collect-cnt collect-item">
											<p class="collect-counter">


												3.1万

											</p>
											<p>粉丝</p>
										</div> -->
									</div>

									<div class="contact">
										<div class="ctn">
											<span class="name"><?php echo $this->_vars['data']['merchantname']; ?>
</span><p></p>
											<span class="name"><img title="卖家信用：<?php  echo vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['data']['muid']}!@"); ?>" align="absmiddle" src="<?php  echo vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['data']['muid']}!@"); ?>"></span>
										
										</div>

									</div>
								</div>
							</section>
							
						</header>




						<section class="nav-bar-wrapper J_tabNavBar">
							<div class="nav J_navBar ui-tab-slider-wrapper">
								<a href="<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item  J_tabItem" data-index="0" data-out="false" data-page="index">
									<span class="count tm-shop-m-iconfont"></span>
									<span class="text">首页</span>
								</a>




								<a href="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item J_tabItem" data-index="1" data-out="false"
								 data-page="allItems">
									<span class="count tm-shop-m-iconfont"></span>
									<span class="text">全部商品</span>
								</a>






								<a href="<?php echo url(array('mod' => 'shop','action' => 'purchase','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item J_tabItem" data-index="2" data-out="false" data-page="newItems">
									<span class="count tm-shop-m-iconfont"></span>
									<span class="text">店铺活动</span>
								</a>



								<a href="<?php echo url(array('mod' => 'shop','action' => 'intro','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item J_tabItem selected-tab" data-index="3" data-out="false" data-page="dynamic">
									<span class="count tm-shop-m-iconfont"></span>
									<span class="text">店铺信息</span>
								</a>

							</div>
						</section>


					










						<section class="search-ctn">
							<div onclick="_go_url('<?php echo url(array('mod' => 'shop','args' => "id:" . $this->_vars['data']['muid'] . "",'action' => 'search'), $this);?>')" class="open-search">
								<span class="icon-search"></span>
								在店铺内搜索
							</div>
						</section>

						<section class="ui-panel-slider J_panelSlider">

						</section>
					</div>
					<div class="detail-item border-grids">
							<a href="javascript:void(0)" class="item-cell">
									<div class="ui-flex cell-left">
										<span class="cell-title">认证信息</span>
										<span class="cell cell-desc"> <?php if ($this->_vars['data']['rzflag'] == 2): ?>
											<img src="<?php echo $this->_vars['indextpl']; ?>
images/ico/certification_no.gif">
											 <?php elseif ($this->_vars['data']['rzflag'] == 1): ?>
											<img src="<?php echo $this->_vars['indextpl']; ?>
images/ico/certautonym_no.gif">
											<?php endif; ?></span>
									</div>
								</a>
	
							<a href="javascript:void(0)" class="item-cell">
									<div class="ui-flex cell-left">
										<span class="cell-title"><pre>保 证 金</pre> </span>
										<span class="cell cell-desc"> <?php echo $this->_vars['data']['bzjcash']; ?>
</span>
									</div>
								</a>
	
							<a href="javascript:void(0)" class="item-cell">
						<div class="ui-flex cell-left">
							<span class="cell-title">商品数量</span>
							<span class="cell cell-desc">	<?php  echo vo_list("fun=@!get_count!@ mod=@!product!@  array=@!'pflag:1,muid:'{$this->_vars['data']['muid']}!@}"); ?></span>
						</div>
					</a>
					<a href="javascript:void(0)" class="item-cell">
							<div class="ui-flex cell-left">
								<span class="cell-title">创店时间</span>
								<span class="cell cell-desc">	<?php echo $this->_run_modifier($this->_vars['data']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</span>
							</div>
						</a>	
				</div>


					<div class="detail-item border-grids">

							<a href="javascript:void(0)" class="item-cell">
									<div class="ui-flex cell-left">
										<span class="cell-title">描述相符</span>
										<span class="cell cell-desc"><?php echo $this->_vars['data']['mspf']; ?>
分</span>
									</div>
								</a>

							<a href="javascript:void(0)" class="item-cell">
						<div class="ui-flex cell-left">
							<span class="cell-title">服务态度</span>
							<span class="cell cell-desc">	<?php echo $this->_vars['data']['fwpf']; ?>
分</span>
						</div>
					</a>
					<a href="javascript:void(0)" class="item-cell">
							<div class="ui-flex cell-left">
								<span class="cell-title">物流速度</span>
								<span class="cell cell-desc">	<?php echo $this->_vars['data']['wlpf']; ?>
分</span>
							</div>
						</a>

					


				</div>

			


					<div class="detail-item border-grids">

							
							<a href="javascript:void(0)" class="item-cell">
						<div class="ui-flex cell-left">
							<span class="cell-title">店铺简介</span>
							<span class="cell cell-desc">	<?php echo $this->_vars['data']['intro']; ?>
</span>
						</div>
					</a>
						
				</div>
				
					
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."shopfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


			