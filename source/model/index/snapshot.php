<?php


namespace ng169\model\index;
use ng169\Y;


checktop();

class snapshot extends Y
{
public function make($productid){
	$where=array('productid'=>$productid);
	$pinfo=T('product')->get_one($where);
	if(!$pinfo)return false;
	$bid=T('back_product')->add($pinfo);
	if(!$bid)return false;
	$attr=T('product_attribute')->get_all($where);
	foreach($attr as $list){
		T('back_product_attribute')->add(array('aname'=>$list['aname'],'bid'=>$bid,'avalue'=>$list['avalue']));
	}
	return $bid;
}

}

?>
