<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/user/order_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:46:09 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script>
	_ajax_file_url = '<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'upimg'), $this);?>';
</script>
<script type="text/javascript">
	$(function () {
		$(".search-opt a").click(function () {
			$(this).hide().siblings().show();
			if ($(this).attr("class") == 'show-whole')
				$(".whole").show();
			else
				$(".whole").hide();
		})
		$(".search-select").click(function () {
			var obj = $(this);
			$(obj).addClass("current");
			$(obj).next().find("li").each(function () {
				var val = $(this).parent().parent().prev().prev().val();

				$.each($('li[key="' + val + '"]'), function (i) {
					$(this).addClass('selected').siblings().removeClass('selected');
				});

			});
			$(this).next().slideToggle("fast", function () {
				if ($(obj).next().is(":visible")) {
					$(document).one('click', function () {
						$(".search-select").next().slideUp("fast");
						$(obj).removeClass("current");
					});
				}
			});
		});
		$(".i-search-select li").click(function () {
			var str = $(this).html();
			$(this).parent().parent().prev().prev().attr("value", $(this).attr("key"));
			$(this).parent().parent().prev().children("span").html(str);
			//$(this).parent().parent().slideToggle();
		});
	});
</script>
<style>
	.none {
		display: none
	}
</style>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."left.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


<div class="right_con">
	<div class="path">
		<div>
			<a href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>">我的商城</a>
			<span>&gt;</span>已买到的商品
		</div>
	</div>

	<div class="main">
		<div class="wrap">
			<div class="hd">
				<ul class="tabs">
					<li class="<?php if ($this->_vars['a'] == 'run'): ?>active<?php else: ?>normal<?php endif; ?>">
						<a href="<?php echo \ng169\hook\url(array('mod' => 'order'), $this);?>">所有订单</a>
					</li>
					<li class="<?php if ($this->_vars['a'] == 'waitpay'): ?>active<?php else: ?>normal<?php endif; ?>">
						<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitpay'), $this);?>">待付款</a>
					</li>
					<li class="<?php if ($this->_vars['a'] == 'waitsure'): ?>active<?php else: ?>normal<?php endif; ?>">
						<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitsure'), $this);?>">待收货</a>
					</li>
					<li class="<?php if ($this->_vars['a'] == 'waitcomment'): ?>active<?php else: ?>normal<?php endif; ?>">
						<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'waitcomment'), $this);?>">待评论</a>
					</li>
				</ul>
			</div>
			<?php if ($this->_vars['a'] == 'run'): ?>
			<div class="searchbar">
				<form action="" method="post">
					<input type="hidden" name="sflag" value="1" />
					<div>
						<input type="text" class="w300" name="productname" value="<?php echo $this->_run_modifier($this->_vars['get']['productname'], 'tostr', 'PHP', 1); ?>
">
						<span class="search-btn">
							<input type="submit" value="订单搜索">
						</span>
						<div class="search-opt">
							<a class="show-whole" <?php if (( $this->_run_modifier($this->_vars['where'], 'sizeof', 'PHP', 1) ) >= 1): ?>style="display:none;"
								<?php endif; ?>href="#">更多筛选条件
								<i>
									<em></em>
									<span></span>
								</i>
							</a>
							<a class="show-simple" <?php if (( $this->_run_modifier($this->_vars['where'], 'sizeof', 'PHP', 1) ) < 1): ?>style="display:none;"
								<?php endif; ?>href="#">精简筛选条件
								<i>
									<em></em>
									<span></span>
								</i>
							</a>
						</div>
					</div>
					<table width="100%" class="whole" <?php if (( $this->_run_modifier($this->_vars['where'], 'sizeof', 'PHP', 1) ) < 1): ?>style="display:none;"
						<?php endif; ?>>
						<tbody>
							<tr>
								<td>
									<label>店铺名称：</label>
									<input type="text" class="w90" name="merchantname" value="<?php echo $this->_vars['get']['merchantname']; ?>
