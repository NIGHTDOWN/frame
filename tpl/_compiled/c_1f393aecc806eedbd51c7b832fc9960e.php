<?php /* "ngtpl[start]:/tpl/user//pfoot.html:[end]" 

	

</div>
</div>
<div class="footer fn-clear">
    <div class="w">
		 <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetabout!@ mod=@!index!@ type=@!im!@ ")); ?>
		  <div class="links">
       <p> <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
        <a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','group' => 'index','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_vars['volist']['title']; ?>
</a><em>|</em>
              
               <?php endforeach; endif; ?>
			</p>
			</div>  <div class="copyright">
			<br><?php echo $this->_vars['config']['powerby']; ?>
 <?php echo $this->_vars['config']['copyright']; ?>
<br>
		</div>



</div>


</body></html>