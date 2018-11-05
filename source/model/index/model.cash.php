<?php




checktop();
class cashModel extends Y {
	private $user=null;
	public function setuid($uid){
		if(!$uid)return false;
		$user=T('user')->get_one(array('uid'=>$uid));
		if(!$user)return false;
		$this->user=$user;
		return $this;
	}
    private function  log($oldmoney,$cash,$type,$soleid=null,$desc=null){
    	$user=$this->user?$this->user:parent::$wrap_user;
		if(!$user)return false;
		$insert['uid']=$user['uid'];
		$insert['addtime']=time();
		$insert['oldcash']=$oldmoney;
		$insert['money']=$cash;
		$insert['type']=$type;
		$insert['desc']=$desc;
		$insert['soleid']=$soleid;
		$insert['adminid']=parent::$wrap_admin['adminid'];
		return T('cash_log')->add($insert);
		
	}
    public function add($money,$soleid,$desc=null){
    	$money=abs($money);
    	
		$user=$this->user?$this->user:parent::$wrap_user;
		if(!$user)return false;
		$oldcash=$user['cash'];
		/*if($oldcash+)*/
		$cash=$oldcash+$money;
		$up=array('cash'=>$cash);
		$where=array('uid'=>$user['uid']);
		
		$b=T('user')->update($up,$where);
		if($b){
			$this->log($oldcash,$money,1,$soleid,$desc);
			return true;}
		return false;
	}

 	public function reduce($money,$soleid=null,$decs=null){
 		$money=abs($money);
		$user=parent::$wrap_user;
		if(!$user)return false;
		$oldcash=$user['cash'];
		if($oldcash<$money){
			return false;
		}
		$cash=$oldcash-$money;
		$up=array('cash'=>$cash);
			$where=array('uid'=>$user['uid']);
			
		$b=T('user')->update($up,$where);
		if($b){
		$this->log($oldcash,$money,0,$soleid,$decs);
		return true;}
		return false;
		
		
		
	}
}
?>
