<?php






checktop();

class control extends userbase{
	public function control_run(){
	$api=T('payapi')->get_all(array('flag'=>0));
	$data=array('api'=>$api);
		$this->view('precharge',$data);
	}
	
}
?>
