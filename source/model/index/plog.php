<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class plog extends Y
{

    public function logp($pid)
    {
     if(!$pid)return false;
     $m=T('product_log');
     $w['uid']=Y::$wrap_user['uid'];
     $w['ip']=YRequest::getip();
     $w['theday']=date('ymd');
     $w['productid']=$pid;
     $log=$m->get_one($w);
     if($log){
		 $w['etime']=time();
		 $w['sxnum']=$log['sxnum']+1;
		 $m->update($w,array('logid'=>$log['logid']));
	 }else{
	 	$w['stime']=time();
	 	$m->add($w);
	 }
     return true;
     
    }


}

?>
