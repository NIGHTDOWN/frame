<?php /* "tpl/muser/set_addaddress.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 00:44:01 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/user.css" rel="stylesheet" type="text/css" />
<script>
	_ajax_file_url="<?php echo url(array('mod' => 'upimg'), $this);?>";
</script>
<script type="text/javascript" src="<?php echo $this->_vars['staticjs']; ?>
ajaxfileupload.js"></script>

<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="history.back();" class="jd-header-icon-back ">
									<span></span>
								</div>
								<form action="<?php echo url(array('mod' => 'search','action' => 'run'), $this);?>" method="POST">


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">添加地址</span>

										</div>
									</div>
								</form>
								<div onclick="_go_url('<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>



					<form method="POST" action="" >

				
					
					<section class="order-act" >
							
					
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">收货人</span>
								</div>
								
								<div class="next">
										<input type="text" class="wtext w1" tag='notnull  ' name='realname' value=''>
									
									</div>
										

						</div>
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">区域</span>
								</div>
								
								<div class="next">
										  <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!province!@ field=@!provinceID,province!@ array=@!flag:0!@")); ?>
										  <select name='provinceid' class='wtext w3'>
												<option value='0'>-请选择-</option>
											   <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
											  
											   <option value='<?php echo $this->_vars['volist']['provinceID']; ?>
'
												   <?php if ($this->_vars['data']['provinceid'] == $this->_vars['volist']['provinceID']): ?>
												 selected="selected"
															   <?php endif; ?>
												   >
												   <?php echo $this->_vars['volist']['province']; ?>
</option>
											   <?php endforeach; endif; ?>
										   </select>
											
											<?php if ($this->_vars['data']['cityid']): ?>
											 <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!city!@ field=@!cityID,city!@ array=@!'flag:0,fatherID:'{$this->_vars['data']['provinceid']}!@}")); ?>
										   <select name='cityid' class='wtext w3'>
												 <option value='0'>-请选择-</option>
											   <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
											   <option value='<?php echo $this->_vars['volist']['cityID']; ?>
'
												   <?php if ($this->_vars['data']['cityid'] == $this->_vars['volist']['cityID']): ?>
												 selected="selected"
															   <?php endif; ?>
												   >
												   
												   
												   <?php echo $this->_vars['volist']['city']; ?>
</option>
											   <?php endforeach; endif; ?>
										   </select>
											<?php endif; ?>
											<?php if ($this->_vars['data']['areaid']): ?>
											 <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!area!@ field=@!areaID,area!@ array=@!'flag:0,fatherID:'{$this->_vars['data']['cityid']}!@}")); ?>
										   <select name='areaid' class='wtext w3'>
											  <option value='0'>-请选择-</option>
											   <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
											   <option value='<?php echo $this->_vars['volist']['areaID']; ?>
'
												   <?php if ($this->_vars['data']['areaid'] == $this->_vars['volist']['areaID']): ?>
												 selected="selected"
															   <?php endif; ?>
												   >
												   <?php echo $this->_vars['volist']['area']; ?>
</option>
											   <?php endforeach; endif; ?>
										   </select>
											<?php endif; ?>  
									
									</div>
										

						</div>
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">街道地址</span>
								</div>
								
								<div class="next">
										<input type="text" class="wtext w1" tag='notnull  ' name='address' value=''>
									
									</div>
										

						</div>
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">手机号码</span>
								</div>
								
								<div class="next">
										<input type="text" class="wtext w1" tag='notnull  ismobile' name='recvmobile' value=''>
									
									</div>
										

						</div>
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">邮政编码</span>
								</div>
								
								<div class="next">
										<input type="text" class="wtext w1" tag='notnull  ' name='recvnum' value=''>
									
									</div>
										

						</div>
						<div class="label4" >
									
										
								<div class="title">
									<span class="tl">默认地址</span>
								</div>
								
								<div class="next">
										<select name='mflag' class="wtext w1">
											<option value="0">否</option>
											<option value="1">是</option>
										</select>
									
									</div>
										

						</div>
					</section>
				
					<button class='btn save'  type="submit"  >确认添加</button>
						<div style="clear:both;margin-bottom:1rem"></div>
				</form>
				</div>







			</div>


			<script>
					$cityurl='<?php echo url(array('action' => 'city','group' => 'index','mod' => 'merchant'), $this);?>';
					$areaurl='<?php echo url(array('action' => 'area','group' => 'index','mod' => 'merchant'), $this);?>';
					$(function(){
						$("[name='provinceid']").change(function(){
							yAjax($cityurl,{provinceid:$(this).val()},function($data){
								if($data.flag){
									$html='';
									$.each($data.data,function(i,v){
										$html+='<option value='+v.cityID+'>'+v.city+'</option>';
									});
									
									if($("[name='cityid']").get(0)){
										$("[name='cityid']").html($html);	
									}else{
										$html="<select name='cityid' class='wtext w3'>"+$html+'</select>';
									$("[name='provinceid']").after($html);	
									}
								}else{
									showd('数据获取失败');
								}
							});
						});
						
						$("[name='cityid']").live('change',function(){
							yAjax($areaurl,{cityid:$(this).val()},function($data){
								if($data.flag){
									$html='';
									$.each($data.data,function(i,v){
										$html+='<option value='+v.areaID+'>'+v.area+'</option>';
									});
									
									if($("[name='areaid']").get(0)){
										$("[name='areaid']").html($html);	
									}else{
										$html="<select name='areaid' class='wtext w3'>"+$html+'</select>';
									$("[name='cityid']").after($html);	
									}
		 
								}else{
									showd('数据获取失败');
								}
							});
						});
						
						
						
						
					});
						
					</script>
				








		</div>












	</div>

	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>