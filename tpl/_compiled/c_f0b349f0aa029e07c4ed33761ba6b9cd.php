<?php /* "ngtpl[start]:/tpl/templets/default/pfoot.html:[end]" 

	

<div id="footer">
   <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetabout!@ mod=@!index!@ type=@!im!@ ")); ?>
       <p> <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
        <a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a><em>|
              
               <?php endforeach; endif; ?>
			</p>
			<?php echo $this->_vars['config']['copyright']; ?>
<br>
</div>

