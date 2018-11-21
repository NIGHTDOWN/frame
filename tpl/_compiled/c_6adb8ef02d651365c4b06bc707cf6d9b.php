<?php /* "ngtpl[start]:tpl/admin/siteset_upset.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 18:29:20 */ ?>

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

    <h6>站点设置<span style="font-size:12px; font-weight:normal; color:#999;">  使用($config.对应的标识)既可调用</span></h6>
          <form action="<?php echo \ng169\hook\url(array('action' => "save",'mod' => "siteset",'group' => "admin"), $this);?>" method="post" name="config_form">
    <table class="oe_table_warp">
         <?php if (count((array)$this->_vars['options'])): foreach ((array)$this->_vars['options'] as $this->_vars['volist']): ?>
	  <tr>
	    <th width="5%"><?php echo $this->_vars['volist']['name']; ?>
：<span class="oe_lable_gray">(标识: <?php echo $this->_vars['volist']['optionname']; ?>
)</span></th>
		<td width="35%">
               <?php if ($this->_vars['volist']['htmltype'] == '1'): ?>
                 <input class="input-b" type="text" value="<?php echo $this->_vars['volist']['optionvalue']; ?>
" name="<?php echo $this->_vars['volist']['optionname']; ?>
" />
              <?php elseif ($this->_vars['volist']['htmltype'] == '2'): ?>
             <button tag='img_up_one' class='<?php echo $this->_vars['volist']['optionname']; ?>
' type="button" id="oe_img_button">上传图片</button>
          图片宽高尺寸    <?php if ($this->_vars['volist']['optionname'] == 'user_head_man' || $this->_vars['volist']['optionname'] == 'user_head_woman' || $this->_vars['volist']['optionname'] == 'user_head_unknow'):  echo $this->_vars['config']['head_img_size'];  elseif ($this->_vars['volist']['optionname'] == 'merchant_head'):  echo $this->_vars['config']['merchant_logo_img_size'];  else:  echo $this->_vars['config']['default_img_size'];  endif; ?>
             <span class="oe_img">  
             
                <span id="viewimg_<?php echo $this->_vars['volist']['optionname']; ?>
">     
              <?php if ($this->_vars['volist']['optionvalue'] != ''): ?>
                <div style="float:left;width:auto;"><div style="height:80px;width:80px;overflow:hidden;margin-top:5px;" class="upimg_view">
                    <img src="<?php echo $this->_vars['volist']['optionvalue']; ?>
"  width="80px"> </div>
                     <input type="hidden" name="<?php echo $this->_vars['volist']['optionname']; ?>
" value="<?php echo $this->_vars['volist']['optionvalue']; ?>
">
                   <button onclick="javascript:delobj($(this).parent('div'));" style=" background: none repeat scroll 0 0 #fafafa; border: 1px solid #ebebeb;border-radius: 3px; cursor: pointer;display: block;margin-top: 10px;width: 80px;" type="button">删除</button></div>
                  <?php endif; ?>
                                    </span>
              <?php elseif ($this->_vars['volist']['htmltype'] == '3'): ?>
                      <textarea name="<?php echo $this->_vars['volist']['optionname']; ?>
" style="width:60%;height:80px;"><?php echo $this->_vars['volist']['optionvalue']; ?>
</textarea>
              <?php elseif ($this->_vars['volist']['htmltype'] == '4'): ?>
            <select name="<?php echo $this->_vars['volist']['optionname']; ?>
">
                            <option value="1" 
                                <?php if ($this->_vars['volist']['optionvalue'] == '1'): ?>selected
                                <?php endif; ?>
                                 >开启</option>
                               <option value="0"
                                   <?php if ($this->_vars['volist']['optionvalue'] == '0'): ?>
                                   selected
                                <?php endif; ?>
                                   >关闭</option>
                        </select>
              <?php endif; ?>
		  <span class="oe_trap"><label></label><em> <?php echo $this->_vars['volist']['desc']; ?>
</em></span>
		</td>
	
	  </tr>
	 
           <?php endforeach; endif; ?>
	</table>
             
	<div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit_uncheck" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
 </form>
  </div>
</div>
    
</body>
</html>