">
								</td>
								<td width="33%">
									<label>交易状态：</label>
									<div class="select_box" style="z-index:99">
										<input type="hidden" value="<?php echo $this->_vars['where']['status']; ?>
" name="status">
										<div class="search-select">
											<span>

												<?php if ($this->_vars['where']['status'] == 0): ?>等待买家付款
												<?php elseif ($this->_vars['where']['status'] == ''): ?>全部
												<?php elseif ($this->_vars['where']['status'] == 1): ?>买家已付款
												<?php elseif ($this->_vars['where']['status'] == 2): ?>卖家已发货
												<?php elseif ($this->_vars['where']['status'] == 3): ?>交易成功
												<?php elseif ($this->_vars['where']['status'] == 4): ?>交易关闭
												<?php elseif ($this->_vars['where']['status'] == 5): ?>退款中的订单
												<?php endif; ?>
											</span>
											<b></b>
										</div>
										<div style="display:none;" class="i-search-select">
											<ul>
												<li key="" class="sub-line">全部</li>
												<li key="0" class="sub-line">等待买家付款</li>
												<li key="1" class="sub-line">买家已付款</li>
												<li key="2" class="sub-line">卖家已发货</li>
												<li key="3" class="sub-line">交易成功</li>
												<li key="4" class="sub-line">交易关闭</li>
												<li key="5" class="sub-line">退款中的订单</li>
											</ul>
										</div>
									</div>
								</td>
								<td>

									<label>成交时间：</label>
									<input type="text" class="w70 date1 " name="createtime[]" value="<?php echo $this->_run_modifier($this->_vars['where']['createtime']['0'], 'date_format', 'plugin', 1, " %Y-%m-%d "); ?>
"> &nbsp;到&nbsp;
									<input type="text" class="w70 date1 " name="createtime[]" value="<?php echo $this->_run_modifier($this->_vars['where']['createtime']['1'], 'date_format', 'plugin', 1, " %Y-%m-%d "); ?>
