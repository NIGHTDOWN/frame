<?php /* "tpl/mtpl/product_detail.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 22:27:29 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script>
	function check_nums() {
		SP_V = '';

		$('.pro-color').find('.selected').each(function (i) {

			SP_V += '<strong>"' + $(this).text() + '"</strong>，';

		});
		SP_V = SP_V.substr(0, SP_V.length - 1);
		SP_V = SP_V + '  ' + $('[name=nums]').val() + '件';
		$('#specDetailInfo_spec').html('<em>您选择了：</em>' + SP_V + '');
		$('#specDetailInfo').html('<em>您选择了：</em>' + SP_V + '');
		$('[name=spec]').val(goodsspec.getSpecstring());
		$('[name=num]').val($('[name=nums]').val());


	}
	function spec(id, spec, price, stock) {
		this.id = id;
		this.spec = spec;
		this.price = price;
		this.stock = stock;
	}
	function goodsspec(specs, specQty, defSpec) {
		this.specs = specs;
		this.value = new Array();
		this.name = new Array();
		this.specQty = specQty;
		this.defSpec = defSpec;
		/*this.spec1 = null;
		this.spec2 = null;*/
		if (this.specQty >= 1) {
			for (var i = 0; i < this.specs.length; i++) {
				if (this.specs[i].id == this.defSpec) {
					break;
				}
			}
		}
		this.getSpec = function () {
			for (var i = 0; i < this.specs.length; i++) {
				return this.specs[i];
			}
			return null;
		}
		this.getSpecstring = function () {
			var string = '';
			for (var key in goodsspec.name) { string += goodsspec.name[key] + ':' + goodsspec.value[key] + ','; }
			string = trim(string, ',');
			return string;
		}
	}
	function selectSpec(num, obj, name, SID) {
		goodsspec['name'][num] = name;
		goodsspec['value'][num] = SID;


		$(obj).addClass("selected");
		$(obj).siblings().removeClass("selected");

		var spec = goodsspec.getSpec();

		var sign = 't';
		$('.pro-color').each(function () {

			if (!$(this).find('a').hasClass('selected')) {
				sign = 'f';
			}
		});
		if (spec != null && sign == 't') {


			if (parseInt(spec.stock) == 0) {
				$('.choose_result').show().html('<div class="dd"><em>库存量不足，请选择其它。</em></div>');
				$('#addcart_submit').attr('disabled', true).css('cursor', 'pointer');
			}
			else {
				SP_V = '';

				check_nums();
				$('#addcart_submit').attr('disabled', false).css('cursor', 'auto');
				$('#nums').val("1");
			}
		}

	}
	$("#low_num").live('click', function () {

		var num = $('#nums').val() * 1;
		if ((num - 1) >= 1) { $('#nums').val(num - 1); }

		check_nums();

	});
	$("#add_num").live('click', function () {
		var num = $('#nums').val() * 1;
		if (num <= $('#nums').attr('size')) {
			$('[name=nums]').val(num + 1);
		}

		check_nums();
	});
	$(".add_cart").live('click', function () {

		if ('<?php echo $this->_vars['user']['uid']; ?>
' == '') {
			alert('请登入用户');
			window.location.href = '<?php echo url(array('mod' => 'login'), $this);?>';
			return;
		}

		if ('<?php echo $this->_vars['user']['uid']; ?>
' == '<?php echo $this->_vars['data']['uid']; ?>
') {
			alert('不能购买自己店铺的商品！');
			return;
		}



		if (1) {

			var num = $('#nums').val();
			var pid = $('[name=pid]').val();
			var gpid = $('[name=gpid]').val();
			var spec = goodsspec.getSpecstring();


			$arr = { 'pid': pid, 'num': num, 'spec': spec };
			yAjax('<?php echo url(array('group' => 'user','mod' => 'cart','action' => 'add'), $this);?>', $arr, function (data) {

				if (data.flag) {
					showd('添加购物车成功');
					$('.hs').hide();
					return true;
				} else {
					showd(data.error.errormsg); return false;
				}

			});

			return false;
		}
	});
	$('.cart').live('click', function () {
		$('#directorder_spec').hide();
		$('#add_cart_spec').show();

		$('.hs').fadeIn();

	});
	$('.buy').live('click', function () {
		$('#add_cart_spec').hide();
		$('#directorder_spec').show();
		$('.hs').fadeIn();

	});
	$('#xskf').live('click', function () {
		$('.kf').toggle();

	});
	$('#choose-spec').live('click', function () {
		/*$('#add_cart_spec').hide();
		$('#directorder_spec').show();*/
		$('.hs').fadeIn();

	});

	function getfavp($id) {
		var url = '<?php echo url(array('mod' => 'product','action' => 'collect'), $this);?>';

		var uname = '<?php echo $this->_vars['user']['username']; ?>
';
		if (uname == '') {
			alert('请登录以后再进行本操作！');
			window.location.href = '<?php echo url(array('mod' => 'login'), $this);?>';
			return false;
		}

		/*$.post(url, pars,showResponse);*/
		yAjax(url, { 'productid': $id }, showResponse);
		function showResponse(data) {
			if (data.flag) {
				showd(data.data);
			} else {
				showd(data.error.errormsg);
			}
		}

	}

