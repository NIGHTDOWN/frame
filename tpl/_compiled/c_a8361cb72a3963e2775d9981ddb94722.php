<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/admin/friendlink_add.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 18:07:06 */ ?>

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
	<span><a href="javascript:;" tag="back" url="<?php echo \ng169\hook\url(array('action' => 'run'), $this);?>">&lt;&lt;返回列表</a></span>
  </div>
  <div class="a_content oe_dlv">
<form method="post" action="<?php echo \ng169\hook\url(array('action' => $this->_vars['a']), $this);?>" >
<input type="hidden" name='id' value="<?php echo $this->_vars['friendlink']['id']; ?>
"/>
     <table class="oe_table_warp">
     <tr>
	    <th width="5%"><span class="red">*</span>名称</th>
		<td width="35%">
             <input type="text" name="name" value="<?php echo $this->_vars['friendlink']['name']; ?>
" class="input-b" tag="notnull" />
              </td></tr>
<tr>
	    <th width="5%"><span class="red">*</span>链接地址</th>
		<td width="35%">
             <input type="text" name="url" value="<?php echo $this->_vars['friendlink']['url']; ?>
" class="input-b" tag="notnull" /> 
              </td></tr>
         <tr>
             <th width="5%">LOGO</th>
             <td width="35%">
                 <button tag='img_up_one' class='img' type="button" id="oe_img_button">上传图片</button>
                 <?php if ($this->_vars['friendlink']['img']): ?>
				 <span id="viewimg_img"><div style="float:left;width:auto;"><div class="upimg_view" style="height:80px;width:80px;overflow:hidden;cursor:pointer;margin-top:5px;"><img alt="点击查看大图" src="<?php echo $this->_vars['friendlink']['img']; ?>
" width="80px" onclick="window.open('<?php echo $this->_vars['friendlink']['img']; ?>
');" style="height: 80px; width: 79px; margin-top: 0px; margin-left: 0.5px;"></div><input type="hidden" value="<?php echo $this->_vars['friendlink']['img']; ?>
" name="img"> <button type="button" style=" background: none repeat scroll 0 0 #fafafa; border: 1px solid #ebebeb;border-radius: 3px; cursor: pointer;display: block;margin-top: 10px;width: 80px;" onclick="javascript:delobj($(this).parent('div'));">删除</button></div></span>
                 
              <?php endif; ?>   
              </td>
         </tr>
       <tr>
	    <th width="5%"><span class="red">*</span>有效时间</th>
		<td width="35%">
             <input type="text" name="stime" value="<?php echo $this->_run_modifier($this->_vars['friendlink']['stime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
" class="input-b date"  /> 
             ---
             <input type="text" name="etime" value="<?php echo $this->_run_modifier($this->_vars['friendlink']['etime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
" class="input-b date"  /> 
              </td></tr>
              <tr>
	    <th width="5%"><span class="red">*</span>排序</th>
		<td width="35%">
             <input type="text" name="orders" value="<?php echo $this->_vars['friendlink']['orders']; ?>
" class="input-b" tag=" fixnum isnum notnull" /> 
              </td></tr>
         

         <tr>
	    <th width="5%">状态：</th>
		<td width="35%">
            <select name="flag">
                <option value="0"
                    <?php if ($this->_vars['friendlink']['flag'] == '0'): ?>
                    select
                                <?php endif; ?>
                   >显示</option>
                <option value="1"
                    <?php if ($this->_vars['friendlink']['flag'] == '1'): ?>
                    select
                                <?php endif; ?>
                   >隐藏</option>
            </select>
              </td></tr>
         
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