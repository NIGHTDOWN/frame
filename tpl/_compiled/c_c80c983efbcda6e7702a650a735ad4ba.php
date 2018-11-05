<?php /* "tpl/templets/default/index0.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:04:40 �й���׼ʱ�� */ ?>




<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."head.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<body class="gray">
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."nav.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>