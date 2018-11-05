<?php





checktop();

class powerModel extends Y
{
    private $db_name="store";
    private $power=array();
    
    
    
    
    public function powerinfo($powername,$muid){
        $field=array($powername=>'pname',$powername.'time'=>'ptime',$powername.'long'=>'plong');
        $mod=T($this->db_name)->set_field($field);
        $array=array('muid'=>$muid);
        $powerinfo=$mod->get_one($array);
        return $powerinfo;
    }
    
    public function closepower($powername,$muid){
        $insert=array($powername=>'0',$powername.'time'=>'0',$powername.'long'=>'0');
        $where= array('muid'=>$muid);
        $mod=T($this->db_name);
        if($mod->check_exist($where)){
            $mod->update($insert,$where);
        }else{
            
        }
    }
    public function getpower($powername,$muid){
       
        $info=$this->powerinfo($powername,$muid);
    
        $time=time();
        if(sizeof($info)>0 && $info['pname']){
            $ld=" + ".$info['plong'] .' day';
            $data=(date("Y-m-d",$info['ptime'])) . $ld;
            
          
            $etime=strtotime($data);
            
            
           
            if(($etime-$time)>0){
                return true;
            }else{
                $this->closepower($powername,$muid);
                return false;
            }
            
        }else{
            $this->closepower($powername,$muid);
            return false;
        }
    }
}

?>
