<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/templets/default/article_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 22:16:55 �й���׼ʱ�� */ ?>

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
	
	<div class="new_bg">
	<div class="new_nei">
        <h2>新闻列表</h2>
        <div class="new_neiz">
            <ul>
            <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                                <li>
                	                    <div class="new_neiliz"><a href="<?php echo url(array('mod' => 'article','action' => 'show','args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
" target="_blank"><img height="123" width="183" src="<?php echo $this->_vars['volist']['pic']; ?>
"></a></div>
                                        <div class="new_neiliz0">
                        <div class="new_neibt"><a href="<?php echo url(array('mod' => 'article','action' => 'show','args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
" target="_blank"> <?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></div>
                        <div class="new_neisj"><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</div>
                        <div class="new_neinr"><p><?php echo $this->_vars['volist']['desc']; ?>
</p></div>
                    </div>
                    <div class="clear"></div>
                </li>
<?php endforeach; endif; ?>
                              
                            </ul>
            <div class="new_ym">
                 <?php echo $this->_vars['page']; ?>
  
            </div>
        </div>
        <div class="new_neiy">
            <b>推荐阅读</b>
            <?php $this->assign('elite', vo_list("fun=@!getarticle!@ type=@!im!@ mod=@!index!@ ")); ?>
            <ul>
        <?php if (count((array)$this->_vars['elite'])): foreach ((array)$this->_vars['elite'] as $this->_vars['volist']): ?>    
            <li>
    <a style="float:left; margin-right:10px;" class="new_neiy_a" href="<?php echo url(array('mod' => 'article','action' => 'show','args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
" target="_blank"><img height="123" width="183" src="<?php echo $this->_vars['volist']['pic']; ?>
"></a>
    <div>
        <p style="height:55px; overflow:hidden;"><a href="<?php echo url(array('mod' => 'article','action' => 'show','args' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" title="<?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
" target="_blank"> <?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></p>
        <p style="padding-top:5px; color:#999999;"><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</p>
    </div>
</li>

<?php endforeach; endif; ?>

</ul>
            <div class="new_banner"></div>
        </div>
        <div class="clear"></div>
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