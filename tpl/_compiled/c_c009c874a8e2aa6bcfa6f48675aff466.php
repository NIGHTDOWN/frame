<?php /* "ngtpl[start]:tpl/admin/frame_main.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 13:42:52 */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_vars['page_charset']; ?>
" />
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<body>

<div class="a_main oemarry_layout">
    <div class="oe_top_nav">
	 <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."a_nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  </div>

  <div class="a_content">
  <h2>系统信息</h2>
    <div class="a_system">
      <table class="a_table">
        <tr>
         <th width="20%">站点域名：</th>
          <td width="30%"><?php echo $this->_vars['config']['site_url']; ?>
</td>
          <th width="20%">操作系统：</th>
          <td width="30%"><?php echo $this->_vars['sysdata']['os']; ?>
</td>
         
        </tr>
        <tr>
          <th>服务器IP：</th>
          <td><?php echo $this->_vars['sysdata']['serverip']; ?>
</td>
          <th>客户端IP：</th>
          <td><?php echo $this->_vars['sysdata']['clientip']; ?>
</td>
        </tr>

        <tr>
          <th>PHP版本：</th>
          <td><?php echo $this->_vars['sysdata']['phpversion']; ?>
</td>
          <th>curl支持：</th>
          <td><?php echo $this->_vars['sysdata']['curl']; ?>
</td>
        </tr>
        <tr>
          <th>GD版本：</th>
          <td><?php echo $this->_vars['sysdata']['gd']; ?>
</td>
          <th>iconv支持：</th>
          <td><?php echo $this->_vars['sysdata']['iconv']; ?>
</td>
        </tr>
        <tr>
          <th>url fopen：</th>
          <td><?php echo $this->_vars['sysdata']['urlopen']; ?>
</td>
           <th>web引擎：</th>
          <td><?php echo $this->_vars['sysdata']['webengine']; ?>
</td>
        </tr>
<tr>
          <th>websock：</th>
          <td><?php if ($this->_vars['sysdata']['sock']): ?>
          	 <font color="green">√</font>
          	<?php else: ?>
          	<font color='red'>×</font>
          	<?php endif; ?>
          	
          </td>
           <th>后台sock状态：[<?php echo $this->_vars['sockport']; ?>
]</th>
          <td><?php if ($this->_vars['sysdata']['sockflag']): ?>
          <font color="green">√</font>
          <a class="oe_ico_red" href="<?php echo \ng169\hook\url(array('mod' => 'siteset','action' => 'closesock'), $this);?>" >关闭</a>
          	<?php else: ?>
          	<font color='red'>×</font>
          	<?php if ($this->_vars['sysdata']['sock']): ?>
          	  <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('mod' => 'siteset','action' => 'sock'), $this);?>" >开启</a>
          	
          	
          	<?php endif; ?>
          	<?php endif; ?>
          	
          </td>
        </tr>
      </table>
    </div>  
  </div>  
  <div class="a_content">
    <h2>网站信息统计</h2>
    <div class="a_system">
      <table class="a_table">
       <tr>
          <th>店铺总数：</th>
          <td><label class=""><?php echo $this->_vars['sysdata']['mnum']; ?>
</label></td>
             <th width="20%">商品总数：</th>
          <td width="30%"><label class=""><?php echo $this->_vars['sysdata']['pnum']; ?>
</label></td>
          <th>订单总额：</th>
          <td><label class=""><?php echo $this->_vars['sysdata']['osum']; ?>
</label></td>
     
        </tr>
        <tr>
          <th width="20%">用户总数：</th>
          <td width="30%"><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'user'), $this);?>')"><?php echo $this->_vars['sysdata']['unum']; ?>
</label></td>
    
           <th width="20%">黑名单用户：</th>
          <td width="30%"><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'user','action' => 'black'), $this);?>')"><?php  echo ng169\hook\vo_list("mod=@!user!@  fun=@!get_count!@  array=@!flag:1!@"); ?></label></td>
          <th width="20%">交易记录总数：</th>
          <td width="30%"><label class=""><?php echo $this->_vars['sysdata']['onum']; ?>
</label></td>
        </tr>
        <tr>
            <th>待审核用户：</th>
            <td><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'user','action' => 'wiatcheck'), $this);?>')"><?php echo $this->_vars['sysdata']['ununum']; ?>
</label></td>
               <th width="20%">待审核商户：</th>
            <td width="30%"><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'merchant','action' => 'waitcheck'), $this);?>')"><?php echo $this->_vars['sysdata']['unmnum']; ?>
</label></td>
            <th>待审核商品：</th>
            <td><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'waitcheck'), $this);?>')"><?php echo $this->_vars['sysdata']['unpnum']; ?>
</label></td>
       
          </tr>
          <tr>
              <th>待审核团购：</th>
              <td><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'groupon','action' => 'wait'), $this);?>')"><?php echo $this->_vars['sysdata']['ungnum']; ?>
</label></td>
                 <th width="20%">需平台介入退款：</th>
              <td width="30%"><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'depot','action' => 'tkneed'), $this);?>')"><?php echo $this->_vars['sysdata']['tknum']; ?>
</label></td>
              <th>需平台介入售后：</th>
              <td><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'depot','action' => 'shneed'), $this);?>')"><?php echo $this->_vars['sysdata']['shnum']; ?>
</label></td>
         
            </tr>
            <tr>
                <th>提现：</th>
                <td><label class="red" onclick="_go_url('<?php echo \ng169\hook\url(array('mod' => 'withdraw','action' => 'wait'), $this);?>')"><?php echo $this->_vars['sysdata']['txnum']; ?>
</label></td>
                   
           
              </tr>
       
       
      </table>
    </div>
  
  </div>
</div>

</body>
</html>
