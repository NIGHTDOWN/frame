<?php /* "tpl/shop/shop_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:29 �й���׼ʱ�� */ ?>


<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menutop.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<div class="intro clearfix">
    <div class="left">
        <div class="store-pic">
            <?php if ($this->_vars['user']['logo']): ?>
            <img width="95" height="95" src="    <?php echo $this->_vars['user']['logo']; ?>
">
            <?php else: ?>
            <img width="95" height="95" src="<?php echo $this->_vars['shoptpl']; ?>
res/default_logo.gif">
            <?php endif; ?>
        </div>
        <div class="userinfo">
            <div class="basic clearfix">
                <strong><?php echo $this->_vars['user']['username']; ?>
</strong>
                <a href="">
                <img src="<?php echo $this->_vars['shoptpl']; ?>
res/certification_no.gif">
                </a>
                <a href="">
                <img src="<?php echo $this->_vars['shoptpl']; ?>
res/certautonym_no.gif">
                </a>
                &nbsp;白金店铺
            </div>
            <div>
                <span>卖家信誉:</span>
               	<img align="0" title="0" src="<?php echo $this->_vars['shoptpl']; ?>
res/s_red_1.gif">
            </div>
            <div>
                <span>店铺名称:</span>
                <a target="_blank" href="<?php echo url(array('mod' => 'shop','action' => 'show','group' => 'index','args' => "id:" . $this->_vars['user']['muid'] . ""), $this);?>"><?php echo $this->_vars['user']['merchantname']; ?>
</a>
            </div>
            <div>
                <span>店铺状态:</span>
                <?php if ($this->_vars['user']['storeflag'] == 0): ?>
                已开启，展示中     
                <?php else: ?>
                 已关闭     
                <?php endif; ?> 
                      </div>
        </div>
    </div>
    <div class="right seller-rate">
        <h2>店铺动态评分</h2>
        <dl>
            <dt>描述相符:</dt>
            <dd class="rate-star"><em><i style="width: <?php echo $this->_vars['user']['mspf']/5*100; ?>
%;"></i></em></dd>
            <dd><?php echo $this->_vars['user']['mspf']; ?>
分</dd>
        </dl>
        <dl>
            <dt>服务态度:</dt>
            <dd class="rate-star"><em><i style=" width: <?php echo $this->_vars['user']['fwpf']/5*100; ?>
%;"></i></em></dd>
            <dd><?php echo $this->_vars['user']['fwpf']; ?>
分</dd>
        </dl>
        <dl>
            <dt>发货速度:</dt>
            <dd class="rate-star"><em><i style=" width: <?php echo $this->_vars['user']['wlpf']/5*100; ?>
%;"></i></em></dd>
            <dd><?php echo $this->_vars['user']['wlpf']; ?>
分</dd>
        </dl>
    </div>
