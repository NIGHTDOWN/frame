<?php /* "tpl/admin/siteset_smsset.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:20:34 �й���׼ʱ�� */ ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_vars['page_charset']; ?>
" />
      <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
       
    <script>
        function getnum($num)
        {
            $ar = {
                'smsname': $('[name=smsname]').val(),
                'smspassword': $('[name=smspassword' + $num + ']').val(),
                'smssender': $('[name=smssender' + $num + ']').val(),
                'smstophone': $('[name=smstophone' + $num + ']').val(),
                'api': $num
            };
            $ur = '<?php echo url(array('action' => "smsset_getnum",'mod' => "siteset",'group' => "admin"), $this);?>'
            yAjax($ur, $ar, function (data)
            {
                if (data.flag) { $('#smsnum'+$num).text(data.data); } else {
                   showd(data.error.errormsg);
                }
            });
        }
        function aaa($num)
        {
            $ar = {
                'smsname': $('[name=smsname]').val(),
                'smspassword': $('[name=smspassword]').val(),
                'smssender': $('[name=smssender]').val(),
                'smstophone': $('[name=smstophone]').val(),
                'api': $num
            };
            $ur = '<?php echo url(array('action' => "smsset_try",'mod' => "siteset",'group' => "admin"), $this);?>'
            yAjax($ur, $ar,
            function (data)
            {
                if (data.flag) {  showd(data.data); } else {
                    showd(data.error.errormsg);
                }
            }
            );
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
      <div class="oe_txtwrap">
	      <span class="red">温馨提示：</span> 如果您还没有发送手机短信接口的账号和密码，请联系QQ：<a href="tencent://message/?uin=3199185290&Site=http://qian1998.com&Menu=yes" target="_blank" class="red">3199185290</a>开通。&nbsp;&nbsp;<br />
         
	</div>
   
     <form action="<?php echo url(array('action' => "save",'mod' => "siteset",'group' => "admin"), $this);?>" method="post" name="config_form">
         <table class="oe_table_warp">
	  <tr>
	    <th width="5%">短信接口开关(标示:smsflag)：</th>
		<td width="35%">
                <select name="smsflag">
                            <option value="1" 
                                <?php if ($this->_vars['config']['smsflag'] == '1'): ?>selected
                                <?php endif; ?>
                                 >开启</option>
                               <option value="0"
                                   <?php if ($this->_vars['config']['smsflag'] == '0'): ?>
                                   selected
                                <?php endif; ?>
                                   >关闭</option>
                        </select>   
		  <span class="oe_trap"><label></label><em> 站点短信开关;关闭则不能发送短信</em></span>
		</td>
	
	  </tr>
	  <?php if ($this->_vars['config']['smsflag'] == '1'): ?>
<tr style="display: none">
	    <th width="5%">发送名称：</th>
		<td width="35%">
                 <input class="input-b" type="name" value="<?php echo $this->_vars['config']['smsname']; ?>
" name="smsname" />
		  <label>   
		  <span class="oe_trap"><em>  (为空时使用网站名，每条短信后面会出现签名，签名格式为：【发送人】，注意一条短信最多70个</em></span>
		</label>
		</td>
	  </tr>
	</table>
         <div class="oe_txtwrap">
	         验证码接口:
	</div>
 <table class="oe_table_warp">
	  <tr>
	    <th width="5%">帐号(标示:smssender)：</th>
		<td width="35%">
               <input class="input-b" type="text" value="<?php echo $this->_vars['config']['smssender']; ?>
" name="smssender" tag="notnull"/>   
		  <label></label>  <span class="oe_trap"><label></label>
                <label class="valid-msg">
                (需要申请)</label><font color="blue">可用短信(条)：</font><span id="smsnum1"></span> &nbsp;&nbsp; <a class="oe_ico_blue" href="javascript:void(0);" onclick="getnum(1);">点击查询</a><em> 
                </em></span></td>
	  </tr>
     <tr>
	    <th width="5%">密码(标示:smspassword)：</th>
		<td width="35%">
                <input class="input-b" name="smspassword" type="password" value="" tag="notnull" />   
		  <span class="oe_trap"><label></label><em> 
   </em></span>
		</td>
	
	  </tr>
     
     <tr>
	    <th width="5%">测试号码：</th>
		<td width="35%">
               <input class="input-b" type="text" value="<?php echo $this->_vars['config']['smstophone']; ?>
" name="smstophone" />
               <label>
               (接受测试短信号码)</label> <a id="send_email1" class="oe_ico_blue" href="javascript:;" onclick="aaa(1)">发送测试</a></td>
	
	  </tr>

  
	</table>
        <?php endif; ?>
         <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
 </form>
  </div>
</div>
</body>
</html>