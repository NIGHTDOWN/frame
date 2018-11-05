<?php




checktop();
class fundModel extends Y {
    
    
    private $db_name='fund';
    private $key='fundid';
    
    public function add($arr){
        $auto=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);
        $insert=array_merge($arr,$auto);
        
        $mod=T($this->db_name);
        $fundid=$mod->add($insert);
        
       return $this->changmoney($fundid); 
    }
    
    public function changmoney($fundid){
        $mod=T($this->db_name);
        $wher=array($this->key=>$fundid);
        $info=$mod->get_one($wher);
        if($info['userid'] &&  $wher['status']==0){
            $where=array('userid'=>$info['userid']);
            $money=abs($info['money']);
            if($info['glidetype']==1){
                $money='cash-'.$money;
            }else{
                $money='cash+'.$money;
            }
            $insert=array('cash'=>$money);
            $user=T('user');
            $flag=$user->updata(array('v'=>$insert,'w'=>$where),0);
            if($flag){
                $in=array('status'=>1,'creatid'=>parent::$wrap_admin['adminid'],'addtime'=>time());
                $flag=$mod->update($in,$wher);
                return true;
            }
        }
        return false;
    }
    
    public function sysadd($userid,$money,$sourcetype,$glidetype=0){
        $arr=array('userid'=>$userid,'money'=>$money,'glidetype'=>$glidetype,'sourcetype'=>$sourcetype);
        $auto=array('addtime'=>time(),'creatid'=>$warp_admin['adminid']);
        $insert=array_merge($arr,$auto);    
        
        $mod=T($this->db_name);
        $fundid=$mod->add($insert);
        
        return $this->changmoney($fundid); 
    }
    
    public function tx($userid,$money,$sourcetype,$glidetype=1){
        $arr=array('userid'=>$userid,'money'=>$money,'glidetype'=>$glidetype,'sourcetype'=>$sourcetype);
        $auto=array('addtime'=>time(),'creatid'=>$warp_admin['adminid']);
        $insert=array_merge($arr,$auto);
        
        $mod=T($this->db_name);
        $fundid=$mod->add($insert);
  
    }
}
?>
