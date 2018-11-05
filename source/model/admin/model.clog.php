<?php




checktop();
class clogModel extends Y {
 
    public function add($uid,$cash,$mark){
        
        $w=array('uid'=>$uid);
        if($cash<0){
            $fh='-';
        }else{
            $fh='+';
        }
        $in=array('ccash'=>"ccash{$fh}".abs($cash));
        $this->log($uid,$cash,$mark,$type);
        T('user')->update($in,$w,0);
    }
    public function log($uid,$cash,$mark,$type){
        $u=userinfo($uid);
        $in=array('uid'=>$uid,'cash'=>$cash,'addtime'=>time(),'mark'=>$mark,'ccash'=>$u['ccash']);
        T('clog')->add($in);
    } 
    

}
?>
