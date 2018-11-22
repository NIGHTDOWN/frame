<?php /* "ngtpl[start]:tpl/admin/area_city.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 18:06:19 */ ?>

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
          
           <a href="<?php echo \ng169\hook\url(array('group' => "admin",'action' => "addcity"), $this);?>" class="icon-plus"> 添加</a>
       
        <span class="fr"><a href="javascript:;"  onClick="msgbox('搜索城市',$('#area_serach'))"  id="condition" class="icon-search" style=""> 搜索城市</a>
        <input id="condition_input" name="condition" value="" type="hidden">
        </span> </div>
      <table class="oe_table_list table_cs"  id="paixun">
        <tbody>
          <tr>
            <th style="width:4%;text-align:center;">选择</th>
            <th style="width:30%;">城市名称</th>  
            <th style="width:30%;">省份名称</th>  
            <th style="width:10%;text-align:center;">排序</th>
            
            <th style="width:10%;text-align:center;">状态</th>
            <th style="text-align:center;">操作</th>
          </tr>
          <?php if (count((array)$this->_vars['area'])): foreach ((array)$this->_vars['area'] as $this->_vars['volist']): ?>
          <tr>
            <td style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['cityID']; ?>
" name="cityID[]">
              </input></td>
               <td >
              
              <?php echo $this->_vars['volist']['city']; ?>
</td>
            <td >
              
              <?php echo $this->_vars['volist']['province']; ?>
</td>
             
            <td who="province" key="<?php echo $this->_vars['volist']['cityID']; ?>
" name="orders" tag="ajaxtext" style="cursor:pointer"><?php echo $this->_vars['volist']['orders']; ?>
</td>
            
            <td who="province" key="<?php echo $this->_vars['volist']['cityID']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer"><?php if ($this->_vars['volist']['flag'] == 1): ?>
              <div class="no"> </div>
              <?php else: ?>
              <div class="yes"> </div>
              <?php endif; ?></td>
            <td style="text-align:center;" class="a_edit_del"><a class="oe_ico_green" href="<?php echo \ng169\hook\url(array('action' => "run",'args' => "cityID:" . $this->_vars['volist']['cityID'] . ""), $this);?>">查看地区</a> 
                <a class="oe_ico_blue"" href="<?php echo \ng169\hook\url(array('action' => "editcity",'args' => "cityID:" . $this->_vars['volist']['cityID'] . ""), $this);?>">编辑</a> 
                <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "delcity",'args' => "cityID:" . $this->_vars['volist']['cityID'] . ""), $this);?>" onclick="boxyn($(this))">删除</a></td>
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
 <div style="display:none" id="area_serach">
          <div>
          	<form method="post" style="width:400px;" action="">
       <input name="sflag" type="hidden" value="1">
     <table  align="center" width="473" class="oe_table_warp">
      <tr>
        <td height="40"  style="text-align:right;">城市：</td>
        <td>
        <input name="city" class="input-b" type="text" value="<?php echo $this->_vars['where']['city']; ?>
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
        </div>
</body>