</div>
<div class="layout">
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."leftmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
    <div class="right_content"><div class="fl i-fl">
    <div class="container h166">
        <div class="hd"><h2>店铺提示</h2></div>
        <div class="content">
            <dl class="focus">
                <h2>您需要关注的店铺情况：</h2>
                <dt>消息：</dt>
               <dd><a href="<?php echo url(array('mod' => 'message','group' => 'user'), $this);?>">系统消息 (<strong><?php echo $this->_vars['data']['xxnum']; ?>
</strong>)</a></dd>
                
                <dt>商品提示：</dt>
                <dd><a href="<?php echo url(array('mod' => 'product','action' => 'waitcheck'), $this);?>">待审核商品 (<strong><?php echo $this->_vars['data']['wchnum']; ?>
</strong>)</a></dd>
                <dd><a href="<?php echo url(array('mod' => 'product','action' => 'depot'), $this);?>">仓库待上架商品 (<strong><?php echo $this->_vars['data']['cknum']; ?>
</strong>)</a></dd>
               
                <!--  <dt>咨询提示：</dt>
               <dd><a href="">买家的留言 (<strong>0</strong>)</a></dd>
                <dt>违规提示：</dt>
                <dd><a href="">被举报禁售 (<strong>0</strong>)</a></dd> -->
            </dl>
            <ul>
                <li><a href="<?php echo url(array('mod' => 'product','action' => 'sell'), $this);?>">出售中的商品 (<strong><?php echo $this->_vars['data']['csnum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'product','action' => 'Illegal'), $this);?>">违规下架的商品 (<strong><?php echo $this->_vars['data']['wgnum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'product','action' => 'add'), $this);?>">商品发布</a></li>
             
            </ul>
        </div>
    </div>
    <div class="container h166">
        <div class="hd"><h2>交易提示</h2></div>
        <div class="content">
            <dl class="focus">
                <h2>您需要立即处理的交易订单：</h2>
                <dt>近期售出：</dt>
                <dd><a href="<?php echo url(array('mod' => 'sells','action' => 'run'), $this);?>">交易中的订单 (<strong><?php echo $this->_vars['data']['doingnum']; ?>
</strong>)</a></dd>
                <dt>销售总额：</dt>
                <dd>订单总额 (<strong><?php echo $this->_vars['data']['cashall']; ?>
</strong>)</dd>
                <dd>实际总额 (<strong><?php echo $this->_vars['data']['cashsjall']; ?>
</strong>)</dd>
            </dl>
            <ul>
                  
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'waitpay'), $this);?>">待付款 (<strong><?php echo $this->_vars['data']['wfknum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'waitsend'), $this);?>">待发货 (<strong><?php echo $this->_vars['data']['yfknum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'waitsure'), $this);?>">待收货 (<strong><?php echo $this->_vars['data']['yfhnum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'over'), $this);?>">完成的 (<strong><?php echo $this->_vars['data']['oallnum']; ?>
</strong>)</a></li>
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'run'), $this);?>">退货 (<strong><?php echo $this->_vars['data']['thnum']; ?>
</strong>)</a></li>
               
                <li><a href="<?php echo url(array('mod' => 'sells','action' => 'wpj'), $this);?>">待评价 (<strong><?php echo $this->_vars['data']['pjnum']; ?>
</strong>)</a></li>
            </ul>
        </div>
    </div>

	<!--[if IE]><script src=""></script><![endif]-->
    <div class="container">
        <div class="hd"><h2>店铺流量</h2></div>
        <div class="content">
		<canvas id="cv" width="575" height="142" style="width: 575px; height: 142px;"></canvas>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo $this->_vars['shoptpl']; ?>
res/Chart.js"></script>
    <script>
       
	window.onload = function() {

         $labels=new Array();
        $data=new Array();
        <?php if (count((array)$this->_vars['data']['visit'])): foreach ((array)$this->_vars['data']['visit'] as $this->_vars['k'] => $this->_vars['volist']): ?>
        $labels[<?php echo $this->_vars['k']; ?>
]='<?php echo $this->_vars['volist']['date']; ?>
'
        $data[<?php echo $this->_vars['k']; ?>
]='<?php echo $this->_vars['volist']['usernum']; ?>
'
        <?php endforeach; endif; ?> 
		var ctx = document.getElementById('cv').getContext('2d');
		var data = {
				labels : $labels,
				datasets : 
				[
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "#DCDCDC",
						pointColor : "#DCDCDC",
						pointStrokeColor : "#fff",
						data : $data
					}
				]
			}
		new Chart(ctx).Line(data);
	};
    </script>
</div>
<div class="fr i-fr">
        <div class="news container h166">
            <div class="hd"><h2>商城公告</h2></div>
            <div class="content">
                <ul>
                    <?php if (count((array)$this->_vars['data']['scnews'])): foreach ((array)$this->_vars['data']['scnews'] as $this->_vars['volist']): ?>
                    <li>
                        <a href="<?php echo url(array('mod' => 'single','action' => 'show','group' => 'index','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>" target="_blank" title="<?php echo $this->_vars['volist']['title']; ?>
"><?php echo $this->_vars['volist']['title']; ?>
</a>
                    </li>
                   <?php endforeach; endif; ?>
                
                
                </ul>
            </div>
        </div>
        <div class="contact container h166">
            <div class="hd"><h2>平台联系方式</h2></div>
            <div class="content">
                <ul>
                    <li>客服电话: <?php echo $this->_vars['config']['site_phone']; ?>
</li>
                    <li>客服手机: <?php echo $this->_vars['config']['site_mobile']; ?>
</li>
                    <li>电子邮箱: <?php echo $this->_vars['config']['site_email']; ?>
</li>
                    <li>联系地址: <?php echo $this->_vars['config']['site_addr']; ?>
</li>
                    <li>服务时间:9:00-18:00(周一至周日)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
    <div class="clear"></div>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>