<?php /* "ngtpl[start]:tpl/user/wx_buy.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:18:02 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pframe.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  	
	<div class="fn-right">
	<div class="block fn-clear weixinqr-modal">
	<div class="modal-box"><div class="modal-left"><p><span>请使用 </span><span class="orange">微信</span><i class="icon icon-qrcode"></i><span class="orange"> 扫一扫</span><br>扫描二维码支付</p><div class="modal-qr"><img class="modal-qrcode" src="<?php echo \ng169\hook\url(array('mod' => 'login','group' => 'index','action' => 'qr','args' => "url:" . $this->_vars['data']['url'] . ""), $this);?>">
	<div class="modal-info"><span>二维码有效时长为2小时, 请尽快支付</span></div></div></div><div class="modal-right"><i class="icon icon-close"></i><img src="<?php echo $this->_vars['usertpl']; ?>
/res/weixin-qrcode.jpg" alt="微信扫码"></div></div>
</div>
</div>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	
<script>

// 执行动作，+数据
ywebsock('<?php echo $this->_vars['ip']; ?>
','<?php echo $this->_vars['port']; ?>
','wxpay',{'orderid':'<?php echo $this->_vars['data']['orderid']; ?>
'},function(data){
	
	if(data.status==1){
		if(data.url){showd('支付成功');_go_url(data.url);}else{showd('支付成功');}
		
		
	}else{
		showd('支付失败');
	}
	
	
	});

</script>

