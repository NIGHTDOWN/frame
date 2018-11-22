<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/mtpl/purchase_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 10:45:52 */ ?>

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




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>
								<form action="<?php echo \ng169\hook\url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">聚实惠</span>

										</div>
									</div>
								</form>
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


						<div class="swiper-container" style="height:140px;">

							<div class="swiper-wrapper" id='mobile_purchase_ad' style="width: 2060px; height: 140px; ">

							</div>
							<div class="pagination"></div>
						</div>
















					</div>

					<div id="commonList">
						<div class="sort-list-2">
							<ul class="article">

								<li>

									<span class="img-box-b" id='mobile_purchase_ad_center'>

									</span>


								</li>
								<li>



									<?php $this->assign('article', \ng169\hook\vo_list("fun=@!get_all!@ num=@!7!@ mod=@!article!@  ")); ?>
									<?php if (count((array)$this->_vars['article'])): foreach ((array)$this->_vars['article'] as $this->_vars['volist']): ?>
									<span class="article">
										<a href=" <?php echo \ng169\hook\url(array('mod' => 'article','action' => 'show','args' => " articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" target="_blank" title="
											<?php echo $this->_vars['volist']['title']; ?>
">
											<?php echo $this->_vars['volist']['title']; ?>

										</a>
									</span>
									<?php endforeach; endif; ?>

								</li>
							</ul>
							<div style="clear:both"></div>

							<ul class="flex_list">
						
								<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['vo']): ?>
									<li class="item">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'product','args' => "productid:" . $this->_vars['vo']['pid'] . "",'action' => 'detail'), $this);?>">
											<div class="cover bg_stamp">
												<img class="ll_fadeIn" src="<?php echo $this->_vars['vo']['gimg']; ?>
"
												 loaded="1" style="opacity: 1;">
											</div>
											<div class="stamp_two">已有人<?php echo $this->_vars['vo']['gsells']; ?>
拼</div>
											<div class="info">
													
												<div class="name"><?php echo $this->_run_modifier($this->_vars['vo']['gtitle'], 'tostr', 'PHP', 1); ?>
</div>
												<div class="lefttime" data-time="<?php echo $this->_run_modifier($this->_vars['vo']['getime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
">
														<i class="iconfont icon-time"></i>
														<span>剩余时间：</span>
														<span class="days">0</span>
														<em>:</em>
														<span class="hours">0</span>
														<em>:</em>
														<span class="minutes">0</span>
														<em>:</em>
														<span class="seconds">0</span>
													</div>
												<div class="price">
														<span class="p1">¥<?php echo $this->_vars['vo']['price']/100; ?>
</span>
													<span>¥
														<em><?php echo $this->_vars['vo']['gprice']/100; ?>
</em></span>
												</div>
											
												<div class="btn">去参团</div>
											</div>
										</a>
									</li>
<?php endforeach; endif; ?>


								
										
								
								</ul>
								<div style="clear:both;"></div>
							<div class="page">
								<?php echo $this->_vars['page']; ?>

							</div>
							<div style="clear:both;margin-bottom:1rem"></div>
						</div>
					</div>
					




				</div>







			</div>








			<div class="page">
				<?php echo $this->_vars['page']; ?>

			</div>



		</div>












	</div>

	</div>
	<script src="<?php echo $this->_vars['indextpl']; ?>
/js/jquery.yomi.js"></script>
	<script>
		$(function(){
		//倒计时
		$(".lefttime").each(function(){
			$(this).yomi();
		});
	
	});
		$domain = '<?php echo $this->_vars['config']['site_url']; ?>
';
		$u2 = '<?php echo \ng169\hook\url(array('action' => 'getad','mod' => 'index'), $this);?>';
		getadmobile($domain, $u2, 'mobile_purchase_ad');
		getadmobilead($domain, $u2, 'mobile_purchase_ad_center');
	</script>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>