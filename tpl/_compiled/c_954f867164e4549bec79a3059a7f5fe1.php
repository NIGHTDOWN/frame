<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/user/index_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:37:17 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

		

		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."left.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
				
				
				<div class="right_con"><style>
	.shortcut li:hover a{color: #000000;}
	.qrcode{text-align: center;display: none;}
	.weixin_code{text-align:center;}
	.weixin_code img{width:180px;height: 180px;}
	.sh_img{width: 190px;height: 190px;margin-top:5px;}
	#my_qr{cursor:pointer;}
	.team-list .item{margin: 0 30px;}
</style>
<div class="wrap_buyer clearfix">
    <div class="layout_l">
        <div class="member_info">
            <dl>
                <dt>
                	<a title="编辑用户信息" href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>"><?php echo $this->_vars['user']['nickname']; ?>
(<?php echo $this->_vars['user']['username']; ?>
)</a>&nbsp;
                	<img align="absmiddle" src="<?php  echo ng169\hook\vo_list("fun=@!getlevelimg2!@ type=@!am!@ mod=@!userlevel!@  param1=@!{$this->_vars['user']['ugod']}'-'{$this->_vars['ubad']}!@"); ?>">
                	<br>
                	
                </dt>
                <dd class="qd payment">
                <?php if (! $this->_vars['user']['emailrz']): ?>
                    <span class="iconfont"></span>&nbsp;<a href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>">未认证</a><?php else: ?>
                    <span class="iconfont" style='color:orange'></span>&nbsp;<a href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>">已认证</a> 
                    <?php endif; ?>
                     <?php if (! $this->_vars['user']['mobilerz']): ?>
                    <span class="iconfont"></span><a href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>">未认证</a><?php else: ?>
                     <span class="iconfont" style='color:orange'></span><a href="<?php echo \ng169\hook\url(array('mod' => 'set'), $this);?>">已认证</a>
                     <?php endif; ?>
                </dd>
				<dd class="payment">
                    <a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'set','action' => 'address'), $this);?>">我的收货地址</a>
                  
                    </dd>
            </dl>
            <div class="s-content">
        <ul>
            <li>
                <a  target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => "waitpay"), $this);?>" ><span>待付款<em><?php  echo ng169\hook\vo_list("fun=@!getwaitpay!@ mod=@!order!@ type=@!im!@"); ?></em></span></a>
            </li>
            <li>
                <a  target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','args' => "status:1"), $this);?>" ><span>待发货<em><?php  echo ng169\hook\vo_list("fun=@!getwaitfh!@ mod=@!order!@ type=@!im!@"); ?></em></span></a>
            </li>
            <li>
                <a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => "waitsure"), $this);?>" ><span>待收货<em><?php  echo ng169\hook\vo_list("fun=@!getwaitsure!@ mod=@!order!@ type=@!im!@"); ?></em></span></a>
            </li>
            <li>
                <a  target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','action' => "waitcomment"), $this);?>" ><span>待评价<em><?php  echo ng169\hook\vo_list("fun=@!getwaitcomment!@ mod=@!order!@ type=@!im!@"); ?></em></span></a>
            </li>
            <li>
                <a  target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'order','args' => "status:5"), $this);?>" ><span>退款<em><?php  echo ng169\hook\vo_list("fun=@!getwaittk!@ mod=@!order!@ type=@!im!@"); ?></em></span></a>
            </li>
        </ul>
    </div>
            
            <div class="clear"></div>
            
        </div>

       

        <div class="tabmenu">
            <ul class="tab">
                <li class="active"><a href="javascript:void(0)">&nbsp;&nbsp;&nbsp;足迹</a><div></div></li>
            </ul>
        </div>
         <div class="footprint">
        <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                <div class="team">
        	<div class="team-title clearfix">
        	
        	<?php  $this->_vars['sb']=(date("%Y-%m-%d",$this->_vars['volist']['stime'])==date("%Y-%m-%d",$this->_vars['time'])); ?>
            	<h3><?php if ($this->_vars['sb']): ?>今天<?php else:  echo $this->_run_modifier($this->_vars['volist']['stime'], 'date_format', 'plugin', 1, "%d"); ?>
日<?php endif; ?></h3>
                <div class="date-info">
                	<p><?php echo $this->_run_modifier($this->_vars['volist']['stime'], 'date_format', 'plugin', 1, "%Y-%m"); ?>
</p>
                    <span>浏览了<?php echo $this->_vars['volist']['num']; ?>
