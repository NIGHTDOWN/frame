<?php /* "tpl/templets/default/product_detail.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:18 �й���׼ʱ�� */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."phead.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


		<div class="w">
			
			
			<div class="detail">
				<div class="detail-bd clearfix">
					<div class="summary clearfix">
						<div class="item-info clearfix">
							<div class="left">
								<div class="gallery">
									<div class="main-pic">
										<a target="_blank" href="<?php echo $this->_vars['data']['smallimg1']; ?>
">
										<img class="jqzoom" height="400" width="400" alt="" src="<?php echo $this->_vars['data']['smallimg1']; ?>
" rel="<?php echo $this->_vars['data']['smallimg1']; ?>
" title="" style="cursor: crosshair;">
											
										</a>
									</div>
									<ul id="jqzoom" class="clearfix">
									<?php if ($this->_vars['data']['smallimg1']): ?>
										<li class=""><img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg1'], 'imgsize', 'PHP', 1, '60,60'); ?>
" big="<?php echo $this->_vars['data']['smallimg1']; ?>
" height="60" width="60"></li><?php endif; ?>
									<?php if ($this->_vars['data']['smallimg2']): ?>
										<li class=""><img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg2'], 'imgsize', 'PHP', 1, '60,60'); ?>
" big="<?php echo $this->_vars['data']['smallimg2']; ?>
" height="60" width="60"></li><?php endif; ?>
										<?php if ($this->_vars['data']['smallimg3']): ?>
										<li class=""><img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg3'], 'imgsize', 'PHP', 1, '60,60'); ?>
" big="<?php echo $this->_vars['data']['smallimg3']; ?>
" height="60" width="60"></li><?php endif; ?>
										<?php if ($this->_vars['data']['smallimg4']): ?>
										<li class=""><img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg4'], 'imgsize', 'PHP', 1, '60,60'); ?>
" big="<?php echo $this->_vars['data']['smallimg4']; ?>
" height="60" width="60"></li><?php endif; ?>
										<?php if ($this->_vars['data']['smallimg5']): ?>
										<li class=""><img src="<?php echo $this->_run_modifier($this->_vars['data']['smallimg5'], 'imgsize', 'PHP', 1, '60,60'); ?>
" big="<?php echo $this->_vars['data']['smallimg5']; ?>
" height="60" width="60"></li><?php endif; ?>
									

									
										
									</ul>
								</div>
							</div>
							<div class="right">
								<div class="wrap">
									<div class="title">
										<h3><?php echo $this->_run_modifier($this->_vars['data']['productname'], 'tostr', 'PHP', 1); ?>
</h3>
									</div>
									<ul class="promo-meta clearfix">
									
										<li>
											<span>价格</span>
											<strong class="promo-price">
												<em class="rmb"><?php echo $this->_vars['config']['currency']; ?>
</em>
												<em id="price" class="rmb-num"><?php  echo $this->_vars['data']['price']/100; ?></em>
											</strong>
										</li>
										<li>
											<span>配送</span>
											<p>
												<?php echo $this->_run_modifier($this->_vars['data']['provinceid'], 'getprovince', 'PHP', 1);  echo $this->_run_modifier($this->_vars['data']['cityid'], 'getcity', 'PHP', 1); ?>
 至
												<a class="region" href="javascript:void(0);"><?php echo $this->_vars['city']['province'];  echo $this->_vars['city']['city']; ?>
</a>
											</p>
											<p style="margin-left:60px;">
												<!--                                  快递:10元 
												-->
											</p>
										</li>
										<li class="counter">
											<div class="sell-counter clearfix">
												<a href="javascript:;">
													<b><?php echo $this->_vars['data']['sells']; ?>
</b><span>交易成功</span>
												</a>
											</div>
											<div class="rate-counter clearfix">
												<a href="javascript:;">
													<b><?php echo $this->_vars['data']['pls']; ?>
</b><span>累计评论</span>
												</a>
											</div>
										</li>
									</ul>
												
									<div class="buy_box clearfix">
										<form id="form" onsubmit="return buy()" action="<?php echo url(array('mod' => 'buy'), $this);?>" method="post">
											<input name="spec" type="hidden" value="">
											<input name="num" type="hidden" value="">
											<input name="pid"  type="hidden" value="<?php echo $this->_vars['data']['productid']; ?>
