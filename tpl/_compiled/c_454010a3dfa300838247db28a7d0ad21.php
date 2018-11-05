<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  require_once('F:\www\ds\source\core\template\src\plugins\modifier.truncate.php'); $this->register_modifier("truncate", "tpl_modifier_truncate");  /* "tpl/templets/default/shop_comment.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:42:21 �й���׼ʱ�� */ ?>

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
	<div id="right"><style>
.score td{text-align:right;}
.score td .div{float:right;text-align:right;}
.scroller{background: url(<?php echo $this->_vars['indextpl']; ?>
res/ico/credit.png) 17px 23px no-repeat; display: block; height: 22px; padding: 0 0 17px 30px; text-align: left; width: 400px; margin-right:25px; }
.scroller span {  display: block; height: 22px; width: 0; }
.scroller em { background: url(<?php echo $this->_vars['indextpl']; ?>
res/ico/credit.png)  -417px 2px no-repeat;  color: white; display: block; float: right; height: 22px; padding-top: 1px;  text-align: center; width: 30px; }
.rate-desc { height: auto; overflow: hidden; width: 400px; }
.rate-desc li { display: block; float: left; text-align: center; width: 80px; }
.span { background: url(<?php echo $this->_vars['indextpl']; ?>
res/ico/star.gif) 0 -27px ; display: inline-block; height: 12px; overflow: hidden; text-align: left; vertical-align: inherit; width: 60px; }
</style>
<div class="module_special">
	<h2>动态评价</h2>
    <div class="score">
    <table width="88%" style="margin:auto;">  
        <tbody><tr>
            <td width="85">
            <div class="div">
            与描述相符
            <p><?php echo ($this->_vars['data']['mspf']); ?>
分</p>
            <span class="star"><em style=" width: <?php  echo ($this->_vars['data']['mspf'])/0.05; ?>%"><?php echo ($this->_vars['data']['mspf']); ?>
</em></span>
            </div>
            </td>
            <td>
            <div class="scroller">
                <span style="width: <?php  echo ($this->_vars['data']['mspf'])/0.05; ?>%;"><em><?php echo ($this->_vars['data']['mspf']); ?>
</em></span>
            </div>
            <div class="rate-desc">
                <ul>
                    <li>非常不满</li>
                    <li>不满意</li>
                    <li>一般</li>
                    <li>满意</li>
                    <li>非常满意</li>
                </ul>
            </div>
            </td>
        </tr>
        
        <tr>
            <td align="right">
            卖家的服务态度
            <p><?php echo ($this->_vars['data']['fwpf']); ?>
分</p>
            <span class="star"><em style=" width: <?php  echo ($this->_vars['data']['fwpf'])/0.05; ?>%"><?php echo ($this->_vars['data']['fwpf']); ?>
</em></span>
            </td>
            <td align="right">
            <div class="scroller">
                <span style="width: <?php  echo ($this->_vars['data']['fwpf'])/0.05; ?>%;"><em><?php echo ($this->_vars['data']['fwpf']); ?>
</em></span>
            </div>
            <div class="rate-desc">
                <ul>
                    <li>非常不满</li>
                    <li>不满意</li>
                    <li>一般</li>
                    <li>满意</li>
                    <li>非常满意</li>
                </ul>
            </div>
            </td>
        </tr>
       
        <tr>
            <td align="right">
            物流发货的速度
            <p><?php echo ($this->_vars['data']['wlpf']); ?>
分</p>
            <span class="star"><em style=" width: <?php  echo ($this->_vars['data']['wlpf'])/0.05; ?>%"><?php echo ($this->_vars['data']['wlpf']); ?>
</em></span></td>
            <td align="right">
            <div class="scroller">
                <span style="width: <?php  echo ($this->_vars['data']['wlpf'])/0.05; ?>%;"><em><?php echo ($this->_vars['data']['wlpf']); ?>
</em></span>
            </div>
            <div class="rate-desc">
                <ul>
                    <li>非常不满</li>
                    <li>不满意</li>
                    <li>一般</li>
                    <li>满意</li>
                    <li>非常满意</li>
                </ul>
            </div>
            </td>
        </tr>
    </tbody></table>
    </div>
