<?php





checktop();

class paytextModel extends Y
{


 public function get(){
 	
		$data=T('pay_text')->order_by(array('s'=>'down','f'=>'RAND()'))->get_one();
		if(!$data)return $this->get();
		return $data['text'];
 }

}

?>
