<?php /* "ngtpl[start]:tpl/templets/default/product_category.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-19 15:24:39 */ ?>

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
res/pcss.css" rel="stylesheet" type="text/css">
	<div class="w">
    
    
    	     <?php if ($this->_vars['pcat']): ?>   
                <div class="detailnav">
                <strong><a href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>">首页</a></strong>
                <?php if (count((array)$this->_vars['pcat'])): foreach ((array)$this->_vars['pcat'] as $this->_vars['k'] => $this->_vars['volist']): ?>
                <?php  $this->_vars['i']==$this->_vars['k']+1; ?>   
                <?php if ($this->_vars['i'] == 1): ?>   
                <strong>
                <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                </strong>
                <?php else: ?>
                 <span>
            
                 &gt; <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                   </span>
                
                <?php endif; ?>
                <?php endforeach; endif; ?>
               
    </div>
                <?php else: ?>
                <div class="detailnav">
    
    	        
                
                <strong><a href="<?php echo \ng169\hook\url(array('mod' => 'index'), $this);?>">首页</a></strong><span>
         &gt; <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a']), $this);?>">全部商品</a>
                
                
                
                
        </span>
    </div>
                <?php endif; ?>
                
      
</div>
	<div class="w">
	<?php  $this->_vars['cnum']=sizeof($this->_vars['ccat']); ?>
	<?php  $this->_vars['anum']=sizeof($this->_vars['attribute']); ?>
	 <?php if ($this->_vars['cnum'] || $this->_vars['anum']): ?>
         <div id="select">
        <?php if ($this->_vars['cnum']): ?>
    	        <dl class="first">
            <dt>分类：</dt>
            <dd>
            <?php if (count((array)$this->_vars['ccat'])): foreach ((array)$this->_vars['ccat'] as $this->_vars['volist']): ?>
                                                <div>
                <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "word:" . $this->_vars['where']['word'] . ",catid:" . $this->_vars['volist']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                </div>
<?php endforeach; endif; ?>
                          
                            </dd>
        </dl>
         <?php endif; ?>
         <?php if (count((array)$this->_vars['attribute'])): foreach ((array)$this->_vars['attribute'] as $this->_vars['volist']): ?>
                <dl>
            <dt><?php echo $this->_vars['volist']['sname']; ?>
：</dt>
            <dd>
            <?php  $this->_vars['key']='att'.$this->_vars['volist']['weight']; ?>
                                <div><a <?php if ($this->_vars['attrwhere'][$this->_vars['key']] == null): ?>class="curr"<?php endif; ?> href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => 'category','args2' => $this->_vars['attrwhere'],'args' => "att" . $this->_vars['volist']['weight'] . ":null"), $this);?>">不限</a></div>
                                <?php  $this->_vars['k']=explode(',',$this->_vars['volist']['var']); ?>
                              <?php if (count((array)$this->_vars['k'])): foreach ((array)$this->_vars['k'] as $this->_vars['value']): ?>  
                             
                                <div>
 <a <?php if ($this->_vars['attrwhere'][$this->_vars['key']] == $this->_vars['value']): ?>class="curr"<?php endif; ?> href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "att" . $this->_vars['volist']['weight'] . ":" . $this->_vars['value'] . "",'args2' => $this->_vars['attrwhere']), $this);?>"><?php echo $this->_vars['value']; ?>