</div>   
<div class="module_special">
	<h2>信用评价</h2>
    <div class="con">
    	<table width="100%" class="credit">
        	<tbody><tr class="title">
            	<th width="20%"></th>
            	<th width="15%">最近1个月</th>
                <th width="15%">最近3个月</th>
                <th width="15%">最近6个月</th>
                <th width="15%">6个月以前</th>
                <th width="15%">总计</th>
            </tr>
                        <tr>
          	                	<th><b><span class="cg">好评</span></b></th>
                                <td><?php echo $this->_vars['commentnum']['m1']['good']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m3']['good']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m6']['good']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m7']['good']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m']['good']; ?>
</td>
            </tr>
                        <tr>
          	                	<th><b><span class="cm">中评</span></b></th>
                               <td><?php echo $this->_vars['commentnum']['m1']['center']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m3']['center']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m6']['center']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m7']['center']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m']['center']; ?>
</td>
            </tr>
                        <tr>
          	                	<th><b><span class="cb">差评</span></b></th>
                                <td><?php echo $this->_vars['commentnum']['m1']['bad']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m3']['bad']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m6']['bad']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m7']['bad']; ?>
</td>
                                <td><?php echo $this->_vars['commentnum']['m']['bad']; ?>
</td>
            </tr>
                        <tr>
            	<th><b><span class="cz">总计</span></b></th>
                <td><?php  echo $this->_vars['commentnum']['m1']['bad']+$this->_vars['commentnum']['m1']['center']+$this->_vars['commentnum']['m1']['good']; ?></td>
                <td><?php  echo $this->_vars['commentnum']['m3']['bad']+$this->_vars['commentnum']['m3']['center']+$this->_vars['commentnum']['m3']['good']; ?></td>
                <td><?php  echo $this->_vars['commentnum']['m6']['bad']+$this->_vars['commentnum']['m6']['center']+$this->_vars['commentnum']['m6']['good']; ?></td>
                <td><?php  echo $this->_vars['commentnum']['m7']['bad']+$this->_vars['commentnum']['m7']['center']+$this->_vars['commentnum']['m7']['good']; ?></td>
                                                <td><?php  echo $this->_vars['data']['m']['bad']+$this->_vars['data']['m']['good']+$this->_vars['data']['m']['center']; ?></td>
            </tr>
        </tbody></table>
    </div>
</div>
<div class="module_special">    
    <h2>来自买家的评论</h2>
    <div class="con">
        <table width="100%" class="comment">
            <tbody><tr class="title">
                <th width="50"></th>
                <th></th>
                <th align="left" width="150">评价人</th>
                <th align="left" width="200">商品</th>
                <th width="100">时间</th>
            </tr>
            <?php if (count((array)$this->_vars['comment'])): foreach ((array)$this->_vars['comment'] as $this->_vars['volist']): ?>
                        <tr>
            	<td align="center">
            	<?php if ($this->_vars['volist']['cmlevel'] == 1): ?>
            	<span class="cg">好评</span>
            	<?php elseif ($this->_vars['volist']['cmlevel'] == 2): ?>
            	<span class="cb">差评</span>
            	<?php elseif ($this->_vars['volist']['cmlevel'] == 0): ?>
            	<span class="cb">中评</span>
            	<?php endif; ?>
            	</td>
                <td>
                	<?php echo $this->_vars['volist']['cmcontent']; ?>

                </td>
                <td><a  href="#"><?php echo $this->_run_modifier($this->_vars['volist']['username'], 'incode', 'PHP', 1); ?>
</a></td>
  <td>
  <a target="_blank" href="<?php echo url(array('mod' => 'product','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'truncate', 'plugin', 1, 24); ?>
</a><p>￥ <?php echo $this->_vars['volist']['total']; ?>
</p></td>
                <td align="center"><?php echo $this->_run_modifier($this->_vars['volist']['cmtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
 </td>
            </tr>
                      <?php endforeach; endif; ?>
                    </tbody></table>
    </div>
</div></div>
    <div class="clear"></div>
	</div>

		


		  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


</body></html>