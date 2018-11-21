<?php require_once('D:\work2\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "ngtpl[start]:tpl/admin/user_index.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-21 14:40:38 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."top/headerjs.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<body>
<div class="oemarry_layout"> 
     <div class="oe_top_nav"><?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."a_nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?></div>
  <div class="a_content">
    <form action="" method="post">
    <input type="hidden" name='html'/>
      <div class="oe_tools_bar clearfix">
           <a class="icon-checkbox-checked icon-checkbox-unchecked" href="javascript:;" onClick="tools_select('uid[]',this)" title="全选" data="true"> 全选 </a> 
        <script>
        	function dcexcel($html){
        		$url='<?php echo \ng169\hook\url(array('action' => 'excel'), $this);?>';
        		$('[name=html]').val($html.get(0).outerHTML);
        		$('form:first').attr('action',$url);
        		$('form:first').submit();
        	}
        	
        	
        </script>
            <a class="" href="javascript:dcexcel($('.oe_table_list'));" > 导出excel</a>
           <a href="<?php echo \ng169\hook\url(array('group' => 'admin','action' => 'add_view'), $this);?>" class="icon-plus"> 添加</a>
        
            <div style="display:none" id="area_serach">
          <input id="areaname" type="text">
          <input name="查找" value="查找" type="button" onClick="search_str($(this).prev('#areaname').val())">
        </div>
         <span class="fr"><a id="condition" class="icon-search <?php if ($this->_vars['where']): ?>red<?php endif; ?>" href="javascript:;" onclick="lbox('筛选条件')"> 筛选条件</a></span> </div>
      <table class="oe_table_list table_cs"  id="paixun">
        <tbody>
          <tr>
            <th style="width:4%;text-align:center;">选择</th>
              <th style="width:8%;" key="uid" data="<?php if ($this->_vars['orderby']['f'] == "uid" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"      >用户ID</th>
               <th style="width:8%;"  
               key="username" data="<?php if ($this->_vars['orderby']['f'] == "username" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               >用户名</th>
              <th style="width:8%;"
              key="realname" data="<?php if ($this->_vars['orderby']['f'] == "realname" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
              
              >真实姓名</th>
               <th style="width:8%;text-align:center;"
               key="mobile" data="<?php if ($this->_vars['orderby']['f'] == "mobile" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               
               >手机</th>
             
               <th style="width:6%;text-align:center;"
               key="email" data="<?php if ($this->_vars['orderby']['f'] == "email" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               
               >邮箱</th>
                 <th style="width:6%;text-align:center;"
               key="logtime" data="<?php if ($this->_vars['orderby']['f'] == "logtime" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               
               >最后登陆</th>
                 <th style="width:6%;text-align:center;"
               key="cash" data="<?php if ($this->_vars['orderby']['f'] == "cash" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               
               >账号余额</th>
               
               <th style="width:4%;text-align:center;"
               key="level" data="<?php if ($this->_vars['orderby']['f'] == "level" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
               
               >等级</th>
                  
            <th style="width:5%;text-align:center;"
            key="flag" data="<?php if ($this->_vars['orderby']['f'] == "flag" && $this->_vars['orderby']['s'] == "up"): ?>down<?php else: ?>up<?php endif; ?>"
           
            >锁定</th>
              
            <th style="text-align:center;">操作</th>
          </tr>
          <tbody>
          <?php if (count((array)$this->_vars['user'])): foreach ((array)$this->_vars['user'] as $this->_vars['volist']): ?>
          <tr>
            <td style="text-align:center;"><input type="checkbox" value="<?php echo $this->_vars['volist']['uid']; ?>
" name="uid[]">
              </input></td>
                <td style="text-align:center;"><?php echo $this->_vars['volist']['uid']; ?>

              </td>
            <td > <?php echo $this->_vars['volist']['username']; ?>
</td>
                <td  ><?php echo $this->_vars['volist']['realname']; ?>
</td>
               <td  ><?php echo $this->_vars['volist']['mobile']; ?>
</td>
                 <td  ><?php echo $this->_vars['volist']['email']; ?>
</td>
                <td ><?php echo $this->_run_modifier($this->_vars['volist']['logtime'], 'date_format', 'plugin', 1, "%Y-%m-%d "); ?>
</td>
                 <td ><?php echo $this->_vars['volist']['cash']; ?>
</td>
                  <td >
                  <img src="
                  	<?php  echo ng169\hook\vo_list("fun=@!getlevelimg2!@ type=@!am!@ mod=@!userlevel!@  param1=@!{$this->_vars['volist']['ugood']}'-'{$this->_vars['volist']['ubad']}!@"); ?>">
                  </td>
         
          
         
                  <td who="user" key="<?php echo $this->_vars['volist']['uid']; ?>
" name="flag" tag="ajaxchoose" style="cursor:pointer"><?php if ($this->_vars['volist']['flag'] == 0): ?>
              <div class="no"></div>
              <?php else: ?>
              <div class="yes"></div>
              <?php endif; ?></td>
            <td style="text-align:center;" class="a_edit_del">
               <a class="oe_ico_green" target="_blank" href="<?php echo \ng169\hook\url(array('mod' => "login_user",'group' => "admin",'action' => "login",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">快速登入</a>
              
               <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('action' => "",'mod' => "order",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">查看交易记录</a> 
               <a class="oe_ico_orange" href="<?php echo \ng169\hook\url(array('action' => "cgpwd",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">修改密码</a> 
                <a class="oe_ico_blue" href="<?php echo \ng169\hook\url(array('action' => "show",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">查看</a>  
              <a class="oe_ico_green" href="<?php echo \ng169\hook\url(array('action' => "edit",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">充值</a> 
              <a class="oe_ico_green" href="<?php echo \ng169\hook\url(array('action' => "edit",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>">发信</a> 
                <a class="oe_ico_red" a="<?php echo \ng169\hook\url(array('action' => "del",'args' => "uid:" . $this->_vars['volist']['uid'] . ""), $this);?>" onClick="boxyn($(this))">删除</a>
            </td>
          </tr>
          <?php endforeach; endif; ?></tbody>
        </tbody>
      </table>
      <div class="oe_page_box"> 
        <?php echo $this->_vars['page']; ?>
 
      </div>
    </form> <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['admintpl']."paix.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  </div>
</div>
     <div style="display:none;" id="searchbox">
  <form method="post" style="width:400px;" action="">
       <input name="sflag" type="hidden" value="1">
     <table  align="center" width="473" class="oe_table_warp">
     <tr>
        <td height="40"  style="text-align:right;">用户ID：</td>
        <td>
        <input name="uid" class="input-b" type="text" value="<?php echo $this->_vars['where']['uid']; ?>
" />
            
        </td>
           
      </tr>
      <tr>
        <td height="40"  style="text-align:right;">用户账号：</td>
        <td>
        <input name="username" class="input-b" type="text" value="<?php echo $this->_vars['where']['username']; ?>
" />
            
        </td>
           
      </tr>
         
             <tr>
        <td height="40"  style="text-align:right;">手机号码：</td>
        <td>
        <input name="mobile" class="input-b" type="text" value="<?php echo $this->_vars['where']['mobile']; ?>
" />
            
        </td>
           
      </tr> 
      
        
      
    
    </table>
        <div style="text-align:center">
           <input name="" value="清空" class="oe_boxbut" tag="reset" type="button">
        <span style="padding-left:50px;"></span>
          <input name="" value="提交查询" class="oe_boxbut" tag="submit" type="button">
    </div>
  </form>
</div>
</body>

<script>
   
    
  


</script>
<div class="addmp none">
<form method="post" action="<?php echo \ng169\hook\url(array('mod' => "",'action' => "addmp",'args' => "",'group' => ""), $this);?>" >
    <input name="uid" type="hidden" value="<?php echo $this->_vars['select']['uid']; ?>
">

     <table class="oe_table_warp">
         <tr>
             <th ><span class="red">*</span>输入数量：</th>
             <td >
                 <input type="text" name="mp" value="<?php echo $this->_vars['user']['alias']; ?>
" class="input-b" tag="notnull isfixnum"/><span class="oe_trap"><em></em></span>
              </td>
         </tr>
 </table>

  <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
</form>
</div>
<div class="addpdb none">
<form method="post" action="<?php echo \ng169\hook\url(array('mod' => "",'action' => "addpdb",'args' => "",'group' => ""), $this);?>" >
    <input name="uid" type="hidden" value="<?php echo $this->_vars['select']['uid']; ?>
">

     <table class="oe_table_warp">
         <tr>
             <th ><span class="red">*</span>输入数量：</th>
             <td >
                 <input type="text" name="mp" value="<?php echo $this->_vars['user']['alias']; ?>
" class="input-b" tag="notnull isfixnum"/><span class="oe_trap"><em></em></span>
              </td>
         </tr>
 </table>

  <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
</form>
</div>
<div class="delhcash none">
<form method="post" action="<?php echo \ng169\hook\url(array('mod' => "",'action' => "hcash",'args' => "",'group' => ""), $this);?>" >
    <input name="uid" type="hidden" value="<?php echo $this->_vars['select']['uid']; ?>
">
     <table class="oe_table_warp">
         <tr>
             <th ><span class="red">*</span>要划去的金额：</th>
             <td >
                 <input type="text" name="hcash" value="<?php echo $this->_vars['user']['alias']; ?>
" class="input-b" tag="notnull isnum"/><span class="oe_trap"><em>不能超过用户H钱包的现有金额</em></span>
              </td>
         </tr>
 </table>
  <div class="oe_button_layout">
	  <input type="button" class="button_2" value="提交保存" tag="submit" /> 
	  <span id="submit_tips" class="error"></span>
	</div>
</form>
</div>