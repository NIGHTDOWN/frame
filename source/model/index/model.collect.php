<?php





checktop();

class collectModel extends Y
{
	private function get_userid(){
		$uid=parent::$wrap_user['uid'];
		if(!$uid)die();
		return $uid;
	}
	public  function get_shopsum(){
		return T('collect_shop')->get_count(array('uid'=>$this->get_userid()));
	}
  public  function get_productsum(){
		return T('collect_product')->get_count(array('uid'=>$this->get_userid()));
	}
	public  function get_history(){
		return T('product_log')->get_count(array('uid'=>$this->get_userid()));
	}
}

?>
