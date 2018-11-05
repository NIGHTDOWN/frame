<?php /* "tpl/mtpl/product_list.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 00:26:08 �й���׼ʱ�� */ ?>

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
								<div onclick="_go_url('<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>')"
								 class="jd-header-icon-back ">
									<span></span>
								</div>
								<div class="jd-header-new-title">
									<div class="header-content"  onclick="_go_url('<?php echo url(array('mod' => 'shop','action' => 'search','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>')">
										<div  class="header-search">
											<i class="search-icon"></i>
											<input type="text" name="keyword" autocomplete="off" id="keywordShow" disabled='true' class="search-input" value="" placeholder="搜索店铺内商品"
											 maxlength="20">
										</div>
									
										<a href="<?php echo url(array('mod' => 'shop','action' => 'search','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="header-menu" ></a>
									</div>
								</div>
								<div  onclick="_go_url('<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>')"
								 class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>








						<section class="J_lazyShopListOrder list_m_mdv">
							<div class="J_orderWrapper">
								<section id="J_order" class="list_m_mdv order">

										<div class="o_item <?php if ($this->_vars['orderby']['f'] == 'collects'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'collects'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":collects"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:collects"), $this); endif; ?>')">推荐
											<div class="price-icon-wrapper  ">
												
											</div></div>

									<div class="o_item  <?php if ($this->_vars['orderby']['f'] == 'sells'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'sells'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":sells"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:sells"), $this); endif; ?>')">销量
										<div class="price-icon-wrapper  ">
											
										</div></div>

									

									<div class="o_item  <?php if ($this->_vars['orderby']['f'] == 'addtime'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'addtime'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":addtime"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:addtime"), $this); endif; ?>')">上新
										
										<div class="price-icon-wrapper  ">
											
										</div>
									</div>

									<div class="o_item <?php if ($this->_vars['orderby']['f'] == 'price'): ?>o_cur <?php echo $this->_vars['orderby']['s'];  endif; ?>" onclick="_go_url('<?php if ($this->_vars['orderby']['f'] == 'price'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":price"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:price"), $this); endif; ?>')">
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
							<ul>
						
								<?php if (count((array)$this->_vars['plist'])): foreach ((array)$this->_vars['plist'] as $this->_vars['volist1']): ?>
								<li>
									<a href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => " productid:" . $this->_vars['volist1']['productid'] . ""), $this);?>">
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
													<?php echo $this->_vars['volist1']['price']/100; ?>

												</em>
												<!-- <em class="price-decimal">.00</em> -->
											</span>
										</span>
										<span class="pro-price-sams"></span>
									</a>
								</li>
								<?php endforeach; endif; ?>
							</ul>
							<div style="clear:both"></div>
							<div class="page">   <?php echo $this->_vars['page']; ?>
</div>  
							<div style="clear:both;margin-bottom:1rem"></div>
						</div>
					</div>



				

				</div>







			</div>












		</div>












	</div>

	</div>