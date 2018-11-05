<?php




checktop();
class nlogModel extends Y {
    
    public function balance($oid){
        $mod=T('out');
        $w=array('oid'=>$oid);
        $info=$mod->get_one($w);
        if($info['status']!=1)return false;
        $bj=$info['cash'];
      
       
       $lx=$info['rate'];
        $s=$lx+$bj;
        $mark="从舍(PD{$info['oid']})奖励:舍本金RMB{$bj}+舍利息RMB{$lx};合计$s";
        $this->add($info['uid'],$s,$mark);
    }
    public function add($uid,$cash,$mark){
        $w=array('uid'=>$uid);
        if($cash<0){
            $fh='-';
            $type=0;
        }else{
            $fh='+';
            $type=1;
        }
        $in=array('ncash'=>"ncash{$fh}".abs($cash));
        $this->log($uid,$cash,$mark);
        T('user')->update($in,$w,0);
  
    }
    public function log($uid,$cash,$mark){
        $u=userinfo($uid);
        $in=array('uid'=>$uid,'cash'=>$cash,'addtime'=>time(),'mark'=>$mark,'ncash'=>$u['ncash']);
        T('nlog')->add($in);
    } 

}
?>
