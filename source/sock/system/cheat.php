<?php





checktop();

class Sock_system_cheat extends systemSock{

	public
	function run($data){
		
		/*$order=T('pay')->get_one(array('soleid'=>$data['data']['orderid']));*/
		$to=$data['data']['touid'];
		
		unset($data['data']['touid']);
		$msg=$data;
		$events=$this->getuser($to);
		foreach($events as $k=>$event ){
			$client=$event['clientid'];
			self::send($client,array('data'=>$msg));
		
		}
		
		return true;

	}




}

?>
