<?php /* "tpl/mtpl/shop_show.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 20:58:54 �й���׼ʱ�� */ ?>

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
											<span class="name"><img title="卖家信用：<?php echo $this->_vars['data']['slevel']; ?>
" align="absmiddle" src="<?php  echo vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['data']['muid']}!@"); ?>"></span>
										</div>

									</div>
								</div>
							</section>
							
						</header>




						<section class="nav-bar-wrapper J_tabNavBar">
							<div class="nav J_navBar ui-tab-slider-wrapper">
								<a href="<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item selected-tab J_tabItem" data-index="0" data-out="false" data-page="index">
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














								<a href="<?php echo url(array('mod' => 'shop','action' => 'intro','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" class="item J_tabItem" data-index="3" data-out="false" data-page="dynamic">
									<span class="count tm-shop-m-iconfont"></span>
									<span class="text">店铺信息</span>
								</a>

							</div>
						</section>


						<section class="J_lazyShopListOrder lazy-shop-list-order list_m_mdv" >
							<div class="J_orderWrapper">
								<section id="J_order" class="list_m_mdv order" >
									<div class="o_item J_itemSort J_sortType_s" data-param="sort=s">综合</div>

									<div class="o_item J_itemSort J_sortType_d" data-param="sort=d">销量</div>

									<div class="o_item J_itemSort J_sortType_oldstarts" data-param="sort=oldstarts">上新</div>

									<div class="o_item J_itemSort order-pirce-item J_sortType_price " data-param="sort=pd">
										价格
										<div class="price-icon-wrapper J_priceIcon ">
											<i class="J_price_up_icon list_m_font oi_icon"></i>
											<i class="J_price_down_icon list_m_font oi_icon"></i>
										</div>
									</div>
									<div class="list_m_font o_item o_style">

										<span class="order-style-wrapper J_styleIcon J_itemSort" data-param="style=tile"></span>

									</div>
								</section>
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
<?php if ($this->_vars['data']['mbanner']): ?>
					<div v-type="hotArea"   >
						<img src="<?php echo $this->_vars['data']['mbanner']; ?>
" >
							</div>
							<?php endif; ?>
					<div id="commonList">
						<div class="sort-list">
							<ul>
   <?php $this->assign('hotsell', vo_list("fun=@!get_all!@ num=@!25!@ mod=@!product!@ orderby=@!f:sells,s:down!@ field=@!productname,productid,smallimg1,price!@ array=@!'pflag:1,shelves:1:status:0,muid:'{$this->_vars['data']['muid']}!@}")); ?>
                       
                        <?php if (count((array)$this->_vars['hotsell'])): foreach ((array)$this->_vars['hotsell'] as $this->_vars['volist1']): ?>
								<li>
									<a href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist1']['productid'] . ""), $this);?>">
										<span class="img-box">
											<img src="<?php echo $this->_vars['volist1']['smallimg1']; ?>
" 
											alt="<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
">
											
										</span>
										<span class="pro-desc"><?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
</span>
										<span class="pro-price">
											<span class="price-info">
												<em class="price-yen">¥</em>
												<em class="price-int"><?php echo $this->_vars['volist1']['price']; ?>
</em>
												<!-- <em class="price-decimal">.00</em> -->
											</span>
										</span>
										<span class="pro-price-sams"></span>
									</a>
								</li>
								<?php endforeach; endif; ?>
							</ul>
							<div style="clear:both;margin-bottom:1rem" ></div>
						</div>
					</div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."shopfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>