件商品</span>
                </div>
            </div>
        	<div class="team-list">
            	<div class="list-box clearfix">
            	<?php $this->assign('plist', \ng169\hook\vo_list("fun=@!getlist!@ array=@!'theday:'{$this->_vars['volist']['theday']}',uid:'{$this->_vars['user']['uid']}!@ mod=@!history!@   type=@!im!@")); ?>
            	<?php if (count((array)$this->_vars['plist'])): foreach ((array)$this->_vars['plist'] as $this->_vars['list']): ?>
                                        <div class="item">
                        <div class="item-box">
                            <div class="p-pic">
                            <a href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['list']['productid'] . ""), $this);?>">
                            <img width="200" height="200" src="<?php echo $this->_run_modifier($this->_vars['list']['smallimg1'], 'imgsize', 'PHP', 1, '220,220'); ?>
">
                            </a> 
                            <a class="delete" href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'collect','action' => 'hdel','args' => "logid:" . $this->_vars['volist']['logid'] . ""), $this);?>"><i></i>删除</a>
                            </div>
                            <div class="p-pname"><?php echo $this->_run_modifier($this->_vars['list']['productname'], 'tostr', 'PHP', 1); ?>
  </div>
                            <div class="p-pirce">
                            	<span>￥</span>
                            	<b><?php echo $this->_vars['list']['price']; ?>
</b>
                            </div>
                        </div>
					</div>
                      <?php endforeach; endif; ?>                  
                                   	</div>
            </div>
        </div>
<?php endforeach; endif; ?>
               
               
                </div>
        
        
        
    </div>
    
    <div class="layout_r">
        <div class="user_atten clearfix">
            <ul>
                <li><a href="<?php echo \ng169\hook\url(array('mod' => 'collect','action' => 'shop'), $this);?>"><strong><?php  echo ng169\hook\vo_list("fun=@!get_shopsum!@ mod=@!collect!@ type=@!im!@"); ?></strong><span>收藏的店铺 </span></a></li>
                <li><a href="<?php echo \ng169\hook\url(array('mod' => 'collect','action' => 'product'), $this);?>"><strong><?php  echo ng169\hook\vo_list("fun=@!get_productsum!@ mod=@!collect!@ type=@!im!@"); ?></strong><span>收藏的商品 </span></a></li>
               
            </ul>
        </div>
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>可能感兴趣的店铺</legend></fieldset>
            </form>
            <div class="right_module_content friends">
               
    <?php $this->assign('shop', \ng169\hook\vo_list("fun=@!get_all!@ mod=@!merchant!@ num=@!6!@  array=@!rzflag:[1|2]!@")); ?>
   
    <?php if (count((array)$this->_vars['shop'])): foreach ((array)$this->_vars['shop'] as $this->_vars['volist']): ?>
    <dl class="clearfix">
        <dt><a target="_blank" href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><img height="50" width="50" src="<?php echo $this->_vars['volist']['logo']; ?>
"></a></dt>
        <dd>
        <p class="name"><a target="_blank" href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"><?php echo $this->_vars['volist']['merchantname']; ?>
</a></p>
        <a class="addicon" href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['volist']['muid'] . ""), $this);?>"  target="_blank"><span>查看店铺</span></a>
        </dd>
    </dl>
<?php endforeach; endif; ?>
  

            </div>
        </div>
        
      <!--  <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>热门活动</legend></fieldset>
            </form>
            <div class="right_module_content ad174">
           
            </div>
        </div>
        
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>商品推荐</legend></fieldset>
            </form>
            <div class="right_module_content ad174">
           
            </div>
        </div>-->
        <div class="right_module">            
            <form class="right_module_title">
                <fieldset><legend>公告栏</legend></fieldset>
            </form>
            <div class="right_module_content con">
            <?php $this->assign('gg', \ng169\hook\vo_list("mod=@!notice!@ type=@!im!@ fun=@!getlist!@ ")); ?>
				<?php if (count((array)$this->_vars['gg'])): foreach ((array)$this->_vars['gg'] as $this->_vars['volist']): ?>
				<li>
				<a href="<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'article','action' => 'show','agrs' => "articleid:" . $this->_vars['volist']['articleid'] . ""), $this);?>" target="_blank" title="<?php echo $this->_vars['volist']['title']; ?>
"><?php echo $this->_vars['volist']['title']; ?>
</a></li>
				<?php endforeach; endif; ?>
           


            </div>
        </div>
    
      <!--  <div class="right_module">
            <form class="right_module_title" id="weixin">
                <fieldset><legend>扫一扫 关注微信公众号</legend></fieldset>
            </form>
            <div class="weixin_code">
				<img src="">;
			</div>
        </div>-->
    </div>
</div>
</div>
				
				
				
				
				
				
				
				
		    
	  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	