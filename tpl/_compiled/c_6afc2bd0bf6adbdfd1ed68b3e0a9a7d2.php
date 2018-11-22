<?php /* "ngtpl[start]:tpl/mtpl/article_show.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:22:00 */ ?>

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
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'purchase','action' => 'run'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>



								<div class="jd-header-new-title">
									<div class="header-content">
										<span class="header-title">资讯</span>

									</div>
								</div>

								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>




					</div>

					<div id="commonList">

						<div class="author-header">
							<h1 class="article-title"><?php echo $this->_vars['data']['title']; ?>
</h1>
						
						</div>

						<div class="article-container">
						<?php echo $this->_vars['data']['content']; ?>

						</div>

						<div style="clear:both;margin-bottom:1rem"></div>
					</div>
				</div>





			</div>







		</div>












	</div>












	</div>

	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>