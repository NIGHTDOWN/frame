<?php /* "tpl/mtpl/buy_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 00:43:21 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['indextpl']; ?>
css/shop.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_vars['indextpl']; ?>
css/cart.css" rel="stylesheet" type="text/css" />

<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="_go_url('<?php echo url(array('mod' => 'cart'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>



								<div class="jd-header-new-title">
									<div class="header-content">
										<span class="header-title">确认订单</span>

									</div>
								</div>

								<div onclick="_go_url('<?php echo url(array('mod' => 'index','group' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>



















					</div>

					<div id="commonList">
							<form action="<?php echo url(array('action' => 'sure'), $this);?>" method="post">
									<section class="core-entry">
											<ul id="addressList">

  <?php if ($this->_run_modifier($this->_vars['address'], 'sizeof', 'PHP', 1)): ?>
		<?php if (count((array)$this->_vars['address'])): foreach ((array)$this->_vars['address'] as $this->_vars['i'] => $this->_vars['volist']): ?>
		
		<?php if ($this->_vars['i'] == 0): ?>
		<input name="addid" value="<?php echo $this->_vars['volist']['addid']; ?>
" type="hidden"/>
		<li class="address-row active" id='showaddressbox'>
			<div class="left-icons">
					<i class="iconfont icon-address"></i>
					
				</div>
			<div class="center">
					
					<div class="font-32">
						<label>收货人:</label>
						<label name="user-name"><?php echo $this->_vars['volist']['realname']; ?>
</label>
						<label name="phone-num" style="float: right"><?php echo $this->_vars['volist']['recvmobile']; ?>
 <?php echo $this->_vars['volist']['recvphone']; ?>
</label>
					</div>
					<div class="font-24">
						<label>收货地址:</label>
						<label name="address"><?php echo $this->_vars['volist']['province']; ?>
 <?php echo $this->_vars['volist']['city']; ?>
 <?php echo $this->_vars['volist']['area']; ?>
 <?php echo $this->_vars['volist']['address']; ?>
</label>
					</div>
					<span class="right-icons">
						<i class="iconfont icon-check"></i>
						
					</span>
				</div>
<div class="moveico">
	<ico class="moreicoc"></ico>
</div>



			
		</li>
		<?php endif; ?>
		<li class="address-row addressbox none" addid='<?php echo $this->_vars['volist']['addid']; ?>
'>
			<div class="left-icons">
					<i class="iconfont icon-address"></i>
					
				</div>
			<div class="center">
					
					<div class="font-32">
						<label>收货人:</label>
						<label name="user-name"><?php echo $this->_vars['volist']['realname']; ?>
</label>
						<label name="phone-num" style="float: right"><?php echo $this->_vars['volist']['recvmobile']; ?>
 <?php echo $this->_vars['volist']['recvphone']; ?>
</label>
					</div>
					<div class="font-24">
						<label>收货地址:</label>
						<label name="address"><?php echo $this->_vars['volist']['province']; ?>
 <?php echo $this->_vars['volist']['city']; ?>
 <?php echo $this->_vars['volist']['area']; ?>
 <?php echo $this->_vars['volist']['address']; ?>
</label>
					</div>
					<span class="right-icons">
						
						
						
					</span>
				</div>
<div class="moveico">
	
	<ico class="icon-select <?php if (! $this->_vars['volist']['mflag']): ?>none <?php endif; ?>"></ico>
	
</div>



			
		</li>
		<?php endforeach; endif;  else: ?>
<li class="address-row selected" onclick="_go_url('<?php echo url(array('mod' => 'set','action' => 'addaddress','group' => 'user'), $this);?>')">
			<div class="center">
			
					<div class="addaddress">
		
			请添加收货地址 
			 <em></em>
			</div></div>
		</li>
<?php endif; ?>


																			
											
											</ul>
					
										</section>

										<input type="hidden" name="pid" value="<?php echo $this->_vars['get']['pid']; ?>
">
										<input type="hidden" name="gpid" value="<?php echo $this->_vars['groupon']['gpid']; ?>
">
									
									   <input type="hidden" name="logis" value="<?php echo $this->_vars['logistype']; ?>
">
									   <input type="hidden" name="num" value="<?php echo $this->_vars['get']['num']; ?>
">
										<input type="hidden" name="spec" value="<?php echo $this->_vars['get']['spec']; ?>
">

									<input name="id" value="<?php echo $this->_vars['randid']; ?>
" type="hidden"/>
						<div id="listContent">
							<div id="huangtiao" primary="0" style="display:none;"></div>
							<!-- 购物车商品列表容器 #list -->
							<div id="cmdtylist" attr-tag="cmdtylist">

 
						
                            


								<div class="section">
									<div class="head_wrap ">
										<div class="head  gs p10" data-type='shop' imuid="<?php echo $this->_vars['volist']['muid']; ?>
">

											<i class="icon_shop"></i>
											<div class="title oneline">
												<?php echo $this->_vars['data']['merchantname']; ?>

												<i class="icon_arrow_right"></i>
											</div>

										</div>
									</div>
								
								
								
									<div class="item">
										<div class="goods  gs " data-type='good' style="padding-left: 108px" imuid="<?php echo $this->_vars['data']['muid']; ?>
">

											<img class="image" style="left: 15px;" src="<?php echo $this->_vars['data']['smallimg1']; ?>
">


											<div class="content">
												<div class="name">
													<i class="mod_tag ">
														<?php if ($this->_vars['data']['yhtype']): ?>
														团购
														<?php endif; ?>
													</i>
													<span class="proNameJs">
														<?php echo $this->_run_modifier($this->_vars['data']['productname'], 'tostr', 'PHP', 1); ?>

													</span>
												</div>
												<?php if ($this->_vars['get']['specs']): ?>
												<p class="sku">
													<?php echo $this->_vars['get']['specs']; ?>

												</p>
												<?php endif; ?>
												<div class="goods_line">
													<p class="price   " attr-tag="">
														<span class="priceJs" goodprice="<?php echo $this->_vars['volist2']['nowprice']; ?>
">¥
															<em class="int">
																<?php if ($this->_vars['groupon']): ?> <span style='    text-decoration: line-through;'><?php echo $this->_vars['data']['price']/100; ?>
</span><br><?php echo $this->_vars['groupon']['gprice']/100;  else:  echo $this->_vars['data']['price']/100;  endif; ?>
															</em>
														</span>
													</p>
													<div class="num_and_more">
														<div class="nums">


															X
															<?php echo $this->_vars['get']['num']; ?>



														</div>
													</div>
												</div>
												

											</div>

										</div>
									
									</div>
								
									<div class="order-row">
										<label class="buy-single-row" >
											<div class="title cell " >配送方式</div>
											<div class="content cell" >
												<div class="select-face">
													 <?php if ($this->_vars['logisfee']): ?>
													
               
															普通配送&nbsp;
																							<select id="wuliu" onchange="count_price($(this));">
																<?php if (count((array)$this->_vars['logisfee'])): foreach ((array)$this->_vars['logisfee'] as $this->_vars['k'] => $this->_vars['v']): ?>
																<script>
																	logisfee['<?php echo $this->_vars['k']; ?>
']='<?php echo $this->_vars['v']; ?>
';
																</script>
																							<option value="<?php echo $this->_vars['k']; ?>
">
																<?php if ($this->_vars['k'] == 'py'): ?>平邮<?php elseif ($this->_vars['k'] == 'ems'): ?>EMS<?php elseif ($this->_vars['k'] == 'kd'): ?>快递<?php endif; ?>&nbsp;&nbsp;<?php echo $this->_vars['v']; ?>
元
															</option>
																<?php if (! $this->_vars['logis']): ?>
																<?php  $this->_vars['logis']=$this->_vars['v']; ?>
																 <?php  $this->_vars['logistype']=$this->_vars['k']; ?>
																<?php endif; ?>                
															  <?php endforeach; endif; ?>                  
																			</select>
																			
															<td class="price">  
																				<b id="show_cem">
															   <?php echo $this->_vars['logis']/100; ?>

																</b>
																			
											<?php else: ?>
											
														   
															卖家包邮&nbsp;
																						   
																			
																				<b id="show_cem">
																0.00
																 <?php  $this->_vars['logis']=0; ?>
																</b>
																		
											<?php endif; ?>
													
													</div>
											
											</div>
											<div class="pointer cell ">
												<div class="nav" ></div>
											</div>
										</label>
										<label class="buy-single-row" >
											<div class="title cell " >给卖家留言</div>
											<div class="content cell" >
												<div class="select-face">
													<input placeholder="选填，可告诉卖家您的特殊要求" name="mark">
												</div>
											
											</div>
											<div class="pointer cell ">
												<div class="nav" ></div>
											</div>
										</label>
									
									</div>
								</div>
               

							


							</div>

						</div>
						<div style="clear: both;margin-bottom:1rem"></div>
						<div class="fixBar gs " data-type='all' name="checkgroup" id="fixBarBot">

							<div class="total" id="totalConfirmDiv">
								
								<p>
										<em id="totalNum">共<?php echo $this->_vars['get']['num']; ?>
件 </em>
									总计：
									<strong id="totalPrice">¥  <?php  echo ($this->_vars['sumtatal']+$this->_vars['logis'])/100; ?></strong>
									
								</p>
								<a href="javascript:;" class="buy buyJs " tag='submit' id="confirmEve">提交订单
									
								</a>
							</div>
							
						</div></form>
					</div>


				</div>





			</div>







		</div>










	</div>












	</div>

	</div>
	<script>
	$(function(){
$('#showaddressbox').click(function(){
$('.addressbox').toggle();
});
$('.addressbox').click(function(){
$('[name=addid]').val($(this).attr('addid'));
$('.addressbox .icon-select').addClass('none');
$(this).find('.icon-select').removeClass('none');
$text=$(this).find('.center').html();
$('#showaddressbox').find('.center').html($text);
$('.addressbox').toggle();
});

	});
	</script>