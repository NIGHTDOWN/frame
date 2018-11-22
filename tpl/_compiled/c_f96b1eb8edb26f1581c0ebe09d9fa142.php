<?php require_once('D:\work2\source\core\template\src\plugins\modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  /* "ngtpl[start]:tpl/user/pay_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:46:19 */ ?>



  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pframe.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	
		<div class="fn-right">
<div class="block fn-clear">
	<div class="i-block payment">
        
        <div class="title">
       		<span class="money"><strong><?php echo $this->_vars['money']/100; ?>
</strong>元</span>
        	<div>
        	<?php  $this->_vars['num']=sizeof($this->_vars['data']); ?>
        	<?php if ($this->_vars['num'] > 1): ?>
            <h3>合并|<?php echo $this->_vars['num']; ?>
笔订单</h3>
            <div class="showorderinfo"><a href="#">订单详情</a></div>
           <script>
           	$(function(){
           		$('.showorderinfo').click(function(){
           			$('#orderinfo').toggle();
           			
           			
           		});
           		
           		
           		
           	});
           </script>
             <div  id='orderinfo'  style='display:none'>
            <?php else: ?>
             <div id='orderinfo' >
            <?php endif; ?>
           
            <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
            <p> <div class="ordernum">订单【<?php echo $this->_vars['volist']['ordernum']; ?>
】(担保交易)</div> 
            <span>店铺名称：<?php echo $this->_vars['volist']['merchantname']; ?>
</span> 
          <span>【<?php echo $this->_run_modifier($this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1), 'truncate', 'plugin', 1, '25'); ?>
...】</span> 
            </p>
           
            <?php endforeach; endif; ?>
             </div>
            </div>
        </div>
		<style>
			[tag='not']{ background-color: #ddd;}
		</style>
                <div class="form">
        <form method="post">
        <input type="hidden" name="act" value="pay">
       
            <fieldset>
            <dl>
                <dt>支付方式：</dt>
                <dd class="pay">
                 
             
                    <ul class="fn-clear">
                    <li >
                    <img <?php if ($this->_vars['user']['cash'] < $this->_vars['money']): ?>tag='not'<?php endif; ?> title="余额支付" style='width:158px;height:45px' alt="余额支付" data-param="{'id':'-1'}" src="<?php echo $this->_vars['usertpl']; ?>
res/bank/yuer.png"><i></i>
                    </li>
                    <?php if (count((array)$this->_vars['api'])): foreach ((array)$this->_vars['api'] as $this->_vars['i'] => $this->_vars['volist']): ?>
                    <?php if ($this->_vars['i'] == 0): ?> <input type="hidden" name="payment_type" value="<?php echo $this->_vars['volist']['apiid']; ?>
" ><?php endif; ?>
                     <li <?php if ($this->_vars['i'] == 0): ?>class="checked"<?php endif; ?>>
                    <img title="<?php echo $this->_vars['volist']['name']; ?>
" style='width:158px;height:45px' alt="<?php echo $this->_vars['volist']['name']; ?>
" data-param="{'id':'<?php echo $this->_vars['volist']['apiid']; ?>
'}" src="<?php echo $this->_vars['volist']['logo']; ?>
"><i></i>
                    </li>
                    <?php endforeach; endif; ?>
                    </ul>
                </dd>
            </dl> 
            </fieldset>
                        <dl>
                <dt></dt>
                <dd>
                <input type="submit" class="submit" value="确定支付">
                </dd>
            </dl>
        </form>   
        </div>
            
    </div>
</div>
   	</div> 
<script>
$(".pay li").bind("click",function(){
	$tag=$(this).children('img').attr('tag');
	if($tag=='not'){
		alert('余额不足，请使用其他方式支付');return false;
	}
	var data = $(this).children('img').attr('data-param');
	eval("data = "+data);
		$("[name=payment_type]").val(data.id);
	$(this).addClass("checked").siblings().removeClass("checked");
});
</script>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	


