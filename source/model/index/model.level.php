<?php





checktop();
class levelModel extends Y
{
	private function checknum($fenshu){
		
	if($fenshu<=10){
		return 1;
	}elseif($fenshu>10 && $fenshu<=40){
		return 2;
	}
	elseif($fenshu>40 && $fenshu<=90){
		return 3;
	}
	elseif($fenshu>90 && $fenshu<=150){
		return 4;
	}
	elseif($fenshu>150 && $fenshu<=250){
		return 5;
	}
	elseif($fenshu>252 && $fenshu<=500){
		return 6;
	}
	elseif($fenshu>500 && $fenshu<=1000){
		return 7;
	}
	elseif($fenshu>1000 && $fenshu<=2000){
		return 8;
	}
	elseif($fenshu>2000 && $fenshu<=5000){
		return 9;
	}elseif($fenshu>5000 && $fenshu<=10000){
		return 10;
	}elseif($fenshu>10000 && $fenshu<=20000){
		return 11;
	}elseif($fenshu>20000 && $fenshu<=50000){
		return 12;
	}elseif($fenshu>50000 && $fenshu<=100000){
		return 13;
	}elseif($fenshu>100000 && $fenshu<=200000){
		return 14;
	}elseif($fenshu>200000 && $fenshu<=500000){
		return 15;
	}elseif($fenshu>500000 && $fenshu<=1000000){
		return 16;
	}elseif($fenshu>1000000 && $fenshu<=2000000){
		return 17;
	}elseif($fenshu>2000000 && $fenshu<=5000000){
		return 18;
	}elseif($fenshu>5000000 && $fenshu<=10000000){
		return 19;
	}elseif($fenshu>10000000){
		return 20;
	}
	}
	
	public function checkuser($uid){
	//判断用户好评数差评数目的差得出等级；跟系统等级相等则不变；小于则原等级-1大于则加1
	if(!$uid)return false;
	$user=T('user')->get_one(array('uid'=>$uid));
	if(!$user)return false;
	$fenshu=$user['ugood']-$user['ubad'];
	$level=$this->checknum($fenshu);
	$center=abs($user['ulevel']-$level);
	if($center==1){
		T('user')->update(array('ulevel'=>$level),array('uid'=>$user['uid']));
	}else{
		if($level>$user['ulevel']){
			T('user')->update(array('ulevel'=>$level),array('uid'=>$user['uid']));
		}
		
		return false;
	}
	
	
	
	
	
	}
	
	public function checkshop($muid){
	//判断用户好评数差评数目的差得出等级；跟系统等级相等则不变；小于则原等级-1大于则加1
	if(!$muid)return false;
	$user=T('merchant')->get_one(array('muid'=>$muid));
	if(!$user)return false;
	$fenshu=$user['good']-$user['bad'];
	$level=$this->checknum($fenshu);
	$center=abs($user['slevel']-$level);
	if($center==1){
		T('merchant')->update(array('slevel'=>$level),array('uid'=>$user['uid']));
	}else{
		if($level>$user['slevel']){
		T('merchant')->update(array('slevel'=>$level),array('uid'=>$user['uid']));
		}
		return false;
	}
	
	
	
	
	
	}
	

  


}

?>