</script>

<body class="bgee">

	<div class="main" style='margin-bottom: 8rem;'>
		<div class="main">

			<header id="head" class="head" style="z-index:198;position: static;">
				<div class="fixtop2" id="logoindex">
					<span id="index-logo">
						<a href="javascript:void(0);" onclick="window.history.go(-1)">
							<i class="logo">
								<img src="<?php echo $this->_vars['indextpl']; ?>
/images/back.png">
							</i>
						</a>
						
					</span>
					<p class="xqtitle">商品详情</p>
					<span class="sign_icon1">
						<a href="<?php echo url(array('mod' => 'cart'), $this);?>">
							<i class="logo">
								<img src="<?php echo $this->_vars['indextpl']; ?>
/images/ico/cartb.png">
							</i>
						</a>
					</span>
				</div>
			</header>
			<div class="app">
				<div class="top-menu"></div>

				<!--商品主要信息-->
				<div id="ct">
					<div class="swiper-container" style="height:340px;">
						<div class="swiper-wrapper">
							<?php if ($this->_vars['data']['smallimg1']): ?>
							<div class="swiper-slide orange-slide swiper-slide-duplicate" style="width: 320px; height: 340px;">
								<div class="title">
									<a href="<?php echo $this->_vars['data']['smallimg1']; ?>
">
										<img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg1'], 'imgsize', 'PHP', 1, '320,320'); ?>
" style="width:100%">
									</a>
								</div>
							</div>
							<?php endif; ?>
							<?php if ($this->_vars['data']['smallimg2']): ?>
							<div class="swiper-slide orange-slide swiper-slide-duplicate" style="width: 320px; height: 340px;">
								<div class="title">
									<a href="<?php echo $this->_vars['data']['smallimg2']; ?>
">
										<img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg2'], 'imgsize', 'PHP', 1, '320,320'); ?>
" style="width:100%">
									</a>
								</div>
							</div>
							<?php endif; ?>
							<?php if ($this->_vars['data']['smallimg3']): ?>
							<div class="swiper-slide orange-slide swiper-slide-duplicate" style="width: 320px; height: 340px;">
								<div class="title">
									<a href="<?php echo $this->_vars['data']['smallimg3']; ?>
">
										<img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg3'], 'imgsize', 'PHP', 1, '320,320'); ?>
" style="width:100%">
									</a>
								</div>
							</div>
							<?php endif; ?>
							<?php if ($this->_vars['data']['smallimg4']): ?>
							<div class="swiper-slide orange-slide swiper-slide-duplicate" style="width: 320px; height: 340px;">
								<div class="title">
									<a href="<?php echo $this->_vars['data']['smallimg4']; ?>
">
										<img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg4'], 'imgsize', 'PHP', 1, '320,320'); ?>
" style="width:100%">
									</a>
								</div>
							</div>
							<?php endif; ?>
							<?php if ($this->_vars['data']['smallimg5']): ?>
							<div class="swiper-slide orange-slide swiper-slide-duplicate" style="width: 320px; height: 340px;">
								<div class="title">
									<a href="<?php echo $this->_vars['data']['smallimg5']; ?>
">
										<img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg5'], 'imgsize', 'PHP', 1, '320,320'); ?>
