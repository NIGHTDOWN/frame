<?php /* "tpl/templets/default/hotsell.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:04:49 �й���׼ʱ�� */ ?>

<?php $this->assign('a1', vo_list("type=@!im!@ mod=@!index!@ fun=@!get1!@")); ?>
 <?php $this->assign('a2', vo_list("type=@!im!@ mod=@!index!@ fun=@!get2!@")); ?>
 <?php $this->assign('a3', vo_list("type=@!im!@ mod=@!index!@ fun=@!get3!@")); ?>
 
 
 	<div class="i-mc fn-clear">
					<?php if (count((array)$this->_vars['a1'])): foreach ((array)$this->_vars['a1'] as $this->_vars['volist']): ?>
					<li class="fore1">
						<div class="p-img">
							<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>">
								<img src="<?php echo $this->_vars['volist']['gimg']; ?>
">
							</a>
						</div>
						<div class="p-name"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
						<div class="p-price">
							<strong><em>￥</em><?php echo $this->_vars['volist']['gprice']/100; ?>
</strong>
							<s class="none">￥</s>
						</div>
						<a class="btn" target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"></a>
					</li>
					<?php endforeach; endif; ?>
					
				</div>

				<div class="i-mc fn-clear fn-hide">
					<?php if (count((array)$this->_vars['a2'])): foreach ((array)$this->_vars['a2'] as $this->_vars['volist']): ?>
					<li class="fore1">
						<div class="p-img">
							<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>">
								<img src="<?php echo $this->_vars['volist']['gimg']; ?>
">
							</a>
						</div>
						<div class="p-name"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
						<div class="p-price">
							<strong><em>￥</em><?php echo $this->_vars['volist']['gprice']/100; ?>
</strong>
							<s class="none">￥</s>
						</div>
						<a class="btn" target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"></a>
					</li>
					<?php endforeach; endif; ?>
				</div>
	
				<div class="i-mc fn-clear fn-hide">
					<?php if (count((array)$this->_vars['a3'])): foreach ((array)$this->_vars['a3'] as $this->_vars['volist']): ?>
					<li class="fore1">
						<div class="p-img">
							<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>">
								<img src="<?php echo $this->_vars['volist']['gimg']; ?>
">
							</a>
						</div>
						<div class="p-name"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
						<div class="p-price">
							<strong><em>￥</em><?php echo $this->_vars['volist']['gprice']/100; ?>
</strong>
							<s class="none">￥</s>
						</div>
						<a class="btn" target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['pid'] . ""), $this);?>"></a>
					</li>
					<?php endforeach; endif; ?>
				</div>