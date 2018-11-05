<?php



checktop();
class yfkModel extends Y{
	private $looparray = array();

private $qian10;
	private function _setalloc(){
		/*$time = $_SERVER['REQUEST_TIME'] - (Y::$conf['pd_min_time'] * G_DAY);
		$pre  = DB_PREFIX;
		$sql  = "UPDATE {$pre}out SET `alloc`=1,`allocmoney`=`cash` WHERE `status`='0'  and `alloc`=0 and `waiting`=1";
		$db   = new daoClass();
		return    $db->query($sql);*/
	}
	private function _getd2(){
		$mod = T('in')->set_field(array('iid','cash'=>'m','uid'));
		$time = $_SERVER['REQUEST_TIME'] - (Y::$conf['gd_min_time'] * G_DAY);
		$where = array('alloc'=>0,'addtime'=>array(0,$time));
		$mod->set_where($where,'=')->order_by(array('f'=>'cash','s'=>'down'));;
		return $mod->get_all();
	}
	private function _getd1(){
		$mod = T('in')->set_field(array('iid','allocmoney'=>'m','uid'));
		$time = $_SERVER['REQUEST_TIME'] - (Y::$conf['gd_min_time'] * G_DAY);
		$where = array('alloc'=>1,'addtime'=>array(0,$time));
		$mod->set_where($where,'=')->order_by(array('f'=>'allocmoney','s'=>'down'));
		return $mod->get_all();
	}
   private function _gets($id = null){
		$mod = T('out')->set_field(array('oid'));
		$where = array('status'=>0,'waiting'=>1);
		if($id){
		$where['oid'] = $id;
		}
		$mod->set_where($where,'=');
		return $mod->get_all();
	}
	public function start(){
		/*$this->_setalloc();*/
		$iid = $this->_gets($id);
		
		$rate=parent::$conf['yfk_bj'];
		
		if($rate<=0){
			  YLog::txt('预付款未开启');
			return false;
		}
		  YLog::txt('预付款执行开始');
		 
		foreach($iid as $v){
			if(!is_array($v))break;
			$pre  = DB_PREFIX;
			$id   = $v['oid'];
			$this->_alloc($id);
			
			
		}
		 YLog::txt('预付款执行结束');
		return 0;
	}
private function geti1(){
	$sum=T('in')->set_field(('sum(allocmoney)'))->set_where(array('alloc'=>1))->get_count();
	if($sum>=$this->qian10)return 1;
	return $this->geti2();
}
private function geti2(){
    $sum=T('in')->set_field(('sum(cash)'))->set_where(array('alloc'=>0))->get_count();
	if($sum>=$this->qian10)return 2;
	return 0;
}
	private function _alloc($oid){
		
		if(!$oid)return false;
		if($this->looparray[$oid] > 10){
			return 0;
		}else{
			$this->looparray[$oid] += 1;
		}
		
		$Aoid = T('out')->set_where(array('oid'=>$oid))->get_one();
		
		$uid = $Aoid['uid'];
		
	    $money=$Aoid['cash']*(Y::$conf['yfk_bj']);
	    
	    $this->qian10=$money;
	    $tj=$this->geti1();
	    
	    switch($tj){
			case 0:
			YLog::txt('无可以匹配的提款订单');
			return false;
			case 1:
			$all=$this->_getd1();
			if(!is_array($all))return false;
			foreach($all as $in){
				if($in['uid']!=$uid){
					
				
				if($in['m']>=$money){
					if($this->add($oid,$in['iid'],$money)){
					T('out')->update(array('waiting'=>2),array('oid'=>$oid));}
					return false;
				}else{
					$this->add($oid,$in['iid'],$in['m']);
					$money=$money-$in['m'];
					T('out')->update(array('waiting'=>2),array('oid'=>$oid));
					
				}}
			}
			
			return false;
			case 2:
			
			$all=$this->_getd2();
				if(!is_array($all))return false;
			foreach($all as $in){
				if($in['uid']!=$uid){
				if($in['m']>=$money){
					if($this->add($oid,$in['iid'],$money)){
					T('out')->update(array('waiting'=>2),array('oid'=>$oid));}
					return false;
				}else{
					$this->add($oid,$in['iid'],$in['m']);
					$money=$money-$in['m'];
					T('out')->update(array('waiting'=>2),array('oid'=>$oid));
					
				}}
			}
			return false;;
		}
	
	  
		}
	private function add($oid,$iid,$money){
	
        $oidarr=array('oid'=>$oid);
        $iidarr=array('iid'=>$iid);
        $cash = abs($money);
        $where= array('`flag`'=>0,'`exit`'=>0);
        $oids = T('out')->join_table(array('t'=>'user','uid','uid'))->get_one(array_merge($oidarr,$where));
        $iids = T('in')->join_table(array('t'=>'user','uid','uid'))->get_one(array_merge($iidarr,$where));
        $outinfo=$oids;
       $ininfo=$iids;
        if (!$iids)return false;
        if (!$oids)return false;
        if ($oids['status'] == 0 && $oids['alloc'] == 0) {
            T('out')->update(array('allocmoney'=>$oids['cash'],'alloc'     =>1),$oidarr);
            $oids = T('out')->get_one($oidarr);
        }
        if ($iids['status'] == 0 && $iids['alloc'] == 0) {
            T('in')->update(array('allocmoney'=>$iids['cash'],'alloc'     =>1),$iidarr);
            $iids = T('in')->get_one($iidarr);
        }
        if ($oids['allocmoney'] < $cash) return false;
        if ($iids['allocmoney'] < $cash)return false;
        if ($oids['uid'] == $iids['uid'])return false;
        $allocobj=M('alloc','am');
        if ($oids['allocmoney'] == $cash) {
            $rate = $oids['cash'] * Y::$conf['pd_rate'];
            $day  = (($_SERVER["REQUEST_TIME"] - $oids['addtime']) / G_DAY);
            $rate = $rate * $day;
            T('out')->update(array('allocmoney'=>0,'alloc'     =>2,'status'    =>3,'rate'      =>$rate,'alloctime' =>$_SERVER["REQUEST_TIME"]),$oidarr);
            $allocobj->_sendsms($outinfo['mobile'],$outinfo['lid']);
        }else {
            T('out')->update(array('allocmoney'=>($oids['allocmoney'] - $cash)),$oidarr);
        }
        if ($iids['allocmoney'] == $cash) {
            T('in')->update(array('allocmoney'=>0,'alloc'     =>2,'status'    =>3),$iidarr);
           
              $allocobj->_sendsms($ininfo['mobile'],$ininfo['lid']);
              
        }else {
            T('in')->update(array('allocmoney'=>($iids['allocmoney'] - $cash)),$iidarr);
        }
        $insert = array('oid'    =>$oids['oid'],'addtime'=>$_SERVER["REQUEST_TIME"],'fromuid'=>$oids['uid'],'touid'  =>$iids['uid'],'iid'    =>$iids['iid'],'cash'   =>$cash,'type'=>1);
        
        $bool = T('pay')->add($insert);
     
		if($bool){
			T('user')->update(array('jf'=>1),array('uid'=>$insert['fromuid']));
			$a=T('user')->get_one(array('uid'=>$oids['uid']));
			$b=T('user')->get_one(array('uid'=>$iids['uid']));
				$allocobj->_sendsms($a['mobile'],$bool);
				$allocobj->_sendsms($b['mobile'],$bool);
		}
        
        
        
        if ($bool) {
           
         
           return true;
           
        } else {
            return false;;
        }

	}

}
?>
