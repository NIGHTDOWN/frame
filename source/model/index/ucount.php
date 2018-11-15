<?php



namespace ng169\model\index;
use ng169\Y;

checktop();
class ucount extends Y
{
    
   private function isin($uid){
   	$where=array('uid'=>$uid);
    	$data=T('user_count')->get_one($where);
        if(!$data){
			T('user_count')->add($where);
		}
		$data=$data?$data:array();
		return $data;
   }
    public function addproduct($uid){
    	$this->isin($uid);
    	
    }
    public function getcarts($uid){
    	$data=$this->isin($uid);
    	return $data['carts'];
    }
     public function addmsg($uid,$num=1){
    	$data=$this->isin($uid);
    	$data1['carts']=$data['msgcount']+$num;
    	return T('user_count')->update($data1,array('uid'=>$uid));
    }
     public function addcollect($uid){
    	$data=$this->isin($uid);
    	$data1['collectpro']=$data['collectpro']+1;
    	return T('user_count')->update($data1,array('uid'=>$uid));
    }
      public function addcart($uid){
    	$data=$this->isin($uid);
    	$data1['carts']=$data['carts']+1;
    	return T('user_count')->update($data1,array('uid'=>$uid));
    }   public function delcart($uid,$num=1){
    	$data=$this->isin($uid);
    	$data1['carts']=$data['carts']-$num;
    	return T('user_count')->update($data1,array('uid'=>$uid));
    }
 
}

?>
