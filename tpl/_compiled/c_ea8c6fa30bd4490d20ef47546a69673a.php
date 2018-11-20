<?php /* "ngtpl[start]:tpl/templets/default/shop_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 10:43:26 */ ?>

     <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."head.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<style>
	.gray{    background: #fff;}
</style>
<body class="gray">
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

	<script type="text/javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/jquery.flexslider-min.js"></script>
	<link href="<?php echo $this->_vars['indextpl']; ?>
res/skin.css" rel="stylesheet" type="text/css">
	
	<link href="<?php echo $this->_vars['indextpl']; ?>
res/shop.css" rel="stylesheet" type="text/css">
	<div class="w">
    <div class="detailnav">
        <strong><a href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>">首页</a></strong>
        <span> &gt; <a href="<?php echo \ng169\hook\url(array('mod' => 'shop'), $this);?>">店铺</a></span>
    </div>
</div>
<div class="w">
	    <div id="select">
        <dl class="first">
            <dt>分类：</dt>
            <dd>
           
             <div>
                <a href="<?php echo \ng169\hook\url(array('mod' => 'shop'), $this);?>" title="<?php echo $this->_vars['volist']['catid']; ?>
">不限</a>
                </div>
                
            <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
                  <div>
                <a href="<?php echo \ng169\hook\url(array('mod' => 'shop','args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>" title="<?php echo $this->_vars['volist']['catid']; ?>
"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                </div>
<?php endforeach; endif; ?>
                          
                       
                            </dd>
        </dl>
    </div>     
	 
    <div class="itemSearchList">
        <div class="itemSearchResult">
            <div style="position:relative">
                <div class="filter clearfix">
                    <div class="fore1 clearfix">
                     <style>
       .order .up,.order .down{
       	background: #E4393C;
    font-weight: bold;
    color: #FFF;
    border-color: #E4393C;
       }
       	.order .up b{background-position: right -23px;}
		.order .down b{background-position: right -30px;}
       	
       </style> 
                      <div class="order">
                                <a <?php if (! $this->_vars['orderby']['f']): ?>class="current"<?php endif; ?> href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "$wherestring"), $this);?>"><span>默认排序</span></a>
                                
			<a class="<?php if ($this->_vars['orderby']['f'] == 'good'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php if ($this->_vars['orderby']['f'] == 'good'):  echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":good",'args1' => "$wherestring"), $this); else:  echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":good",'args1' => "$wherestring"), $this); endif; ?>"><span>好评率</span><b></b></a>
			
                
            </div>
                        <div class="i-search">
                        <form action="" method="post">
                      
                        <input class="text" type="text" value="<?php echo $this->_vars['word']; ?>
" size="20" name="word">
                        <input type="submit" value="搜索">
                        </form>
                        </div>
                    </div>
            	</div>
				<div class="district">
                <div class="area"><span>所在区</span><b></b></div>
                <div style="display:none;" class="i-area">
                   <form action="" method="post" id='areafrom' >
                    <input type='hidden' name='provinceid'/> 
                    <script>
			$(function(){
				$u='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'area'), $this);?>';
				
				$.get($u,function(data){
					$('#areafrom').append(data);
					
				
				});
				
			});
		</script>
                     </form>
                </div>
            </div>
            </div>
            			<script>
			 $(function(){
                        $(".area").click(function(){
                            var obj=$(this);
                            $(this).next().slideToggle("fast",function(){
                                if($(obj).next().is(":visible")){
                                    $(document).one('click',function(){
                                        $(".area").next().slideUp("fast");
                                    });
                                }});
                        });
                        $(".i-area li").click(function(){
                            var str=$(this).html();
                            $(this).parent().parent().prev().children("span").html(str);
                            $(this).parent().parent().slideToggle();
                            var id=$(this).attr("key");
                            $form=$("#areafrom");
                                                      /*  window.location='http://www.mallbuilder.cn/product-list-1005.html&province='+id;*/
                                                     /* d();*/
                           $form.find('[name=provinceid]').val(id);  
                         /*  d($form.find('[name=provinceid]'));*/
                           $form.submit();                         
                        });

                        /*$(".district").left($('.type').width());*/
                    });
			</script>
<?php if (! ( $this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1) )): ?>
<div class="itemsNull">
                <h3>很抱歉，没有找到符合条件的店铺</h3>
                <p>
                    <em>建议您：</em>
                    <span>1、适当减少筛选条件，可以获得更多结果</span>
                    <span>2、尝试其他关键字</span>
                </p>
            </div><?php else:  if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
        
			                                <div class="item clearfix">
                    <div class="left">
                        <div class="pic">
                            <a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>">
                            <img width="100" height="100" src="<?php echo $this->_vars['volist']['logo']; ?>
">
                                   </a>
                        </div>	
                        <div class="info">
                            <dl>
                                <dt><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><?php echo $this->_vars['volist']['merchantname']; ?>
