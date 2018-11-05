<?php /* "/tpl/templets/default/pfoot.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:19 �й���׼ʱ�� */ ?>

<div id="footer">
   <?php $this->assign('single', vo_list("fun=@!footgetabout!@ mod=@!index!@ type=@!im!@ ")); ?>
       <p> <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
        <a href="<?php echo url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a><em>|
              
               <?php endforeach; endif; ?>
			</p>
			<?php echo $this->_vars['config']['copyright']; ?>
<br>
</div>


