<?php /* "ngtpl[start]:tpl/templets/default/index_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-19 11:38:30 */ ?>


	<script type="text/javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/jquery.flexslider-min.js"></script>
	
	<link href="<?php echo $this->_vars['indextpl']; ?>
res/skin.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $this->_vars['indextpl']; ?>
res/product.css" rel="stylesheet" type="text/css">
	<div class="w fn-clear">
		<div class="adv">
			<div class="adv787X327">
				<div class="slide" id="slider_1" style="min-height: inherit;">
					<ul class="slides " id='indexbanner'>
					
					
          
					</ul>
					<ul class="flex-direction-nav">
        
						<li><a class="prev" href="#">Previous</a>
						</li>
						<li><a class="next" href="#">Next</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="" id='indexbannerbottom'>

			</div>
		</div>
	

		<?php if (! $this->_vars['user']): ?>
		<div class="right_side">
			<dl class="right_side_1">
				<dt>公告</dt>
				<dd class="fore1" id='ggid'>
					
				</dd>
				<script>
		
			$(function(){
				
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'gg'), $this);?>';
				$.get($u,function(data){
					$('#ggid').append(data);
				});
			});
			
			
			
			
		</script>
				<dd class="fore2">
					<a class="login" href="<?php echo \ng169\hook\url(array('mod' => 'login'), $this);?>"></a>
					<a class="register" href="<?php echo \ng169\hook\url(array('mod' => 'reg'), $this);?>"></a>
				</dd>
			</dl>
			<dl class="buying">
				<dt>即时抢购</dt>
				<dd  id='indexqianggou'>
					
					
				</dd>
			</dl>
		</div><?php else: ?>

		<DIV class=right_side sizcache="5" sizset="55"><DIV class=notice sizcache="5" sizset="55">
				<DIV class="notice-hd fn-clear" sizcache="2" sizset="30">
					<UL sizcache="2" sizset="30">
						<LI class=cur>公告 </LI></UL></DIV>
				<UL class="notice-bd fn-clear" sizcache="5" sizset="55">
					<?php $this->assign('gg', \ng169\hook\vo_list("mod=@!notice!@ type=@!im!@ fun=@!getlist!@ ")); ?>
				
					<?php if (count((array)$this->_vars['gg'])): foreach ((array)$this->_vars['gg'] as $this->_vars['volist']): ?>
					<LI sizcache="4" sizset="55"><a href="<?php echo \ng169\hook\url(array('mod' => 'article','action' => 'show','agrs' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a>
					</li>
					<?php endforeach; endif; ?></UL></DIV>
			<DL class=member sizcache="4" sizset="59">
				<DT sizcache="4" sizset="59"><A href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'index'), $this);?>" target=_blank>
				<IMG src="<?php if ($this->_vars['user']['headimg']):  echo $this->_vars['user']['headimg'];  else:  echo $this->_vars['static']; ?>
images/head.png<?php endif; ?>" width=60 height=60> 
				Hi! <STRONG><?php echo $this->_vars['user']['username']; ?>
</STRONG> </A><IMG align=absMiddle src="<?php  echo ng169\hook\vo_list("fun=@!getlevelimg1!@ mod=@!userlevel!@ type=@!am!@ param1=@!{$this->_vars['user']['uid']}!@"); ?>"> 
					<P class=fn-clear sizcache="4" sizset="60"> <A class=last href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'index'), $this);?>" target=_blank>会员中心</A> </P></DT>
				<?php $this->assign('gg', \ng169\hook\vo_list("mod=@!notice!@ type=@!im!@ fun=@!getlist!@ ")); ?>	
				<DD class=fn-clear sizcache="4" sizset="62">
				<?php $this->assign('vv', \ng169\hook\vo_list("fun=@!getwaitsure!@ mod=@!order!@ type=@!im!@")); ?>
					<A href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'product','action' => 'waitsure'), $this);?>" target=_blank><STRONG><?php echo $this->_vars['vv']; ?>
</STRONG>待收货</A> <?php $this->assign('vv', \ng169\hook\vo_list("fun=@!getwaitpay!@ mod=@!order!@ type=@!im!@")); ?>
									
									
					<A class=pay href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'product','action' => 'waitpay'), $this);?>" target=_blank><STRONG><?php echo $this->_vars['vv']; ?>
</STRONG>待付款</A>
					<?php $this->assign('vv', \ng169\hook\vo_list("fun=@!getwaitcomment!@ mod=@!order!@ type=@!im!@")); ?>
					<A href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'product','action' => 'waitevaluate'), $this);?>" target=_blank><STRONG><?php echo $this->_vars['vv']; ?>
</STRONG>待评价</A> </DD></DL>

			<dl class="buying">
				<dt>即时抢购</dt>
				<dd  id='indexqianggou'>
				
				
				</dd>
			</dl>

		</DIV><?php endif; ?>
	</div>

	<div class="w mt20 fn-clear">
		<dl class="hot">
			<dt class="dt">
				<span class="current">疯狂抢购<b></b></span>
				<span>热卖产品<b></b></span>
				<span>新品上架<b></b></span>
			</dt>    
			<dd id='hotsell'>
			</dd>
		</dl>
		<div class="right_side ">
			<div class="" id='indexrightad1'>	
			</div>
		</div>
	</div>
	<div class="w " id='indexproducttop'>
	</div>
	<div class="w mt20 fn-clear">
		<div class="left fn-clear" id='ajaxhot'>	
		</div>
		<div class="right">
			<dl class="sns">
				<dt class="fn-clear">	
					<h2>口碑广场</h2>
				</dt>
				<dd id='kbid'>
				</dd>
			</dl>
		</div>
	</div>
	<script type="text/javascript">
		$(".dt span").hover(function(){
				var index=$(this).index();
				$(this).addClass("current").siblings().removeClass("current");
				$(this).parent().parent().find(".i-mc").eq(index).show().siblings(".i-mc").hide();
			});
	</script>
	
	<div class="fn-clear"></div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script>
		
			$(function(){
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'gethot'), $this);?>';
			
				$.get($u,function(data){
					$('#ajaxhot').append(data);
				});
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'hotsell'), $this);?>';
				$.get($u,function(data){
					
					$('#hotsell').append(data);
				});
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'kb'), $this);?>';
				$.get($u,function(data){
					$('#kbid').append(data);
				});
				
			});
			$domain='<?php echo $this->_vars['config']['site_url']; ?>
';
			$u2='<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'index','action' => 'getad'), $this);?>';
			getad($domain,$u2,'indexrightad1');
			getad($domain,$u2,'indexproducttop');
			getad($domain,$u2,'indexbannerbottom');
			getad($domain,$u2,'indexqianggou');
			getadfunction($domain,$u2,'indexbanner',function($html){
				$(".slide").flexslider({
		slideshowSpeed: 4000, //展示时间间隔ms
		animationSpeed: 400, //滚动时间ms
		touch: true //是否支持触屏滑动
	});
  
		});	
		</script>

</body></html>

