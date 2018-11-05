<?php /* "tpl/templets/default/shop_show.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:42:22 �й���׼ʱ�� */ ?>

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
        
	<div id="right">
	<div class="module_special">
	<h2>橱窗推荐</h2>
    <div class="con">
    	<ul class="list">
    	<?php if (count((array)$this->_vars['plist'])): foreach ((array)$this->_vars['plist'] as $this->_vars['volist']): ?>
                        <li>
                <div class="pic">
                <a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
"  href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><img src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
" width="220" height="220" alt="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
"></a></div>
                <h3><a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></h3>
                <p><?php echo $this->_vars['config']['currency'];  echo $this->_vars['volist']['price']/100; ?>
</p>
            </li>
<?php endforeach; endif; ?>
                     
                    </ul>
    </div>
</div>
<div class="module_special">
	<h2>热销商品</h2>
    <div class="con">
    	<ul class="list">
                        <?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
                        <li>
                <div class="pic">
                <a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><img src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
" width="220" height="220" alt="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
"></a></div>
                <h3><a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></h3>
                <p><?php echo $this->_vars['config']['currency'];  echo $this->_vars['volist']['price']/100; ?>
</p>
            </li>
<?php endforeach; endif; ?>
                    </ul>
    </div>
</div>
</div>
    <div class="clear"></div>
	</div>

		


		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


</body></html>