<?php /* "ngtpl[start]:/tpl/mtpl/foot.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 10:45:40 */ ?>



<div class="footer">
    <ul class="line">
        <li <?php if ($this->_vars['c'] == 'index'): ?>class="current"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'index'), $this);?>"><i class="i1"></i><span>首页</span></a></li>
   
        <li <?php if ($this->_vars['c'] == 'category'): ?>class="current"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'category','group' => 'index'), $this);?>"><i class="i2"></i><span>分类</span></a></li>
        <li <?php if ($this->_vars['c'] == 'purchase'): ?>class="current"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'purchase','action' => '','group' => 'index'), $this);?>"><i class="i3"></i><span>聚实惠</span></a></li>
      
       <li <?php if ($this->_vars['c'] == 'cart'): ?>class="current"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'cart','group' => 'index'), $this);?>"><i class="i4"></i><span>购物车</span></a></li>
        <li <?php if ($this->_vars['c'] == 'user'): ?>class="current"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'user','action' => ''), $this);?>"><i class="i5"></i><span>我的 </span></a></li>
    </ul>
</div>





<script>
	
	
     $(function(){
     	$(".back-top").click(function(){
     	
     		 $("html,body").animate({scrollTop:0},500);

     	});
$(window).scroll(function(){
		$ob=$('.back-top');
		$h=$(window).height();
		$sh=$(window).scrollTop();
		$up=$sh>$h?1:0;
	
	
		if($up){
			/*$ob=$('.back-top .none').fadeIn();*/
			
			$('.back-top:hidden').fadeIn();
		}else{
			$('.back-top').fadeOut();
			
		}
		
	});
     });
</script>
<script>
		var vlogurl='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'logset','group' => 'index'), $this);?>';
		var vlogid='<?php echo $this->_vars['vlogid']; ?>
';
		
	</script>
	<script src="<?php echo $this->_vars['staticjs']; ?>
log.js" type="text/javascript"></script>  


 
</body>
</html>
