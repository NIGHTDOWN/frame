<?php





checktop();
class control extends userbase{
	
	public
	function control_run(){
		$get=get(array('int'=>array('num'=>1,'pid'=>1),'string'=>array('spec')),array('num'=>'数量','pid'=>'产品编号','spec'=>'产品规格'));
		$product=T('product')->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'productid'=>$get['pid']))->get_one();
		if(!$product){
			
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		$this->view();
		/*$insert['productid']=$product['productid'];
		$insert['uid']=$this->get_userid();
		$insert['specs']=$get['spec'];
		$insert['nowprice']=$product['price'];
		$in=T('cart')->get_one($insert);
		if($in){
			$id=T('cart')->update(array('nums'=>$in['nums']+$get['num']),$insert);
		}else{
			$insert['nums']=$get['num'];
			$insert['addtime']=time();
			$insert['muid']=$product['muid'];
			$id=T('cart')->add($insert);	
		}
		if($id){
			$count=T('cart')->set_field('sum(nums) as  num')->get_one(array('uid'=>$this->get_userid()));
			if($count['num'])out($count['num']);
			error('购物车还是空的哦');
		}else{
			error('添加购物车失败');
		}*/
	}

}
?>