" style="width:100%">
									</a>
								</div>
							</div>
							<?php endif; ?>




						</div>
						<div class="pagination"></div>
					</div>
				</div>
				<h4 class="in_from">
					<?php echo $this->_run_modifier($this->_vars['data']['productname'], 'tostr', 'PHP', 1); ?>

				</h4>
				<?php if ($this->_vars['data']['gcheck'] == 1): ?>
				<div style="overflow:hidden;margin-bottom: 5px;">
					<div class="o-price">市场价￥
						<del>
							<?php echo $this->_vars['data']['price']/100; ?>

						</del>
					</div>
					<div class="buy fl">
						<span class="price-new">
							<span class="qh"></span>
							<i>￥</i>
							<?php echo $this->_vars['data']['gprice']/100; ?>

						</span>
					</div>
					<div class="fr">
						已有
						<b style="color:#fc9c9d">
							<?php echo $this->_vars['data']['sells']; ?>

						</b>人购买
					</div>
				</div>
				<?php else: ?>
				<div style="overflow:hidden;margin-bottom: 5px;">

					<div class="buy fl">
						<span class="price-new">
							<span class="qh"></span>
							<i>￥</i>
							<?php echo $this->_vars['data']['price']/100; ?>

						</span>
					</div>
					<div class="fr">
						已有
						<b style="color:#fc9c9d">
							<?php echo $this->_vars['data']['sells']; ?>

						</b>人购买
					</div>
				</div>
				<?php endif; ?>




			</div>


		</div>

		<div class="bq-content" id='choose-spec'>

			<div id="specDetailInfo" class="base-txt">
				<span class="part-note-msg">选择</span>
				&nbsp;&nbsp;
			</div>

			<em class="icon-popups"></em>
		</div>

		<div class="pq-content">
			<ul class="tab-lst">
				<li class='on'>商品介绍</li>
				<li>商品规格</li>
				<li>商品评价</li>

			</ul>
		</div>


		<!--详情图片-->
		<div class="t-content-1 t-content">
			<?php echo $this->_vars['data']['content']; ?>


		</div>
		<div class="t-content-2 t-content none">
			<table class="table-border" width="100%">
				<tbody>
					<tr>
						<td colspan="2">
							<strong>主体</strong>
						</td>
					</tr>
					<?php if (count((array)$this->_vars['attribute'])): foreach ((array)$this->_vars['attribute'] as $this->_vars['volist']): ?>
					<tr>
						<td>
							<?php echo $this->_vars['volist']['aname']; ?>

						</td>
						<td>
							<?php echo $this->_vars['volist']['avalue']; ?>

						</td>
					</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>

		</div>
		<div class="t-content-3 t-content none">
			
<iframe style="
width: 100%;
border: none;
min-height: 15rem;
" src="<?php echo url(array('mod' => 'comment','action' => 'list','args' => "productid:" . $this->_vars['data']['productid'] . ""), $this);?>"></iframe>


		</div>

		<!--end-->
		<!--猜你喜欢商品-->

		<div id="goods">
			<div class="list_summary">
				<span>热销产品</span>
			</div>
			<div id="goods">
				<section class="goods" id="goods">
					<ul class="goods-list clear" id="goods_block">

						<?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
						<li>
							<a href="<?php echo url(array('args' => " productid:" . $this->_vars['volist']['productid'] . "",'action' => 'detail','mod' => 'product'), $this);?>" target="_blank">
								<div class="goods-pic">
									<img class="lazy" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
">
								</div>
								<div class="goods-title">
									<span class="title">

										<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>

									</span>
								</div>
								<div class="list-price buy">
									<div class="jiage">
										<span class="n_jiage">￥
											<?php echo $this->_vars['volist']['price']/100; ?>

										</span>
									</div>

								</div>

							</a>
						</li>
						<?php endforeach; endif; ?>





					</ul>
				</section>
			</div>
		</div>
		<!--end-->
		<div class='hs none'>
			<form id="form" action="<?php echo url(array('mod' => 'buy'), $this);?>" method="post">
				<input name="spec" type="hidden" value="">
				<input name="num" type="hidden" value="">
				<input name="pid" type="hidden" value="<?php echo $this->_vars['data']['productid']; ?>
">
				<input name="gpid" type="hidden" value="<?php echo $this->_vars['data']['gpid']; ?>
">
				<div class="spec-menu">
					<div class="spec-menu-content spec-menu-show" style="display: block;">

						<div class="spec-menu-top bdr-b">
							<div class="spec-first-pic">
								<img id="spec_image" src="<?php echo $this->_vars['data']['smallimg1']; ?>
