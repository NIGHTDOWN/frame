<?php /* "ngtpl[start]:tpl/templets/default/menu.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 10:22:38 */ ?>

<dd class="dd" style="display: <?php if ($this->_vars['c'] == 'index'): ?>block<?php else: ?>none<?php endif; ?>">
<script>
var $ad='';
	$domain='<?php echo $this->_vars['config']['site_url']; ?>
';
			$u2='<?php echo \ng169\hook\url(array('mod' => 'index','group' => 'index','action' => 'getads'), $this);?>';
</script>
            <div id="J_Category" class="category">
    <div class="navcatgory">
    
        <ul>
        <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
      	  	            <li class="j_MenuItem">
                <p>
                    <em ><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['volist']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist']['catname']; ?>
</a></em>
                </p>
            </li>
         
               <?php endforeach; endif; ?>        
                    </ul>
    </div>
        <div id="J_SubCategory" class="subCategory" style="width: 0px; height: 620px; top: 99px;">
        <?php if (count((array)$this->_vars['cat'])): foreach ((array)$this->_vars['cat'] as $this->_vars['volist']): ?>
             
         <div class="j_SubView fn-clear">
            <div class="catlist">  
             <?php if (count((array)$this->_vars['volist']['list'])): foreach ((array)$this->_vars['volist']['list'] as $this->_vars['i'] => $this->_vars['volist2']): ?>
                                <dl class="fore<?php echo $this->_vars['i']; ?>
">
                    <dt><a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['volist2']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist2']['catname']; ?>
</a></dt>
                    <dd>
                    
              <?php if (count((array)$this->_vars['volist2']['list'])): foreach ((array)$this->_vars['volist2']['list'] as $this->_vars['volist3']): ?>
                                        <a target="_blank" href="<?php echo \ng169\hook\url(array('mod' => 'product','action' => 'category','args' => "catid:" . $this->_vars['volist3']['catid'] . ""), $this);?>"><?php echo $this->_vars['volist3']['catname']; ?>
</a>
                                        <?php endforeach; endif; ?>
                                       
                                        </dd>
                    
                                      
                                    </dl>
 <?php endforeach; endif; ?>       
                             
                            </div>
            <div class="advcat " id="menu<?php echo $this->_vars['volist']['alias']; ?>
">
            <!--这里用异步加载-->
             
          
            </div>
            <script>
            	$ad=$ad+',menu<?php echo $this->_vars['volist']['alias']; ?>
';
            </script>
        </div>
             <?php endforeach; endif; ?>          
           
             <script>
             $ad=trim($ad,',');
             
            	ads($domain,$u2,$ad);
            </script>  
            </div>  
</div>

            </dd>
      