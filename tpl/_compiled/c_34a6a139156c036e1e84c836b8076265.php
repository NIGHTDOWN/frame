<?php /* "/tpl/admin/a_nav.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 20:08:00 �й���׼ʱ�� */ ?>

<i></i>当前位置：网站管理首页 >>
 <a href="<?php echo url(array('mod' => $this->_vars['c'],'group' => "admin"), $this);?>"><?php echo ac(array('group' => "admin",'mod' => $this->_vars['c']), $this);?></a>>
 <a href="<?php echo url(array('mod' => $this->_vars['c'],'action' => $this->_vars['a'],'group' => "admin"), $this);?>"><?php echo ac(array('group' => "admin",'mod' => $this->_vars['c'],'action' => $this->_vars['a']), $this);?></a>
 