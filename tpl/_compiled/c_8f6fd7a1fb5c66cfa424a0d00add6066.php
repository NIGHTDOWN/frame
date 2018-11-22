<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/user/pindex.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:51:04 */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pframe.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	
	<div class="fn-right"><div class="block fn-clear">
	<div class="balance account">
    	<p>
        账户余额
       
        </p>
        <div>
            <span class="wallet">
                <em><strong><?php echo $this->_vars['user']['cash']/100; ?>
</strong></em>
                <span> 元</span>
            </span>
            <a class="btn" href="<?php echo \ng169\hook\url(array('mod' => 'recharge'), $this);?>">充 值</a>
            <a class="btn1" href="<?php echo \ng169\hook\url(array('mod' => 'withdraw'), $this);?>">提 现</a>
           
        </div>
    </div>
	<div class="message">
	<p>最近登录IP </p>
	<?php if (count((array)$this->_vars['log'])): foreach ((array)$this->_vars['log'] as $this->_vars['volist']): ?>
	<p><span><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y/%m/%d %H:%M:%S"); ?>
</span>|
	<span><?php echo $this->_vars['volist']['ip']; ?>
</span></p>
	<?php endforeach; endif; ?>
	</div>
</div>
<div class="block">
	<div class="record">
        <p>
            交易记录
          
            <a href="<?php echo \ng169\hook\url(array('action' => 'recharge','mod' => 'log'), $this);?>">充值记录</a>
            <a href="<?php echo \ng169\hook\url(array('action' => 'withdraw','mod' => 'log'), $this);?>">提现记录</a>
        </p>
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tbody><tr>
            	<th class="al" width="80">创建时间</th>
                <th class="al">名称 | 交易号
                </th><th width="200">金额(元)</th>
                <th width="80">状态</th>
                <th width="80">操作</th>
            </tr>
            <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
        	            <tr>
            	<td class="al"><?php echo $this->_run_modifier($this->_vars['volist']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</td>
            	<td class="al">订单【<?php echo $this->_vars['volist']['ordernum']; ?>
】消费</td>
            	<td class="price  minus">
                	<?php echo $this->_vars['volist']['paytotal']/100; ?>

                </td>
            	<td>
                                	 <?php if ($this->_vars['volist']['status'] == 0): ?>等待买家付款
                             
                     <?php elseif ($this->_vars['volist']['status'] == 1): ?>买家已付款
                     <?php elseif ($this->_vars['volist']['status'] == 2): ?>卖家已发货
                     <?php elseif ($this->_vars['volist']['status'] == 3): ?>交易成功
                     <?php elseif ($this->_vars['volist']['status'] == 4): ?>交易关闭
                     <?php elseif ($this->_vars['volist']['status'] == 5): ?>退款中的订单
                     <?php endif; ?>                                </td>
            	<td>
                                	<a href="<?php echo \ng169\hook\url(array('group' => 'user','mod' => 'order','args' => "oid:" . $this->_vars['volist']['ordernum'] . "",'action' => 'detail'), $this);?>">查看订单</a>
                                </td>
            </tr>
                         <?php endforeach; endif; ?>         
                                </tbody></table>
    </div> 
</div></div>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."pfoot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	


