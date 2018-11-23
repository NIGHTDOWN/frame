<?php /* "ngtpl[start]:tpl/admin/singlepage_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-23 14:07:10 */ ?>

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
           <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('abid[]',this)" title="全选" data="true"> 全选 </a> 
          <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo \ng169\hook\url(array('action' => "del",'group' => "admin"), $this);?>',id:'abid'})" title="删除" onclick="boxyn($(this))"> 删除</a>
           <a href="<?php echo \ng169\hook\url(array('group' => "admin",'action' => "add_view"), $this);?>" class="icon-plus"> 添加</a>
        <div style="display:none" id="area_serach">
          <input id="areaname" type="text">
          <input name="查找" value="查找" type="button" onClick="search_str($(this).prev('#areaname').val())">
        </div>
  <span class="fr"><a href="javascript:;"  onClick="lbox('筛选条件')"  id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>"> 筛选条件</a></span>
        <input id="condition_input" name="condition" value="" type="hidden">
        </span> </div>
      <table class="oe_table_list table_cs"  id="paixun">
        <tbody>
          <tr>
            <th style="width:4%;text-align:center;">选择</th>
            <th style="width:8%;">名称</th>
           <th style="width:8%;">分类名称</th>
               <th style="width:20%;text-align:center;">外部URL</th>
               <th style="width:5%;text-align:center;">排序</th>
               <th style="width:5%;text-align:center;">使用url</th>
       
            <th style="width:5%;text-align:center;">状态</th>
            <th style="text-align:center;">操作</th>
          </tr>
          
          <?php if (count((array)$this->_vars['singlepage'])): foreach ((array)$this->_vars['singlepage'] as $this->_vars['volist']): ?>
          <tr>
            <td style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['abid']; ?>
" name="abid[]">
              </input></td>
            <td style="cursor:pointer" who="singlepage" key="<?php echo $this->_vars['volist']['abid']; ?>
" name="title" tag="ajaxtext">
              <?php echo $this->_vars['volist']['title']; ?>
</td>
            <td >
              <?php echo $this->_vars['volist']['catname']; ?>
</td>
                <td who="singlepage" key="<?php echo $this->_vars['volist']['abid']; ?>
" name="url" tag="ajaxtext" style="cursor:pointer"><?php echo $this->_vars['volist']['url']; ?>
</td>
            <td who="singlepage" key="<?php echo $this->_vars['volist']['abid']; ?>
" name="orders" tag="ajaxtext" style="cursor:pointer"><?php echo $this->_vars['volist']['orders']; ?>
</td>
               <td who="singlepage" key="<?php echo $this->_vars['volist']['abid']; ?>
" name="useurl" tag="ajaxchoose" style="cursor:pointer"><?php if ($this->_vars['volist']['useurl'] == 0): ?>
              <div class="no"> </div>
              <?php else: ?>
              <div class="yes"> </div>
              <?php endif; ?></td>
            <td who="singlepage" key="<?php echo $this->_vars['volist']['abid']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer">
                <?php if ($this->_vars['volist']['flag'] == 1): ?>
              <div class="no"> </div>
              <?php else: ?>
              <div class="yes"> </div>
              <?php endif; ?></td>
            <td style="text-align:center;" class="a_edit_del">
                  <a class="oe_ico_green" target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'single','group' => "index",'action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ""), $this);?>">前台预览</a> 
                <a class="oe_ico_blue"" href="<?php echo \ng169\hook\url(array('action' => "show",'args' => "abid:" . $this->_vars['volist']['abid'] . ""), $this);?>">编辑</a> 
                <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "del",'args' => "abid:" . $this->_vars['volist']['abid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a></td>
          </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
      <div class="oe_page_box"> 
        <?php echo $this->_vars['page']; ?>
 
      </div>
      
      
    </form>
    <div style="display: none;" id="searchbox">
  <form method="post" style="width:400px;" action="">
       <input name="sflag" type="hidden" value="1">
     <table align="center" width="473" class="oe_table_warp">
      <tbody><tr>
        <td height="40" style="text-align:right;">标题：</td>
        <td>
        <input name="title" class="input-b" type="text" value="<?php echo $this->_vars['where']['title']; ?>
">
            
        </td>
           
      </tr>
        
        
    </tbody></table>
        <div style="text-align:center">
           <input name="" value="清空" class="oe_boxbut" tag="reset" type="button">
        <span style="padding-left:50px;"></span>
          <input name="" value="提交查询" class="oe_boxbut" tag="submit" type="button">
    </div>
  </form>
</div>
  </div>
</div>
    
</body>
