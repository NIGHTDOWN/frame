<?php /* "tpl/mtpl/category_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 23:26:22 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['indextpl']; ?>
css/shop.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_vars['indextpl']; ?>
css/category.css" rel="stylesheet" type="text/css" />

<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div class="mui-page-cont mui-page-in-biz mui-global-biz-shop ">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="_go_url('<?php echo url(array('mod' => 'index'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>
								<form action="<?php echo url(array('mod' => 'search'), $this);?>" method="POST" id='ff'>
								<div class="jd-header-new-title">
									<div class="header-content" >
										<div class="header-search">
											<i class="search-icon"></i>
											<input type="text" name="keyword" autocomplete="off" id='search_keyword' onkeyup="get_search_word(this.value);" class="search-input" value="" placeholder="搜索店铺内商品"
											 maxlength="20">
											
										</div>
										

									</div>
								</div>
								<div onclick='$("#ff").submit()' class="serbtn">
										<span>搜索</span>
								</div></form>
							</div>
						</header>
						<div class="search_box" id="search_suggest" >
								<ul>
								</ul>
							</div>







					</div>

					
						<div class="category-viewport">
							<div id="rootList" class="category-tab">
								<div >
									<ul >
										<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['i'] => $this->_vars['volist']): ?>
										<li <?php if ($this->_vars['i'] == 0): ?>class="on"<?php endif; ?> >
											<a  href="<?php echo url(array('mod' => 'category','action' => 'level2','args' => "id:" . $this->_vars['volist']['catid'] . ""), $this);?>" target="right_category"><?php echo $this->_vars['volist']['catname']; ?>
</a>
										</li>
									<?php endforeach; endif; ?>
										
									</ul>
								</div>
							</div>
							<div class="category-content">
								<iframe src='<?php echo url(array('mod' => 'category','action' => 'level2','args' => "id:" . $this->_vars['data']['0']['catid'] . ""), $this);?>' name='right_category'></iframe>
							</div>
						</div>


<script>
	$(function(){
$('.category-tab li').click(function(){
$(this).addClass('on').siblings().removeClass('on');


});
$h=$(window).height();
$w=$(window).width();
$('.category-content').height($h);
$('iframe').height($h);
/*$('iframe').width('73%');*/


	});
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
            $('#search_suggest').show();
         
            $('#search_suggest ul').html($html);
        }
        else
            $('#search_suggest').hide();
    }

}
function select_word(v)
{
    $('#search_keyword').val(v);
    $('#search_suggest').hide();
}



</script>















				





				</div>







			</div>












		</div>












	</div>

	</div>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>