<?php /* "tpl/templets/default/product_list.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:50:16 �й���׼ʱ�� */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."phead.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


		<div class="w">
          
        <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pleft.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>  
	<div id="right"><div class="module_special">
    <div class="con">
        <form method="post" action="<?php echo url(array('mod' => 'product','args' => "id:" . $this->_vars['data']['muid'] . "",'action' => 'list'), $this);?>">
        <div class="search">
        	<h4><span>所有宝贝</span><s></s></h4>
            <div class="i-con clearfix">
                <div class="search_form">
                    <ul class="clearfix"> 
                        <li class="keyword"><label for="word">关键字：</label><input type="text" value="<?php echo $this->_vars['where']['word']; ?>
" name="word" id="keyword"></li>
                        <li class="price"><label for="price">价格：</label> <input type="text" value="<?php echo $this->_vars['where']['price1']; ?>
" name="price1" id="price1" onkeyup="value=value.replace(/[^\d.]/g,'')"> 到 <input type="text" value="<?php echo $this->_vars['where']['price2']; ?>
" name="price2" id="price2" onkeyup="value=value.replace(/[^\d.]/g,'')"></li>
                        <li><button type="submit" class="button">搜索</button></li>
                    </ul> 
                </div>
              <?php if ($this->_vars['pagesize']): ?>  <div class="search_result">共搜索到<span> <?php echo $this->_vars['pagesize']; ?>
 </span>个符合条件的商品。</div><?php endif; ?>
            </div>
    	</div>
      
        </form>
        <div class="filter">
            <div class="sort">
                <span>排序:</span>
                
                <a class="<?php if ($this->_vars['orderby']['f'] == 'sells'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php if ($this->_vars['orderby']['f'] == 'sells'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":sells"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:sells"), $this); endif; ?>">销量<em class="icon"></em></a>
                <a class="<?php if ($this->_vars['orderby']['f'] == 'addtime'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php if ($this->_vars['orderby']['f'] == 'addtime'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":addtime"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:addtime"), $this); endif; ?>">新品<em class="icon"></em></a>
                <a class="<?php if ($this->_vars['orderby']['f'] == 'price'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php if ($this->_vars['orderby']['f'] == 'price'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":price"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:price"), $this); endif; ?>">价格<em class="icon"></em></a>
                <a class="<?php if ($this->_vars['orderby']['f'] == 'collects'):  echo $this->_vars['orderby']['s'];  endif; ?>" href="<?php if ($this->_vars['orderby']['f'] == 'collects'):  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . "," . $this->_vars['by'] . ":collects"), $this); else:  echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['where']['id'] . ",word:" . $this->_vars['where']['word'] . ",price1:" . $this->_vars['where']['price1'] . ",price2:" . $this->_vars['where']['price2'] . ",up:collects"), $this); endif; ?>">人气<em class="icon"></em></a>
              
            </div> 
        </div>
        
        <ul class="list product">
                        <?php if (count((array)$this->_vars['plist'])): foreach ((array)$this->_vars['plist'] as $this->_vars['volist']): ?>
                        <li>
                <div class="pic">
                <a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><img src="<?php echo $this->_run_modifier($this->_vars['volist']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
" width="220" height="220" alt="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
"></a></div>
                <h3><a target="_blank" title="<?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></h3>
                <p><?php echo $this->_vars['config']['currency'];  echo $this->_vars['volist']['price']/100; ?>
</p>
            </li>
<?php endforeach; endif; ?>
                    </ul>
    	<div class="page">   <?php echo $this->_vars['page']; ?>
</div>    
    </div>
</div>
</div>
    <div class="clear"></div>
	</div>

        <script>
        $(".block_ico,.none_ico").click(function(e){
        var xx = e.originalEvent.x || e.originalEvent.layerX || 0; 
        var lo = $(this).offset().left

        if($(this).parents("li").find("ul").length > 0)
        {
            if($(this).parents("li").find("ul").is(":visible"))
            {

                $(this).parents("li").find("ul").slideUp()
                $(this).removeClass("none_ico").addClass("block_ico")
            }
            else
            {
                $(this).parents("li").find("ul").slideDown()
                 $(this).removeClass("block_ico").addClass("none_ico")
            }
        }
        
        if(xx*1 - lo*1 < 22)
        {
            return false
        }
    })</script>


		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


</body></html>