<?php /* "/tpl/templets/default/head.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:10 �й���׼ʱ�� */ ?>

<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title><?php echo $this->_run_modifier($this->_vars['seo']['title'], 'tostr', 'PHP', 1); ?>
</title>
<meta name="description" content="<?php echo $this->_vars['seo']['desc']; ?>
">
<meta name="keywords" content="<?php echo $this->_vars['seo']['keyword']; ?>
">
<meta name="copyright" content="<?php echo $this->_vars['config']['copyright']; ?>
">


<script src="<?php echo $this->_vars['staticjs']; ?>
jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_vars['indextpl']; ?>
res/base.js" type="text/javascript"></script>
<script src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js" type="text/javascript"></script>
<script src="<?php echo $this->_vars['staticjs']; ?>
getad.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="<?php echo $this->_vars['indextpl']; ?>
res/page.css" rel="stylesheet" type="text/css">


