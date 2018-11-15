<?php

namespace ng169\model\admin;
use ng169\Y;


checktop();
class tree extends Y{
	public function uptree($db,$catid,$pcid){
		$isexist=T($db)->set_where(array('cid'=>$catid),'=')->get_one();
		$oldtree=$isexist['tree'];
		$ptree=T($db)->set_where(array('cid'=>$pcid),'=')->get_one();
		
		if($ptree){
			$mytree=$ptree['tree'].G_BREAK.$catid;
		}else{
			$mytree=$pcid.G_BREAK.$catid;
		}
	
		if($isexist){
			T($db)->update(array('tree'=>$mytree),array('cid'=>$catid));
			$sql="UPDATE `".DB_PREFIX.$db."` 
			SET `tree` = REPLACE(`tree`, '".$oldtree.G_BREAK."', '".$mytree.G_BREAK."') 
			WHERE INSTR(`tree`,'".$catid.G_BREAK."') < 0";
			T($db)->get_one(null,null,$sql);
		
		}else{
			T($db)->add(array('cid'=>$catid,'tree'=>$mytree));
		
		}
		//子更新
		
	
		return true;
	
	}
	//获取所有子节点
	public function getctree($db,$catid){
		$thisid=T($db)->get_one(array('cid'=>$catid));
		$data=T($db)->set_field(array('cid'))->set_limit(5000)->set_where('tree like "%'.$thisid['tree'].G_BREAK.'%"')->get_all();
		
		$data2=array_column($data,'cid');
		
		return $data2;
	}
	//获取父亲节点
	public function getptree($db,$catid){
		$data=T($db)->set_field(array('tree'))->get_one(array('cid'=>$catid));
		if(!$data)return false;
		$data=explode(G_BREAK,$data['tree']);
		if($data[0]==0){
			unset($data[0]);
		}
		return $data;
	}
	public function fix($db){
		
		$data=T($db)->order_by(array('f'=>'depth','s'=>'up'))->set_field(array('catid','parentid'))->get_all();
	
		foreach($data as $list){
			$this->uptree($db.'_tree',$list['catid'],$list['parentid']);
		}
		return false;
	}
}
?>
