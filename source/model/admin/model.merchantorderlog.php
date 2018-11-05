<?php




checktop();
class merchantorderlogModel extends Y {
    private $db_name="merchantorderlog";
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
