<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/admin/merchant_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 20:08:00 �й���׼ʱ�� */ ?>

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
    <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('muid[]',this)" title="全选" data="true"> 全选 </a>
    <a class="icon-remove-2" href="javascript:;" do="tools_submit({action:'<?php echo url(array('action' => "del"), $this);?>',id:'muid'})" title="删除" onclick="boxyn($(this))"> 删除</a>


    <span class="fr"><a href="javascript:;"  onClick="lbox('筛选条件')"  id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>"> 筛选条件</a></span>
</div>
<table class="oe_table_list table_cs"  id="paixun">
    <tr>
        <th style="width:4%; text-align:center;">选择</th>
        <th style="width:4%; text-align:center;">ID</th>
        <th >店铺账号</th>
        <th >店铺名称</th>
        <th >店铺LOGO</th>
        <th>店铺等级</th>
          <th>保证金</th>
         <th >店铺认证</th>
         <th >店铺状态</th>
          <th >创建时间</th>
         <th style="width:4%">推荐</th>
        <th style="text-align:center;">操作</th>
    </tr>
    <tbody>
    <?php if (count((array)$this->_vars['merchant'])): foreach ((array)$this->_vars['merchant'] as $this->_vars['volist']): ?>
    <tr>
      <td  style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['muid']; ?>
" name="muid[]"></input></td>
      <td > <?php echo $this->_vars['volist']['muid']; ?>
 </td>
      <td > <?php echo $this->_vars['volist']['username']; ?>
 </td>
      <td > <?php echo $this->_vars['volist']['merchantname']; ?>

      </td>
       <td >
       <?php if ($this->_vars['volist']['logo']): ?>
       <img width="80px" height="80px;" src="<?php echo $this->_vars['volist']['logo']; ?>
"/>
      <?php else: ?>
        <img width="80px" height="80px;" src="<?php echo $this->_vars['static']; ?>
images/default_logo.gif"/>
      <?php endif; ?>
      </td>
       <td > <?php echo $this->_vars['volist']['good']; ?>

       
       <img src="<?php  echo vo_list("fun=@!getlevelimg2!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['volist']['good']}'-'{$this->_vars['volist']['bad']}!@"); ?>">
                  
      </td>
       <td > <?php echo $this->_vars['volist']['bzjcash']; ?>

      </td>
         <td > <?php if ($this->_vars['volist']['rzflag'] == 0): ?>未认证<?php elseif ($this->_vars['volist']['rzflag'] == 1): ?>个人认证<?php elseif ($this->_vars['volist']['rzflag'] == 2): ?>企业认证<?php elseif ($this->_vars['volist']['rzflag'] == 3): ?>认证失败<?php endif; ?>
      </td>
        <td > <?php if ($this->_vars['volist']['storeflag'] == 0): ?>正常<?php else: ?>关闭<?php endif; ?>
      </td>
         <td style="text-align:center;">
             <?php echo $this->_run_modifier($this->_vars['volist']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>

         </td>

           <td  who="<?php echo $this->_vars['c']; ?>
" key="<?php echo $this->_vars['volist']['muid']; ?>
" name="elite" tag="ajaxchoose" style="cursor:pointer;text-align:center;" >
             <?php if ($this->_vars['volist']['elite'] == 1): ?> <div class="yes"></div>
             <?php else: ?><div class="no"></div>
             <?php endif; ?>
                </td>
        <td  style="text-align:center;" class="a_edit_del">  
          <a class="oe_ico_blue" target="_blank" href="<?php echo url(array('action' => "shop",'mod' => 'login_user','args' => "muid:" . $this->_vars['volist']['muid'] . ""), $this);?>">登入商户中心</a>
          <?php if ($this->_vars['a'] == 'waitcheck'): ?>
           <a class="oe_ico_green" href="<?php echo url(array('action' => "rz",'args' => "muid:" . $this->_vars['volist']['muid'] . ""), $this);?>">查看认证</a>
          <?php endif; ?>
        <a class="oe_ico_blue" href="<?php echo url(array('action' => "show",'args' => "muid:" . $this->_vars['volist']['muid'] . ""), $this);?>">编辑</a>
        <a class="oe_ico_red" a="<?php echo url(array('action' => "del",'args' => "muid:" . $this->_vars['volist']['muid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a>
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
        <td height="40"  style="text-align:right;"> 商户名称：</td>
        <td>
        <input name="merchantname" class="input-b" type="text" value="<?php echo $this->_vars['where']['merchantname']; ?>
" />
            
        </td>
           
      </tr> 
          <tr>
        <td height="40"  style="text-align:right;"> 用户名：</td>
        <td>
        <input name="username" class="input-b" type="text" value="<?php echo $this->_vars['where']['username']; ?>
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
