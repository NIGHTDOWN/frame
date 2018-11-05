<?php





checktop();

class Sock_user_cheat extends userSock{
  
	public
	function run($socket,$data){
		/*$sock=socketClass::$sockets[socketClass::getindex($socket)];
		
		$user=$this->login($data->cookie);
		
		$this->broadcast($user['uid']);*/
		
		$this->login($socket,$data->cookie);
		return true;

	}




}

?>
