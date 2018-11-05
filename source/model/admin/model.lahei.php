<?php




checktop();
class laheiModel extends Y{

	private $uid;
  

	public function close($uid){
		if(!$uid)return false;
		$this->uid = $uid;
		T('user')->update(array('flag'=>1),array('uid'=>$this->uid));
        
		$info=T('user')->get_one(array('uid'=>$this->uid));
       
		if($info && $info['gid']){
			$name=$info['username'];
			/*M('nlog','am')->add($info['pid'],-Y::$conf['ld_fk'],$info['username'].'下属封号');*/
        	
			M('nlog','am')->add($info['gid'],-(Y::$conf['ld_fk']),"下属({$name})封号领导罚款");
			$this->downgrade($info['gid']);
		}
		
		$this->closein();
		$this->closeout();
		$this->orderfix();
		return 1;
	}
	public function downgrade($uid){
		return false;
		$where=array('flag'=>0,'uid'=>$uid);
		$ubfo=T('user')->get_one($where);
		if(!$ubfo)return false;
		$num=$ubfo['m_gd']+1;
		if($num>2){
			$level=$ubfo['level']-1;
			if($level<0){
				
			}else{
				
				T('user')->update(array('level'=>$level),$where);
			}
			
		}
		T('user')->update(array('m_gd'=>$num),$where);
	}
	
	
	public function closelevel($uid){
		if(!$uid)return false;
		$this->uid = $uid;
		T('user')->update(array('flag'=>1),array('uid'=>$this->uid));
        
		$info=T('user')->get_one(array('uid'=>$this->uid));
       
		if($info && $info['gid']){
			$name=$info['username'];
			/*M('nlog','am')->add($info['pid'],-Y::$conf['ld_fk'],$info['username'].'下属封号');*/
        	
			M('nlog','am')->add($info['gid'],-(Y::$conf['order_less_ldfk']),"下属({$name})未完成报单最少次数封号领导罚款");
			$this->downgrade($info['gid']);
		}
		
		$this->closein();
		$this->closeout();
		$this->orderfix();
		return 1;
	}
    
	public function closenewuser($uid){
		if(!$uid)return false;
		$this->uid = $uid;
		T('user')->update(array('flag'=>1),array('uid'=>$this->uid));
        
		$info=T('user')->get_one(array('uid'=>$this->uid));
       
		if($info && $info['gid']){
			$name=$info['username'];
			/*M('nlog','am')->add($info['pid'],-Y::$conf['ld_fk'],$info['username'].'下属封号');*/
			M('nlog','am')->add($info['gid'],-(Y::$conf['new_ld_fk']),"下属({$name})冻结领导罚款");
			$this->downgrade($info['gid']);
		}
		
		/*   $this->closein();
		$this->closeout();
		$this->orderfix();*/
		return 1;
	}
	public function closerobuser($uid){
		if(!$uid)return false;
		$this->uid = $uid;
		T('user')->update(array('flag'=>1),array('uid'=>$this->uid));
        
		$info=T('user')->get_one(array('uid'=>$this->uid));
       
		if($info && $info['gid']){
			$name=$info['username'];
			/*M('nlog','am')->add($info['pid'],-Y::$conf['ld_fk'],$info['username'].'下属封号');*/
			M('nlog','am')->add($info['gid'],-(Y::$conf['ld_fk']),"下属({$name})被抢单罚款");
			$this->downgrade($info['gid']);
		}
		
		/*   $this->closein();
		$this->closeout();
		$this->orderfix();*/
		return 1;
	}
    
    
	private function closeout(){
    	
		T('out')->update(array('status'=>2),array('uid'   =>$this->uid,'status'=>'!=1'));
	}
	private function closein(){
		T('in')->update(array('status'=>2),array('uid'   =>$this->uid,'status'=>'!=1'));
	}
	private function orderfix(){
		$uid = $this->uid;
		$from= T('pay')->set_where("fromuid={$uid} and flag!=2 and flag!=4")->get_all();

		T('pay')->update(array('flag'=>4),"fromuid={$uid} and flag!=2 and flag!=4");
        
        
		foreach($from as $in){
			$this->fixfrom($in['iid'],$in['cash']);
		}
		$to = T('pay')->set_where("touid={$uid} and flag!=2 and flag!=4")->get_all();

		T('pay')->update(array('flag'=>4),"touid={$uid} and flag!=2 and flag!=4");
        
        

		foreach($to as $out){
			$this->fixto($out['oid'],$out['cash']);
		}
	}
	private function fixfrom($iid,$cash){

		if(!$iid || !$cash)return false;
		$where = array('iid'=>$iid);
		$info   = T('in')->get_one($where);
		$insert = array();
		if($info && $info['status'] != 1 && $info['status'] != 2){
			$insert['allocmoney'] = $info['allocmoney'] + $cash;
			$insert['status'] = 0;
			$insert['alloc'] = 1;

			T('in')->update($insert,$where);
            
		}return false;

	}
	private function fixto($oid,$cash){

		if(!$oid || !$cash)return false;
		$where = array('oid'=>$oid);
		$info   = T('out')->get_one($where);
		$insert = array();
		if($info && $info['status'] != 1 && $info['status'] != 2){
			$insert['allocmoney'] = $info['allocmoney'] + $cash;
			$insert['status'] = 0;
			$insert['alloc'] = 1;
			T('out')->update($insert,$where);
		}return false;

	}
}
?>
