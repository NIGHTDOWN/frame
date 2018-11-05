<?php /* "/tpl/mtpl/shopfoot.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 20:58:54 �й���׼ʱ�� */ ?>

<div style="clear:both;margin-bottom:1rem" ></div>
<div class="tm-btm-menu J_btmMenuCtn tm-mdv"  style="bottom: 0px;">
		<ul class="tm-btm-menu-list muicell">

			<li class="menu-item-index-0 menu-item muicell center  ">

				<a href="<?php echo url(array('mod' => 'shop','args' => "id:" . $this->_vars['data']['muid'] . "",'action' => 'search'), $this);?>"
				 target="_self">
					商品分类
				</a>


			</li>

			<li class="menu-item-index-1 menu-item muicell center  " id="xskf">

				<a href="javascript:void();" target="_self">
					咨询客服
				</a>


			</li>

		

		</ul>
	</div>

</div>







</div>












</div>



<?php $this->assign('kf', vo_list("fun=@!get!@ type=@!im!@ mod=@!kf!@   param1=@!{$this->_vars['data']['muid']}!@")); ?>

<div class="kf kf2" style='display: none'>
		<?php if (count((array)$this->_vars['kf'])): foreach ((array)$this->_vars['kf'] as $this->_vars['vkf']): ?>
		<?php if ($this->_vars['vkf']['type'] == 0): ?>
		
		<li onclick="_go_url('mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $this->_vars['vkf']['num']; ?>
')">
		<i class='qq'></i>
		<div class="kfr"><span>称呼：<?php echo $this->_vars['vkf']['name']; ?>
</span>
		<span><b><?php echo $this->_vars['vkf']['num']; ?>
</b></span></div>
		</li>
		<?php elseif ($this->_vars['vkf']['type'] == 1): ?>
		<li onclick="_go_url('http://www.taobao.com/webww/ww.php?ver=3&amp;touid=<?php echo $this->_vars['vkf']['num']; ?>
&amp;siteid=<?php echo $this->_vars['config']['site_url']; ?>
&amp;status=1&amp;charset=utf-8')">
		<i class='ww'></i>
		<div class="kfr"><span>称呼：<?php echo $this->_vars['vkf']['name']; ?>
</span>
		<span><b><?php echo $this->_vars['vkf']['num']; ?>
</b></span></div>
		</li>
		
		
		
		<?php elseif ($this->_vars['vkf']['type'] == 2): ?>
		<li onclick="_go_url('tel: <?php echo $this->_vars['vkf']['num']; ?>
')">
		<i class='mobile'></i>
		<div class="kfr"><span>称呼：<?php echo $this->_vars['vkf']['name']; ?>
</span>
		<span><b><?php echo $this->_vars['vkf']['num']; ?>
</b></span></div>
		</li>
		<?php elseif ($this->_vars['vkf']['type'] == 3): ?>
<li onclick="_go_url('<?php echo url(array('mod' => 'msg','action' => 'cheat','group' => 'user','args' => "user:" . $this->_vars['vkf']['num'] . ""), $this);?>')">
		<i class='ygt'></i>
		<div class="kfr"><span>称呼：<?php echo $this->_vars['vkf']['name']; ?>
</span>
		<span><b><?php echo $this->_vars['vkf']['num']; ?>
</b></span></div>
		</li>
				
		
		<?php endif; ?>
		<?php endforeach; endif; ?>	
		</div>









</div>

</div>
<script>
	function getfavshop($id)
			{	
				var url = '<?php echo url(array('mod' => 'shop','action' => 'collect'), $this);?>';
	
				var uname='霓光网络有限公司';
				if(uname=='')
				{
					alert('请登录以后再进行本操作！');
					window.location.href='<?php echo url(array('mod' => 'login','action' => 'run'), $this);?>';
					return false;
				}
				
				/*$.post(url, pars,showResponse);*/
				yAjax(url,{'muid':$id},showResponse);
				function showResponse(data)
				{
					if(data.flag){
						showd(data.data);
					}else{
						showd(data.error.errormsg);
					}
				}}
				$('.collect-btn').live('click',function(){
					getfavshop('<?php echo $this->_vars['data']['muid']; ?>
');
				});
				$('#xskf').live('click',function(){
					$('.kf').toggle();
					
				});
</script>