</a></dt>
                                <dd><span class="tit">店主：</span><span><a target="_blank" href="#"><?php echo $this->_vars['volist']['username']; ?>
</a></span></dd>
                                <dd>
                                <span class="tit">信用度：</span>
                                <span class="tit"><img align="absmiddle" src="<?php  echo ng169\hook\vo_list("fun=@!getlevelimg!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['volist']['muid']}!@"); ?>"></span>
                                <span class="tit">&nbsp;&nbsp;好评率：</span>
                                <span><?php if (( $this->_vars['volist']['good'] + ( $this->_vars['volist']['bad'] ) ) == 0): ?>100%<?php else: ?>
                    <?php  echo (($this->_vars['volist']['good'])*100)/($this->_vars['volist']['good']+($this->_vars['volist']['bad'])); ?>%<?php endif; ?></span>
                                </dd>
								<dd><span class="tit">主营产品：</span><?php echo $this->_vars['volist']['licence']; ?>
 </dd>
                                <dd><span class="tit">联系电话：</span><?php echo $this->_vars['volist']['phone']; ?>
</dd>
                                <dd><span class="tit">所在地区：</span><?php echo $this->_run_modifier($this->_vars['volist']['provinceid'], 'getprovince', 'PHP', 1); ?>
 <?php echo $this->_run_modifier($this->_vars['volist']['cityid'], 'getcity', 'PHP', 1); ?>
 <?php echo $this->_run_modifier($this->_vars['volist']['areaid'], 'getarea', 'PHP', 1); ?>
</dd>
                                <dd><span class="tit">详细地址：</span> <?php echo $this->_vars['volist']['address']; ?>
</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="right">
                        <ul>
                        <?php $this->assign('hotsell', \ng169\hook\vo_list("fun=@!get_all!@ num=@!3!@ mod=@!product!@ orderby=@!f:sells,s:down!@ field=@!productname,productid,smallimg1,price!@ array=@!'pflag:1,shelves:1:status:0,muid:'{$this->_vars['volist']['muid']}!@")); ?>
                        
                        <?php if (count((array)$this->_vars['hotsell'])): foreach ((array)$this->_vars['hotsell'] as $this->_vars['volist1']): ?>
                                                        <li>
                                <div class="p-img">            
                                <a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist1']['productid'] . ""), $this);?>">
                                <img src="<?php echo $this->_vars['volist1']['smallimg1']; ?>
" width="100" height="100" alt="<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
">
                                </a>
                                </div>
                                <div class="p-name">
                                <a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist1']['productid'] . ""), $this);?>"><p><?php echo $this->_run_modifier($this->_vars['volist1']['productname'], 'tostr', 'PHP', 1); ?>
</p>
                                </a>
                                </div>
                                <div class="p-price"><?php echo $this->_vars['config']['currency'];   echo $this->_vars['volist1']['price']/100; ?></div>
                            </li>
                                                        <?php endforeach; endif; ?>
                                                     
                                                    </ul>
                    </div>
                </div> 
<?php endforeach; endif; ?>
               
                   				<div class="page"> <?php echo $this->_vars['page']; ?>
</div>
                   				<?php endif; ?>
                    </div>
        <div class="shop">
        	<div class="m">
            	<div class="mt"><h3>热门店铺</h3></div>
            	<div class="mc">
            	<?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
            	<?php if ($this->_vars['i'] <= 3): ?>
						    <dl class="fore1">
    	<dt><b>1</b><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><?php echo $this->_vars['volist']['merchantname']; ?>
</a></dt><dt>
        </dt><dd class="clearfix">
    		<div class="pic"><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><img width="50" height="50" src="<?php echo $this->_vars['volist']['logo']; ?>
"></a></div>
            <div class="info">
            	<p>店主：<a target="_blank" href="#"><?php echo $this->_vars['volist']['username']; ?>
</a></p>
                <p>信用度：<img align="absmiddle" src="<?php  echo ng169\hook\vo_list("fun=@!getlevelimg!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['volist']['muid']}!@"); ?>"></p>
                <p>好评率：<?php if (( $this->_vars['volist']['good'] + ( $this->_vars['volist']['bad'] ) ) == 0): ?>100%<?php else: ?>
                    <?php  echo (($this->_vars['volist']['good'])*100)/($this->_vars['volist']['good']+($this->_vars['volist']['bad'])); ?>%<?php endif; ?></p>
            </div>
       </dd>
    </dl>
<?php else: ?>
 <div class="fore2">
    	<b><?php echo $this->_vars['i']; ?>
</b><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><?php echo $this->_vars['volist']['merchantname']; ?>
</a>
    </div>

<?php endif;  endforeach; endif; ?>
    	  
    
                </div>
            </div>
        
        </div>
    </div>
</div>

	
	
	
	<div class="fn-clear"></div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>