<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/shop/set_kf.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:35:39 �й���׼ʱ�� */ ?>



<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menutop.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<div class="layout">
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."leftmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
	<div class="right_content">



		<div class="path">
			<div> <a href="<?php echo url(array('mod' => 'shop','action' => 'run'), $this);?>">卖家中心</a> <span>&gt;</span> <a href="<?php echo url(array('mod' => 'set','action' => 'run'), $this);?>">店铺设置</a> <span>&gt;</span> 客服设置</div>
		</div>


		<DIV class=main sizcache="1" sizset="5"><DIV class=wrap sizcache="1" sizset="5">
				<DIV class=hd>
					<UL class=tabs>
					
						<LI class=normal><A href="<?php echo url(array('action' => 'run'), $this);?>">店铺设置</A></LI>
						<LI class=normal><A href="<?php echo url(array('action' => 'mobile'), $this);?>">手机店铺设置</A></LI>
						<LI class=active><A href="<?php echo url(array('action' => 'kf'), $this);?>">客服中心</A></LI>
					
					</UL></DIV>
				
				<DIV class="form-style cs" sizcache="1" sizset="5">
				<FORM id=form method=post action="" sizcache="1" sizset="5">
				
						<DL sizcache="0" sizset="5" genre="pre">
							
							<DD>
								<DIV class=cs_title><SPAN class=name>客服名称</SPAN> 
								<SPAN class=tool>客服工具</SPAN> 
								<SPAN class=number>客服账号</SPAN>
								<SPAN class=number>客服工作时间</SPAN></DIV>
								<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['k'] => $this->_vars['volist']): ?>
								<DIV class=cs_list>
								<SPAN class=name>
								<INPUT value="<?php echo $this->_vars['volist']['name']; ?>
" class="text w60" name=name[o<?php echo $this->_vars['k']; ?>
] maxLength=10 ></SPAN>
								<INPUT value="<?php echo $this->_vars['volist']['kfid']; ?>
" type="hidden" class="text w60" name=kfid[o<?php echo $this->_vars['k']; ?>
]  >
								<SPAN class=tool>
								<SELECT name=type[o<?php echo $this->_vars['k']; ?>
]> 
								<OPTION <?php if ($this->_vars['volist']['type'] == 3): ?>selected<?php endif; ?> value=3>乐沟通</OPTION>
								<OPTION <?php if ($this->_vars['volist']['type'] == 0): ?>selected<?php endif; ?> value=0>QQ</OPTION> 
								<OPTION <?php if ($this->_vars['volist']['type'] == 1): ?>selected<?php endif; ?> value=1>旺旺</OPTION>
								<OPTION <?php if ($this->_vars['volist']['type'] == 2): ?>selected<?php endif; ?> value=2>手机</OPTION>		
										
								</SELECT>
								</SPAN>
								<SPAN class=number><INPUT value="<?php echo $this->_vars['volist']['num']; ?>
" class="text w160 " name=num[o<?php echo $this->_vars['k']; ?>
]></SPAN>
								<SPAN class=><INPUT value="<?php echo $this->_run_modifier($this->_vars['volist']['stime'], 'date_format', 'plugin', 1, "%H:%M"); ?>
" class="text w80 time" name=stime[o<?php echo $this->_vars['k']; ?>
]></SPAN>
								<SPAN class=><INPUT value="<?php echo $this->_run_modifier($this->_vars['volist']['etime'], 'date_format', 'plugin', 1, "%H:%M"); ?>
" class="text w80 time" name=etime[o<?php echo $this->_vars['k']; ?>
]></SPAN>
								<SPAN class=del><A class=btn2  href="#" onclick="delkf($(this),<?php echo $this->_vars['volist']['kfid']; ?>
);" >删除</A></SPAN></DIV>
								<?php endforeach; endif; ?>
								<?php if ($this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) == 0): ?>
								<DIV class=cs_list>
								<SPAN class=name>
								<INPUT value="" class="text w60" name=name[] maxLength=10 value=''></SPAN>
								<SPAN class=tool>
								<SELECT name=type[]> 
								<OPTION selected value=3>乐沟通</OPTION>
								<OPTION  value=0>QQ</OPTION> 
								<OPTION value=1>旺旺</OPTION>
								<OPTION value=2>手机</OPTION></SELECT>
								</SPAN>
								<SPAN class=number><INPUT value="" class="text w160 " name=num[]></SPAN>
								<SPAN class=><INPUT value="" class="text w80 time" name=stime[]></SPAN>
								<SPAN class=><INPUT value="" class="text w80 time" name=etime[]></SPAN>
								<SPAN class=del><A class=btn2 onclick="delkf($(this),0);" href='###' >删除</A></SPAN></DIV>
								<?php endif; ?>
								</DD>
								<P><A class=btn2 onclick="addkf();" href="javascript:void(0);">添加客服</A></P>
								</DL>
					
						
						<DL class=foot sizcache="0" sizset="8">
							<DT>&nbsp;</DT>
							<DD><INPUT style="" class=submit value=提交 type=submit></DD></DL></FORM></DIV>
				
				
			</DIV></DIV>

	</div>
	<div class="clear"></div>
</div>
<script>
function delkf($obj,$id){
	$ob=$obj.closest('.cs_list');
	$ob.remove();
	if($id){
		$.post('<?php echo url(array('action' => 'del'), $this);?>',{'kfid':$id});
	}
}

	function addkf(){
		$('[genre="pre"]').find('dd').append($('box').html());
	}
	
</script>
<box style='display:none'>
	<DIV class=cs_list>
								<SPAN class=name>
								<INPUT value="" class="text w60" name=name[] maxLength=10 value=''></SPAN>
								<SPAN class=tool>
								<SELECT name=type[]> 
								<OPTION selected value=3>乐沟通</OPTION> 
								<OPTION  value=0>QQ</OPTION> 
								<OPTION value=1>旺旺</OPTION>
								<OPTION value=2>手机</OPTION></SELECT>
								</SPAN>
								<SPAN class=number><INPUT value="" class="text w160 " name=num[]></SPAN>
								<SPAN class=><INPUT value="" class="text w80 time" name=stime[]></SPAN>
								<SPAN class=><INPUT value="" class="text w80 time" name=etime[]></SPAN>
								<SPAN class=del><A class=btn2 onclick="delkf($(this),0);" href='###' >删除</A></SPAN></DIV>
	
</box>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>