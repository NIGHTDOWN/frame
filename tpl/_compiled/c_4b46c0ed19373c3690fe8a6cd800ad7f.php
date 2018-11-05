<?php require_once('E:\www\ng169\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/admin/article_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 21:25:50 �й���׼ʱ�� */ ?>

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
    <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('articleid[]',this)" title="全选" data="true"> 全选 </a>
    <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo url(array('action' => "del"), $this);?>',id:'articleid'})" title="删除" onclick="boxyn($(this))"> 删除</a>
    <a href="<?php echo url(array('action' => "add_view"), $this);?>" class="icon-plus">添加</a>

    <span class="fr"><a href="javascript:;"  onClick="lbox('筛选条件')"  id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>"> 筛选条件</a></span>
</div>
<table class="oe_table_list table_cs"  id="paixun">
    <tr>
        <th style="width:4%; text-align:center;">选择</th>
        <th style="width:25%">标题</th>
         <th style="width:10%">分类</th>
        <th style="width:15%">添加时间</th>
        <th style="width:5%">排序</th>
        <th style="width:4%">状态</th>
         <th style="width:4%">推荐</th>
        <th style="text-align:center;">操作</th>
    </tr>
    <tbody>
    <?php if (count((array)$this->_vars['article'])): foreach ((array)$this->_vars['article'] as $this->_vars['volist']): ?>
    <tr>
      <td  style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['articleid']; ?>
" name="articleid[]"></input></td>
      <td tag="ajaxtext" key="<?php echo $this->_vars['volist']['articleid']; ?>
" who="<?php echo $this->_vars['c']; ?>
" name="title"> <?php echo $this->_vars['volist']['title']; ?>

      </td>
       
         <td style="text-align:center;"><?php echo $this->_vars['volist']['catname']; ?>
</td>
         <td style="text-align:center;">
             <?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

         </td>
       <td  who="<?php echo $this->_vars['c']; ?>
" key="<?php echo $this->_vars['volist']['articleid']; ?>
" name="orders" tag="ajaxtext" style="cursor:pointer;text-align:center;" ><?php echo $this->_vars['volist']['orders']; ?>
</td>
      
      <td  who="<?php echo $this->_vars['c']; ?>
" key="<?php echo $this->_vars['volist']['articleid']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer;text-align:center;" >
             <?php if ($this->_vars['volist']['flag'] == 0): ?> <div class="yes"></div>
             <?php else: ?><div class="no"></div>
             <?php endif; ?>
                </td>
           <td  who="<?php echo $this->_vars['c']; ?>
" key="<?php echo $this->_vars['volist']['articleid']; ?>
" name="elite" tag="ajaxchoose" style="cursor:pointer;text-align:center;" >
             <?php if ($this->_vars['volist']['elite'] == 1): ?> <div class="yes"></div>
             <?php else: ?><div class="no"></div>
             <?php endif; ?>
                </td>
        <td  style="text-align:center;" class="a_edit_del">  
        <a class="oe_ico_blue" href="<?php echo url(array('action' => "show",'args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>">编辑</a>
        <a class="oe_ico_red" a="<?php echo url(array('action' => "del",'args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a>
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
        <td height="40"  style="text-align:right;">标题：</td>
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
