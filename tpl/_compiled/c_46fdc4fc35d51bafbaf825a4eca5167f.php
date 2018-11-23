<?php /* "ngtpl[start]:tpl/admin/articlecategory_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-23 13:54:01 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<body>
<div class="oemarry_layout"> 
     <div class="oe_top_nav"><?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."a_nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?></div>
  <div class="a_content">
    <form action="" method="post">
      <div class="oe_tools_bar clearfix">
          <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('catid[]',this)" title="全选" data="true"> 全选 </a> 
          <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo \ng169\hook\url(array('action' => "del",'group' => "admin"), $this);?>',id:'catid'})" onclick="boxyn($(this))"  title="删除"> 删除</a>
           <a href="<?php echo \ng169\hook\url(array('group' => "admin",'action' => "add_view"), $this);?>" class="icon-plus"> 添加</a>
        <div style="display:none" id="area_serach">
          <input id="areaname" type="text" class="input-b">
          <input name="查找" value="查找" type="button" class="oe_boxbut" onClick="search_str($(this).prev('#areaname').val())">
        </div>
        <span class="fr"><a href="javascript:;"  onClick="msgbox('搜索分类',$('#area_serach'))"  id="condition" class="icon-search" style=""> 搜索分类</a>
        <input id="condition_input" name="condition" value="" type="hidden">
        </span> </div>
      <table class="oe_table_list table_cs"  id="paixun">
        <tbody>
          <tr>
            <th style="width:4%;text-align:center;">选择</th>
            <th style="width:30%;">分类名称</th>  <th style="width:10%;">分类别名</th>
            <th style="width:10%;text-align:center;">排序</th>
            <th style="width:10%;text-align:center;">推荐</th>
            <th style="width:10%;text-align:center;">状态</th>
            <th style="text-align:center;">操作</th>
          </tr>
          <?php if (count((array)$this->_vars['articlecategory'])): foreach ((array)$this->_vars['articlecategory'] as $this->_vars['volist']): ?>
          <tr>
            <td style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['catid']; ?>
" name="catid[]">
              </input></td>
            <td style="cursor:pointer" who="article_category" key="<?php echo $this->_vars['volist']['catid']; ?>
" name="catname" tag="ajaxtext">
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
              -- 
              <?php endfor; endif; ?> 
              <?php echo $this->_vars['volist']['catname']; ?>
</td>
                <td >
              <?php echo $this->_vars['volist']['alias']; ?>
</td>
            <td who="article_category" key="<?php echo $this->_vars['volist']['catid']; ?>
" name="orders" tag="ajaxtext" style="cursor:pointer"><?php echo $this->_vars['volist']['orders']; ?>
</td>
            <td who="article_category" key="<?php echo $this->_vars['volist']['catid']; ?>
" name="elite" tag="ajaxchoose" style="cursor:pointer"><?php if ($this->_vars['volist']['elite'] == 0): ?>
              
              <div class="no"> </div>
              
              <?php else: ?>
              <div class="yes"> </div>
              <?php endif; ?></td>
            <td who="article_category" key="<?php echo $this->_vars['volist']['catid']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer"><?php if ($this->_vars['volist']['flag'] == 1): ?>
              <div class="no"> </div>
              <?php else: ?>
              <div class="yes"> </div>
              <?php endif; ?></td>
            <td style="text-align:center;" class="a_edit_del"><a class="oe_ico_green" href="<?php echo \ng169\hook\url(array('action' => "add_view",'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>">添加子分类</a> 
                <a class="oe_ico_blue"" href="<?php echo \ng169\hook\url(array('action' => "show",'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>">编辑</a> 
                <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "del",'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a></td>
          </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
      <div class="page_nav"> 
        <?php echo $this->_vars['page']; ?>
 
      </div>
    </form>
  </div>
</div>

</body>
