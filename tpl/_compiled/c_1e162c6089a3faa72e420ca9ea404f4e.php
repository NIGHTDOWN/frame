<?php /* "ngtpl[start]:tpl/admin/frame_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 13:42:52 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<style type="text/css">
    body{position:relative;}
</style>
<script type="text/javascript">
    var WIN_WIDTH = 0;
    var WIN_HEIGHT = 0;
    WIN_WIDTH = $(window).width();
    WIN_HEIGHT = $(window).height();
    window.onresize = function ()
    {
        WIN_WIDTH = $(window).width();
        WIN_HEIGHT = $(window).height();
        $(".oe_fright").css("width", WIN_WIDTH - 240);
        $("#left").css("height", WIN_HEIGHT - 72);
        $("#left").css("max-height", WIN_HEIGHT - 72);
        $("#main").css("width", WIN_WIDTH - 240);
        $("#main").css("height", WIN_HEIGHT - 80);
    }
    $(function ()
    {
        $(".oe_fright").css("width", WIN_WIDTH - 240);
        $("#left").css("height", WIN_HEIGHT - 72);
        $("#left").css("max-height", WIN_HEIGHT - 72);
        $("#main").css("width", WIN_WIDTH - 240);
        $("#main").css("height", WIN_HEIGHT - 80);
    });
    function oe_menu_top($class, $obj)
    {
        $('.oe_menu_top_on').removeClass('oe_menu_top_on');
        $('.oe_fleft').hide();
        $('.' + $class).show();
        $($obj).addClass('oe_menu_top_on');
        $('.' + $class).css("height", WIN_HEIGHT - 72);
        $('.' + $class).css("max-height", WIN_HEIGHT - 72);
        $('.' + $class).find('ul').find('li:first').addClass('current');
    }
</script>

<style>
   
</style>
<body>
    <div class="oe_ftop">
        <div class="fram_top">
            <div class="oe_fntop">
                <div class="oe_adminlogo" >
                    <a href="<?php echo \ng169\hook\url(array('mod' => " frame",'group' => "admin",'action' => "run"), $this);?>"></a>
                </div>
                <div class="oe_admintop_center">
                    <ul>
                       
                        <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                        <li><a href="javascript:;" onclick="oe_menu_top('menu_level1_<?php echo $this->_vars['volist']['catid']; ?>
',this)"<?php if ($this->_vars['i'] == 1): ?>   class="oe_menu_top_on" <?php endif; ?>   ><?php echo $this->_vars['volist']['catname']; ?>
</a></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="oe_top_right">
            <ul>
                <li class="oe_top_con1">您好 <?php echo $this->_vars['admin']['adminname']; ?>
 </li>
                <li class="oe_top_con2 oe_tout" onmouseover="this.className='oe_top_con2 oe_thover'" onmouseout="this.className='oe_top_con2 oe_tout'">
                    <a href="#">帐户</a>
                    <div class="oe_la_menu">
                        <a class="oe_la_ico1" href='<?php echo \ng169\hook\url(array('action' => "cgpwd",'args' => "adminid:" . $this->_vars['admin']['adminid'] . "",'mod' => "admins",'group' => "admin"), $this);?>' target="main">修改密码</a>
                        <a class="oe_la_ico2" href="<?php echo \ng169\hook\url(array('action' => "logout",'mod' => "login",'group' => "admin"), $this);?>">退出</a>
                    </div>
                </li>
                <li class="oe_top_con3 oe_tout" onmouseover="this.className='oe_top_con3 oe_thover'" onmouseout="this.className='oe_top_con3 oe_tout'">
                    <a href="">更新数据</a>
                    <div class="oe_la_menu">
                        <a class="oe_la_ico3" href="<?php echo \ng169\hook\url(array('action' => " clearcache",'mod' => "siteset",'group' => "admin"), $this);?>">清除页面缓存</a>
                        <a class="oe_la_ico3" href="<?php echo \ng169\hook\url(array('action' => " updatecache",'mod' => "siteset",'group' => "admin"), $this);?>">更新数据缓存</a>
                    </div>
                </li>
                <li class="oe_top_con4"> <a href="<?php echo $this->_vars['siteurl']; ?>
" target="_blank">网站首页</a> </li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="oe_left_top"></div>
    <?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['sy'] => $this->_vars['volist']): ?>
    <div class="oe_fleft menu_level1_<?php echo $this->_vars['volist']['catid']; ?>
" id="left" style="overflow-y:auto; overflow-x:hidden;<?php if ($this->_vars['sy'] != 0): ?>display:none<?php endif; ?>">
 
        <?php $this->assign('tpldata', \ng169\hook\vo_list("mod=@!backstage_menu!@ fun=@!get_all!@ orderby=@!s:up,f:orders!@ array=@!'depth:2,flag:0,parentid:'{$this->_vars['volist']['catid']}!@")); ?>
          
        <ul class="oe_leftmenu" style="margin-top:15px;">
            <?php if (count((array)$this->_vars['tpldata'])): foreach ((array)$this->_vars['tpldata'] as $this->_vars['yy'] => $this->_vars['volist2']): ?>
            <?php $this->assign('bool', \ng169\hook\vo_list("mod=@!power!@ type=@!am!@ fun=@!checkuser!@ param1=@!{$this->_vars['volist2']['mod']}'+'{$this->_vars['volist2']['action']}!@")); ?>
             <?php if ($this->_vars['bool']): ?>
                <li class="oe_submenu">
                <ul>
                    <li class="sub_index"><i class="oe_mico_<?php echo $this->_vars['sy']+1; ?>
_<?php echo $this->_vars['yy']+1; ?>
"></i><a target="main" href="javascript:;"><?php echo $this->_vars['volist2']['catname']; ?>
</a><span></span></li>
                    <?php $this->assign('tpldata2', \ng169\hook\vo_list("mod=@!backstage_menu!@ fun=@!get_all!@ orderby=@!s:up,f:orders!@ array=@!'depth:3,flag:0,parentid:'{$this->_vars['volist2']['catid']}!@}")); ?>
                    <?php if (count((array)$this->_vars['tpldata2'])): foreach ((array)$this->_vars['tpldata2'] as $this->_vars['i'] => $this->_vars['volist3']): ?>
                    <?php $this->assign('bool', \ng169\hook\vo_list("mod=@!power!@ type=@!am!@ fun=@!checkuser!@ param1=@!''{$this->_vars['volist3']['mod']}!@+@!{$this->_vars['volist3']['action']}!@}")); ?>
                  <?php if ($this->_vars['bool']): ?>
                    <li onclick="acls('oe_mon',$(this));" class="oe_nextli <?php if ($this->_vars['i'] == 0): ?>oe_mon<?php endif; ?>   "><label></label><a target="main" href='<?php echo \ng169\hook\url(array('group' => admin,'mod' => $this->_vars['volist3']['mod'],'action' => $this->_vars['volist3']['action']), $this);?>'>        <?php echo $this->_vars['volist3']['catname']; ?>
</a></li>
               <?php endif; ?>
                    <?php endforeach; endif; ?>
                  
                </ul><?php endif; ?>
            </li>
             
            <?php endforeach; endif; ?>
        </ul>
  

    </div>
    <?php endforeach; endif; ?>
    <script type="text/javascript">
        $(function ()
        {
            if ('order' == 'admin')
            {
                $(".oe_submenu .current").parent().parent().parent().addClass('current');
            } else
            {
                $(".oe_submenu:first").addClass('current');
            }
            $(".oe_submenu .sub_index").on("click", function ()
            {
                $(this).parent().parent().toggleClass('current');
            })
        });
        function acls(c, obj)
        {
            $('.oe_nextli').removeClass(c);
            obj.addClass(c);
        }
    </script>
    <div class="oe_fright">
        <iframe name="main" id="main" frameborder="no" src="<?php echo \ng169\hook\url(array('mod' => "frame",'action' => "main",'group' => "admin"), $this);?>"></iframe>
    </div>
    <div class="oe_bottom">
        <div class="oe_bottom_left" style="display:none">左边</div>
        <div class="oe_bottom_right">Vesion：2</div>
    </div>
</body>
</html>