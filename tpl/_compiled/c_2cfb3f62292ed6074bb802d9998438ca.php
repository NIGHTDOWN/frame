<?php /* "ngtpl[start]:/tpl/templets/default/phead.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-22 11:37:01 */ ?>

<!DOCTYPE html>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="<?php echo $this->_vars['indextpl']; ?>
res/space.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_vars['indextpl']; ?>
res/share.css" rel="stylesheet" type="text/css">
	<style type="text/css">object,embed{                
				-webkit-animation-duration: .001s;
				-webkit-animation-name: playerInserted;                
				-ms-animation-duration: .001s;
				-ms-animation-name: playerInserted;                
				-o-animation-duration: .001s;
				-o-animation-name: playerInserted;                
				animation-duration: .001s;
				animation-name: playerInserted;}
			@-webkit-keyframes playerInserted{from{
					opacity: 0.99;}
				to{
					opacity: 1;}
			}                @-ms-keyframes playerInserted{
				from{
				opacity: 0.99;}
			to{
				opacity: 1;}
			}                @-o-keyframes playerInserted{
				from{
				opacity: 0.99;}
			to{
				opacity: 1;}
			}                @keyframes playerInserted{from{
					opacity: 0.99;}
				to{
					opacity: 1;}
			}</style>
<script language="javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/share.js"></script>

<script language="javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/jquery.Sonline.js"></script>
<script language="javascript" src="<?php echo $this->_vars['indextpl']; ?>
res/jquery.imagezoom.min.js"></script>
<script language="javascript" type="text/ecmascript">
    var str=$('title').text();
    function check(){
    str=str.substr(1)+str.substr(0,1);
    window.status=str;
    document.title=str;
    setTimeout(check,1000);
    }
    check();
</script>

			