">
											<input name="gpid"  type="hidden" value="<?php echo $this->_vars['data']['gpid']; ?>
">
											<div class="select_style clearfix">
											<script>var $gg=new Array();</script>
				<?php if (count((array)$this->_vars['spec'])): foreach ((array)$this->_vars['spec'] as $this->_vars['volist']): ?>	
				 <script>$gg[<?php echo $this->_vars['i']-1; ?>
]='<?php echo $this->_vars['volist']['id']; ?>
';</script>
				 <dl id="spec_10">
    <dt><?php echo $this->_vars['volist']['sname']; ?>
</dt>
        <dd>
            <ul genre="property">
             <?php  $this->_vars['k']=explode(',',$this->_vars['volist']['svalue']); ?>
            <?php if (count((array)$this->_vars['k'])): foreach ((array)$this->_vars['k'] as $this->_vars['value']): ?>
		
			<li title="<?php echo $this->_vars['value']; ?>
">	<a onclick="selectSpec('<?php echo $this->_vars['volist']['id']; ?>
',this,'<?php echo $this->_vars['volist']['sname']; ?>
','<?php echo $this->_vars['value']; ?>
');"><?php echo $this->_vars['value']; ?>
<i></i></a>
                </li>
			<?php endforeach; endif; ?>
            
                
            </ul>
        </dd>
    </dl>						
  <?php endforeach; endif; ?>
     <script>
             	var specs = new Array();
				specs.push(new spec(<?php echo $this->_vars['data']['productid']; ?>
, $gg, <?php  echo $this->_vars['data']['price']/100; ?>, <?php echo $this->_vars['data']['count']; ?>
));
				
				var specQty = 0;
				var defSpec = <?php echo $this->_vars['data']['productid']; ?>
;
				var goodsspec = new goodsspec(specs, specQty, defSpec);
             	
             </script>  
   
    <dl>	<dt>数量</dt>
        <dd class="stock">	<a href="javascript:void(0);" id="low_num">-</a>
            <input onkeyup="check_nums();" size="3" name="nums" id="nums" type="text" value="1">	<a href="javascript:void(0);" id="add_num">+</a>
            <em>件 （库存 <span id="stock"><?php echo $this->_vars['data']['count']; ?>
</span> <?php echo $this->_vars['data']['unit']; ?>
） </em>
        </dd>
    </dl>
</div>
										
											<div class="choose_result"></div>
											<div class="clear"></div>
											<div class="choose_btn">
												<a href="javascript:void(0);" class="btn-buy"></a>
												<a href="javascript:void(0);" class="add-cart"></a>
											</div>
										</form>
									</div>
									<div class="sep-line clearfix"></div>
									<ul class="social clearfix">
										<li class="like"><a href="javascript:like(<?php echo $this->_vars['data']['productid']; ?>
);"><i></i>喜欢商品</a></li>
										<li class="fav"><a href="javascript:getfavp(<?php echo $this->_vars['data']['productid']; ?>
);"><i></i>收藏商品</a></li>
										<li class="share" id='share'><a href="javascript:void(0);"><i></i>分享</a></li>
										<script>
											$(function() {

								            $("#share").socialShare({
								                content: '<?php echo $this->_vars['data']['title']; ?>
',
												url:'<?php echo url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "productid:" . $this->_vars['data']['productid'] . ""), $this);?>',
												titile:'<?php echo $this->_vars['data']['title']; ?>
'
								            });
								           
								            });
										</script>
										<li class="ercode iconfont"><a href="javascript:void(0);" style="padding-left: 0"><span style="color:orange"></span> 二维码
										
										</a>
										
										</li>
									</ul>
									<div class="qrcode" style="float: right; padding-right: 70px;display: none">
									<img src="<?php echo url(array('action' => 'qr','args' => "productid:" . $this->_vars['data']['productid'] . ""), $this);?>"></div>
									<div class="bshare-custom icon-medium hidden"><div class="bsPromo bsPromo2"></div>
										<div class="bsPromo bsPromo2"></div>
										
										
									</div>
									<div class="clear"></div>
									<div id="cart_show" style="display:none"><div class="cartbg"></div>
