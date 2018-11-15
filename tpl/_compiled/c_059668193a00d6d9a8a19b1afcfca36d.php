<?php /* "/tpl/templets/default/foot.html" //NG框架模板引擎;仅适用本系统框架; 2018-11-15 17:33:41 �й���׼ʱ�� */ ?>

<div class="footer fn-clear">
    <div class="footer_1">
        <div class="w">
            <div class="helps fn-clear">    <dl>
        <dt style="background:url(<?php echo $this->_vars['indextpl']; ?>
res/ico/1.png) no-repeat left center;">
            <strong>消费者保障</strong>
        </dt>
        <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetxfz!@ mod=@!index!@ type=@!im!@ ")); ?>
        <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
                <dd><a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></dd>
               <?php endforeach; endif; ?>
            </dl>
    <dl>
        <dt style="background:url(<?php echo $this->_vars['indextpl']; ?>
res/ico/2.png) no-repeat left center;">
            <strong>新手上路</strong>
        </dt>
              <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetxssl!@ mod=@!index!@ type=@!im!@ ")); ?>
        <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
                <dd><a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></dd>
               <?php endforeach; endif; ?>
            </dl>
    <dl>
        <dt style="background:url(<?php echo $this->_vars['indextpl']; ?>
res/ico/3.png) no-repeat left center;">
            <strong>付款方式</strong>
        </dt>
              <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetfkfs!@ mod=@!index!@ type=@!im!@ ")); ?>
        <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
                <dd><a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></dd>
               <?php endforeach; endif; ?>
            </dl>
    <dl>
        <dt style="background:url(<?php echo $this->_vars['indextpl']; ?>
res/ico/4.png) no-repeat left center;">
            <strong>帮助信息</strong>
        </dt>
              <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgethelp!@ mod=@!index!@ type=@!im!@ ")); ?>
        <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
                <dd><a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a></dd>
               <?php endforeach; endif; ?>
            </dl>
</div>
        </div>
    </div>
    <div class="footer_2">
        <div class="w">
            <dl class="link fn-clear">
                <dt>合作伙伴</dt>
                <dd>   
                <?php $this->assign('cat', \ng169\hook\vo_list("fun=@!get!@ mod=@!friend!@ type=@!im!@ ")); ?>
                <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['list']): ?>
    <a href="<?php echo $this->_vars['list']['url']; ?>
" title="<?php echo $this->_vars['list']['name']; ?>
" target="_blank"><?php echo $this->_vars['list']['name']; ?>
</a>
    <?php endforeach; endif; ?>
    
</dd>
            </dl>
            <div class="links">
                <?php $this->assign('single', \ng169\hook\vo_list("fun=@!footgetabout!@ mod=@!index!@ type=@!im!@ ")); ?>
        <?php if (count((array)$this->_vars['single'])): foreach ((array)$this->_vars['single'] as $this->_vars['volist']): ?>
        <a href="<?php echo \ng169\hook\url(array('mod' => 'single','action' => 'show','args' => "abid:" . $this->_vars['volist']['abid'] . ",alias:" . $this->_vars['volist']['alias'] . ""), $this);?>"><?php echo $this->_run_modifier($this->_vars['volist']['title'], 'tostr', 'PHP', 1); ?>
</a><em>|
              
               <?php endforeach; endif; ?>
           </div>
            <div class="copyright"><?php echo $this->_vars['config']['copyright']; ?>
</div>
        </div>
    </div>
</div>
<script>
    var vlogurl='<?php echo \ng169\hook\url(array('mod' => 'index','action' => 'logset','group' => 'index'), $this);?>';
    var vlogid='<?php echo $this->_vars['vlogid']; ?>
';
    
</script>
<script src="<?php echo $this->_vars['staticjs']; ?>
log.js" type="text/javascript"></script>  