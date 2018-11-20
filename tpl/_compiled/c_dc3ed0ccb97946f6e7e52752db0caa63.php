<?php require_once('D:\work2\source\core\template\src\plugins\modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  /* "ngtpl[start]:tpl/templets/default/cartasyn.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 16:26:23 */ ?>




            	<div class="nav-fore1">
                	<a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'cart'), $this);?>">
                    <span>购物车</span><font><?php  echo ng169\hook\vo_list("fun=@!getcount!@ mod=@!cart!@ type=@!im!@"); ?></font>件
                    </a>
                    <i><em></em></i>
                </div>
               <div class="nav-fore2">
               <?php $this->assign('cartlist', \ng169\hook\vo_list("fun=@!getlist!@ mod=@!cart!@ type=@!im!@")); ?>
               <?php $this->assign('sum', \ng169\hook\vo_list("fun=@!get_count!@ mod=@!cart!@ args=@!'uid:'{$this->_vars['user']['uid']}!@}")); ?>
               <ul><?php if ($this->_vars['cartlist']): ?>
               <?php if (count((array)$this->_vars['cartlist'])): foreach ((array)$this->_vars['cartlist'] as $this->_vars['volist']): ?>
               <li class="fn-clear ">
					<div class="mini-cart-img"><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><img width="40" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '60,60'); ?>
"></a></div>
					<div class="mini-cart-title"><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','group' => 'index','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1), 'truncate', 'plugin', 1, 15); ?>
...</a></div>
					<div class="mini-cart-count"><b><?php echo $this->_vars['volist']['specs']; ?>
</b> <span><?php echo $this->_vars['volist']['nowprice']/100; ?>
</span><m>￥</m></div>
					</li>
               <?php endforeach; endif; ?>
               <?php if (( $this->_run_modifier($this->_vars['cartlist'], 'sizeof', 'PHP', 1) ) < $this->_vars['sum']): ?>
              
                 <li class="first">您的购物车还有<?php echo $this->_vars['sum']-($this->_run_modifier($this->_vars['cartlist'], 'sizeof', 'PHP', 1)); ?>
件商品未显示<p></p>
             <a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'cart'), $this);?>">查看我的购物车</a>   	
                 </li>
                 <?php endif; ?>
               <?php else: ?>
                 <li class="first">您购物车里还没有任何宝贝。</li>
               <?php endif; ?>
             </ul></div>
           
  