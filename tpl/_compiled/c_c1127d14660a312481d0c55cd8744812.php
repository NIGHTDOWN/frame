<?php /* "ngtpl[start]:/tpl/user//left.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:37:17 */ ?>

<div class="left_con">
					<dl class="user">
						<dd>
							<div class="pic">
								<a href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>"><?php if ($this->_vars['user']['headimg']): ?>
								<img height="100" width="100" src="<?php echo $this->_vars['user']['headimg']; ?>
"><?php else: ?>
									<img height="100" width="100" src="<?php echo $this->_vars['usertpl']; ?>
res/avatar.png">
									<?php endif; ?>
								</a>
							</div>
						</dd>
					</dl>
               
					<div class="business_handle" id="my_menu">
						<h3>交易操作</h3>
						<div <?php if ($this->_vars['c'] == 'order'): ?>class="active"<?php endif; ?>><em class="i1"></em><a href="<?php echo \ng169\hook\url(array('mod' => 'order'), $this);?>">已买到的商品</a></div>
						   
				<!--		<div class="normal"><em class="i2"></em><a href="">我的代金券</a></div>
						   
						<div class="normal"><em class="i3"></em><a href="">我的会员卡</a></div>-->
						   
						<dl>
							<dt><em class="i4"></em><a href="javascript:void(0)">我的收藏</a></dt>
							<dd <?php if ($this->_vars['c'] == 'collect' && $this->_vars['a'] == 'product'): ?>class="active"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'collect','action' => 'product'), $this);?>">收藏商品</a>
							</dd>
							<dd <?php if ($this->_vars['c'] == 'collect' && $this->_vars['a'] == 'shop'): ?>class="active"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'collect','action' => 'shop'), $this);?>">收藏店铺</a>
							</dd>
							<dd <?php if ($this->_vars['c'] == 'collect' && $this->_vars['a'] == 'history'): ?>class="active"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'collect','action' => 'history'), $this);?>">我的足迹</a>
							</dd>
						</dl>
                           
						<dl>
							<dt><em class="i5"></em><a href="javascript:void(0)">我的积分</a></dt>
							<dd <?php if ($this->_vars['c'] == 'jf' && $this->_vars['a'] == 'run'): ?>class="active"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'jf'), $this);?>">积分明细</a>
							</dd>
							<dd <?php if ($this->_vars['c'] == 'jf' && $this->_vars['a'] == 'product'): ?>class="active"<?php endif; ?>><a href="<?php echo \ng169\hook\url(array('mod' => 'jf','action' => 'product'), $this);?>">已兑换的商品</a>
							</dd>
						</dl>
                           
						<div <?php if ($this->_vars['c'] == 'comment'): ?>class="active"<?php endif; ?>><em class="i6"></em><a href="<?php echo \ng169\hook\url(array('mod' => 'comment'), $this);?>">评价管理</a></div>
						   
					<!--	<dl>
							<dt><em class="i7"></em><a href="javascript:void(0)">咨询与维权</a></dt>
							<dd class="normal"><a href="">我的咨询</a>
							</dd>
						</dl>-->
                           
					</div>
				</div>