<?php


checktop();
class ztModel extends Y {
    public function award($uid,$lid){
        $w=array('lid'=>$lid);
        $mod=T('lh')->join_table(array('t'=>'out','oid','oid'));
        $data=$mod->get_one($w);
        if(!$w)return false;
        $money=Y::$conf['zt_rate']*$data['cash'];
        $mark="获取来自下级{$data['uid']}舍得循环直推奖励;总额=RMB{$money}，可得数额  =RMB{$money} （发放100%至M钱包）";
        $this->log($uid,$lid,$money,$mark);
        M('mlog','am')->add($uid,$money,$mark,2);
    }
    public function log($uid,$lid,$cash,$mark){
        $sm=userinfo($uid,'mcash');
        $in=array('uid'=>$uid,'addtime'=>time(),'money'=>$sm,'cash'=>$cash,'lid'=>$lid,'mark'=>$mark);
        $mod=T('zt');
        $mod->add($in);
    }
    public function count($Ause){
    }
}
?>
