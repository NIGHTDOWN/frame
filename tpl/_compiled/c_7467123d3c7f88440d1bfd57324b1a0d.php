<?php /* "ngtpl[start]:tpl/mtpl/product_category.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:49:05 */ ?>

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




			<div  class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<form action="<?php echo \ng169\hook\url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">

								
								<div class="jd-header-new-title-all">
									<div class="header-content" >
										<div  class="header-search-all">
											
											<input type="text" name="word" autocomplete="off" id="keywordShow" tag=' enter' class="search-input" value="<?php echo $this->_vars['where']['word']; ?>
" placeholder="搜索店铺内商品"
											 maxlength="20">
											<button type="submit"><i class="search-icon-r" ></i></button> 
										</div>
									
									
									</div>
								</div>
							</form>
								<div  onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')"
								 class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>








						<section class="J_lazyShopListOrder list_m_mdv">
							<div class="J_orderWrapper">
								<section id="J_order" class="list_m_mdv order">

									<div class="o_item <?php if ($this->_vars['orderby']['f'] == 'collects'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'collects'):  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":collects"), $this); else:  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:collects"), $this); endif; ?>')">推荐
										<div class="price-icon-wrapper  ">
											
										</div></div>

								<div class="o_item  <?php if ($this->_vars['orderby']['f'] == 'sells'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'sells'):  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":sells"), $this); else:  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:sells"), $this); endif; ?>')">销量
									<div class="price-icon-wrapper  ">
										
									</div></div>

								

								<div class="o_item  <?php if ($this->_vars['orderby']['f'] == 'addtime'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'addtime'):  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":addtime"), $this); else:  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:addtime"), $this); endif; ?>')">上新
									
									<div class="price-icon-wrapper  ">
										
									</div>
								</div>

								<div class="o_item <?php if ($this->_vars['orderby']['f'] == 'price'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'price'):  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":price"), $this); else:  echo \ng169\hook\url(array('mod' => 'search','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:price"), $this); endif; ?>')">
									价格
									<div class="price-icon-wrapper  ">
									
									</div>
								</div>

							</section>
							</div>




						</section>










					
					</div>

					<div id="commonList">
					
						<div class="sort-list">
								<?php if ($this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1)): ?>
							<ul>
						
								<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist1']): ?>
								<li>
									<a href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => " productid:" . $this->_vars['volist1']['productid'] . ""), $this);?>">
										<span class="img-box">
											<img src="<?php echo $this->_vars['volist1']['smallimg1']; ?>
" alt="<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
">

										</span>
										<span class="pro-desc">
											<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>

										</span>
										<span class="pro-price">
											<span class="price-info">
												<em class="price-yen">¥</em>
												<em class="price-int">
													<?php echo $this->_vars['volist1']['price']; ?>

												</em>
												<!-- <em class="price-decimal">.00</em> -->
											</span>
										</span>
										<span class="pro-price-sams"><?php echo $this->_vars['volist1']['sells']; ?>
人购买</span>
									</a>
								</li>
								<?php endforeach; endif; ?>
							</ul>
							<?php else: ?>

							<div class="empty-section">
									<i class="empty-icon"></i>
									<div class="empty-title">抱歉，暂无符合条件的商品</div>
									<p >
											<div class="empty-tips">建议您：</div>
											<div class="empty-tips">1、适当减少筛选条件，可以获得更多结果</div>
											<div class="empty-tips">2、尝试其他关键字</div>
										</p>
									<div class="empty-tips">去其他地方看看吧</div>
									<div class="empty-btn-box">
										<div class="empty-btn" type="home" onclick="_go_url('<?php echo $this->_vars['config']['site_url']; ?>
')">查看首页</div>
										<div class="empty-btn" type="all" style="display: none">查看全部商品</div>
									</div>
								</div>
								<?php endif; ?>
							<div style="clear:both"></div>
							<div class="page">   <?php echo $this->_vars['page']; ?>
</div>  
							<div style="clear:both;margin-bottom:1rem"></div>
						</div>

						
					</div>



				

				</div>







			</div>








			<div class="page"><?php echo $this->_vars['page']; ?>
</div>



		</div>












	</div>

	</div>
	  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>