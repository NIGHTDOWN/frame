<?php /* "ngtpl[start]:tpl/templets/default/area.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-19 15:24:39 */ ?>

 <?php $this->assign('province', \ng169\hook\vo_list("fun=@!get_all!@ mod=@!province!@ field=@!provinceID,province!@ array=@!flag:0!@")); ?>
                        <ul>
                                                 <li key="0">不限</li>
                                                     <?php if (count((array)$this->_vars['province'])): foreach ((array)$this->_vars['province'] as $this->_vars['volist']): ?>  
                                                      <li key="<?php echo $this->_vars['volist']['provinceID']; ?>
"><?php echo $this->_vars['volist']['province']; ?>
</li>
                                                     <?php endforeach; endif; ?>
                                                    </ul>