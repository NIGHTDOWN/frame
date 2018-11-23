<?php /* "ngtpl[start]:tpl/admin/singlepage_add_view.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-23 14:07:09 */ ?>

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
<form method="post" action="<?php echo \ng169\hook\url(array('action' => "add"), $this);?>" >
    <input name="abid" type="hidden" value="<?php echo $this->_vars['singlepage']['abid']; ?>
">
     <table class="oe_table_warp">
        
	  <tr>
	    <th width="5%"><span class="red">*</span>标题：</th>
		<td width="35%"><input type="text" name="title" tag="notnull notnum" value="<?php echo $this->_vars['singlepage']['title']; ?>
"  class="input-b"/>
            <span class="oe_trap"><label></label><em>填写单页标题</em></span>
		</td></tr>
    
          
                   <tr>
                     <tr>
	    <th width="5%"><span class="red">*</span>选择分类</th>
		<td width="35%"> <?php $this->assign('cat', \ng169\hook\vo_list("fun=@!get_child!@ mod=@!singlepage_category!@ field=@!catid,catname,depth,alias!@ array=@!catid!@")); ?>
            <select name='catid'>
                <option value=''>顶级分类</option>
                <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
                <option value='<?php echo $this->_vars['volist']['catid']; ?>
'
                    <?php if ($this->_vars['select']['catid'] == $this->_vars['volist']['catid']): ?>
                  selected="selected"
                                <?php endif; ?>
                    >
                     <?php if (isset($this->_sections['customer'])) unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($this->_vars['volist']['depth']) ? count($this->_vars['volist']['depth']) : max(0, (int)$this->_vars['volist']['depth']);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
	$this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
	if ($this->_sections['customer']['total'] == 0)
		$this->_sections['customer']['show'] = false;
} else
	$this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

		for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
			 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
			 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']	  = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']	   = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
                    |
                    <?php endfor; endif; ?>
                    <?php if (isset($this->_sections['customer'])) unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($this->_vars['volist']['depth']) ? count($this->_vars['volist']['depth']) : max(0, (int)$this->_vars['volist']['depth']);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
	$this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
	if ($this->_sections['customer']['total'] == 0)
		$this->_sections['customer']['show'] = false;
} else
	$this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

		for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
			 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
			 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']	  = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']	   = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
                    --<?php endfor; endif; ?>
                    
                    <?php echo $this->_vars['volist']['catname']; ?>
</option>
                <?php endforeach; endif; ?>
            </select>
		</td></tr>
    
          
                   <tr>
	    <th width="5%">&nbsp;<span class="red">*</span>内容：</th>
		<td width="35%"><textarea rows="25"  cols="45" name="content" id="editor_id"  tag="notnull"><?php echo $this->_vars['singlepage']['content']; ?>
</textarea></td></tr>
                
            <tr>
	    <th width="5%">使用外部url（开启则原内容不生效）：</th>
		<td width="35%">
                    <select name="urlflag">
                        <option value="0"
                            <?php if ($this->_vars['menu']['urlflag'] == '0'): ?>
                            select
                                        <?php endif; ?>
                            >关闭</option>
                        <option value="1"
                            <?php if ($this->_vars['menu']['urlflag'] == '1'): ?>
                            select
                              <?php endif; ?>
                            >开启</option>
                    </select></td></tr>
         <tr>
	    <th width="5%">URL：</th>
		<td width="35%"><input type="text" name="url" value="<?php echo $this->_vars['singlepage']['url']; ?>
" class="input-b" tag="cannull isurl"/></td></tr>
        
	    <th width="5%">排序 ：</th>
		<td width="35%"><input type="text" name="orders" value="<?php echo $this->_vars['singlepage']['orders']; ?>
" class="input-b" tag="cannull isnum"/></td></tr>
       
         <tr>
	            <th width="5%">显示：</th>
		        <td width="35%">
                    <select name="flag">
                        <option value="0"
                            <?php if ($this->_vars['menu']['flag'] == '0'): ?>
                            select
                                        <?php endif; ?>
                           >正常</option>
                        <option value="1"
                            <?php if ($this->_vars['menu']['flag'] == '1'): ?>
                            select
                                        <?php endif; ?>
                           >隐藏</option>
                    </select></td></tr>
         
           <tr>
	    <th width="5%">meta标题：</th>
		<td width="35%"><input type="text" name="metatitle" value="<?php echo $this->_vars['singlepage']['alias']; ?>
" class="input-b" /></td></tr>
         <tr>
	    <th width="5%">meta关键词：</th>
		<td width="35%"><textarea rows="2"  cols="45" name="metakeyword" ></textarea></td></tr>
           <tr>
	    <th width="5%">meta描述：</th>
		<td width="35%"><textarea rows="2"  cols="45" name="metadesc"></textarea></td></tr>
     </table>
  <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
</form>
</div>
</div>
</body>
