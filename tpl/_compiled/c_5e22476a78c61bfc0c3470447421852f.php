<?php /* "/tpl/shop/menutop.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:33 �й���׼ʱ�� */ ?>


<div class="menu clearfix">
    <ul>
        		<li class="first selected"><a href="<?php echo url(array('mod' => 'shop'), $this);?>"><span>我是卖家</span></a></li>
        	
            </ul>
	<a target="_blank" href="<?php echo url(array('group' => 'pay','mod' => 'index'), $this);?>" class="payment"><span>我的钱包</span></a>
	<a target="_blank" href="<?php echo url(array('mod' => 'shop','action' => 'show','group' => 'index','args' => "id:" . $this->_vars['user']['muid'] . ""), $this);?>" class="mytb"><span>我的店铺</span></a>
</div>