">
							</div>
							<a class="rt-close-btn-wrap spec-menu-close">
								<p class="flick-menu-close"></p>
							</a>

							<div class="spec-price" id="specJdPri" style="display: block">
								<span class="yang-pic spec-yang-pic"></span>
								<span id="spec_price">
									￥<?php if ($this->_vars['group']): ?>
									<?php echo $this->_vars['data']['gprice']/100; ?>

									<?php else: ?>
									<?php echo $this->_vars['data']['price']/100; ?>

									<?php endif; ?>
									
								</span>
							</div>


						</div>
						<div class="spec-menu-middle">
							<div class="prod-spec" id="prodSpecArea">
								<!-- 已选 -->
								<script>var $gg = new Array();</script>
								<div class="spec-desc">




									<div id="specDetailInfo_spec" class="base-txt">
										<span class="part-note-msg">选择</span>
										&nbsp;&nbsp;
									</div>
								</div>
								<div class="nature-container" id="natureCotainer">
									<!--颜色 5.5版本之前的规格属性-->
									<div class="pro-color">
										<?php if (count((array)$this->_vars['spec'])): foreach ((array)$this->_vars['spec'] as $this->_vars['i'] => $this->_vars['volist']): ?>
										<script>$gg[<?php echo $this->_vars['i']; ?>
]='<?php echo $this->_vars['volist']['id']; ?>
';</script>

										<span class="part-note-msg">
											<?php echo $this->_vars['volist']['sname']; ?>

										</span>
										<p id="property<?php echo $this->_vars['volist']['id']; ?>
">

<?php  $this->_vars['f']=explode(",",$this->_vars['volist']['svalue']); ?>
											<?php if (count((array)$this->_vars['f'])): foreach ((array)$this->_vars['f'] as $this->_vars['value']): ?>

											<a class="a-item  " onclick="selectSpec('<?php echo $this->_vars['volist']['id']; ?>
',this,'<?php echo $this->_vars['volist']['sname']; ?>
','<?php echo $this->_vars['value']; ?>
');">
												<?php echo $this->_vars['value']; ?>

											</a>

											<?php endforeach; endif; ?>



										</p>

										<?php endforeach; endif; ?>
										<script>
											var specs = new Array();
											specs.push(new spec(<?php echo $this->_vars['data']['productid']; ?>
, $gg, <?php echo $this->_vars['data']['price']; ?>
, <?php echo $this->_vars['data']['count']; ?>
));

											var specQty = 0;
											var defSpec = <?php echo $this->_vars['data']['productid']; ?>
;
											var goodsspec = new goodsspec(specs, specQty, defSpec);

										</script>



									</div>
									<!--尺寸-->

									<!--容量-->

									<!--数量-->
									<div id="addCartNum" class="pro-count">
										<span class="part-note-msg">数量</span>
										<p></p>
										<div class="quantity-wrapper">

											<a class="quantity-decrease   " id='low_num'>
												<em id="minus">-</em>
											</a>
											<input type="text" class="quantity" size="<?php echo $this->_vars['data']['count']; ?>
" tag='fixnum' onblur="check_nums()" value="1" name='nums'
											 id='nums'>
											<a class="quantity-increase " id='add_num'>
												<em id="plus">+</em>
											</a>
										</div>
										<span class="lowestbuy-tip"></span>
									</div>
								</div>

							</div>
							<!--延保start-->

							<!--延保end-->
						</div>

						<div class="flick-menu-btn spec-menu-btn">
							<a class="yellow-color add_cart" id="add_cart_spec">加入购物车</a>
							<a class="red-color directorder" id="directorder_spec" tag='submit'>立即购买</a>



						</div>
					</div>
				</div>
			</form>
		</div>




		<div id="foot">
		<?php $this->assign('kf', vo_list("fun=@!get!@ type=@!im!@ mod=@!kf!@   param1=@!{$this->_vars['data']['muid']}!@")); ?>
			<div class="kf " style='display: none'>
				<?php if (count((array)$this->_vars['kf'])): foreach ((array)$this->_vars['kf'] as $this->_vars['vkf']): ?>
				<?php if ($this->_vars['vkf']['type'] == 0): ?>

				<li onclick="_go_url('mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $this->_vars['vkf']['num']; ?>
')">
					<i class='qq'></i>
					<div class="kfr">
						<span>称呼：
							<?php echo $this->_vars['vkf']['name']; ?>

						</span>
						<span>
							<b>
								<?php echo $this->_vars['vkf']['num']; ?>

							</b>
						</span>
					</div>
				</li>
				<?php elseif ($this->_vars['vkf']['type'] == 1): ?>
				<li onclick="_go_url('http://www.taobao.com/webww/ww.php?ver=3&amp;touid=<?php echo $this->_vars['vkf']['num']; ?>
