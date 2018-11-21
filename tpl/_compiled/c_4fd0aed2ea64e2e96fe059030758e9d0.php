<?php /* "ngtpl[start]:tpl/admin/user_add_view.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 14:40:40 */ ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    
    	function checkgid($obj){
    		$url='<?php echo \ng169\hook\url(array('action' => 'isexist'), $this);?>';
    		$value=$($obj).val();
    		yAjax($url,{'username':$value},function(data){
    			
    		if(data.flag){
    			 change_form_statu(true);
           $callback.call($obj, $msg, 1);
    			
    		}
    		else{
    			 change_form_statu(false);
            	$callback.call($obj, data.error.errormsg, 0);
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
<span><a href="javascript:;" url="<?php echo \ng169\hook\url(array('action' => 'run'), $this);?>" tag="back">&lt;&lt;返回列表</a></span>
  </div>
  <div class="a_content oe_dlv">
<form method="post" action="<?php echo \ng169\hook\url(array('action' => 'add'), $this);?>" >
 
    <h3>账号信息</h3>
     <table class="oe_table_warp">
	  <tr>
	    <th width="15%"><span class="red">*</span>用户名：</th>
		<td width="35%"><input type="text" name="username" tag="notnull" value="<?php echo $this->_vars['data']['username']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em>唯一</em></span>
		</td>
            <th width="15%">昵称：</th>
		<td width="35%">
                    <input type="text" name="nickname" tag=""  value="<?php echo $this->_vars['data']['nickname']; ?>
"  class="input-b"/>
            <label></label>
		</td>
	  </tr>
         <tr>
          <th ><span class="red">*</span>手机：</th>
		<td ><input type="text" name="mobile" tag="notnull ismobile" value="<?php echo $this->_vars['data']['mobile']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em>唯一</em></span>
		</td>
	    <th ><span class="red">*</span>邮箱：</th>
		<td ><input type="text" name="email" tag=" " value="<?php echo $this->_vars['data']['email']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em>唯一</em></span>
		</td>
         
	  
	   
            
	  </tr>
<tr>
	  
            <th no="15%">账号状态</th>
		<td no="35%">
                    <select name="flag">
                        <option value="0"
                            <?php if ($this->_vars['data']['flag'] == '0'): ?>
                            selected
                                        <?php endif; ?>
                            >正常</option>
                        <option value="1"
                            <?php if ($this->_vars['data']['flag'] == '1'): ?>
                            selected
                                        <?php endif; ?>
                            >锁定</option>
                    </select>
            <label></label>
		</td>
	  </tr>
	  <tr>
	    <th width="15%"><span class="red">*</span>登入密码：</th>
		<td width="35%"><input type="password" name="password" tag="notnull iscomplex" value="<?php echo $this->_vars['data']['username']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em>唯一</em></span>
		</td>
            <th width="15%">确认登入密码：</th>
		<td width="35%">
                    <input type="password" name="cpassword" tag="notnull isequal" value=""  class="input-b"/>
            <label></label>
		</td>
	  </tr>
<tr>
	    <th width="15%"><span class="red">*</span>安全密码</th>
		<td width="35%"><input type="password" name="safepwd" tag="notnull iscomplex" value="<?php echo $this->_vars['data']['username']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em></em></span>
		</td>
            <th width="15%">确认安全密码：</th>
		<td width="35%">
                    <input type="password" name="csafepwd" tag="notnull isequal" value=""  class="input-b"/>
            <label></label>
		</td>
	  </tr>
         </table>
          
         
         
  <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
</form>
</div>
</div>
</body>
