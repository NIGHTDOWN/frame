<?php /* "ngtpl[start]:tpl/muser/pay_balance.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:08:54 */ ?>

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



					<form method="POST" action="" >

				
					
					<section class="order-act" >
							
					
						<div class="label4">
									
										
								<div class="title">
										<span class="money">￥<?php echo $this->_vars['data']['paycash']/100; ?>
</span>
									 
									  <p> <div class="ordernum"><strong>【<?php echo $this->_vars['data']['title']; ?>
】</strong></div> 
									
								
										</p>
									   
									
										
								</div>
								
							

						</div>
						<div class="label4">
									
										
								<div class="title">
									<span class="tl"> 支付密码</span>
								</div>
								
								<div class="next">
										<input name="pay_passwd" type="password" tag="notnull " class="wtext w1">
										
									</div>
										

						</div>
					
						
					</section>
				
					<button class='btn '  type="submit"  >确认支付</button>
						<div style="clear:both;margin-bottom:1rem"></div>
				</form>
				</div>







			</div>


			<script>
					$(function(){
							var intDiff =0;
							$('#sendsms').click(function() {
									if(intDiff<=0){
		
										var $mobile = '<?php echo $this->_vars['user']['mobile']; ?>
';
								
										var $action = '<?php echo \ng169\hook\url(array('action' => 'sendmsg'), $this);?>';
									
										$.post($action,{mobile:$mobile},function(data){
		
												intDiff = parseInt(60);//倒计时总秒数量
												var timer = window.setInterval(function(){
														$("#sendsms").attr("disabled", true);
														$("#sendsms").val(''+intDiff+'秒后重新获取');
														intDiff--;
														if(intDiff<0){
															clearInterval(timer);
															$("#sendsms").removeAttr("disabled");
															$("#sendsms").val('获取短信验证码');
														}
													}, 1000);
		
		
												if(data.flag ){
													alert(data.data);
												}
											});
									}
		
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