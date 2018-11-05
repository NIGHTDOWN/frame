<?php




checktop();
class levelupModel extends Y{
	private $userinfo;
    
	public function checkup($uid){
		$userinfo = $this->getuser($uid);
     
		if(!$userinfo)return false;
		$sorcelevel = $userinfo['level'];
		$newlevel   = $this->isup($uid,$sorcelevel+1);
		/*	return  $this->setlevel($uid,$newlevel);*/
		if($newlevel){
			$this->setlevel($uid,$newlevel);
		}else{
			return false;
		}
	}
    
	public  function setlevel($uid,$level){
		if(!$this->getuser($uid))return false;
		$where = array('uid'=>$uid);
		$mod = T('user');
		$L=$level+1;
		$LEVELZT="pt_l{$L}_zt";
		$LEVELGR="pt_l{$L}_td";
		switch($level){
			case 0:
            
			$mod->update(array('level'    =>$level,'newcashbl'=>0,'dj'       =>0),$where);
			break;
			case 1:
			
			$mod->update(array('level'    =>$level,'newcashbl'=>0,'dj'       =>0),$where);
			break;
			case 2:
			$mod->update(array('level'    =>$level,'newcashbl'=>1,'dj'       =>15),$where);
			break;
			case 3:
			$mod->update(array('level'    =>$level,'newcashbl'=>1,'dj'       =>15),$where);
			break;
			case 4:
			$mod->update(array('level'    =>$level,'newcashbl'=>2,'dj'       =>10),$where);
			break;
			case 5:
			$mod->update(array('level'    =>$level,'newcashbl'=>3,'dj'       =>5),$where);
			break;
			case 6:
			$mod->update(array('level'    =>$level,'newcashbl'=>4,'dj'       =>0),$where);
			break;
			case 7:
			$mod->update(array('level'    =>$level,'newcashbl'=>5,'dj'       =>0),$where);
			break;
			case 8:
			$mod->update(array('level'    =>$level,'newcashbl'=>6,'dj'       =>0),$where);
			break;
			case 9:
         
		}
		return true;



	}
    
	public function levelaword($uid,$depth){
		$user = $this->getuser($uid);
		if(!$user)return false;
		$level = $user['level'];
        
		switch($depth){
			case 1:
			if($level == 2)return 0.1;
			break;
			case 2:
			if($level == 3)return 0.05;
			break;
			case 3:
			if($level == 4)return 0.03;
			break;
			case 4:
			if($level == 5)return 0.01;
			break;
			case 5:
			if($level == 6)return 0.025;
			break;
			case 6:
			if($level == 7)return 0.005;
			break;
			case 7:
			if($level == 8)return 0.001;
			break;
			case 8:
			if($level == 9)return 0.001;
			break;
			case 9:
			if($level == 10)return 0.001;
			break;
			case 10:
			if($level == 11)return 0.001;
			break;
			case 11:
			if($level == 12)return 0.001;
			break;

		}
		return false;
	}

    
	public  function checkdown(){

	}
	private function getuser($uid){
        
		$info = T('user')->get_one(array('uid' =>$uid,'flag'=>0));
		if(!$info)return false;
		$this->userinfo = $info;
		return $info;
	}
    
	private function isup($uid,$level){
		$L=$level+1;
		$LEVELZT="pt_l{$L}_zt";
		$LEVELGR="pt_l{$L}_td";
		if(!$level ){
			return  false;
		}
		$g=Y::$conf[$LEVELGR];
		$zt=Y::$conf[$LEVELZT];
		$groupcount = T('user_tree')->join_table(array('t'=>'user','uid','uid'))->get_count(array('isok'=>array(1,1000),'flag'=>0,'treeid'=>$uid.G_BREAK));
		if($groupcount >= $g && $this->userinfo['ztrs']>=$zt){
			return $level;
		}
        
	}
	/*   private function level($sourcelevel)
	{
	$level = sizeof(explode(',',Y::$conf['user_level']));
	$uid   = $this->userinfo['uid'];
	if ($sourcelevel >= $level)return false;
	switch ($sourcelevel) {
	case 0:
          
          
	$groupcount = T('user_tree')->join_table(array('t'=>'user','uid','uid'))->get_count(array('isok'=>array(1,1000),'flag'=>0,'treeid'=>$uid.G_BREAK));
	if ($groupcount >= 300 && $this->userinfo['ztrs']>=30) {
	return $sourcelevel + 1;
	}
	break;
            

	}
	return false;
	}
	*/
}
?>
