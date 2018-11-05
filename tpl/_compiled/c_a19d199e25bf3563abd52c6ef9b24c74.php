<?php /* "/tpl/shop/menu.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:33 �й���׼ʱ�� */ ?>

<!DOCTYPE html PUBLIC>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
<title>卖家中心 - <?php echo $this->_vars['config']['site_name']; ?>
</title>

<meta name="description" content="">
<meta name="keywords" content="">
<link href="<?php echo $this->_vars['shoptpl']; ?>
res/user_admin.css" rel="stylesheet" type="text/css">
<script src="<?php echo $this->_vars['staticjs']; ?>
jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_vars['shoptpl']; ?>
res/index.js" type="text/javascript"></script>
<script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ajaxfileupload.js'>
    </script>
    <script src="<?php echo $this->_vars['staticjs']; ?>
data2.js" type="text/javascript"></script>
    <link href="<?php echo $this->_vars['staticjs']; ?>
data2.css" rel="stylesheet" type="text/css">
<script src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_vars['shoptpl']; ?>
res/jquery.ui.js"></script>
<script type="text/javascript" id="dialog_js" charset="utf-8" src="<?php echo $this->_vars['shoptpl']; ?>
res/dialog.js"></script>
<link href="<?php echo $this->_vars['shoptpl']; ?>
res/dialog.css" rel="stylesheet" type="text/css">
<script language="javascript">
  _ajax_file_url='<?php echo url(array('group' => 'user','mod' => 'upimg'), $this);?>';
function searchFocus(e){
	if(e.value == searchTxt){
		e.value='';
		$('#keyword').css("color","");
	}
}
function searchBlur(e){
	if(e.value == ''){
		e.value=searchTxt;
		$('#keyword').css("color","#999999");
	}
}
// 收缩展开效果
$(document).ready(function(){
	$(".sidebar dl dt").click(function(){
		$(this).toggleClass("hou");
		var sidebar_id = $(this).attr("id");
		var sidebar_dd = $(this).next("dd");
		sidebar_dd.slideToggle("slow",function(){
				sidebar_dd.css("display");
		 });
	});
});
</script>
</head>
<body>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="shortcut">
    <div class="w">
        <div class="fl">
           欢迎<a class="name" href="<?php echo url(array('mod' => 'shop'), $this);?>"><?php echo $this->_vars['user']['merchantname']; ?>
</a> ！&nbsp;<a href="<?php echo url(array('mod' => 'login','action' => 'logout','group' => 'index'), $this);?>">退出</a>
			<a href="<?php echo url(array('mod' => 'index','group' => 'index'), $this);?>">首页</a>
        </div>
        <div class="fr">
            <a href="<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>" style="font-weight: bold;">买家中心</a>
          
            <a href="<?php echo url(array('mod' => 'message','group' => 'user'), $this);?>">站内信</a>
        </div>
    </div>
</div>

<div class="header">
    <h1>
    	<a href="<?php echo url(array('mod' => 'index','group' => 'index'), $this);?>" title="<?php echo $this->_vars['config']['site_name']; ?>
">
        <img title="<?php echo $this->_vars['config']['site_name']; ?>
" style="height: 60px;" alt="<?php echo $this->_vars['config']['site_name']; ?>
" src="<?php echo $this->_vars['static']; ?>
logo/logo.png">
        </a>
        <i><a href="<?php echo url(array('mod' => 'shop'), $this);?>">卖家中心</a></i>
	</h1>
     <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['shoptpl']."search.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</div>
