<?php /* "tpl/shop/set_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:35:38 �й���׼ʱ�� */ ?>



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
	
	<div class="right_content"><script src="script/my_lightbox.js"></script>



		<div class="path">
			<div> <a href="<?php echo url(array('mod' => 'shop','action' => 'run'), $this);?>">卖家中心</a> <span>&gt;</span> <a href="<?php echo url(array('mod' => 'set','action' => 'run'), $this);?>">店铺设置</a> <span>&gt;</span> 店铺设置</div>
		</div>


		<DIV class=main sizcache="1" sizset="5"><DIV class=wrap sizcache="1" sizset="5">
				<DIV class=hd>
					<UL class=tabs>
					
						<LI class=active><A href="<?php echo url(array('action' => 'run'), $this);?>">店铺设置</A></LI>
						<LI class=normal><A href="<?php echo url(array('action' => 'mobile'), $this);?>">手机店铺设置</A></LI>
						<LI class=normal><A href="<?php echo url(array('action' => 'kf'), $this);?>">客服中心</A></LI>
						
						</UL></DIV>
				<DIV class=form-style sizcache="1" sizset="5">
					<FORM id=form method=post action=''>
					
						<DL sizcache="0" sizset="5">
							<DT><EM>*</EM>店铺名称：</DT>
							<DD>
								<P><INPUT style="" id=company class="w400 text" tag='notnull in' max='10' min='2' name='merchantname' value='<?php echo $this->_vars['user']['merchantname']; ?>
'></P>
								<P class=hint>店铺名称请控制长度不超过10字</P></DD></DL>
						<DL sizcache="0" sizset="6">
							<DT>主营商品：</DT>
							<DD>
								<P><TEXTAREA id=main_pro class="textarea w394"  name=licence><?php echo $this->_vars['user']['licence']; ?>
</TEXTAREA></P>
								<P class=hint>主营商品关键字（Tag）有助于搜索店铺时找到您的店铺<BR>关键字最多可输入50字，请用","进行分隔，例如”男装,女装,童装”</P></DD></DL>
						<DL sizcache="0" sizset="7">
							<DT>店铺分类：</DT>
							<DD>
								<P><?php echo $this->_vars['data']['catname']; ?>
</P></DD></DL>
						<DL sizcache="0" sizset="8">
							<DT>店铺logo：</DT>
							<DD style="position: relative">
								
								
								<button type='button' id=upload-button class="logo" value="" tag='img_up_one' >上传</button>
								<span id="viewimg_logo" class='pic'>
								<?php if ($this->_vars['data']['logo']): ?>
								<div style="float:left;width:auto;"><div class="upimg_view" style="height:80px;width:80px;overflow:hidden;cursor:pointer;margin-top:5px;"><img alt="点击查看大图" src="<?php echo $this->_vars['data']['logo']; ?>
" width="80px" onclick="window.open('<?php echo $this->_vars['data']['logo']; ?>
');" style="height: 71px; width: 80px; margin-top: 4.5px; margin-left: 0px;"> </div><input type="hidden" value="<?php echo $this->_vars['data']['logo']; ?>
" name="logo"> <button type="button" style=" background: none repeat scroll 0 0 #fafafa; border: 1px solid #ebebeb;border-radius: 3px; cursor: pointer;display: block;margin-top: 10px;width: 80px;" onclick="javascript:delobj($(this).parent('div'));">删除</button></div>
								<?php endif; ?>
								</span>
								
								
								<P class=hint>此处为您的店铺logo，将显示在店铺Logo栏里；<BR>
								<SPAN style="COLOR: orange">建议使用宽200像素-高60像素内的GIF或PNG透明图片；点击下方"提交"按钮后生效。</SPAN></P></DD></DL>
						<DL sizcache="0" sizset="9">
							<DT>店铺条幅：</DT>
							<DD style="position: relative"> 
							<button type='button' id=upload-button class="header" value="" tag='img_up_one' >上传</button>
								<span id="viewimg_header" class='pic'>
								<?php if ($this->_vars['data']['header']): ?>
								<div style="float:left;width:auto;"><div class="upimg_view" style="height:80px;width:80px;overflow:hidden;cursor:pointer;margin-top:5px;"><img alt="点击查看大图" src="<?php echo $this->_vars['data']['header']; ?>
" width="80px" onclick="window.open('<?php echo $this->_vars['data']['header']; ?>
');" style="height: 71px; width: 80px; margin-top: 4.5px; margin-left: 0px;"> </div><input type="hidden" value="<?php echo $this->_vars['data']['header']; ?>
" name="header"> <button type="button" style=" background: none repeat scroll 0 0 #fafafa; border: 1px solid #ebebeb;border-radius: 3px; cursor: pointer;display: block;margin-top: 10px;width: 80px;" onclick="javascript:delobj($(this).parent('div'));">删除</button></div>
								<?php endif; ?>
								</span>
								
								<P class=hint>此处为您的店铺条幅，将显示在店铺导航上方的banner位置；<BR><SPAN style="COLOR: orange">建议使用宽961像素*高150像素的图片；点击下方"提交"按钮后生效。</SPAN></P></DD></DL>
					
						<DL sizcache="0" sizset="11">
							<DT><EM>*</EM>所在地区：</DT>
							<dd>
							
                   <script>
           $cityurl='<?php echo url(array('action' => 'city','mod' => 'merchant'), $this);?>';
           $areaurl='<?php echo url(array('action' => 'area','mod' => 'merchant'), $this);?>';
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
           					$html="<select name='cityid'>"+$html+'</select>';
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
           					$html="<select name='areaid'>"+$html+'</select>';
           				$("[name='cityid']").after($html);	
           				}

           			}else{
           				showd('数据获取失败');
           			}
           		});
           	});
           	
           	
           	
           	
           });
           	
           </script>
              <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!province!@ field=@!provinceID,province!@ array=@!flag:0!@")); ?>
            <select name='provinceid'>
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
            <select name='cityid'>
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
            <select name='areaid'>
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
            
			
								
							</dd>
							</DL>
						<DL sizcache="0" sizset="12">
							<DT><EM>*</EM>详细地址：</DT>
							<DD>
								<P><INPUT style="" id=addr class="text w400" name=address maxLength=200 value='<?php echo $this->_vars['data']['address']; ?>
'></P>
								<P class=hint>不必重复填写所在地区</P></DD></DL>
						<DL sizcache="0" sizset="13">
							<DT><EM>*</EM>联系电话：</DT>
							<DD><INPUT style="" id=tel class="text w150" name=phone value='<?php echo $this->_vars['data']['phone']; ?>
'></DD></DL>
						<DL sizcache="0" sizset="14">
							<DT>店铺简介：</DT>
							<DD>
								
							<TEXTAREA style="WIDTH: 100%; DISPLAY: ; HEIGHT: 500px" name=intro ><?php echo $this->_vars['data']['intro']; ?>
</TEXTAREA></DD></DL>
						
						
						<DL sizcache="0" sizset="18">
							<DT>店铺二维码：</DT>
							<DD>
								<P class=pic><IMG src="<?php echo url(array('action' => 'qr'), $this);?>"></P></DD></DL>
						<DL class=foot sizcache="0" sizset="19">
							<DT>&nbsp;</DT>
							<DD><INPUT style="" class=submit tag='submit' value=提交 type='button' ></DD></DL></FORM></DIV></DIV></DIV>

	</div>
	<div class="clear"></div>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>