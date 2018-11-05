<?php /* "/tpl/templets/default/pleft.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-13 23:50:16 �й���׼ʱ�� */ ?>

<div id="left">
        <div class="user clearfix">
            <div class="user_photo">
                <h2><?php echo $this->_vars['data']['muid']; ?>
 </h2>
                <dl>
                    <dt>
                     <img width="65" height="60" src="<?php echo $this->_vars['data']['logo']; ?>
">
                                            </dt>
                    <dd><b><a target="_blank" href="#"><?php echo $this->_vars['data']['username']; ?>
</a></b></dd>
                    	<?php $this->assign('shoplevel', vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['data']['muid']}!@")); ?>
					<dd><img title="卖家信用：<?php echo $this->_vars['data']['slevel']; ?>
" align="absmiddle" src="<?php echo $this->_vars['shoplevel']; ?>
"></dd>
                    <dd>好评率：
                    <?php if (( $this->_vars['data']['good'] + ( $this->_vars['data']['bad'] ) ) == 0): ?>100%<?php else: ?>
                    <?php  echo (($this->_vars['data']['good'])*100)/($this->_vars['data']['good']+($this->_vars['data']['bad'])); ?>%<?php endif; ?></dd>
                </dl> 
            </div>
            <div class="clear"></div>
            <div class="user_data">
                <h2>动态评价</h2>
                <p>描述相符：<span class="star"><em style=" width:<?php  echo ($this->_vars['data']['mspf'])/0.05; ?>%"><?php echo $this->_vars['data']['mspf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['mspf']; ?>
分</span></p>
                <p>服务态度：<span class="star"><em style=" width:<?php  echo ($this->_vars['data']['fwpf'])/0.05; ?>%"><?php echo $this->_vars['data']['fwpf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['fwpf']; ?>
分</span></p>
            
                <p>物流速度：<span class="star"><em style=" width:<?php  echo ($this->_vars['data']['wlpf'])/0.05; ?>%"><?php echo $this->_vars['data']['wlpf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['wlpf']; ?>
分</span></p>			
				<h2>店铺信息</h2>
                <p>认证信息：
                <?php if ($this->_vars['data']['rzflag'] == 2): ?>
                <img src="<?php echo $this->_vars['indextpl']; ?>
res/ico/certification_no.gif">
                 <?php elseif ($this->_vars['data']['rzflag'] == 1): ?>
                <img src="<?php echo $this->_vars['indextpl']; ?>
res/ico/certautonym_no.gif">
                <?php endif; ?>
                </p>
                <p>保证金：<?php  echo $this->_vars['data']['bzjcash']/100; ?></p>
                <p>商品数量：<?php  echo vo_list("fun=@!getprocount!@ mod=@!mcount!@ type=@!im!@  param1=@!{$this->_vars['data']['muid']}!@"); ?></p>
                <p>创店时间：<?php echo $this->_run_modifier($this->_vars['data']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</p>
            </div>
            <div class="shop_other">
                <ul>
                    <li class="info_qrcode">
                        <a href="javascript:void(0)">
                        <span>店铺二维码</span><b></b>
                       
                        <p class="qrcode"><img src="<?php echo url(array('action' => 'qr','mod' => 'shop','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="i-search">
            <h2>店内搜索</h2>
            <div class="con">
                <form method="post" action="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" >
                	<table>
                    	<tbody><tr>
                        	<td width="40">商品：</td>
                        	<td><input type="text" name="word" value="" class="text w112"></td>
                        </tr>
                    	<tr>
                        	<td>价格：</td>
                        	<td>
                            <input type="text" name="price1" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" class="text w48">
                            -
                            <input type="text" name="price2" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" class="text w48">
                            </td>
                        </tr>
                    	<tr>
                        	<td></td>
                        	<td><input type="submit" value="搜索" class="btn"></td>
                        </tr>
                    </tbody></table>
                   
                </form>
            </div>
        </div>
                <div class="module_common">
            <h2>分类</h2>
            <div class="con">
                <ul class="submenu">
                    <li><a class="block_ico" href="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>" title="全部">全部</a>
                    </li>
                    <?php $this->assign('cat', vo_list("fun=@!get_all!@ mod=@!shop_category!@  array=@!'depth:0,muid:'{$this->_vars['data']['muid']}!@}")); ?>
                    <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
                                        <li>
  <?php $this->assign('cat2', vo_list("fun=@!getl2!@ type=@!im!@ mod=@!scategory!@  array=@!'muid:'{$this->_vars['data']['muid']}',scatid:'{$this->_vars['volist']['scatid']}!@")); ?>

                    <a class="block_ico" href="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ",scatid:" . $this->_vars['volist']['scatid'] . ""), $this);?>" title="<?php echo $this->_vars['volist']['catname']; ?>
"><?php echo $this->_vars['volist']['catname']; ?>
</a>
                                       <ul style="display: none">
                                      
                                      
                                        <?php if (count((array)$this->_vars['cat2'])): foreach ((array)$this->_vars['cat2'] as $this->_vars['volist2']): ?>
                                                    <li><a href="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ",scatid:" . $this->_vars['volist2']['scatid'] . ""), $this);?>" title="<?php echo $this->_vars['volist2']['catname']; ?>
"><?php echo $this->_vars['volist2']['catname']; ?>
</a></li>
                                                     <?php endforeach; endif; ?>       
                                                
                                            </ul>
                                        </li>
                                <?php endforeach; endif; ?>       
                                    </ul>
            </div>
        </div>
                    </div>