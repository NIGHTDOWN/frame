<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/admin/friendlink_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 09:25:41 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<body>
<div class="oemarry_layout"> 
   <div class="oe_top_nav">
	 <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."a_nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
  </div>

<form action="" method="post">
<div class="oe_tools_bar clearfix">
    <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('id[]',this)" title="全选" data="true"> 全选 </a>
    <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo \ng169\hook\url(array('action' => "del"), $this);?>',id:'id'})" title="删除" onclick="boxyn($(this))"> 删除</a>
    <a href="<?php echo \ng169\hook\url(array('action' => "add"), $this);?>" class="icon-plus">添加</a>

    <span class="fr"><a href="javascript:;"  onClick="lbox('筛选条件')"  id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>"> 筛选条件</a></span>
</div>
<table class="oe_table_list table_cs"  id="paixun">
    <tr>
        <th style="width:4%; text-align:center;">选择</th>
        <th style="width:25%">链接名称</th>
         <th style="width:10%">排序</th>
        <th style="width:15%">友情链接管理</th>
        <th style="width:5%">Logo</th>
        <th style="width:4%">创建时间</th>
        <th style="width:4%">有效期</th>
        <th style="width:4%">状态</th>
         
        <th style="text-align:center;">操作</th>
    </tr>
    <tbody>
    <?php if (count((array)$this->_vars['friendlink'])): foreach ((array)$this->_vars['friendlink'] as $this->_vars['volist']): ?>
    <tr>
      <td  style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['id']; ?>
" name="id[]"></input></td>
      <td tag="ajaxtext" key="<?php echo $this->_vars['volist']['id']; ?>
" who="<?php echo $this->_vars['c']; ?>
" name="name"> <?php echo $this->_vars['volist']['name']; ?>

      </td>
       
         <td style="text-align:center;"><?php echo $this->_vars['volist']['orders']; ?>
</td>
          <td style="text-align:center;"><?php echo $this->_vars['volist']['url']; ?>
</td>
           <td style="text-align:center;"><img src="<?php echo $this->_vars['volist']['img']; ?>
" style="width: 80px;height:80px;"/></td>
         <td style="text-align:center;">
             <?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

         </td>
         <td style="text-align:center;">
             <?php echo $this->_run_modifier($this->_vars['volist']['stime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
-<?php echo $this->_run_modifier($this->_vars['volist']['etime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

         </td>
      
      <td  who="<?php echo $this->_vars['c']; ?>
" key="<?php echo $this->_vars['volist']['id']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer;text-align:center;" >
             <?php if ($this->_vars['volist']['flag'] == 0): ?> <div class="yes"></div>
             <?php else: ?><div class="no"></div>
             <?php endif; ?>
                </td>
          
        <td  style="text-align:center;" class="a_edit_del">  
        <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('action' => "edit",'args' => "id:" . $this->_vars['volist']['id'] . ""), $this);?>">编辑</a>
        <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "del",'args' => "id:" . $this->_vars['volist']['id'] . ""), $this);?>" onclick="boxyn($(this))">删除</a>
        </td>
      </tr>
    <?php endforeach; endif; ?></tbody>
       </table>
               
   <div class="oe_page_box">
                   <?php echo $this->_vars['page']; ?>

                </div>
</form> <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."paix.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</div>
</div>
<div style="display:none;" id="searchbox">
  <form method="post" style="width:400px;" action="">
       <input name="sflag" type="hidden" value="1">
     <table  align="center" width="473" class="oe_table_warp">
      <tr>
        <td height="40"  style="text-align:right;">链接名称：</td>
        <td>
        <input name="title" class="input-b" type="text" value="<?php echo $this->_vars['where']['title']; ?>
" />
            
        </td>
           
      </tr>
        
        
    </table>
        <div style="text-align:center">
           <input name="" value="清空" class="oe_boxbut" tag="reset" type="button">
        <span style="padding-left:50px;"></span>
          <input name="" value="提交查询" class="oe_boxbut" tag="submit" type="button">
    </div>
  </form>
</div>
</body>
