<?php /* "tpl/templets/default/gg.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:04:45 �й���׼ʱ�� */ ?>

<?php $this->assign('gg', vo_list("mod=@!notice!@ type=@!im!@ fun=@!getlist!@")); ?>
					<?php if (count((array)$this->_vars['gg'])): foreach ((array)$this->_vars['gg'] as $this->_vars['volist']): ?>
					<li>
						<a href="<?php echo url(array('mod' => 'article','action' => 'show','agrs' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></li>
					<?php endforeach; endif; ?>