<div class="cartinfo">
	<a id="close_box" class="cart-shut" href="#" onclick="$('#cart_show').fadeOut(500);return false;"></a>
    <div class="cart-head">添加成功！</div>
	<div class="cart-text">
    	<p class="cart-stats">购物车共有<strong id='cartnum'>0</strong>件</p>
        <a title="去购物车结算" class="cart-checkout" href="<?php echo url(array('group' => 'user','mod' => 'cart'), $this);?>">去购物车结算</a>
        <a class="close-page" onclick="$('#cart_show').fadeOut(500);return false;" href="#">再逛逛</a>
    </div>
</div></div>
								</div>
							</div>
						</div>
					</div>
					<div class="sidebar clearfix">
						<div class="shop-info">
						<?php $this->assign('levelimg1', vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!''{$this->_vars['data']['muid']}!@}")); ?>
						<?php $this->assign('levelimg', vo_list("fun=@!getlevelimg!@ type=@!am!@ mod=@!shoplevel!@  param1=@!''{$this->_vars['data']['muid']}!@}")); ?>
							<a class="shop-info-bg" href="">
						<?php if ($this->_vars['levelimg1']): ?>
							<img width="198" height="45" src="<?php echo $this->_vars['levelimg1']; ?>
">
							<?php endif; ?>	
							</a>
							<div class="shop-info-wrap clearfix">
								<div class="shop-info-hd">
									<dl>
										<dt>店铺：</dt>
										<dd><?php echo $this->_vars['data']['merchantname']; ?>
</dd>
									</dl>
									<dl>
										<dt>信誉：</dt>
										<dd>
										<?php if ($this->_vars['levelimg']): ?><img align="absmiddle" src="<?php echo $this->_vars['levelimg']; ?>
">
											<?php endif; ?>
										</dd>
									</dl>
									<dl>
										<dt>掌柜：</dt>
										<dd><a target="_blank" href="#"><?php echo $this->_vars['data']['username']; ?>
</a></dd>
									</dl>
									<dl class="shop-icon">
										<dt>资质：</dt>
										<dd>
										<?php if ($this->_vars['data']['rzflag']): ?>
										 <b ><img src="<?php echo $this->_vars['indextpl']; ?>
res/ico/rz.png"/></b>
										<?php endif; ?>
											<?php if ($this->_vars['data']['bzjcash'] > 0): ?>
											<span title="已缴纳<?php echo $this->_vars['data']['bzjcash']; ?>
元保证金"><?php  echo $this->_vars['data']['bzjcash']/100; ?> 元</span>
											<?php endif; ?>
										</dd>
									</dl>
								</div>
								<div class="shop-info-bd clearfix">
									<div class="shop-rate clearfix">
										<dl>
											<dt>描述&nbsp;&nbsp;</dt>
											<dd><b><?php echo $this->_vars['data']['mspf']; ?>
</b></dd>
										</dl>
										<dl>
											<dt>物流&nbsp;&nbsp;</dt>
											<dd><b><?php echo $this->_vars['data']['wlpf']; ?>
</b></dd>
										</dl>
										<dl>
											<dt>服务&nbsp;&nbsp;</dt>
											<dd><b><?php echo $this->_vars['data']['fwpf']; ?>
</b></dd>
										</dl>
									</div>
								</div>
								<div class="shop-info-fd clearfix">
									<a target="_blank" href="<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>">进入店铺</a>
									<a class="fr" href="javascript:void(0);" onclick="javascript:getfavshop(<?php echo $this->_vars['data']['muid']; ?>
);">收藏店铺</a>
								</div>
							</div>
						</div>
						<div class="pine">
							<div class="pine-hd clearfix">看了又看</div>
							<div class="pine-bd clearfix">
							<?php if (count((array)$this->_vars['other'])): foreach ((array)$this->_vars['other'] as $this->_vars['volist']): ?>
								<li class="fore1">
									<div class="p-img ld">
										<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">
											<img width="100" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
">
										</a>
									</div>
									<div class="p-name"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
									<div class="p-price"><strong><?php echo $this->_vars['volist']['currency'];   echo $this->_vars['volist']['price']/100; ?></strong></div>
								</li>
