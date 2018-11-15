<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/templets/default/kb.html" //NG框架模板引擎;仅适用本系统框架; 2018-11-15 17:27:10 �й���׼ʱ�� */ ?>

<?php $this->assign('kb', \ng169\hook\vo_list("fun=@!getcomment!@ mod=@!index!@ type=@!im!@"));  if (count((array)$this->_vars['kb'])): foreach ((array)$this->_vars['kb'] as $this->_vars['volist']): ?>
					<li class="fn-clear">
						<div class="fore1 fn-clear">
							<b><?php echo $this->_vars['volist']['merchantname']; ?>
</b>
							<span><?php echo $this->_run_modifier($this->_vars['volist']['cmtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</span>
						</div>
						<div class="fore2 fn-clear">
							<div class="txt"><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">【<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
】</a><?php echo $this->_vars['volist']['cmcontent']; ?>
</div>
							<div class="pic fn-clear">
								<img width="80" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '60,60'); ?>
">
								<img width="80" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg2'], 'imgsize', 'PHP', 1, '60,60'); ?>
">
								<img width="80" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg3'], 'imgsize', 'PHP', 1, '60,60'); ?>
">
							</div>
						</div>
						<div class="fore3 fn-clear">
							<!--<span>评论(0)</span>
							<span>转发(0)</span>-->
						</div>
					</li>
					<?php endforeach; endif; ?>