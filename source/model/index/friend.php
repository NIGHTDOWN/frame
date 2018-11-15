<?php


namespace ng169\model\index;
use ng169\Y;


checktop();

class friend extends Y
{


 public function get(){
 	$w['flag']=0;
 	$w['stime']=array('1'=>time());
	$w['etime']=array('0'=>time());
 	$info=T('friendlink')->set_limit(10)->order_by(array('f'=>'orders','s'=>'down'))->get_all($w);
 	$w['flag']=0;
 	$w['stime']=0;
	$w['etime']=0;
 	$info2=T('friendlink')->set_limit(10)->order_by(array('f'=>'orders','s'=>'down'))->get_all($w);
 	return array_merge($info,$info2);
 	
 }
}

?>
