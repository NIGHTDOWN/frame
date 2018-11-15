<?php




namespace ng169\model\index;
use ng169\Y;
checktop();
class pcate extends Y
{
	
	//获取商品分类
	public function get(){
		
		$id='product';
        $cache=new cfileClass();
		list($bool,$cae)=$cache->get($id);
		
		if($bool){
		$data=	$cae;
		}else{
			$data=	T('product_category')->set_field('catid,catname,depth,alias,ptype')->get_child('catid');
			$cache->set($id,$data);
			
		}
		
		return $data;	
	}
	public function addspec($muid,$catid,$name){
		
		$insert['type']=1;
		$insert['sname']=$name;
		$insert['catid']=intval($catid);
		$isin=T('product_category_attribute')->get_one($insert);
		if($isin)return $isin;
		$insert['setmuid']=$muid;
		$insert['type']=1;
		$insert['sname']=$name;
		$insert['catid']=$catid;
		$insert['addtime']=time();
		$id=T('product_category_attribute')->add($insert);
		$insert['id']=$id;
		return $insert;
	}
	//获取商户常用的规格
	public function getspeclist($array){
		$muid=intval($array['muid']);
		$w['type']=1;
		$w['catid']=$array['catid'];
		
		$data=T('product_category_attribute')->set_where('setmuid in(0,'.$muid.')')->set_where($w)->group_by('sname')->set_limit(10)->get_all();
		
		return $data;	
	}

	

  


}

?>
