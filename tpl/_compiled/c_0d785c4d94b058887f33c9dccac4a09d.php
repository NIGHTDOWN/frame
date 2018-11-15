<?php /* "/tpl/templets/default/cart.html" //NG框架模板引擎;仅适用本系统框架; 2018-11-15 16:35:47 �й���׼ʱ�� */ ?>

 <?php if (! $this->_vars['user']): ?>
        	<li class="nav cart drop-down">
            	<div class="nav-fore1">
                	<a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'cart'), $this);?>">
                    <span>购物车</span><font>0</font>件
                    </a>
                    <i><em></em></i>
                </div>
               <div class="nav-fore2">
               <ul><li class="first">您购物车里还没有任何宝贝。</li></ul></div>
            </li>
<?php else: ?>
<script>
		
			$(function(){
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'cart'), $this);?>';
				
				$.get($u,function(data){
					$('#cartysn').append(data);
					
				});
				
			});
		</script>

<li class="nav cart drop-down" id='cartysn'>
            	
            </li>
  <?php endif; ?>  