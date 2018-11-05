<?php



checktop();
class control extends indexbase{
	
	
	public function control_city(){
		$k=get(array('int'=>array('provinceid'=>1)));
		$info=T('city')->get_all(array('fatherID'=>$k['provinceid']));
		out($info);
		/*$this->view(null,$var_array);*/
	}
	public function control_area(){
		$k=get(array('int'=>array('cityid'=>1)));
		$info=T('area')->get_all(array('fatherID'=>$k['cityid']));
		out($info);
	
	}

}
?>
