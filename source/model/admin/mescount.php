<?php
namespace ng169\model\admin;
use ng169\Y;
checktop();
class mescountModel extends Y {
    public function getnum($payid){
    	if(!$payid)return false;
        $count=T('cheat')->get_count(array('payid'=>$payid));
         return $count; 
    }
}
?>
