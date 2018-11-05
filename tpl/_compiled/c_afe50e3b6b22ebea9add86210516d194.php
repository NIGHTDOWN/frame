<?php /* "tpl/shop/product_add.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:22 �й���׼ʱ�� */ ?>


<title>选择分类 - 发布产品</title>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

  <div class="layout">
    <div class="flow-chart"></div>
    <div class="search_com">
        <span class="icon"></span>
        <span class="txt">分类搜索：<input type="text" name='catname' class="text" maxlength="22" id="SEARCHVALUE"></span>
        <a id="searchBtn" href="JavaScript:catesearch();" class="btn_search">搜索</a>
    </div>
	<div class="search_sort">
        <div class="search_title" style="display: none;">
            <div class="txt">您常用的商品分类：</div>
            <select onchange="getid(this);">
                <option value="">选择常用类别</option>
                
                            </select>
        </div>
       
        <div class="search_result" style="<?php if (! $this->_vars['data']['catid']): ?>display: none;<?php endif; ?>" >
            <div class="back_to_sort" >
            	<a genre="return_choose_sort" href="JavaScript:backmain();">&lt;&lt;返回商品分类选择</a>
            </div>
            <div style="display:none;" id="searchNone" class="no_result">
                <p>没有找到相关的商品分类。</p>
                <p><a genre="return_choose_sort" href="JavaScript:backmain();">返回商品分类选择</a></p>
            </div>
            <div style="display: block;" id="searchSome" class="has_result">
                <div id="searchEnd"></div>
                <div id="searchList" class="result_list">
                <ul>
                	<li genre="searchList_name" onclick="catechoose($(this),<?php echo $this->_vars['data']['catid']; ?>
);"><?php echo $this->_vars['data']['catname']; ?>
</li>
                	
                	
                </ul>
            	</div>
            </div>  
 </div>  
        <div class="sort_block" style="<?php if ($this->_vars['data']['catid']): ?>display: none;<?php endif; ?>">
        	<div class="sort_list">
                <div class="wp_category_list">
                    <div class="category_list" id="class_div_1">
                        <ul>
                        <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!product_category!@ field=@!catid,catname!@ array=@!flag:0,depth:1!@")); ?>
                        <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
                    <li id=""  onclick="district($(this),<?php echo $this->_vars['volist']['catid']; ?>
,1);">
                    <a href="javascript:void(0)" class="" ><span class="has_leaf"><?php echo $this->_vars['volist']['catname']; ?>
</span></a>
                    </li>
                    <?php endforeach; endif; ?>
                                                    
                                                    </ul>
                    </div>
                </div>
            </div>
        	<div class="sort_list">
                <div class="wp_category_list">
                	<div class="category_list" id="class_div_2">
                    	<ul>
                    		
                    	</ul>
                    </div>
                </div>
            </div>
        	<div class="sort_list">
                <div class="wp_category_list ">
                    <div class="category_list" id="class_div_3">
                    	<ul></ul>
                    </div>
                </div>
            </div>
        	<div class="sort_list">
                <div class="wp_category_list ">
                	<div class="category_list" id="class_div_4">
                   		<ul></ul>
                    </div>
                </div>
            </div>
        </div>
   

        </div>
        	<div style="display: block; clear:both;" class="tips_choice">
        <span class="tips_zt"></span>
        <dl class="hover_tips_cont">
            <dt id="commodityspan" style="display: none;">
                <span style="color:#F00;">请选择商品类别</span>
            </dt>
            <dt class="current_sort" style="" id="commoditydt">您当前选择的商品类别是：</dt>
            <dd id="commoditydd">
           <span class="has_leaf"><?php echo $this->_vars['data']['catname']; ?>
</span>

            </dd>
        </dl>
    </div>
    <div class="btn_confirm">
    <form method="post"  action="<?php if ($this->_vars['a'] == 'cgcate'):  echo url(array('action' => $this->_vars['a']), $this); else:  echo url(array('action' => 'addtemp'), $this); endif; ?>"   >
 
		<input type="hidden" id="edit" name="catid" value="<?php echo $this->_vars['data']['catid']; ?>
