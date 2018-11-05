<?php /* "tpl/templets/default/shop_intro.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:42:20 �й���׼ʱ�� */ ?>

 <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."phead.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


		<div class="w">
          
         <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pleft.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>  
	<div id="right"><div class="module_special">
	<h2>店铺简介</h2>
    <div class="info">
    <pre>
    	<?php echo $this->_vars['data']['intro']; ?>

    </pre>
     	
    </div>
</div></div>
    <div class="clear"></div>
	</div>

		


		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


</body></html>