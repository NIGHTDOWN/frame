<?php


namespace ng169\model\admin;
use ng169\Y;

checktop();
class orderlog extends Y {
    private $db_name="orderlog";
    public function log($args){
        $db= T($this->db_name);
        
        if(is_array($args)){
            $args['addtime']=time();

            return  $db->add($args);
        }else{
            return false;
        }
    }
}
?>
