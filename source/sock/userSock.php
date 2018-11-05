<?php





checktop();
im(LIB.'/class.socket.php');
class userSock extends socketClass{
	public $user='';
	
	private function islogin_user_table($clientid,$uname){
		if(!$clientid)return false;
		if(!$uname)return false;
		$userislogin=T('sock_client')->get_one(array('uname'=>$uname,'online'=>1,'check'=>1,'handshake'=>1));
		
		 T('sock_client')->update(array('uname'=>$uname,'check'=>1),array('clientid'=>$clientid));
		if(!$userislogin){
			return true;
		}
		return false;
	}
    public function checklogin($cookie){
     	
	 	/*$userinfo = $this->getcookie();*/
	 	
	 	$Xcode     = Y::import('code', 'tool');
		$cookie = $Xcode->authCode($cookie, 'DECODE');
		
		$cookie = unserialize($cookie);
		if(!empty($cookie)){

			$user = T('user');
			$w    = array_filter(array(
					'username'=> $cookie['username'],
					'password'=> $cookie['password']));
			$userdbinfo = $user->set_where($w,'=')->get_one();


if($userdbinfo)return $userdbinfo;
		return false;	
		}
		return false;
	 }
    public function login($socket,$cookie){
	    $clientid=socketClass::getindex($socket);
		$sock=socketClass::$sockets[$clientid];
		$user=$this->checklogin($cookie);
		if(!$user)return false;
		
		/*$this->user=$user;*/
		$sock[$clientid]['uname']=$user['uid'];
		$sock[$clientid]['check']=1;
		$login=$this->islogin_user_table($clientid,$user['uid']);
		if($login){
			//广播登入信息；
			$data['uid']=$user['uid'];
			$data['username']=$user['username'];
			if(self::reflash($user['uid'])){
				$this->broadcast($data);
			}
			
		}
		return $user;
		 
}
}

?>