</a>
                </div>
                               <?php endforeach; endif; ?>
                            </dd>
        </dl>
                    <?php endforeach; endif; ?>
                              
            </div>
 <?php endif; ?>
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
    <div class="filter clearfix">
        <div class="fore1 clearfix">
            <div class="order">
                                <a <?php if (! $this->_vars['orderby']['f']): ?>class="current"<?php endif; ?> href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'],'args2' => $this->_vars['byattr']), $this);?>"><span>默认排序</span></a>
			<a class="<?php if ($this->_vars['orderby']['f'] == 'sells'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":sells",'args2' => $this->_vars['byattr']), $this);?>"><span>销量</span><b></b></a>
                <!--<a class="<?php if ($this->_vars['orderby']['f'] == 'hits'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":hits",'args2' => $this->_vars['byattr']), $this);?>"><span>人气</span><b></b></a>
                 <a class="<?php if ($this->_vars['orderby']['f'] == 'plpjf'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":plpjf",'args2' => $this->_vars['byattr']), $this);?>"><span>信用</span><b></b></a>-->
           <a class="<?php if ($this->_vars['orderby']['f'] == 'addtime'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":addtime",'args2' => $this->_vars['byattr']), $this);?>"><span>最新</span><b></b></a>
               <a class="<?php if ($this->_vars['orderby']['f'] == 'price'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":price",'args2' => $this->_vars['byattr']), $this);?>"><span>价格</span><b></b></a>
            </div>
            <?php if ($this->_vars['pagesize']): ?><div class="total">共<strong><?php echo $this->_vars['pagesize']; ?>
</strong>个商品</div><?php endif; ?>
        </div>
       	<div class="fore2 clearfix">
            <div style="position:relative;">
                <dl class="type">
                                                            <dd><a class="current" href="#"><b></b>&nbsp;全新</a></dd>
                                        <dd style="display: none"><a href=""><b></b>&nbsp;二手</a></dd>
                                    </dl>

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
                                                 
                           $form.find('[name=provinceid]').val(id);  
                         /*  d($form.find('[name=provinceid]'));*/
                           $form.submit();                         
                        });

                        /*$(".district").left($('.type').width());*/
                    });
                </script>
            </div>
            <div class="list">
            	            	<a class="current" href="#"><span class="shop"></span></a>
                <a href="<?php echo \ng169\hook\url(array('mod' => 'shop'), $this);?>"><span class="product"></span></a>
            </div>
		</div>
    </div>
    
    <div class="itemSearchList">
        <?php if ($this->_run_modifier($this->_vars['data'], 'sizeof', 'PHP', 1)): ?>
    	        <div class="itemSearchResult clearfix">
            <ul class="clearfix">
            <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['k'] => $this->_vars['volist']): ?>
            <?php  $this->_vars['i']=$this->_vars['k']+1; ?>
                                <li <?php if ($this->_vars['i'] % 4 == 0): ?>class="mr0"<?php endif; ?>>
                    <div class="p-info">
                        <a class="p-img" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">  <img height="200" width="200" alt="<?php echo $this->_vars['volist']['productid']; ?>
" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
"> </a>
                        <a class="p-name" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a>
                        <p class="p-price"><strong><?php echo $this->_vars['config']['currency'];  echo $this->_vars['volist']['price']/100; ?>
</strong></p>
                      <div class="p-shop"><a href="<?php echo \ng169\hook\url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><?php echo $this->_vars['volist']['merchantname']; ?>
</a></div>
                    </div>
                </li>
                        <?php endforeach; endif; ?>      
                            </ul>
			<div class="page">   <?php echo $this->_vars['page']; ?>
</div>
       
       
        </div> <?php else: ?>
        <div class="itemsNull">
                <h3>很抱歉，没有找到符合条件的宝贝</h3>
                <p>
                    <em>建议您：</em>
                    <span>1、适当减少筛选条件，可以获得更多结果</span>
                    <span>2、尝试其他关键字</span>
                </p>
            </div>
<?php endif; ?>
        <div class="hotProduct">
        	<div class="m">
                <div class="mt"><h3>热销产品</h3></div>
                <div class="mc">
                  <?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
                 <li class="fore1">
<div class="p-img ld">
    <a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">
        <img style="width:220px;height:220px" src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
">
    </a>
</div>
<div class="p-name"><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"> <?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></div>
<div class="p-price"><strong><?php echo $this->_vars['config']['currency'];  echo $this->_vars['volist']['price']/100; ?>
</strong></div>
</li>
  <?php endforeach; endif; ?>      

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