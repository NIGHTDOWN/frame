<?php /* "ngtpl[start]:tpl/mtpl/cart_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 14:45:02 */ ?>

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
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'user'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>
								<form action="<?php echo \ng169\hook\url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">购物车</span>

										</div>
									</div>
								</form>
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>



















					</div>

					<div id="commonList">

						<div id="listContent">
							<div id="huangtiao" primary="0" style="display:none;"></div>
							<!-- 购物车商品列表容器 #list -->
							<div id="cmdtylist" attr-tag="cmdtylist">
								<?php $this->assign('muid', null); ?>
								<?php if ($this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) == 0): ?>
								<div class="shopcart_empty_wrap">
									<img src="<?php echo $this->_vars['indextpl']; ?>
/images/5a93c51cN3bb5e37b.png" class="empty_icon">
									<p class="empty_txt">购物车空空如也，去逛逛吧~</p>
									<p class="empty_txt"><a href="<?php echo $this->_vars['config']['site_url']; ?>
">去首页</a></p>
								</div>
								<?php endif; ?>

								<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['i'] => $this->_vars['volist']): ?>
								<?php if ($this->_vars['muid'] != ( $this->_vars['volist']['muid'] )): ?>
								<?php  $this->_vars['muid']=$this->_vars['volist']['muid']; ?>

								<?php if ($this->_vars['i'] != 0): ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="section">
							<div class="head_wrap ">
								<div class="head  gs" data-type='shop' imuid="<?php echo $this->_vars['volist']['muid']; ?>
">
									<i class="icon_select" attr-chktye="2" attr-tag="iconChkEve"></i>
									<i class="icon_shop"></i>
									<div class="title oneline" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'shop','group' => 'index','action' => 'show','args' => " id:" . $this->_vars['volist']['muid'] . ""), $this);?>')" >
										<?php echo $this->_vars['volist']['merchantname']; ?>

										
										<i class="icon_arrow_right"></i>
									</div>

								</div>

								<div class="item">
									<div class="goods  gs  <?php if ($this->_vars['volist']['old']): ?>ds<?php endif; ?>" data-type='good' ipid="<?php echo $this->_vars['volist']['cid']; ?>
" imuid="<?php echo $this->_vars['volist']['muid']; ?>
">
										<i class="icon_select"></i>
										<img class="image" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
" onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>')">


										<div class="content">
											<div class="name" onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'product','action' => 'detail','args' => " productid:" . $this->_vars['volist']['productid'] . ""), $this);?>')">
												<i class="mod_tag ">
													<?php if ($this->_vars['volist']['yhtype']): ?>
													团购
													<?php endif; ?>
												</i>
												<span class="proNameJs">
													<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>

												</span>
											</div>
											<?php if ($this->_vars['volist']['specs']): ?>
											<p class="sku">
												<?php echo $this->_vars['volist']['specs']; ?>

											</p>
											<?php endif; ?>
											<div class="goods_line">
												<p class="price   " attr-tag="">
													<span class="priceJs" goodprice="<?php echo $this->_vars['volist']['nowprice']/100; ?>
">¥
														<em class="int">
															<?php echo $this->_vars['volist']['nowprice']/100; ?>

														</em>
													</span>
												</p>
												<div class="num_and_more">
													<div class="num_wrap">
														<span class="minus "></span>
														<div class="input_wrap">
															<input class="num" type="tel" data-id="<?php echo $this->_vars['volist']['cid']; ?>
" data-max="<?php echo $this->_vars['volist']['count']; ?>
" name="nums" id="nums" value="<?php echo $this->_vars['volist']['nums']; ?>
">
														</div>
														<span class="plus "></span>
													</div>
												</div>
											</div>
											<div class="goods_sub_line">

												<div class="m_action" attr-tag="action">

													<span class="m_action_item" attr-tag="delItemEve" issuit="">
														<a onclick="boxyn($(this))" a="<?php echo \ng169\hook\url(array('mod' => 'cart','action' => 'del','args' => " product_id:" . $this->_vars['volist']['cid'] . ""), $this);?>">删除</a>
													</span>
												</div>
											</div>

										</div>

									</div>
								</div>
								<?php else: ?>
								<div class="item">
									<div class="goods  gs <?php if ($this->_vars['volist']['old']): ?>ds<?php endif; ?>" data-type='good' ipid="<?php echo $this->_vars['volist']['cid']; ?>
" imuid="<?php echo $this->_vars['volist']['muid']; ?>
">
										<i class="icon_select"></i>
										<img class="image" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
" onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'product','action' => 'detail','args' => "
										 productid:" . $this->_vars['volist']['productid'] . ""), $this);?>')">


										<div class="content">
											<div class="name" onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'product','action' => 'detail','args' => " productid:" . $this->_vars['volist']['productid'] . ""), $this);?>')">
												<i class="mod_tag ">
													<?php if ($this->_vars['volist']['yhtype']): ?>
													团购
													<?php endif; ?>
												</i>
												<span class="proNameJs">
													<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>

												</span>
											</div>
											<?php if ($this->_vars['volist']['specs']): ?>
											<p class="sku">
												<?php echo $this->_vars['volist']['specs']; ?>

											</p>
											<?php endif; ?>
											<div class="goods_line">
												<p class="price   " attr-tag="">
													<span class="priceJs" goodprice="<?php echo $this->_vars['volist']['nowprice']/100; ?>
">¥
														<em class="int">
															<?php echo $this->_vars['volist']['nowprice']/100; ?>

														</em>
													</span>
												</p>
												<div class="num_and_more">
													<div class="num_wrap">
														<span class="minus "></span>
														<div class="input_wrap">
															<input class="num" type="tel" data-id="<?php echo $this->_vars['volist']['cid']; ?>
" data-max="<?php echo $this->_vars['volist']['count']; ?>
" name="nums" id="nums" value="<?php echo $this->_vars['volist']['nums']; ?>
">
														</div>
														<span class="plus "></span>
													</div>
												</div>
											</div>
											<div class="goods_sub_line">

												<div class="m_action" attr-tag="action">

													<span class="m_action_item" attr-tag="delItemEve" issuit="">
														<a onclick="boxyn($(this))" a="<?php echo \ng169\hook\url(array('mod' => 'cart','action' => 'del','args' => " product_id:" . $this->_vars['volist']['cid'] . ""), $this);?>">删除</a>
													</span>
												</div>
											</div>

										</div>

									</div>
								</div>
								<?php if ($this->_vars['i'] == 0): ?>
							</div>
							<?php endif; ?>
							<?php endif; ?>


							<?php endforeach; endif; ?>


						</div>

					</div>
					<div style="clear: both;margin-bottom:1rem"></div>
					<div class="fixBar gs" data-type='all' name="checkgroup" id="fixBarBot">
						<i class="icon_select">全选</i>
						<div class="total" id="totalConfirmDiv">
							<p>总计：
								<strong id="totalPrice">¥0.00</strong>
								<!-- <small>
											<span id="totalBackMoney">总额¥0.00 立减¥0.00</span>
										</small> -->
							</p>
							<a href="javascript:;" class="buy buyJs disabled" id="confirmEve">去结算
								<em id="totalNum">(0件)</em>
							</a>
						</div>
						<div class="btns" style="display:none" id="operateDiv">
							<a href="javascript:;" class="btn_3">删除</a>
							<a href="javascript:;" class="btn_2">移至收藏</a>
						</div>
					</div>
				</div>


			</div>





		</div>







	</div>










	</div>












	</div>

	</div>
	<form id="buy">

	</form>
	<script type="text/javascript">
		$url = "<?php echo \ng169\hook\url(array('mod' => 'buy','action' => 'cartsure'), $this);?>";
		$("#confirmEve").bind("click", function () {
			if (!$(this).hasClass("disabled")) {

				$html = '';
				$(".gs[data-type='good'].selected").each(function () {
					$html += "<input type='hidden' name='product_id[]' value='" + $(this).attr('ipid') + "'>";
				});
				$f = $('#buy');
				$f.attr('action', $url);
				$f.attr('method', 'post');
				$f.append($html);
				$f.submit();

			}
		});
		$(".gs .icon_select").click(function () {
			$ob = $(this).parent('.gs');
			var flag = $ob.hasClass("selected");

			var data_type = $ob.attr("data-type");

			if (flag) {

				if (data_type == 'all') {

					ckeckbox(".gs", true);
				}
				else if (data_type == 'shop') {
					var data_value = $ob.attr("imuid");
					ckeckbox(".gs[imuid='" + data_value + "']", true);
				}
				else if (data_type == 'good') {
					var data_value = $ob.attr("ipid");
					ckeckbox(".gs[ipid='" + data_value + "']", true);
				}


			}
			else {

				if (data_type == 'all') {
					ckeckbox(".gs", false);
				}
				else if (data_type == 'shop') {
					var data_value = $ob.attr("imuid");

					ckeckbox(".gs[imuid='" + data_value + "']", false);
				}
				else if (data_type == 'good') {
					var data_value = $ob.attr("ipid");

					ckeckbox(".gs[ipid='" + data_value + "']", false);
				}

			}

			count();
		});
		function ckeckbox(obj, flag) {
			$num = 50;
			$obj = $(obj);
			if ($obj.length >= $num) {
				showd('购物车最多选择' + $num + '件产品;请分次结算');
				return false;
			}

			if (!flag) {
				$obj.addClass('selected');
			} else {
				$obj.removeClass('selected');
				$('.gs[data-type="all"]').removeClass('selected');
			}


			$(".gs[data-type='shop']").each(function () {
				$id = $(this).attr('imuid');
				$selecteds = $(".goods[imuid=" + $id + "]").length;

				$selecteds2 = $(".selected.goods[imuid=" + $id + "]").length;
				if ($selecteds > $selecteds2) {
					$(this).removeClass('selected');
				} else {
					$(this).addClass('selected');
				}

			});
			return true;
		}
		function count() {
			var count = 0;
			var num = $(".gs[data-type='good'].selected").length;
			if (num > 0) {
				$('#confirmEve').removeClass('disabled');
			} else {
				$('#confirmEve').addClass('disabled');
			}
			$(".gs[data-type='good'].selected").each(function () {
				var price = $(this).find('.int').text();
				var thisnum = $(this).find('[name="nums"]').val();
				/*var price = $(this).parent().parent().parent().find("#cell"+value+" span").html();*/

				// var price = $(this).parent().parent().parent().find("#cell"+value+" span").attr('cash');

				price = price.replace(/,/g, "")
				price = Number(price);
				count = count + price * thisnum;

				// num ++;
				// $(this).parent().parent().parent().addClass("checked");
			});
			$("#totalPrice").html(count.toFixed(2));
			$("#totalNum").html("(" + num + "件)");
			if (num > 0)
				$(".submit-btn").removeClass("submit-btn-disabled");
			else
				$(".submit-btn").addClass("submit-btn-disabled");
		}
		var c = $(".num_and_more");
		var e = null;
		c.each(function () {
			var g = $(this).find(".num_wrap span");
			var h = $(this).find("input#nums");
			var o = this;
			var f = h.attr("data-max");
			var i = 1;
			var id = h.attr("data-id");
			h.bind("input propertychange", function () {

				var j = this;
				var k = $(j).val();
				e && clearTimeout(e);
				e = setTimeout(function () {
					var l = Math.max(Math.min(f, k.replace(/\D/gi, "").replace(/(^0*)/, "") || 1), i);
					$(j).val(l);
					edit_num(id, l, o);

					if (l <= i) {
						g.eq(0).addClass("disabled");
					} else {
						g.eq(0).removeClass("disabled");
					}
					if (l >= f) {
						g.eq(1).addClass("disabled");
					} else {
						g.eq(1).removeClass("disabled");
					}

				}, 50)
			}).trigger("input propertychange").blur(function () { $(this).trigger("input propertychange") }).keydown(function (l) {
				if (l.keyCode == 38 || l.keyCode == 40) {
					var j = 0;
					l.keyCode == 40 && (j = 1); g.eq(j).trigger("click")
				}
			});
			g.bind("click", function (l) {
				event.stopPropagation();
				if ($(this).hasClass("minus")) {

					if ($(this).hasClass("disabled")) {
						return false;
					}
					var j = parseInt(h.val(), 10) || 1;
					j--;
					edit_num(id, j, o);

				}
				if ($(this).hasClass("plus")) {
					if ($(this).hasClass("disabled")) {
						return false;
					}
					var j = parseInt(h.val(), 10) || 1;
					j++;
					edit_num(id, j, o);


				}
				h.val(j);
				count();
				if (j <= i) {
					g.eq(0).addClass("disabled");
				} else {
					g.eq(0).removeClass("disabled");
				}
				if (j >= f) {
					g.eq(1).addClass("disabled");
				} else {
					g.eq(1).removeClass("disabled");
				}

			})
		})
		function edit_num(id, num, obj) {
			var url = "<?php echo \ng169\hook\url(array('action' => 'addnum','mod' => 'cart','group' => 'index'), $this);?>";
			var pars = { 'cid': id, 'nums': num };

			yAjax(url, pars, showResponse);
			function showResponse(originalRequest) {

				if (originalRequest.flag) {
					$('#cell' + id + ' span').attr('cash', (Number(originalRequest.data).toFixed(2)));
					$('#cell' + id + ' span').html((rmb(originalRequest.data)));
				}
				else {
					showd(originalRequest.error.errormsg);
				}


			}

		}
	</script>