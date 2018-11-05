<?php





checktop();
class gljModel extends Y {
    
    private $rate=array(2=>0.07,3=>0.04,4=>0.03,5=>0.01,6=>0.005,1=>0);
    private $mod=null;
    private $fromlid=null; 
    public function award($gid,$lid){
        $data=T('lh')->join_table(array('t'=>'out','oid','oid'))->get_one(array('lid'=>$lid));
        $clevel=userinfo($data['uid'],'level');
        $ilevel=userinfo($gid,'level');
        $this->fromlid=$lid;
        $cash=$data['cash'];
        if($ilevel>$clevel){
            $this->loop($gid,$cash);
        }elseif($ilevel==$clevel && $ilevel==6){
            $cash=$cash*0.0005; 
            $this->samelevel($gid,$cash); 
        }
        elseif($ilevel==$clevel && $ilevel!=6){
            $this->loop($gid,$cash);
            
        }else{
            
        }
    }
    
    private function samelevel($uid,$cash){
        $this->log($uid,$cash);
    }
    private function loop($uid,$cash){
        if(!$uid)return false;
        $uinfo=userinfo($uid);
        $rate=$this->rate[$uinfo['level']];
        if(!$rate)return false;
        $money=$cash*$rate;
        $this->log($uid,$money);
        $ginfo=userinfo($uinfo['gid']);
        if($ginfo['level']==6 && $uinfo['level']==$ginfo['level']){
            $this->samelevel($ginfo['uid'],$cash);
        }
        if($uinfo['level']<=$ginfo['level']){
            $this->loop($ginfo['uid'],$cash);
        }
        return ;
    }
    public function log($uid,$cash){
        $in=array('lid'=>$this->fromlid,'uid'=>$uid,'cash'=>$cash,'addtime'=>time(),'etime'=>(time()+(14*(Y::$conf['m_glj_time']))));
        T('glj')->add($in);
    }
}
?>