&amp;siteid=<?php echo $this->_vars['config']['site_url']; ?>
&amp;status=1&amp;charset=utf-8')">
					<i class='ww'></i>
					<div class="kfr">
						<span>称呼：
							<?php echo $this->_vars['vkf']['name']; ?>

						</span>
						<span>
							<b>
								<?php echo $this->_vars['vkf']['num']; ?>

							</b>
						</span>
					</div>
				</li>



				<?php elseif ($this->_vars['vkf']['type'] == 2): ?>
				<li onclick="_go_url('tel: <?php echo $this->_vars['vkf']['num']; ?>
')">
					<i class='mobile'></i>
					<div class="kfr">
						<span>称呼：
							<?php echo $this->_vars['vkf']['name']; ?>

						</span>
						<span>
							<b>
								<?php echo $this->_vars['vkf']['num']; ?>

							</b>
						</span>
					</div>
				</li>
<?php elseif ($this->_vars['vkf']['type'] == 3): ?>

				<li onclick="_go_url('<?php echo url(array('mod' => 'msg','action' => 'cheat','group' => 'user','args' => "user:" . $this->_vars['vkf']['num'] . ""), $this);?>')">
					<i class='ygt'></i>
					<div class="kfr">
						<span>称呼：
							<?php echo $this->_vars['vkf']['name']; ?>

						</span>
						<span>
							<b>
								<?php echo $this->_vars['vkf']['num']; ?>

							</b>
						</span>
					</div>
				</li>

				<?php endif; ?>
				<?php endforeach; endif; ?>
			</div>

			<div class="bottom_bar">
				<div class="bottom_bar_icon">
					<div class="wangwang" id='xskf'>
						<p class="icon"></p>
						<p class="text">客服</p>
					</div>
				</div>
				<div class="bottom_bar_icon">
					<div class="shop" data-spm="shop" onclick="_go_url('<?php echo url(array('mod' => 'shop','action' => 'show','agrs' => " id:" . $this->_vars['data']['muid'] . ""), $this);?>')">
						<p class="icon"></p>
						<p class="text">店铺</p>
					</div>
				</div>
				<div class="bottom_bar_fav">
					<div class=" default" onclick="javascript:getfavp('<?php echo $this->_vars['data']['productid']; ?>
');">
						<p class="icon"></p>
						<p class="text">收藏</p>
					</div>
				</div>
				<div class="sys_button cart yellow-color">
					<p>加入购物车</p>
				</div>
				<div class="sys_button buy red-color">
					<p>立即购买</p>
				</div>
			</div>
		</div>



	</div>



	<div style="clear: both;"></div>








	</div>

	</div>

	<div id="back_top" class="slide-box ">

		<a href="javascript:void(0);" class="back-top none">
			<img src="<?php echo $this->_vars['indextpl']; ?>
images/ico/download.png">
		</a>
	</div>



	<script>
		var swiper = new Swiper('.swiper-container', {
			pagination: '.pagination',
			loop: true,
			grabCursor: true,
			autoplay: 3000,
			observer: true,
			observeParents: true,
			paginationClickable: true
		});
		var tabh = $('.tab-lst').offset().top;

		$(function () {
			$(".tab-lst li").click(function () {
				var b = $(".tab-lst li").index($(this));
				if ($(window).scrollTop() != tabh) {
					$("html,body").animate({ scrollTop: tabh }, $(window).scrollTop())
				}

				$(this).addClass("on").siblings().removeClass("on");
				$(".t-content").eq(b).show().siblings(".t-content").hide();
			});

			$(window).scroll(function () {
				$ob = $('.back-top');
				$h = $(window).height();
				$sh = $(window).scrollTop();
				$up = $sh > $h ? 1 : 0;

				if ($sh < tabh) {

					if ($(".tab-lst").hasClass('fixed')) {
						$(".tab-lst").removeClass('fixed');
					}
				} else {
					if (!$(".tab-lst").hasClass('fixed')) {
						$(".tab-lst").addClass('fixed');
					}
				}

				if ($up) {

					$('.back-top:hidden').fadeIn();
				} else {
					$('.back-top').fadeOut();

				}

			});
			$(".back-top").click(function () {

				$("html,body").animate({ scrollTop: 0 }, 500);

			}); $(".rt-close-btn-wrap").click(function () {

				$(".hs").hide();

			});


		});
	</script>