<?php /* "ngtpl[start]:tpl/admin/siteset_mailset.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-23 14:24:03 */ ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_vars['page_charset']; ?>
" />
      <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
    <style type="text/css">
        .auto-style1 {
            height: 25px;
        }
    </style>
   
    <script>
        function aaa()
        {
            $ar = {
                'port': $('[name=port]').val(),
                'sendmail': $('[name=sendmail]').val(),
                'sendname': $('[name=sendname]').val(),
                'sendpassword': $('[name=sendpassword]').val(),
                'sendtype': $('[name=sendtype]').val(),
                'smtp': $('[name=smtp]').val(),
                'ssl': $('[name=mailssl]').val(),
                'test_email': $('[name=test_email]').val()
            };
            $ur = '<?php echo \ng169\hook\url(array('action' => "mailset_try",'mod' => "siteset",'group' => "admin"), $this);?>';
            yAjax($ur, $ar, function($data){
            	if($data.flag){
            		showd('发送成功');
            	}else{
            		showd($data);
            	}
            });
          
        }




</script>
</head>

<body>
    <div class="oemarry_layout">
  <div class="oe_top_nav">
	 <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."a_nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
  </div>
  <div class="oe_content">
      
   
     <form action="<?php echo \ng169\hook\url(array('action' => "save",'mod' => "siteset",'group' => "admin"), $this);?>" method="post" name="config_form">
 <table class="oe_table_warp">
        
	  <tr>
	    <th width="5%">邮箱接口开关：</th>
		<td width="35%">
                <select name="mailflag">
                            <option value="1" 
                                <?php if ($this->_vars['config']['mailflag'] == '1'): ?>selected
                                <?php endif; ?>
                                 >开启</option>
                               <option value="0"
                                   <?php if ($this->_vars['config']['mailflag'] == '0'): ?>
                                   selected
                                <?php endif; ?>
                                   >关闭</option>
                        </select>   
		  <span class="oe_trap"><label></label><em> 站点邮件开关;关闭则不能发送邮件</em></span>
		</td>
	
	  </tr>
	  <?php if ($this->_vars['config']['mailflag'] == '1'): ?>
	 <tr>
	    <th width="5%">邮件发送方式：</th>
		<td width="35%">
                <select name="sendtype">
                            <option value="1" 
                                <?php if ($this->_vars['config']['sendtype'] == '1'): ?>selected
                                <?php endif; ?>
                                 >SMTP</option>
                             
                        </select>   
		  <label></label>  <span class="oe_trap"><label></label><em> 
    选择邮件服务器类型 </em></span></td>
	
	  </tr>
     <tr>
	    <th width="5%">使用SSL：</th>
		<td width="35%">
                <select name="mailssl">
                            <option value="0" <?php if ($this->_vars['config']['mailssl'] == 0): ?>selected <?php endif; ?> >关闭</option>
                                <option value="1" <?php if ($this->_vars['config']['mailssl'] == 1): ?>selected <?php endif; ?>>
                              开启</option>
                        </select>   
		  <label></label>  <span class="oe_trap"><label></label><em> 
    &nbsp;</em></span></td>
	
	  </tr>
     <tr>
	    <th width="5%">SMTP地址：</th>
		<td width="35%">
                <input class="input-b" autocomplete="off" name="smtp" type="text" value="<?php echo $this->_vars['config']['smtp']; ?>
"  tag="notnull"/>   
		  <span class="oe_trap"><label></label><em> 
    发送邮箱的smtp地址。如: smtp.gmail.com或smtp.qq.com </em></span>
		</td>
	
	  </tr>
     <tr>
	    <th width="5%">端口:</th>
		<td width="35%">
               <input class="input-s" autocomplete="off" type="text" value="<?php echo $this->_vars['config']['port']; ?>
" name="port" tag="notnull isnum"/>
 <span class="oe_trap"><em> 服务端口</em></span>
		</td>
	
	  </tr>
     <tr>
	    <th width="5%" class="auto-style1">邮箱地址：</th>
		<td width="35%" class="auto-style1">
               <input class="input-b" type="text" autocomplete="off" value="<?php echo $this->_vars['config']['sendmail']; ?>
" name="sendmail" tag="notnull ismail" />
		  <label>   
		  <span class="oe_trap"><em> 邮箱地址请输入完整地址email@email.com格式</em></span>
		</label>
		</td>
	  </tr>
     <tr>
	    <th width="5%">邮箱密码：</th>
		<td width="35%">
                 <input class="input-b" autocomplete="off" type="password" value="<?php echo $this->_vars['config']['sendpassword']; ?>
" name="sendpassword" />
		  <label>   
		  <span class="oe_trap"><em> 邮箱地址请输入完整地址email@email.com格式</em></span>
		</label>
		</td>
	
	  </tr>
     <tr>
	    <th width="5%">发送者姓名：</th>
		<td width="35%">
               <input class="input-b" autocomplete="off" type="text" value="<?php echo $this->_vars['config']['sendname']; ?>
" name="sendname" />
		        <label>
                邮箱密码</label></td>
	
	  </tr>
     <tr>
	    <th width="5%">测试收件地址：</th>
		<td width="35%">
               <input class="input-b" autocomplete="off" type="text" value="" name="test_email" tag="cannull ismail" />
		  <label>收件邮箱地址 <a id="send_email0" class="oe_ico_blue" href="javascript:;" onclick="aaa()">发送测试</a></label></td>
	
	  </tr>
    <?php endif; ?>       
	</table>
         <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
 </form>
  </div>
</div>
    
</body>
</html>