">
								</td>
								<td class="order">
									<button class="button button-pay" type="submit">搜索</button>
								</td>
							</tr>
							<tr>


							</tr>
						</tbody>
					</table>
				</form>



			</div>
			<?php endif; ?>
			<table class="table-list-style order">
				<thead>
					<tr>
						<th width="*">商品</th>
						<th width="80">单价(元)</th>
						<th width="80">数量</th>
						<th width="100">商品操作</th>
						<th width="120">实付款(元)</th>
						<th width="120">交易状态</th>
						<th width="120">交易操作</th>
					</tr>
				</thead>
				<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
				<tbody>
					<tr>
						<td class="sep-row" colspan="20"></td>
					</tr>
					<tr>
						<th class="bdl">
							<span class="dealtime">
								<?php echo $this->_run_modifier($this->_vars['volist']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

							</span>
							<span class="number">订单号：
								<?php echo $this->_vars['volist']['ordernum']; ?>

							</span>
						</th>
						<th colspan="2">
							<a target="_blank" title="mark" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','group' => 'index','args' => " id:" . $this->_vars['volist']['muid'] . ""), $this);?>">
								<?php echo $this->_vars['volist']['merchantname']; ?>

							</a>
						</th>
						<th></th>
						<th class="bdr" colspan="3">

							<?php if ($this->_vars['volist']['status'] == 3 || $this->_vars['volist']['status'] == 4): ?>
							<a class="order_del" onclick="return confirm('确定是否要删除？');" style='float:right' href="<?php echo \ng169\hook\url(array('action' => 'del','mod' => 'order','args' => "
							 oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">删除订单</a>
							<?php endif; ?>
							<?php if ($this->_vars['volist']['prorow'] == 0): ?>
							<a class="order_del" onclick="return confirm('确定是否要删除？');" style='float:right' href="<?php echo \ng169\hook\url(array('action' => 'del','mod' => 'order','args' => "
							 oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">删除订单</a>
							<?php endif; ?>
						</th>
					</tr>

					<?php if (count((array)$this->_vars['volist']['productlist'])): foreach ((array)$this->_vars['volist']['productlist'] as $this->_vars['k'] => $this->_vars['volist2']): ?>
					<?php if ($this->_vars['k'] == 0): ?>
					<tr>
						<td class="bdl product">
							<a class="pic" target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => " productid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">
								<img width="80" height="80" src="<?php echo $this->_run_modifier($this->_vars['volist2']['smallimg'], 'imgsize', 'PHP', 1, '80,80'); ?>
">
							</a>
							<div class="desc">
								<a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => " productid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">
									<?php echo $this->_run_modifier($this->_vars['volist2']['productname'], 'tostr', 'PHP', 1); ?>

								</a>
								<a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'backdetail','group' => 'index','args' => " bid:" . $this->_vars['volist2']['bid'] . ""), $this);?>">【交易快照】</a>
								<span class='spec'>
									<?php echo $this->_vars['volist2']['spec']; ?>

								</span>
							</div>
						</td>
						<td>
							<?php echo $this->_vars['volist2']['price']/100; ?>

						</td>
						<td>
							<?php echo $this->_vars['volist2']['num']; ?>

						</td>
						<td>
							<?php if ($this->_vars['volist']['status'] == 0): ?>
							<?php elseif ($this->_vars['volist']['status'] == 1): ?>
							<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">关闭</a>
							<?php endif; ?>
							<?php elseif ($this->_vars['volist']['status'] == 2): ?>
							<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:
								" . $this->_vars['volist2']['productid'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:
								" . $this->_vars['volist2']['productid'] . ""), $this);?>">关闭</a>
							<?php endif; ?>
							<?php elseif ($this->_vars['volist']['status'] == 3): ?>

							<?php if ($this->_vars['volist2']['shflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">申请售后</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">售后完成</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">售后关闭</a>
							<?php endif; ?>



							<?php elseif ($this->_vars['volist']['status'] == 4): ?>
							<?php if ($this->_vars['volist2']['tkflag']): ?>
							
							<a href="<?php echo \ng169\hook\url(array('mod' => 'log','group' => 'pay','action' => 'glide','args' => "type:1, desc:" . $this->_vars['volist']['ordernum'] . "退款"), $this);?>">查看退款</a>
							<?php endif; ?>
							<?php elseif ($this->_vars['volist']['status'] == 5): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'tkdetail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">退款中的订单</a>
							<?php endif; ?>





						</td>

						<td class="bl" rowspan="<?php echo $this->_vars['volist']['prorow']; ?>
">
							<b>
								<?php echo $this->_vars['volist']['paytotal']/100; ?>

							</b>
							<?php if ($this->_vars['volist']['logisfee']): ?>
							<br>
							<span>(含运费：
								<?php echo $this->_vars['volist']['logisfee']/100; ?>
)</span>
							<?php endif; ?>
						</td>

						<td class="bl" rowspan="<?php echo $this->_vars['volist']['prorow']; ?>
">
							<?php if ($this->_vars['volist']['status'] == 0): ?>等待买家付款
							<?php elseif ($this->_vars['volist']['status'] == 1): ?>买家已付款
							<?php elseif ($this->_vars['volist']['status'] == 2): ?>卖家已发货
							<?php elseif ($this->_vars['volist']['status'] == 3): ?>交易成功
							<?php elseif ($this->_vars['volist']['status'] == 4): ?>交易关闭
							<?php elseif ($this->_vars['volist']['status'] == 5): ?>
							<?php endif; ?>

							<a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",pid:
								" . $this->_vars['volist2']['productid'] . ""), $this);?>">订单详情</a>

						</td>

						<td class="bl bdr" rowspan="<?php echo $this->_vars['volist']['prorow']; ?>
">
							<?php if ($this->_vars['volist']['status'] == 0): ?>
							<a class="button button-pay" href="<?php echo \ng169\hook\url(array('group' => 'pay','mod' => 'pay','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'product'), $this);?>">立刻付款</a>
							<a onclick="return confirm('确定是否要取消？');" href="<?php echo \ng169\hook\url(array('mod' => 'order','args' => " oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'cancel'), $this);?>">取消订单</a>

							<?php elseif ($this->_vars['volist']['status'] == 1): ?>
							<span style="color: #f40">等待卖家发货</span>
							<?php elseif ($this->_vars['volist']['status'] == 2): ?>
							<div>
								<p style="margin-bottom:3px;">
									<span class="">
										<span>还剩
										<?php  echo residual_time($this->_vars['volist']['autosuretime']-$this->_vars['time']); ?>
											
										</span>
									</span>
								</p>

								<a class="button button-sure" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'sure','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">确认收货</a>



								<?php elseif ($this->_vars['volist']['status'] == 3): ?>
								<?php if (! $this->_vars['volist']['cflag']): ?>
								<a class="button button-comment" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'comment','args' => " oid:" . $this->_vars['volist']['ordernum'] . ""), $this);?>">评价</a>
								<?php endif; ?>

								<?php elseif ($this->_vars['volist']['status'] == 4): ?>交易关闭
								<?php elseif ($this->_vars['volist']['status'] == 5): ?>退款中的订单
								<?php endif; ?>




						</td>
					</tr>
					<?php else: ?>
					<tr>
						<td class="bdl product">
							<a class="pic" target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => " productid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">
								<img width="80" height="80" src="<?php echo $this->_run_modifier($this->_vars['volist2']['smallimg'], 'imgsize', 'PHP', 1, '60,60'); ?>
