<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/user/message_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 23:23:15 �й���׼ʱ�� */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  <script>
  	_ajax_file_url='<?php echo url(array('group' => 'user','mod' => 'upimg'), $this);?>';
  </script>
<style>
	.none{display:none}
</style>
		

		 <div class="left_con">
                                                <div class="business_handle" id="my_menu">
                        <h3 style="text-indent:20px;">消息提醒</h3>
                        <ul>
                                                                                                                 <li class="<?php if ($this->_vars['a'] == 'run'): ?>active<?php endif; ?>"><a href="<?php echo url(array('mod' => 'message'), $this);?>">我的消息 </a>
                            </li>  
                              <li ><a href="<?php echo url(array('mod' => 'msg'), $this);?>">在线聊天 </a>
                            </li>
                                                                                                                                             
                                                                                </ul>
                    </div>
                                    </div>
				
				
				
				
				
				
				
				<div class="right_con">
				


<div class="path">
    <div>
    	    		<a href="<?php echo url(array('mod' => 'index'), $this);?>">我的商城</a> <span>&gt;</span>
              <a href="<?php echo url(array('mod' => 'message','action' => 'run'), $this);?>">消息提醒</a>  <span>></span>我的消息
            </div>
</div>
<script>
	$(function(){
		$('.tabs').find('a').on('click',function(){
		
			$indexnum=$('.tabs').find('a').index($(this));
				$('.tabs').find('li').removeClass('active');
				$('.tabs').find('li').addClass('normal');
$($('.tabs').find('li').get($indexnum)).removeClass('normal');
				$($('.tabs').find('li').get($indexnum)).addClass('active');
				$('#content').children().hide();
				$($('#content').children().get($indexnum)).show();
		});
		
	});
</script>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
             
                <li class="active"><a href="#" >消息列表</a></li>
                
            </ul>
        </div>
        <div id="content">
                <table class="table-list-style">
              
                <tbody>
                    	<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
                                        <tr>
                    <td></td>
                    <td class="tl"  <?php if ($this->_vars['volist']['uread'] == 0): ?>style='color:#f11057'<?php endif; ?>"><?php echo $this->_vars['volist']['title']; ?>
 </td>
                    <td class="tl">
                        <span  style="    max-width: 600px;
                        overflow: hidden;
                        width: 500px;
                        display: block;
                        margin-left: 10px;
                        word-wrap: break-word;"><?php echo $this->_vars['volist']['content']; ?>
</span></td>
                 
                    <td class="tl" ><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
<br>
                    </td>
                   
                    <td><a href="<?php echo url(array('action' => 'show','args' => "msgid:" . $this->_vars['volist']['msgid'] . ""), $this);?>">查看</a>
                         <a a="<?php echo url(array('action' => 'del','args' => "msgid:" . $this->_vars['volist']['msgid'] . ""), $this);?>" onclick="boxyn($(this))">删除</a></td>
                </tr>
                <?php endforeach; endif; ?>
                                        </tbody>
                            <tbody><tr><td colspan="7">
                            <div class="pagination">  <?php echo $this->_vars['page']; ?>

                                 </div></td>
                           
                                </tr>
            </tbody></table>
             
                 
                 
                 
            </div>
               
            </div>
</div></div>
				
				
				
				
				
				
				
				
		    
	  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	