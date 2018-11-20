<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/templets/default/order_list.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 10:29:49 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."phead.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

	
					
				
					<div id="deal-record" class="i-con ">
					<table width="100%" cellpadding="0" cellspacing="0" class="record">
						
							<tbody>
							<?php if (( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
							<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
								<tr>
									<td class="pl15"><?php echo $this->_vars['volist']['username']; ?>
</td>
									<td><?php echo $this->_vars['volist']['subtotal']/100; ?>
</td>
									<td><?php echo $this->_vars['volist']['num']; ?>
</td>
									<td><?php echo $this->_run_modifier($this->_vars['volist']['paytime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</td>
									<td><?php echo $this->_vars['volist']['spec']; ?>
</td>
								</tr>
								<?php endforeach; endif;  else: ?>
								<tr>
									<td class="no-result" colspan="5">暂时还没有买家购买此商品</td>
								</tr>
<?php endif; ?>
							</tbody>  
						</table>
						<?php if (( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
						<div class="pages"><?php echo $this->_vars['page']; ?>
</div>
						<?php endif; ?>
					</div>
					
					
			