">
							</a>
							<div class="desc">
								<a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => " productid:" . $this->_vars['volist2']['productid'] . ""), $this);?>">
									<?php echo $this->_run_modifier($this->_vars['volist2']['productname'], 'tostr', 'PHP', 1); ?>

								</a>
								<a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'backdetail','group' => 'index','args' => " bid:" . $this->_vars['volist2']['bid'] . ""), $this);?>">【交易快照】</a>
								<span class='spec'>
									<?php echo $this->_vars['volist2']['spec']; ?>

								</span>
							</div>
						</td>
						<td>
							<?php echo $this->_vars['volist2']['price']/100; ?>

						</td>
						<td>
							<?php echo $this->_vars['volist2']['num']; ?>

						</td>
						<td>
							<?php if ($this->_vars['volist']['status'] == 0): ?>
							<?php elseif ($this->_vars['volist']['status'] == 1): ?>
							<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">关闭</a>
							<?php endif; ?>

							<?php elseif ($this->_vars['volist']['status'] == 2): ?>
							<?php if ($this->_vars['volist2']['tkflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款完成</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货处理中</a>
							<?php elseif ($this->_vars['volist2']['tkflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'tk','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款/退货关闭</a>
							<?php endif; ?>


							<?php elseif ($this->_vars['volist']['status'] == 3): ?>
							<?php if ($this->_vars['volist2']['shflag'] == 0): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'apply','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">申请售后</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 1): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 2): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">售后完成</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 3): ?>
							<a style='color:red' href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">已申请</a>
							<?php elseif ($this->_vars['volist2']['shflag'] == 4): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'sh','action' => 'detail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">售后关闭</a>
							<?php endif; ?>

							<?php elseif ($this->_vars['volist']['status'] == 4): ?>
							<?php if ($this->_vars['volist2']['tkflag']): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'showtk','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">查看退款</a>
							<?php endif; ?>
							<?php elseif ($this->_vars['volist']['status'] == 5): ?>
							<a href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => 'tkdetail','args' => " oid:" . $this->_vars['volist']['ordernum'] . ",id:
								" . $this->_vars['volist2']['id'] . ""), $this);?>">退款中的订单</a>
							<?php endif; ?>





						</td>

					</tr>
					<?php endif; ?>
					<?php endforeach; endif; ?>

				</tbody>
				<?php endforeach; endif; ?>

				<tfoot>
					<tr>
						<td colspan="20">
							<div class="pagination">
								<?php echo $this->_vars['page']; ?>

							</div>
						</td>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>