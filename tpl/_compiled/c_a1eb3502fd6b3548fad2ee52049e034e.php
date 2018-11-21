<?php /* "ngtpl[start]:tpl/templets/default/single_show.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 14:39:54 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."head.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


<body >
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


	<div class="w">
    <div class="detailnav">
        <strong><a href="#"><?php echo $this->_vars['data']['catname']; ?>
</a></strong>
        <span> &gt;  <?php echo $this->_run_modifier($this->_vars['data']['title'], 'tostr', 'PHP', 1); ?>
</span>
    </div>
</div>
<div class="w help">
    <div class="left">
    	<div class="help_side">
           	<div class="current">
                <h4><span><?php echo $this->_vars['data']['catname']; ?>
</span><b></b></h4>
                <ul>  
                <?php if (count((array)$this->_vars['other'])): foreach ((array)$this->_vars['other'] as $this->_vars['volist']): ?>
                                            <li>
                        <a href="<?php echo \ng169\hook\url(array('action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a>
                        </li>
                          <?php endforeach; endif; ?>                
                                    </ul>
            </div>
        </div>
    </div>		
    
    <div class="right">
        <h3 class="help_tit"><?php echo $this->_run_modifier($this->_vars['data']['title'], 'tostr', 'PHP', 1); ?>
</h3>
        <div class="help_box">
            
               <?php echo $this->_vars['data']['content']; ?>
         
	   
	                    </div>
    </div>
</div>
	

	
	
	<div class="fn-clear"></div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>