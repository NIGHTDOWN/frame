<?php /* "ngtpl[start]:tpl/admin/pay_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 18:06:24 */ ?>

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

</div>
<table class="oe_table_list table_cs"  id="paixun">
    <tr>
       
          <th 
      
          
          >APIID</th>
          <th 
          
       
          
          >支付接口名称</th>
          <th 
         
          
          >接口LOGO</th>
          <th 
         
          
          >状态</th>
        <th style="text-align:center;">操作</th>
    </tr><tbody>
    <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
    <tr  >
   
         
       
        <td ><?php echo $this->_vars['volist']['apiid']; ?>
</td> 
        <td ><?php echo $this->_vars['volist']['name']; ?>
</td>
        <td ><img src="<?php echo $this->_vars['volist']['logo']; ?>
" style="width: 130px;"/></td>
          <td ><?php if ($this->_vars['volist']['flag']): ?><b style="color:red">未启用</b>
          	<?php else: ?><b style="color:green">启用</b>
          	<?php endif; ?>
          </td>
        <td  style="text-align:center;" class="a_edit_del">  
         <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('mod' => "pay",'action' => "edit",'args' => "apiid:" . $this->_vars['volist']['apiid'] . ""), $this);?>">设置</a>
        </td>
      </tr>
    <?php endforeach; endif; ?></tbody>
       </table>
   <div class="oe_page_box">
                   <?php echo $this->_vars['page']; ?>

                </div>
</form>  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."paix.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</div>
</div>

</body>
