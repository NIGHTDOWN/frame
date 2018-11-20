<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/admin/product_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-19 18:03:24 */ ?>

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
    <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('productid[]',this)" title="全选" data="true"> 全选 </a>
    <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo \ng169\hook\url(array('action' => "del"), $this);?>',id:'productid'})" title="删除" onclick="boxyn($(this))"> 删除</a>
     
  
    <a href="<?php echo \ng169\hook\url(array('action' => "add"), $this);?>" class="icon-plus">添加</a>
    <?php if ($this->_vars['a'] == 'waitcheck'): ?>
  <a class="" href="javascript:;" onclick="tools_submit({action:'<?php echo \ng169\hook\url(array('action' => "checkall"), $this);?>',id:'productid'})" title="删除" > 批量审核通过</a>
  <?php endif; ?>
    <span class="fr"><a href="javascript:;"  onClick="lbox('筛选条件')"  id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>"> 筛选条件</a></span>
</div>
<table class="oe_table_list table_cs"  id="paixun">
    <tr>
        <th style="width:4%; text-align:center;">选择</th>
        <th >商品名称</th>
        <th >商品LOGO</th>
        <th >商品类目</th>
        <th >商铺名称</th>
        <th>商户名</th>
        <th >商品价格</th>
        <th>销量</th>
        <th>点击量</th>
        <th>上架</th>
        <th>状态</th>
        <th>创建时间</th>
        <th style="text-align:center;">操作</th>
    </tr>
    <tbody>
    <?php if (count((array)$this->_vars['product'])): foreach ((array)$this->_vars['product'] as $this->_vars['volist']): ?>
    <tr>
      <td  style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['productid']; ?>
" name="productid[]"></input></td>
      <td > <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
 </td>
      <td > <img src="<?php echo $this->_vars['volist']['smallimg1']; ?>
" width="80px" height="80px"/>
      </td>
       <td > <?php echo $this->_vars['volist']['catname']; ?>

      </td>
       <td > <?php echo $this->_vars['volist']['merchantname']; ?>

      </td>
      <td > <?php echo $this->_vars['volist']['username']; ?>

      </td>
      <td > <?php echo $this->_vars['volist']['price']; ?>
/<?php echo $this->_vars['volist']['unit']; ?>

      </td>
      <td > <?php echo $this->_vars['volist']['sales']; ?>

      </td>
      <td > <?php echo $this->_vars['volist']['hits']; ?>

      </td>
      <td > <?php if ($this->_vars['volist']['shelves'] == 1): ?>已上架<?php elseif ($this->_vars['volist']['shelves'] == 0): ?>未上架<?php elseif ($this->_vars['volist']['shelves'] == 2): ?>已下架<?php elseif ($this->_vars['volist']['shelves'] == 3): ?>违规下架<?php elseif ($this->_vars['volist']['shelves'] == 4): ?>永久下架<?php endif; ?>
      </td>
      <td > <?php if ($this->_vars['volist']['pflag'] == 0): ?>未审核<?php elseif ($this->_vars['volist']['pflag'] == 1): ?>审核成功<?php elseif ($this->_vars['volist']['pflag'] == 2): ?>审核失败(<?php echo $this->_vars['volist']['reason']; ?>
)<?php elseif ($this->_vars['volist']['pflag'] == 3): ?>编辑重审<?php endif; ?>
      </td>
       <td > <?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

      </td>
        
       

         
        <td  style="text-align:center;" class="a_edit_del">  
         
           <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('action' => "edit",'args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">编辑</a>
           <a class="oe_ico_red" href="<?php echo \ng169\hook\url(array('action' => "stopsell",'args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">禁销</a>
        
           <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('action' => "check",'args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">审核</a>
           <a class="oe_ico_green" target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','group' => 'index','action' => "detail",'args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">预览商品</a>
        <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "del",'args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a>
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
        <td height="40"  style="text-align:right;">商户名称</td>
        <td>
        <input name="merchantname" class="input-b" type="text" value="<?php echo $this->_vars['where']['merchantname']; ?>
" />
            
        </td>
           
      </tr>
        
        <tr>
        <td height="40"  style="text-align:right;">产品名称</td>
        <td>
        <input name="productname" class="input-b" type="text" value="<?php echo $this->_run_modifier($this->_vars['where']['productname'], 'tostr', 'PHP', 1); ?>
" />
            
        </td>
           
      </tr>
      <tr>
        <td height="40"  style="text-align:right;">分类名称</td>
        <td>
        <input name="catname" class="input-b" type="text" value="<?php echo $this->_vars['where']['catname']; ?>
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
