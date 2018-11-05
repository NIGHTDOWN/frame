<?php


checktop();

class scategoryModel extends Y
{
	
	
	public function getl1num($muid)
	{
		if(!$muid)return false;
		$where=array('muid'=>$muid,'depth'=>0);
		$data=T('shop_category')->get_count($where);
	
		return $data;
	}
	public function getl2num($muid,$pid)
	{
		if(!$muid)return false;
		$where=array('muid'=>$muid,'depth'=>1,'pid'=>$pid);
		$data=T('shop_category')->get_count($where);
		return $data;
	}
	public function getl2($data)
	{
		
		if(!$data['muid'])return false;
		if(!$data['scatid'])return false;
		
		$where=array('muid'=>$data['muid'],'pid'=>$data['scatid'],'depth'=>1);
		$data=T('shop_category')->set_field('scatid,catname,orders,muid,pid')->order_by(array('s'=>'down','f'=>'orders'))->get_all($where);
		
		return $data;
	}
	public function getallcatid($catid){
		if(!$catid)return false;
	  $dbcatid=T('shop_category')->set_where(array('scatid'=>$catid))->get_one();
	  if(!$dbcatid)return false;
	  if(!$dbcatid['depth']==0)return array($catid);
	  $dbcatidchild=T('shop_category')->set_where(array('pid'=>$catid))->set_field('scatid')->get_all();
	  $data = array_column($dbcatidchild, 'scatid');
      array_push($data,$catid);
 return $data;
	}
}

?>
