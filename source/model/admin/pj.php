<?php

namespace ng169\model\admin;
use ng169\Y;


checktop();
class pj extends Y{
    
 
	public function fpj($payid,$level){
		$payid=array('payid'=>$payid);
		$order=T('pay')->get_one($payid);
		if($order['fevaluate']!=0)return false;
		T('pay')->update(array('fevaluate'=>$level),$payid);
		$uid=$order['touid'];
		$where=array('uid'=>$uid);
		$info=T('user')->get_one($where);
		if(!$info)return false;
		switch($level){
			case 1:
			$up=array('good'=>$info['good']+1);
			T('user')->update($up,$where);
			
			break;
			case 2:
			break;
			case 3:
			$up=array('bad'=>$info['bad']+1);
			if($up['bad']>=Y::$conf['bad_pj_max']){
				$up['bad']=0;
				$up['walletetime']=($up['walletetime']<(time()))?time():$up['walletetime'];
				$up['walletetime']+=(Y::$conf['bad_pj_dj_day']*G_DAY);
			}
			
			T('user')->update($up,$where);
		
			break;
		}
		return true;
	}
	public function tpj($payid,$level){
		$payid=array('payid'=>$payid);
		$order=T('pay')->get_one($payid);
		if($order['tevaluate']!=0)return false;
		T('pay')->update(array('tevaluate'=>$level),$payid);
		$uid=$order['fromuid'];
		$where=array('uid'=>$uid);
		$info=T('user')->get_one($where);
		if(!$info)return false;
		switch($level){
			case 1:
			$up=array('good'=>$info['good']+1);
			T('user')->update($up,$where);
			break;
			case 2:
			break;
			case 3:
			$up=array('bad'=>$info['bad']+1);
			if($up['bad']>=Y::$conf['bad_pj_max']){
				
				$up['walletetime']=($up['walletetime']<(time()))?time():$up['walletetime'];
				$up['walletetime']+=(Y::$conf['bad_pj_dj_day']*G_DAY);
			}
			if($up['bad']>Y::$conf['bad_pj_max']){
				$up['bad']=0;
			}
			T('user')->update($up,$where);
		
			break;
		}
		return true;
	}

}
?>
