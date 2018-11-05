<?php




checktop();
class tmpcodeModel extends Y
{
	private $errormsg = null;
	public function geterror()
	{
		return $this->errormsg;
	}
	
	public function make($who)
	{
		$table = T('tmpcode');
		$ip = YRequest::getip();
		$msg = $this->check($who);
	
		if ($msg)
		{
			
			$this->errormsg = $msg;
			return false;
		}
		;
		$ar = array();
		$ar['ip'] = $ip;
		$ar['who'] = $who;
		
		$ar['addtime'] = time();
		$ar['code'] = rand(11111, 99999);
		$table->del(array('who' => $who));
		$table->add($ar);
		return $ar['code'];

	}
	
	
	public function get($who)
	{
		
		$table = T('tmpcode');
		$info = $table->get_one(array('who' => $who));
		return $info;

	}
	
	public function check($who)
	{
		
		$ip = YRequest::getip();
		$timeout = Y::$conf['timeoutcode'];
		$table = T('tmpcode');
		$w1 = array('addtime' => array((time() - $timeout), time()), 'ip' => $ip);
		$w2 = array('addtime' => array((time() - $timeout), time()), 'who' => $who);
		
		if ($table->get_count($w1) > 10)
		{
			return ('请勿频繁操作');
		}
		if ($table->get_count($w2))
		{
			return ("{$timeout}秒钟内只能获取1次，请稍后再试！");
		}
		else
		{
			return false;

		}


	}

}

?>
