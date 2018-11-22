<?php /* "ngtpl[start]:tpl/muser/order_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:05:36 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/order.css" rel="stylesheet" type="text/css" />

<body class="bgee">

<div>
	<div id="content">




		<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





			<div class="a-msp-index">
				<div id="bodyCont" class="fullscreen index">

					<header class="jd-header header-section-search header-banner">
						<div class="jd-header-new-bar">
							<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-back ">
								<span>
								</span>
							</div>
							<form action="<?php echo \ng169\hook\url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">


								<div class="jd-header-new-title">
									<div class="header-content">
										<span class="header-title">
											订单管理
										</span>

									</div>
								</div>
							</form>
							<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
								<span>
								</span>
							</div>
						</div>
					</header>


				</div>







				<div class="order-manage list">
					<div>
						<div>

							<div class="nav-tab-top">
								<ul>
									<li class="<?php if ($this->_vars['a'] == 'run'): ?>cur<?php endif; ?>">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'run'), $this);?>">
											全部
										</a>
									</li>
									<li class="<?php if ($this->_vars['a'] == 'dfh'): ?>cur<?php endif; ?>">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'dfh'), $this);?>">
											待发货
										</a>
									</li>
									<li class="<?php if ($this->_vars['a'] == 'waitpay'): ?>cur<?php endif; ?>">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitpay'), $this);?>">
											待付款
										</a>
									</li>
									<li class="<?php if ($this->_vars['a'] == 'waitsure'): ?>cur<?php endif; ?>">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitsure'), $this);?>">
											待收货
										</a>
									</li>
									<li class="<?php if ($this->_vars['a'] == 'waitcomment'): ?>cur<?php endif; ?>">
										<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitcomment'), $this);?>">
											待评论
										</a>
									</li>


								</ul>
							</div>
						</div>
						<div class="">
							<div class="">
								<?php if (( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
								<section class="order-cont btomshow">
									<div class="order">
										<ul class="order-list">


											<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
											<li class="">
												<div class="module  storage" id="storage116">
												</div>
												<div class="module  seller" id="seller117">
													<div class="o-t-title-shop">
														<div class="tcont">
															<div class="ico">
																<img src="<?php echo $this->_vars['usertpl']; ?>
/images/store.png">
															</div>
															<div class="contact">
																<a calluptaobao="true">
																	<p
																		class="title" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','group' => 'index','args' => " id:" . $this->_vars['volist']['muid'] . ""), $this);?>')">
																		<?php echo $this->_vars['volist']['merchantname']; ?>

																	</p>
																	<p class="arrow">
																		<span class="icon-right">
																		</span>
																	</p>
																</a>

															</div>
															<div class="state">
																<div class="state-cont">
																	<p class="h">
																		<?php if ($this->_vars['volist']['status'] == 0): ?>
																		待付款

																		<?php elseif ($this->_vars['volist']['status'] == 1): ?>等待卖家发货
																		<?php elseif ($this->_vars['volist']['status'] == 2): ?>
																		待验收



																		<?php elseif ($this->_vars['volist']['status'] == 3): ?>
																		交易完成

																		<?php elseif ($this->_vars['volist']['status'] == 4): ?>交易关闭
																		<?php elseif ($this->_vars['volist']['status'] == 5): ?>退款中的订单
																		<?php endif; ?>

																	</p>

																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="module _1 item">
													<?php if (count((array)$this->_vars['volist']['productlist'])): foreach ((array)$this->_vars['volist']['productlist'] as $this->_vars['k'] => $this->_vars['volist2']): ?>
													<div class="item-list o-t-item">
														<div
															class="item-img" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => " productid:" . $this->_vars['volist2']['productid'] . ""), $this);?>')">
															<p>
																<img class="lazy" src="<?php echo $this->_run_modifier($this->_vars['volist2']['smallimg'], 'imgsize', 'PHP', 1, '80,80'); ?>
">
															</p>
														</div>
														<div
															class="item-info" onclick="_go_url('<?php echo \ng169\hook\url(array('action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>')">
															<h3 class="title">
																<?php echo $this->_run_modifier($this->_vars['volist2']['productname'], 'tostr', 'PHP', 1); ?>

															</h3>
															<p class="sku">
																<?php echo $this->_vars['volist2']['spec']; ?>

															</p>
														</div>
														<div class="item-pay">
															<div class="item-pay-data">
																<p class="price">
																	￥
																	<?php echo $this->_vars['volist2']['price']/100; ?>

																</p>
																<p class="nums">
																	x
																	<?php echo $this->_vars['volist2']['num']; ?>

																</p>
																<p class="h">
																	<?php if ($this->_vars['volist']['status'] == 0): ?>
																	<?php elseif ($this->_vars['volist']['status'] == 1): ?>
																	<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">关闭
																	</a>
																	<?php endif; ?>
																	<?php elseif ($this->_vars['volist']['status'] == 2): ?>
																	<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">退款/退货处理中
																	</a>
																	<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">关闭
																	</a>
																	<?php endif; ?>
																	<?php elseif ($this->_vars['volist']['status'] == 3): ?>

																	<?php if ($this->_vars['volist2']['shflag'] == 0): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">申请售后
																	</a>
																	<?php elseif ($this->_vars['volist2']['shflag'] == 1): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请
																	</a>
																	<?php elseif ($this->_vars['volist2']['shflag'] == 2): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">售后完成
																	</a>
																	<?php elseif ($this->_vars['volist2']['shflag'] == 3): ?>
																	<a
																		style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请
																	</a>
																	<?php elseif ($this->_vars['volist2']['shflag'] == 4): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:" . $this->_vars['volist2']['id'] . ""), $this);?>">售后关闭
																	</a>
																	<?php endif; ?>



																	<?php elseif ($this->_vars['volist']['status'] == 4): ?>
																	<?php if ($this->_vars['volist2']['tkflag']): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'log','group' => 'pay','action' => 'glide','args' => "type:1, desc:" . $this->_vars['volist']['ordernum'] . "退款"), $this);?>">查看退款
																	</a>
																	<?php endif; ?>
																	<?php elseif ($this->_vars['volist']['status'] == 5): ?>
																	<a
																		href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'tkdetail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">退款中的订单
																	</a>
																	<?php endif; ?>


																</p>
															</div>
														</div>
													</div>
													<?php endforeach; endif; ?>

												</div>
												<div class="module  pay" id="pay120">
													<div class="o-total-price">
														<div class="cont">
															<span>
																共
																<b>
																	<?php echo $this->_vars['volist']['productcount']; ?>

																</b>件商品
															</span>
															<span>
																合计:
																<b>
																	￥
																	<?php echo $this->_vars['volist']['paytotal']/100; ?>

																</b>
															</span>
															<span>
																(含运费
																<b>
																	￥
																	<?php echo $this->_vars['volist']['logisfee']/100; ?>

																</b>)
															</span>
														</div>
													</div>
												</div>
												<div class="module  orderop" id="orderop121">
													<div class="o-tab-btn">
														<ul>
															<li
																class="bl" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>')">订单详情
															</li>

															<?php if ($this->_vars['volist']['status'] == 0): ?>
															<li
																class="h" onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'pay','mod' => 'pay','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'product'), $this);?>')">立刻付款
															</li>

															<li
																onclick="boxyn($(this),'确认取消订单？')" a="<?php echo \ng169\hook\url(array('mod' => 'order','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'cancel'), $this);?>">取消订单
															</li>

															<?php elseif ($this->_vars['volist']['status'] == 1): ?>
															<li
																onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'txfh'), $this);?>')">提醒卖家发货
															</li>

															<?php elseif ($this->_vars['volist']['status'] == 2): ?>

															<li
																onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'sure'), $this);?>')">确认收货
															</li>




															<?php elseif ($this->_vars['volist']['status'] == 3): ?>
															<?php if (! $this->_vars['volist']['cflag']): ?>
															<li
																class="h" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'comment','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>')">评价
															</li>
															<?php endif; ?>
															<li
																onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'del','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>')">删除订单
															</li>
															<?php else: ?>
															<li
																onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'del','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>')">删除订单
															</li>
															<?php endif; ?>

														</ul>
													</div>
												</div>
											</li>
											<?php endforeach; endif; ?>
										</ul>
									</div>
									<div class="clearboth">
									</div>
								</section>
								<?php endif; ?>
								<?php if (! ( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
								<section class="order-cont btomhide" data-code="waitPay" style="">
									<div class=" error" id="error1">
										<div class="o-error" id="error1">
											<div>
												<div class="img">
													<p>
														<span class="icon-form">
														</span>
													</p>
												</div>
												<p class="txt">
													您还没有相关的订单
												</p>
												<p class="sub-txt">
													可以去看看有哪些想买
												</p>
												<p class="refresh">
													<a href="<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'index'), $this);?>" class="bt">
														随便逛逛
													</a>
												</p>
											</div>
										</div>
									</div>
								</section>
								<?php endif; ?>




							</div>


						</div>


					</div>
				</div>
				<div style="clear:both">
				</div>
				<div class="page">
					<?php echo $this->_vars['page']; ?>

				</div>



				<div style="clear:both;margin-bottom:4rem">
				</div>

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