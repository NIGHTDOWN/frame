<?php /* "ngtpl[start]:tpl/templets/default/area.html:[end]" 

	

 <?php $this->assign('province', \ng169\hook\vo_list("fun=@!get_all!@ mod=@!province!@ field=@!provinceID,province!@ array=@!flag:0!@")); ?>
                        <ul>
                                                 <li key="0">不限</li>
                                                     <?php if (count((array)$this->_vars['province'])): foreach ((array)$this->_vars['province'] as $this->_vars['volist']): ?>  
                                                      <li key="<?php echo $this->_vars['volist']['provinceID']; ?>
"><?php echo $this->_vars['volist']['province']; ?>
</li>
                                                     <?php endforeach; endif; ?>
                                                    </ul>