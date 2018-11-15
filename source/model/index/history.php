<?php
namespace ng169\model\index;
use ng169\Y;
checktop();

class history extends Y
{
    private $maxnum=30;
  public function getlist($array){
if(!$array)return false;
$mode=T('product_log')->join_table(array('t'=>'product','productid','productid'))->group_by('v.productid')->order_by(array('f'=>stime,'s'=>down));
$mode->set_limit($this->maxnum);
$where['uid']=$array['uid'];
$where['theday']=$array['theday'];
$data=$mode->get_all($where);
return $data;
  }
}
