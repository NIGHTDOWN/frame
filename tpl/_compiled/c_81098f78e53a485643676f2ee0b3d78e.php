<?php /* "/tpl/muser//foot.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 13:30:35 �й���׼ʱ�� */ ?>



<div class="footer">
    <ul class="line">
        <li <><a href="<?php echo url(array('mod' => 'index','group' => 'index'), $this);?>"><i class="i1"></i><span>首页</span></a></li>
   
        <li ><a href="<?php echo url(array('mod' => 'category','group' => 'index'), $this);?>"><i class="i2"></i><span>分类</span></a></li>
        <li><a href="<?php echo url(array('mod' => 'purchase','action' => '','group' => 'index'), $this);?>"><i class="i3"></i><span>聚实惠</span></a></li>
      
       <li ><a href="<?php echo url(array('mod' => 'cart','group' => 'index'), $this);?>"><i class="i4"></i><span>购物车</span></a></li>
        <li class="current"><a href="<?php echo url(array('mod' => 'index','group' => 'user','action' => ''), $this);?>"><i class="i5"></i><span>我的 </span></a></li>
    </ul>
</div>


<div id="back_top" class="slide-box " >
	
	<a href="javascript:void(0);" class="back-top " style="display: none">
		<img src="<?php echo $this->_vars['usertpl']; ?>
/images/ico/download.png">
	</a>
</div>


<script>
	
	
     $(function(){
     	$(".back-top").click(function(){
     	
     		 $("html,body").animate({scrollTop:0},500);

     	});
$(window).scroll(function(){
		$ob=$('.back-top');
		$h=$(window).height();
		$sh=$(window).scrollTop();
		$up=$sh>$h?1:0;
	
	
		if($up){
			/*$ob=$('.back-top .none').fadeIn();*/
			
			$('.back-top:hidden').fadeIn();
		}else{
			$('.back-top').fadeOut();
			
		}
		
	});
     });
</script>



 
</body>
</html>