<?php endforeach; endif; ?>
							

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tabbar-wrap clearfix">
				<div class="shop-search">
					<div class="search-panel">
						<form action="<?php echo url(array('mod' => 'shop','action' => 'search','args' => "muid:" . $this->_vars['data']['muid'] . ""), $this);?>" method="post">
							<div class="search-btn">
								<input type="submit" value="">
							</div>
							<div class="search-fields">
								<input type="text" value="" name="word">
							</div>
						</form>
					</div>
				</div>
				<div class="inner-wrap">
					<ul class="clearfix">
						<li class="cur"><a href="javascript:void(0);">商品详情</a></li>
						<li><a href="javascript:void(0);">累计评论</a></li>
						<li><a href="javascript:void(0);">成交记录</a></li>
						
					</ul>
				</div>
			</div>
			<div class="layout clearfix">
				<div class="left">
					<div class="m">
						<div class="mt"><h3>热销产品</h3></div>
						<div class="mc">
						<?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
							<li class="fore1">
								<div class="p-img ld">
									<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">
										<img width="100" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
">
									</a>
								</div>
								<div class="p-name"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
								<div class="p-price"><strong><?php echo $this->_vars['volist']['currency'];   echo  $this->_vars['volist']['price']/100; ?></strong></div>
							</li>
<?php endforeach; endif; ?>
							
						</div>
					</div>
				</div>
				<div class="con clearfix">
					<div class="i-con">
						<div class="attributes clearfix">
							<ul class="clearfix">
							<?php if (count((array)$this->_vars['attribute'])): foreach ((array)$this->_vars['attribute'] as $this->_vars['volist']): ?>	
								<li><?php echo $this->_vars['volist']['aname']; ?>
：<?php echo $this->_vars['volist']['avalue']; ?>
</li>
								<?php endforeach; endif; ?>
							</ul>
						</div>
						<div class="description">
						<div style="text-align:center;">
								<?php echo $this->_vars['data']['content']; ?>

								
								<span style="line-height:1.5;"></span> 
							</div></div>
					</div>
					<div id="reviews" class="i-con hidden">
					<div class="reviews-hd-fore1 clearfix">
								<div class="score">
									<span>商品与描述相符</span>
									<strong><?php echo $this->_vars['data']['plpjf']; ?>
</strong>
									<span>分</span>
								</div>
								<div class="links"><a target="_blank" href="<?php echo url(array('mod' => 'shop','action' => 'comment','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><i></i>店铺评价</a></div>
							</div>
						<iframe style="border:none;width:100%;height:100%;min-height: 1000px;" src="<?php echo url(array('mod' => 'comment','action' => 'list','args' => "productid:" . $this->_vars['data']['productid'] . ""), $this);?>"></iframe>
					</div>
					<div id="deal-record" class="i-con hidden">
						<div id="deal-record" class="i-con ">
					<table width="100%" cellpadding="0" cellspacing="0" class="record" style='    border-bottom: none;'>
							<thead>
								<tr>
									<td colspan="5">交易中<b><?php echo $this->_vars['data']['sells']; ?>
</b>笔，交易成功<b><?php  echo $this->_vars['data']['sells']-$this->_vars['data']['jfsell']; ?></b>笔，纠纷退款<b><?php echo $this->_vars['data']['jfsell']; ?>
</b>笔</td>
								</tr>
								<tr>
									<td colspan="5">原价：<?php echo $this->_vars['config']['currency']; ?>
<em><?php  echo $this->_vars['data']['price']/100; ?></em><span>拍下价格的不同可能会由促销和打折引起的，详情可以咨询卖家。</span></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="pl15">买家</th>
									<th>拍下价格</th>
									<th>数量</th>
									<th>付款时间</th>
									<th>款式和型号</th>
								</tr>
							</tbody>
						</table>
						
					</div>
					<iframe style="border:none;width:100%;height:100%;min-height: 1000px;" src="<?php echo url(array('mod' => 'order','action' => 'list','args' => "productid:" . $this->_vars['data']['productid'] . ""), $this);?>"></iframe>
					</div>
					
					
				</div>
				<div class="right"><ul></ul></div>
			</div>
			

		</div>

		


		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


</body></html>