">
		<input type="submit" value="下一步" id="button_next_step" style="cursor: pointer;">
	</form>
    </div>
</div>

<script>
	function district($obj,id,level){
		$obj.parent().find('a').removeClass('classDivClick');
		$obj.children('a').addClass('classDivClick');
		//class变化
		$url='<?php echo url(array('mod' => 'product','action' => 'cate'), $this);?>';
		$ar={'catid':id,'depth':level};
		$html='';
		$newlevel=level+1;
		switch(level){
			case 1:
			yAjax($url,$ar,function(data){
				if(data.flag){
					$.each(data.data,function(i,v){
						$html+=' <li onclick="district($(this),'+v.catid+','+$newlevel+');"><a href="javascript:void(0)" ><span class="has_leaf">'+v.catname+'</span></a></li>';
					});
					$('#class_div_'+$newlevel).children('ul').html($html);
					
				}
				
				
			});
				break;
			case 2:yAjax($url,$ar,function(data){
				if(data.flag){
					$.each(data.data,function(i,v){
						$html+=' <li onclick="district($(this),'+v.catid+','+$newlevel+');"><a href="javascript:void(0)" ><span class="has_leaf">'+v.catname+'</span></a></li>';
					});
					$('#class_div_'+$newlevel).children('ul').html($html);
					
				}
				
				
			});
				break;
				case 3:yAjax($url,$ar,function(data){
				if(data.flag){
					$.each(data.data,function(i,v){
						$html+=' <li onclick="district($(this),'+v.catid+','+$newlevel+');"><a href="javascript:void(0)" ><span class="has_leaf">'+v.catname+'</span></a></li>';
					});
					$('#class_div_'+$newlevel).children('ul').html($html);
					
				}
				
				
			});
				break;
				case 4:
				yAjax($url,$ar,function(data){
				if(data.flag){
					$.each(data.data,function(i,v){
						$html+=' <li onclick="district($(this),'+v.catid+','+$newlevel+');"><a href="javascript:void(0)" ><span class="has_leaf">'+v.catname+'</span></a></li>';
					});
					$('#class_div_'+$newlevel).children('ul').html($html);
					/*$('#class_div_'+$newlevel).parent('div').removeClass('blank');*/
					/*$('.blank').removeClass('blank');*/
				}
				
				
			});
				break;
		}
		
		
		//子分类
		//input隐藏
		$('[name=catid]').val(id);
		//选择的分类
		$text=$obj.children('a').text();
		$length=$('#commoditydd').children('.has_leaf').length;
		if($length>level){
			$('#commoditydd').html('  <span class="has_leaf">'+$text+'</span>');
		}else if($length==level){
			$($('#commoditydd').children('.has_leaf').get(level-1)).text($text);
			
		}else{
			$('#commoditydd').html($('#commoditydd').html()+'  &nbsp;&gt;&nbsp;<span class="has_leaf">'+$text+'</span>');
			
		}
		
		
		
	}
	function catechoose($obj,id){
			$('[name=catid]').val(id);
			$text=$obj.text();
			$('#commoditydd').html('  <span class="has_leaf">'+$text+'</span>');
	}
	function catesearch(){
		$url='<?php echo url(array('mod' => 'product','action' => 'searchcate'), $this);?>';
		$ar={'catname':$('[name=catname]').val()};
		$('.sort_block').hide();
		$('.search_result').show();
		$html='';
		yAjax($url,$ar,function(data){
				if(data.flag){
					$('#searchSome').show();
					
					
						$('#searchNone').hide();
					$.each(data.data,function(i,v){
						$html+=' <li genre="searchList_name" onclick="catechoose($(this),'+v.catid+');" >'+v.catname+'</li>';
					});
					$('#searchList').children('ul').html($html);
					
				}else{
					$('#searchSome').hide();
						$('#searchNone').show();
				}
				
				
			});
	}
	function backmain(){
				$('.search_result').hide();
				$('.sort_block').show();
						
	}
</script>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>