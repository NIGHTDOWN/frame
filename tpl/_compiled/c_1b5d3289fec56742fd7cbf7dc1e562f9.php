<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/templets/default/purchase_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 09:44:55 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."head.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script type="text/javascript" src="<?php echo $this->_vars['indextpl']; ?>
js/jquery.yomi.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['indextpl']; ?>
res/iconfont.css"></link>
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
                
                 <strong><a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a']), $this);?>">团购</a></strong>
          
                <?php if (count((array)$this->_vars['pcat'])): foreach ((array)$this->_vars['pcat'] as $this->_vars['volist']): ?>
                <?php if ($this->_vars['i'] == 1): ?>   
                
                <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                
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
    
    	        
                
              <strong><a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a']), $this);?>">团购</a></strong>&gt;团购列表
                
                
                
                
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
                                <a <?php if (! $this->_vars['orderby']['f']): ?>class="current"<?php endif; ?> href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['byattr']), $this);?>"><span>默认排序</span></a>
			<a class="<?php if ($this->_vars['orderby']['f'] == 'gstime'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":gstime",'args1' => $this->_vars['byattr']), $this);?>"><span>最新</span><b></b></a>
          
                
           <a class="<?php if ($this->_vars['orderby']['f'] == 'gsells'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":gsells",'args1' => $this->_vars['byattr']), $this);?>"><span>销量</span><b></b></a>
               <a class="<?php if ($this->_vars['orderby']['f'] == 'gprice'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'args' => $this->_vars['by'].":gprice",'args1' => $this->_vars['byattr']), $this);?>"><span>价格</span><b></b></a>
            </div>
            <div class="total">共<strong><?php echo $this->_vars['pagearray']['total']; ?>
</strong>个商品</div>
        </div>
       	
    </div>
    
    <div class="itemSearchList">
    	        
        <ul class="gb-index-list clearfix">
<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                                                                      <li class="mod-shadow-card">
                    <a href="<?php echo \ng169\hook\url(array('action' => 'detail','args' => "gpid:" . $this->_vars['volist']['gpid'] . ""), $this);?>" class="img"><img src="<?php echo $this->_vars['volist']['gimg']; ?>
" alt=""  class="lazy" style="display: inline-block;"></a>
                    <div class="clearfix">
                        <div class="price">¥<?php echo $this->_vars['volist']['gprice']/100; ?>
</div>
                        <div class="man"><?php echo $this->_vars['volist']['gsells']; ?>
人已参加</div>
                    </div>
                    <a href="<?php echo \ng169\hook\url(array('action' => 'detail','args' => "gpid:" . $this->_vars['volist']['gpid'] . ""), $this);?>" target="_blank" class="name"><?php echo $this->_run_modifier($this->_vars['volist']['gtitle'], 'tostr', 'PHP', 1); ?>
</a>
                    <div class="lefttime" data-time="<?php echo $this->_run_modifier($this->_vars['volist']['getime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
">
                        <i class="iconfont icon-time"></i>
                        <span>剩余时间：</span>
                        <span class="days">0</span>
                        <em>:</em>
                        <span class="hours">0</span>
                        <em>:</em>
                        <span class="minutes">0</span>
                        <em>:</em>
                        <span class="seconds">0</span>
                    </div>
                    <?php if ($this->_vars['time'] > $this->_vars['volist']['getime']): ?>
                    
                      <a href="<?php echo \ng169\hook\url(array('action' => 'detail','args' => "gpid:" . $this->_vars['volist']['gpid'] . ""), $this);?>" class="gb-btn bid_end">团购结束</a>
                    <?php else: ?>
                                        <a href="<?php echo \ng169\hook\url(array('action' => 'detail','args' => "gpid:" . $this->_vars['volist']['gpid'] . ""), $this);?>" class="gb-btn">立即团</a>
                                        <?php endif; ?>
                                    </li>
                                   
                        <?php endforeach; endif; ?>                                                                  
                                                            </ul>
<div class="itemSearchResult clearfix">

        </div>
<div class="page">   <?php echo $this->_vars['page']; ?>
</div>

            </div>
</div>
	
	
	
	<div class="fn-clear"></div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script type="text/javascript">
	$(function(){
		//倒计时
		$(".lefttime").each(function(){
			$(this).yomi();
		});
	
	});
    </script>
</body></html>