<?php /* "ngtpl[start]:tpl/templets/default/jfstore_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-19 15:23:50 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."head.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<style>
.menu{ margin-bottom:0px !important;}
.new_bg{background:#F2F2F2; width:100%; padding:15px 0px;}
.new_nei{margin:0 auto; width:1200px; background:#fff;}
.new_nei h2{background:#fbfbfb; height:35px; line-height:35px; border-bottom:1px solid #f5f4f4; font-family:微软雅黑; font-size:16px; font-weight:normal; padding-left:20px;}
.new_neiz{float:left; width:949px; border-right:1px solid #f5f4f4;}
.new_neiz ul{padding:15px;}
.new_neiz li{padding:25px 15px; border-bottom:1px dashed #DDDDDD;}
.new_neiliz{float:left; width:183px; height:123px; border:1px solid #f0f0f0;}
.new_neiliz0{float:left; width:680px; padding-left:20px;}
.new_neibt{font-family:微软雅黑; font-size:16px;}
.new_neisj{color:#999999; padding-top:10px;}
.new_neinr{color:#6C6C6C; padding-top:5px;}
.new_neinr p{line-height:24px;}
.new_ym{padding-bottom:30px; padding-left:30px;}
.clear{clear:both;}
.new_neiy{float:right; width:250px; margin:0 auto; padding-top:20px;}
.new_neiy b{ font-size:16px; padding:20px 15px 0px; font-family:微软雅黑; color:#333;}
.new_neiy_a{width:100px;}
.new_neiy_a img{width:100px; height:75px;}
.new_neiy ul{list-style:none; padding:0px 15px;}
.new_neiy li{margin: 15px 0 0;}
.new_banner{ margin-top:30px; border-top:1px solid #F5F4F4;}
.new_banner img{width:217px; padding:15px 15px 0;}
.footer{margin-top:0px !important;}
</style>

<body class="gray">
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

	<script type="text/javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/jquery.flexslider-min.js"></script>
	
	<div class="wrap">
<div class="bbc-base-layout">

<div class="bbc-banner-right">
<a href="<?php echo \ng169\hook\url(array('mod' => 'jfstore'), $this);?>" title="积分列表页中部广告位">
<img style="width:100%; " border="0" src="<?php echo $this->_vars['indextpl']; ?>
res/jfbanner.jpg" alt="">
</a>
</div>

<div class="exchange-score">
                	                   
                    <?php if ($this->_vars['user']): ?>
                     <div class="u-info">
                        <a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'index'), $this);?>" class="u-avatar"><img src="<?php echo $this->_vars['user']['headimg']; ?>
" alt=""></a>
                        <div class="u-name"><a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'index'), $this);?>"><?php echo $this->_vars['user']['username']; ?>
</a></div>
                    </div>
                    <div class="score-info">
                        <div class="item">
                            <p>可用积分</p>
                            <div class="num"><?php echo $this->_vars['user']['points']; ?>
</div>
                        </div>
                        <div class="item">
                            <p>余额（元）</p>
                            <div class="num"><?php echo $this->_vars['user']['cash']; ?>
</div>
                        </div>
                    </div>
<?php else: ?>
<div class="u-info">
                        <a href="<?php echo \ng169\hook\url(array('mod' => 'login'), $this);?>" class="u-avatar"><img src="themes/ecmoban_dsc2017/images/touxiang.jpg" alt=""></a>
                        <div class="u-name"><strong>Hi,欢迎来到<?php echo $this->_vars['config']['site_name']; ?>
</strong></div>
                    </div>
<div class="score-info">
                        <a href="<?php echo \ng169\hook\url(array('mod' => 'login'), $this);?>" class="login-button">请登录</a>
                        <a href="<?php echo \ng169\hook\url(array('mod' => 'reg'), $this);?>" class="register_button">立即注册</a>
                    </div>
                    <?php endif; ?>
                                    </div>

</div>
<div class="bbc-main-layout">
<div class="bbc-main-layout mb30">
<div class="title">
<h3>
<span class="iconfont icon-lipin bbc_color"></span>热门礼品兑换 <span class="more"><a href="<?php echo \ng169\hook\url(array('action' => 'list'), $this);?>">更多<i class="iconfont icon-iconjiantouyou rel_top2"></i></a></span>
</h3>
</div>
<ul class="exchange-list clearfix">
<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                                                                        <li class="mod-shadow-card">
                                <a href="<?php echo \ng169\hook\url(array('args' => "productid:" . $this->_vars['volist']['productid'] . "",'action' => 'detail'), $this);?>" target="_blank" class="img"><img src="<?php echo $this->_vars['volist']['smallimg1']; ?>
" alt="" class="lazy" data-original="<?php echo $this->_vars['volist']['smallimg1']; ?>
" style="display: inline-block;"></a>
                                <div class="clearfix">
                                    <div class="score">积分 <?php echo $this->_vars['volist']['originalprice']; ?>
</div>
                                    <div class="market"><em>¥</em><?php echo $this->_vars['volist']['price']; ?>
</div>
                                </div>
                                <a href="<?php echo \ng169\hook\url(array('args' => "productid:" . $this->_vars['volist']['productid'] . "",'action' => 'detail'), $this);?>" target="_blank" class="name"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a>
                                <div class="already">
                                    <i class="iconfont icon-package"></i>
                                    <?php echo $this->_vars['volist']['sells']; ?>
 人兑换                               </div>
                                <a href="<?php echo \ng169\hook\url(array('args' => "productid:" . $this->_vars['volist']['productid'] . "",'action' => 'detail'), $this);?>" class="ex-btn" target="_blank">立即兑换</a>
                            </li>
                        <?php endforeach; endif; ?>                                                                  
                                                            </ul>
</div>

</div>
</div>
	<script type="text/javascript">
		$(".dt span").hover(function(){
				var index=$(this).index();
				$(this).addClass("current").siblings().removeClass("current");
				$(this).parent().parent().find(".i-mc").eq(index).show().siblings(".i-mc").hide();
			});
	</script>
	
	<div class="fn-clear"></div>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>