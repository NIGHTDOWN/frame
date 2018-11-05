<?php require_once('E:\www\ng169\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/templets/default/comment_list.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:21 �й���׼ʱ�� */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."phead.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

	
					
					<div id="reviews" class="i-con ">
						<div class="reviews-hd">
							
							<div class="reviews-hd-fore2">
								<div class="filter clearfix">
									<ul>
										
										<li><label><input type="radio" name="reviews-type" <?php if ($this->_vars['im'] == 0 && $this->_vars['cm'] == -1): ?>checked="checked"<?php endif; ?> value="<?php echo url(array('action' => 'list','mod' => 'comment','args' => "productid:" . $this->_vars['get']['productid'] . ""), $this);?>"><span>全部</span></label></li>
										<li><label><input  <?php if (( $this->_vars['get']['cmlevel'] ) == 1): ?>checked="checked"<?php endif; ?> type="radio" name="reviews-type" value="<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:1,productid:" . $this->_vars['get']['productid'] . ""), $this);?>"><span>好评</span></label></li>
										<li><label><input <?php if (( $this->_vars['get']['img'] ) == 1): ?>checked="checked"<?php endif; ?> type="radio" name="reviews-type" value="<?php echo url(array('action' => 'list','mod' => 'comment','args' => "img:1,productid:" . $this->_vars['get']['productid'] . ""), $this);?>"><span>图片</span></label></li>
										<li><label><input <?php if ($this->_vars['im'] == 0 && $this->_vars['cm'] == 0): ?>checked="checked"<?php endif; ?> type="radio" name="reviews-type" value="<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:0,productid:" . $this->_vars['get']['productid'] . ""), $this);?>"><span>中评</span></label></li>
										<li><label><input <?php if (( $this->_vars['get']['cmlevel'] ) == 2): ?>checked="checked"<?php endif; ?> type="radio" name="reviews-type" value="<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:2,productid:" . $this->_vars['get']['productid'] . ""), $this);?>"><span>差评</span></label></li>
									</ul>
								</div>
							</div>
						</div>
						<?php if (( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
						
						<div class="reviews-bd clearfix">
<ul>
<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
    <li class="clearfix">
        <div class="buyer">
            <div class="avatar">
                <span>
                    <img width="40" height="40" src="<?php echo $this->_vars['volist']['headimg']; ?>
"><br>
                    <span><?php echo $this->_run_modifier($this->_vars['volist']['username'], 'incode', 'PHP', 1); ?>
</span>
                </span><br>
                <img src="<?php  echo vo_list(fun); ?>}")}-->">
            </div>
        </div>
        <dl>
            <dt class="buyerconten"><span><?php echo $this->_vars['volist']['cmcontent']; ?>
</span>
            <span>
            <?php if ($this->_vars['volist']['cmimg']): ?>
            <?php  $this->_vars['t']=explode(',',$this->_vars['volist']['cmimg']); ?>
            	<?php if (count((array)$this->_vars['t'])): foreach ((array)$this->_vars['t'] as $this->_vars['value']): ?>
            	<img src='<?php echo $this->_run_modifier($this->_vars['value'], 'imgsize', 'PHP', 1, '60,60'); ?>
'  onclick="window.open('<?php echo $this->_vars['value']; ?>
')" />
            	<?php endforeach; endif; ?>
            	<?php endif; ?>
            </span>
            </dt>
            <dd><?php echo $this->_run_modifier($this->_vars['volist']['cmtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
 <span style="margin-left: 20px"><?php echo $this->_vars['volist']['specs']; ?>
</span></dd>
        </dl>
    </li>
<?php endforeach; endif; ?>
</ul>
<div class="pages"> <?php echo $this->_vars['page']; ?>
  </div>
</div>
<?php else: ?>
						<div class="reviews-bd clearfix">
							<ul>
								<li class="no-result">没有找到结果</li>
							</ul>
							<div class="pages"></div>
						</div>
<?php endif; ?>
					</div>
			<script>
				$(function(){
					$('[name=reviews-type]').change(function(){
						location.href=$(this).val();
						
					});
					
				});
				
			</script>		
					
					
			