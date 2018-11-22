<?php /* "ngtpl[start]:tpl/mtpl/category_level2.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:48:57 */ ?>


<link href="<?php echo $this->_vars['indextpl']; ?>
css/category.css" rel="stylesheet" type="text/css" />





	<div id="branchList" >
		<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
		<div class="category-div cur">
			
			<h4><?php echo $this->_vars['volist']['catname']; ?>
</h4>
			<ul class="category-style">
				<?php $this->assign('cat3', \ng169\hook\vo_list("mod=@!product_category!@ array=@!'flag:0,depth:3,parentid:'{$this->_vars['volist']['catid']}!@} fun=@!get_all!@")); ?>
					<?php if (count((array)$this->_vars['cat3'])): foreach ((array)$this->_vars['cat3'] as $this->_vars['volist3']): ?>
				<li>
					<a class="catname" target="_blank"  href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['volist3']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist3']['catname']; ?>

					</a>
				</li><?php endforeach; endif; ?>
				<div style="clear:both"></div>
			</ul>
			
		</div>
	<?php endforeach; endif; ?>
	<div style="clear:both;margin-bottom:150px"></div>
	</div>










