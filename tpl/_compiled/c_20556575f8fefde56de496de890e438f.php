<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/shop/product_sell.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:33 �й���׼ʱ�� */ ?>



<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."menutop.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<div class="layout">
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."leftmenu.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
<div class="right_content">
<script type="text/javascript">

$(function(){
    /* 全选 */
	 $('.checkall').click(function(){
        var _self = this;
        $('.checkitem').each(function(){
            if (!this.disabled)
            {
                $(this).attr('checked', _self.checked);
            }
        });
        $('.checkall').attr('checked', this.checked);
    });
	
});
</script>
<div class="path">
    <div>
    	<a href="<?php echo url(array('mod' => 'shop'), $this);?>">卖家中心</a> <span>&gt;</span> 
        出售中的商品
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
            <?php if ($this->_vars['a'] == 'sell'): ?>
                <li class="active"><a href="#">出售中的商品</a></li>
                <?php endif; ?>
            <?php if ($this->_vars['a'] != 'sell'): ?>
                <li <?php if ($this->_vars['a'] == 'depot'): ?>class="active"<?php else: ?>class='normal'<?php endif; ?>><a href="<?php echo url(array('action' => 'depot'), $this);?>">仓库中的商品</a></li>
                  <li <?php if ($this->_vars['a'] == 'Illegal'): ?>class="active"<?php else: ?>class='normal'<?php endif; ?>><a href="<?php echo url(array('action' => 'Illegal'), $this);?>">违规商品</a></li>
                    <li <?php if ($this->_vars['a'] == 'waitcheck'): ?>class="active"<?php else: ?>class='normal'<?php endif; ?>><a href="<?php echo url(array('action' => 'waitcheck'), $this);?>">待审核商品</a></li>
                <?php endif; ?>
                <li class="search-box">
                    <form method="post" action='<?php echo url(array('action' => $this->_vars['a']), $this);?>'>
						
                        <input type="text" class="w200" placeholder="请输入商品关键字或商家编码" name="productname" value="<?php echo $this->_run_modifier($this->_vars['where']['productname'], 'tostr', 'PHP', 1); ?>
">
                        <input type="submit" class="btn2" value="搜索">
                    </form>
                </li>
            </ul>
        </div> <form method="post" >
       <table class="table-list-style">
        	<thead>
            <tr>
            	<th width="30"></th>
            	<th width="70"></th>
            	<th>商品名称</th>
                <th width="100">价格</th>
            	<th width="100">库存</th>
            	<th width="100">发布时间</th>
            	<th width="100">推荐</th>
            	<th width="90">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                        <tr>
            	<th class="tc"><input type="checkbox" value="<?php echo $this->_vars['volist']['productid']; ?>
" class="checkitem" name="productid[]"></th>
            	<th colspan="6">商品货号: <?php echo $this->_vars['volist']['productid']; ?>
 </th>
                <th class="tc">
                
                
                </th>
            </tr>
            <tr> 
                <td></td>
                <td>
                <div class="pic-small">
                    <a target="_blank" href="<?php echo url(array('mod' => 'product','group' => 'index','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">
                    	<img width="60" height="60" src="<?php echo $this->_vars['volist']['smallimg1']; ?>
" alt="gfh">
                    </a>
                </div>
                </td>
                <td class="tl" valign="top"><a target="_blank" href="<?php echo url(array('mod' => 'product','group' => 'index','action' => 'detail','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['productname'], 'tostr', 'PHP', 1); ?>
</a></td>
                <td><?php echo $this->_vars['volist']['price']/100; ?>
</td>
                <td><?php echo $this->_vars['volist']['count']; ?>
</td>
                <td><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</td>
                <td>
                <?php if ($this->_vars['volist']['melite']): ?>
                <span id="rec1_1267"><a href="<?php echo url(array('mod' => 'product','action' => 'downmelite','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">点击取消推荐</a></span>
               <?php else: ?>
                <span style="display:" id="rec2_1267"><a href="<?php echo url(array('mod' => 'product','action' => 'upmelite','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">点击橱窗推荐</a></span>
                <?php endif; ?>
                </td>
                <td>
               
                <p>
                <?php if ($this->_vars['volist']['shelves']): ?>
                <a href="<?php echo url(array('mod' => 'product','action' => 'downshelves','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">下架</a><?php else: ?>
                <a href="<?php echo url(array('mod' => 'product','action' => 'upshelves','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>">上架</a>
                <?php endif; ?>
                </p>
                <p><a href="<?php echo url(array('mod' => 'product','action' => 'edit','args' => "pid:" . $this->_vars['volist']['productid'] . ""), $this);?>">编辑</a></p>
                <p><a href="<?php echo url(array('mod' => 'product','action' => 'del','args' => "productid:" . $this->_vars['volist']['productid'] . ""), $this);?>" onclick="return confirm('确定删除');">删除</a></p>
                </td>
            </tr>
<?php endforeach; endif; ?>
           
                        </tbody>
            <tfoot>
            <tr>
                <td class="tc"><input type="checkbox" class="checkall"></td>
                <td colspan="20">
                <label for="del" class="btn2 checkall">全选</label>
               <a class="btn2" href="javascript:;" do="tools_submit({action:'<?php echo url(array('action' => 'del'), $this);?>',id:'productid'})" title="删除" onclick="boxyn($(this))" > 删除</a>
                <div class="pagination">   
               <?php echo $this->_vars['page']; ?>

                </div>
                </td>
            </tr>
            </tfoot>
        </table>
        </form>
    </div>    
</div></div>




    <div class="clear"></div>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

</body></html>