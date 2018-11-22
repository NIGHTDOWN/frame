<?php /* "ngtpl[start]:/tpl/user//foot.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:37:17 */ ?>


	</div>
		</div>
<div id="footer">
		 <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetabout!@ mod=@!index!@ type=@!im!@ ")); ?>
       <p> <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
        <a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','group' => 'index','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_vars['volist']['title']; ?>
</a><em>|</em>
              
               <?php endforeach; endif; ?>
			</p>
			
			<br><?php echo $this->_vars['config']['powerby']; ?>
 <?php echo $this->_vars['config']['copyright']; ?>
<br>
		</div>




	</body></html>