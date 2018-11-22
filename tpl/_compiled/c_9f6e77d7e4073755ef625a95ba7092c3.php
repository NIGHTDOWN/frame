<?php require_once('D:\work2\source\core\template\src\plugins\modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  /* "ngtpl[start]:tpl/muser/pay_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:08:52 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/user.css" rel="stylesheet" type="text/css" />


<body class="bgee">

	<div >
		<div id="content">




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'order'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>
							


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">支付确认</span>

										</div>
									</div>
							
								<div onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>



					<form method="POST" action="" target="_blank" >

				
					
					<section class="order-act" >
							
					
						<div class="label4">
									
										
								<div class="title">
										<span class="money">￥<?php echo $this->_vars['money']/100; ?>
</span>
										<?php  $this->_vars['num']=sizeof($this->_vars['data']); ?>
										<?php if ($this->_vars['num'] > 1): ?>
										<h3 class="morebtn">合并|<?php echo $this->_vars['num']; ?>
笔订单   <i class="moreorder"></i></h3>

										<?php endif; ?>
										<div id='hidebox' class=' <?php if ($this->_vars['num'] > 1): ?>none<?php endif; ?>' >
									  <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
									  <p> <div class="ordernum">订单【<?php echo $this->_vars['volist']['ordernum']; ?>
】(担保交易)</div> 
										<span>店铺名称：<?php echo $this->_vars['volist']['merchantname']; ?>
</span> 
									  <span>【<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'truncate', 'plugin', 1, '25'); ?>
...】</span> 
										</p>
									   
										<?php endforeach; endif; ?>
									</div>
								</div>
								
							

						</div>
						<div class="label4">
									
										
								<div class="title">
									<span class="tl">支付方式</span>
								</div>
								<div class="next nn">
										
										<div class="ico">	<ico class="api-1"></ico></div>
											<div class="name">余额支付</div>
										
											<div class="radio">
													<input type="radio" value="-1" name='payment_type'>	

											</div>	
										
									</div><div class="clear"></div>
									 <?php if (count((array)$this->_vars['api'])): foreach ((array)$this->_vars['api'] as $this->_vars['volist']): ?>
								<div class="next nn">
										
										<div class="ico">	<ico class="api<?php echo $this->_vars['volist']['apiid']; ?>
"></ico></div>
											<div class="name"><?php echo $this->_vars['volist']['name']; ?>
</div>
										
											<div class="radio">
													<input type="radio" value="<?php echo $this->_vars['volist']['apiid']; ?>
" name='payment_type'>	

											</div>	
										
									</div><div class="clear"></div>
								 <?php endforeach; endif; ?>		

						</div>
					
						
					</section>
				
					<button class='btn '  type="submit"  >确认充值</button>
						<div style="clear:both;margin-bottom:1rem"></div>
				</form>
				</div>







			</div>


			<script>
					$(function(){
						$('.morebtn').click(function(){
						
$b=$('#hidebox').toggle();
if(!$('#hidebox:hidden').length){
	$('.moreorder').addClass('up');
}else{
	$('.moreorder').removeClass('up');
}

						});
									
						});
				</script>
		
<script>

function choosepay($id){
	var ip='<?php echo $this->_vars['ip']; ?>
';
var port='<?php echo $this->_vars['port']; ?>
';
	switch($id){
		case '2':ywebsock(ip,port,'mobilewxpay',{'orderid':'<?php echo $this->_vars['data']['orderid']; ?>
'},doing);
			break;
		case '3':
		
		//ywebsock(ip,port,'mobilezfb',{'orderid':'<?php echo $this->_vars['data']['orderid']; ?>
'},doing);
			break;
		
	}
	return true;
}
var doing=function(data){
	if(data.status==1){
		if(data.url){showd('支付成功');_go_url(data.url);}else{showd('支付成功');}
		
		
	}else{
		showd('支付失败');
	}
}
// 执行动作，+数据
$(function(){
	$('[type=submit]').live('click',function(){
		
		
		if($('[name=payment_type]:checked').length==0){
			showd('选择支付方式');
		return false;	
		}
		
		$val=$('[name=payment_type]:checked').val();
		choosepay($val);
		return true;
	});
	
});
	
	
	


</script>







		</div>












	</div>

	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>