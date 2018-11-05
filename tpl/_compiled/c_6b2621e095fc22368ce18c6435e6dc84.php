<?php /* "tpl/templets/default/hot.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:04:46 �й���׼ʱ�� */ ?>




<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['list']): ?>
			<dl>
				<div class="i-m">
					<dt style="border-left-color:"><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['list']['catid'] . ""), $this);?>"><?php echo $this->_vars['list']['catname']; ?>
</a></dt>
					<dd class="fn-clear">
						<ul class="fn-clear">
							<?php $this->assign('hotcatep', vo_list("fun=@!getcategoryproduct!@ mod=@!index!@ type=@!im!@  param1=@!{$this->_vars['list']['catid']}!@")); ?>
							
						
						
							<?php if (count((array)$this->_vars['hotcatep']['hot'])): foreach ((array)$this->_vars['hotcatep']['hot'] as $this->_vars['k'] => $this->_vars['volist']): ?>
						<?php  $this->_vars['i']=$this->_vars['k']+1; ?>
							<li class="fore<?php echo $this->_vars['i']; ?>
">
								<div class="p-img">
									<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">
										<img src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
">
									</a>
								</div>
								<div class="p-name">
								<a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
							</li>
							<?php endforeach; endif; ?>
						
						</ul>
						<ul class="cat fn-clear">
							
						
							<?php if (count((array)$this->_vars['hotcatep']['cat'])): foreach ((array)$this->_vars['hotcatep']['cat'] as $this->_vars['list']): ?>
							<li><a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['list']['catid'] . ""), $this);?>"><?php echo $this->_vars['list']['catname']; ?>
</a></li>
							<?php endforeach; endif; ?>
						
						</ul>        
					</dd>
				</div>
			</dl>
			<?php endforeach; endif; ?>