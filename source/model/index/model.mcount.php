<?php





checktop();
class mcountModel extends Y
{
    
   private function isin($muid){
   	$where=array('muid'=>$muid);
    	$data=T('merchant_count')->get_one($where);
        if(!$data){
			T('merchant_count')->add($where);
			$data=array();
		}
		return $data;
   }
    public function addprocount($muid){
    	$data=$this->isin($muid);
    	$where=array('muid'=>$muid);
    	$in['product']=$data['product']+1;
    	T('merchant_count')->update($in,$where);
    }
     public function delprocount($muid){
    	$data=$this->isin($muid);
    	$where=array('muid'=>$muid);
    	$in['product']=$data['product']-1;
    	$in['product']=$in['product']>0?$in['product']:0;
    	T('merchant_count')->update($in,$where);
    }
    public function getprocount($muid){
    		$where=array('muid'=>$muid);
    	$data=T('merchant_count')->get_one($where);
    	$data=is_array($data)?$data:array();
    	return intval($data['product']);
    }
    
 
}

?>
