<?php /* "/tpl/shop/leftmenu.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:33 �й���׼ʱ�� */ ?>

<div class="sidebar">

<dl>
    <dt onclick="_go_url('<?php echo url(array('mod' => 'shop','action' => 'run'), $this);?>')"><i class="pngFix"></i>首页</dt>    	
            <dd style="display:">
            	<ul>
                	                                                                <li>
                        <a href="<?php echo url(array('mod' => 'shop','action' => 'run'), $this);?>">卖家中心</a>
                        </li>
                          
                         
                                                                                                                                        </ul>
            </dd>
        </dl>
        
                <dl>
        	<dt><i class="pngFix"></i>商品管理</dt>
            <dd style="display:">
            	<ul>
                	                                                                <li>
                        <a href="<?php echo url(array('mod' => 'product','action' => 'add'), $this);?>">商品发布</a>
                        </li>
                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'product','action' => 'sell'), $this);?>">出售中的商品</a>
                        </li>
                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'product','action' => 'depot'), $this);?>">仓库中的商品</a>
                        </li>
                         
                                                                                                                                        </ul>
            </dd>
        </dl>
                <dl>
        	<dt><i class="pngFix"></i>交易管理</dt>
            <dd style="display:">
            	<ul>
                	                                                                <li>
                        <a href="<?php echo url(array('mod' => 'sells','action' => 'run'), $this);?>">已售商品</a>
                        </li>
                                                                                                                                              
                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'logistics','action' => 'run'), $this);?>">物流工具</a>
                        </li>
                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'comment','action' => 'run'), $this);?>">我的评论</a>
                        </li>
                                                                                                                                                                                                                                                                </ul>
            </dd>
        </dl>
                <dl>
        	<dt><i class="pngFix"></i>网店设置</dt>
            <dd style="display:">
            	<ul>
                	                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'set','action' => 'run'), $this);?>">店铺设置</a>
                        </li>
                 <li>
                        <a href="<?php echo url(array('mod' => 'category','action' => 'run'), $this);?>">店铺分类</a>
                        </li>
                        
                            
                                                                                                                                                                                                                                                                                                        </ul>
            </dd>
        </dl>
                <dl>
        	<dt><i class="pngFix"></i>营销中心</dt>
            <dd style="display:">
            	<ul>
                	                                                                                                        <li>
                        <a href="<?php echo url(array('mod' => 'groupon','action' => 'run'), $this);?>">团购管理</a>
                        </li>
                           
                                                                                                                                              
                                                                                                </ul>
            </dd>
        </dl>
                <dl style="display:none">
        	<dt><i class="pngFix" ></i>其他设置</dt>
            <dd style="display:none">
            	<ul>
                	                                                                <li>
                        <a href="<?php echo url(array('mod' => 'product','action' => 'depot'), $this);?>">我的咨询</a>
                        </li>
                                                                                                                                                                                </ul>
            </dd>
        </dl>
            </div>