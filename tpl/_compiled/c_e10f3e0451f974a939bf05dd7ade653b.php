<?php /* "tpl/mtpl/index_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 03:29:05 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<body class="bgee">

<div class="main" style='margin-bottom: 38rem;'>
<div class="main">
        <div class="app">
            
<header id="head" class="head" style="z-index:198">
	<div class="fixtop" id="logoindex">
		<span id="index-logo">
			<a href="<?php echo url(array('mod' => 'category'), $this);?>">
				<i class="logo">
					<img src="<?php echo $this->_vars['indextpl']; ?>
/images/ico/fl.png">
				</i>
			</a>
		</span>
		<span id="index" class="index-search">
			<div class="search-area">
				<form id="search-form" action="<?php echo url(array('mod' => 'search'), $this);?>" method="post">
					<div class="box-search insidebox-search">
						<input type="text" onkeyup="get_search_word(this.value);" id="search_keyword" name="word" value="" x-webkit-speech="" placeholder="搜索商品" autocomplete="off">
						<a href="javascript: $('#search-form').submit();" class="index-search-do"><img src="<?php echo $this->_vars['indextpl']; ?>
/images/ico/search.png"></a>
					</div>
					<div class="search_suggest" id="gov_search_suggest" >
						<ul>
						</ul>
					</div>
				</form>
			</div>
		</span>
		<?php if ($this->_vars['user']): ?>
		<span class="sign_icon" onclick="_go_url('<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>')">
			<i class="logo">
				<img src="<?php echo $this->_vars['indextpl']; ?>
/images/ico/muser.png">
			</i>
		</span><?php else: ?>
		<span class="sign_icon" id="sign" onclick="_go_url('<?php echo url(array('mod' => 'login'), $this);?>')">
			登入
		</span><?php endif; ?>
	</div>
</header>


            <div class="top-menu"></div>

<div id="ct" style="border-top:15px solid #e4e4e4">
			
			    <div class="swiper-container" style="height:140px;">
			
				<div class="swiper-wrapper"  id='mobile_index_banner' style="width: 2060px; height: 140px; ">
	
															</div>
						<div class="pagination"></div>		
						</div>
				
						<section  class="ad-metro-2nd mobile_index_banner_buttom mobile_index_banner_buttom_right">
							 
   
  
									</section>
					   
		<div class="shoufa-wrapper">
    <div class="title-wrapper">
        <div class="shoufa-tit  theme-border-left-color-1">
            <span class="shoufa-img"></span>
            <span class="shoufa-txt">
				限时团购
                   <!-- <b><i class="theme-color-1">大面额</i>优惠券</b>-->
                </span>
            <a href="<?php echo url(array('mod' => 'purchase'), $this);?>">查看更多</a>
        </div>
    </div>

    <div class="shoufa-list">
        <ul id='newpro'>
					
				
			
				<li style="background: #c5c5c5;">
					<a href="<?php echo url(array('mod' => 'purchase'), $this);?>">
						<div class="seckill-all" style="text-align:center;">
							<span class="show-all-title" style="font-size:14px;margin-top: 30px;display: block;">查<br>看<br>更<br>多</span>
						</div>
					</a>
				</li>
			
		</ul>
    </div>
</div>
	<!-- 广告图 -->
		<!-- end -->
    
<div id="goods">
	<div class="list_summary">
		<span>精选热卖</span>
	</div>
	<div id="goods">		
		<section class="goods" id="goods">
			<ul class="goods-list clear" id="goods_block">
				
			</ul>
		</section>
	</div>
</div>                    
</div>
       </div>
    </div>



       <div style="clear: both;"></div>
     


  

    

    
</div>

</div>
<div id="back_top" class="slide-box " >
	
		<a href="javascript:void(0);" class="back-top " style="display: none">
			<img src="<?php echo $this->_vars['indextpl']; ?>
/images/ico/download.png">
		</a>
	</div>
<script>

function get_search_word(k)
{
    if(k!='')
    {
        var url = '<?php echo url(array('mod' => 'search','action' => 'getmore'), $this);?>';
        var sj = Math.random();
        var pars = 'shuiji=' + sj+'&key='+k;
        $.post(url, pars,showResponse);
    }

    function showResponse(originalRequest)
    {
    	originalRequest=jta(originalRequest);
    	$html='';
    	if(originalRequest.flag){
    		$.each(originalRequest.data,function(n,i){
    			
    			$html+="<li onclick=\"select_word('"+i.word+"')\" href='#'> <font style='margin-left:0.5rem'>"+i.word+"</font></li>";
    			
    		});
    	}else{return 0;}
    	
    	        if(originalRequest)
        {
            $('#gov_search_suggest').show();
         
            $('#gov_search_suggest ul').html($html);
        }
        else
            $('#gov_search_suggest').hide();
    }

}
function select_word(v)
{
    $('#search_keyword').val(v);
    $('#gov_search_suggest').hide();
}
$domain='<?php echo $this->_vars['config']['site_url']; ?>
';
$(function(){
	var sc=0;
	$(window).scroll(function(){
		$ob=$('.fixtop');
		$h=$ob.height();
		$sh=$(window).scrollTop();
		$up=$sh>sc?1:0;
		sc=$sh;
	
		if($sh>=$h*3){
			$ob.css('background','#bd0a0d');
		}else if($sh<$h*3 && $sh>0){
			$rate=$sh/$h/3;
			
			$ob.css('background','-moz-linear-gradient(top, #bd0a0d, rgba(234, 40, 40,'+$rate+'))');
			$ob.css('background','-webkit-gradient(linear, 0 0, 0 bottom, from(#bd0a0d), to(rgba(234, 40, 40,'+$rate+')))');
		
		}else{
			$ob.css('background','-moz-linear-gradient(top, rgb(16, 23, 37), rgba(255,255,255,0))');
			$ob.css('background','-webkit-gradient(linear, 0 0, 0 bottom, from(rgb(16, 23, 37)), to(rgba(255,255,255,0)))');
			
		}
		
	});
	
});

			$u2='<?php echo url(array('action' => 'getad','mod' => 'index'), $this);?>';
			
			getadmobile($domain,$u2,'mobile_index_banner');
			getadmobile2($domain,$u2,'mobile_index_banner_buttom');
			getadmobile3($domain,$u2,'mobile_index_banner_buttom_right');
			$u3='<?php echo url(array('action' => 'hotsell','mod' => 'index'), $this);?>';
			getadmobilehot($domain,$u3,'newpro');



</script>
<script>
	
	
	
		 
	var purl = "<?php echo url(array('mod' => 'index','action' => 'getproduct'), $this);?>";

	
	
	var page = 0; //当前页的页码
        var flagNoData = true; //false
        function showAjax(currentIndex) {
        	
        	if(!flagNoData){return false;}
            yAjax(purl,{'s':currentIndex},function(data){
            	$html='';
            	page+=1;
            	
            	if(data.length){
            		
            		for (var i=0;i<data.length;i++){
            			$url=$domain+'/index.php?c=product&a=detail'+'&productid='+data[i]['productid'];
            		$html+='<li><a href="'+$url+'" target="_blank"><div class="goods-pic"><img class="lazy" src="'+data[i]['smallimg1']+'"></div><div class="goods-title"><span class="title"><span class="tmall_bg"></span>'+data[i]['productname']+'</span></div><div class="list-price buy"><div class="jiage"><span class="n_jiage">￥'+data[i]['price']/100+'</span></div></div><div class="list-price buy "><div class="dp"><span onlick="_go_irl("'+$url+'")">立刻购买</span></div></div></a></li>';
            	}	
            	
            			$("#goods_block").append($html);
            	}else{
            		/*console.log('加载错误');*/
            	
            		flagNoData=false;
            		console.log('加载结束');
            	}
            	
            	
            });
        }
	showAjax(0);
	$(document).ready(function () {
		 function scrollFn() {
		 
            //真实内容的高度
            var pageHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight);
            //视窗的高度
            var viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0;
            //隐藏的高度
            var scrollHeight = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
          
            if (!flagNoData) { //数据全部加载完了
                return;
            } else if (pageHeight - viewportHeight - scrollHeight < viewportHeight/2) {    //如果满足触发条件，执行
            	
                showAjax(page);
            }
        }
		
		 $(window).bind("scroll", scrollFn); 
	});   
</script>				

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>