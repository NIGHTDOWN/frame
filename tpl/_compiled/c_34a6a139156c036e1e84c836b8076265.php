<?php /* "ngtpl[start]:/tpl/admin/a_nav.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 13:42:52 */ ?>

<i></i>当前位置：网站管理首页 >>
 <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'group' => "admin"), $this);?>"><?php echo \ng169\hook\ac(array('group' => "admin",'mod' => $this->_vars['c']), $this);?></a>>
 <a href="<?php echo \ng169\hook\url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'group' => "admin"), $this);?>"><?php echo \ng169\hook\ac(array('group' => "admin",'mod' => $this->_vars['c'],'action' => $this->_vars['a']), $this);?></a>
 