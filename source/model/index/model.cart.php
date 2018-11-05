<?php





checktop();

class cartModel extends Y
{
private function getuid(){
	$uid=parent::$wrap_user['uid'];
	if($uid)return $uid;
	return false;
}

public function check($uid){
	if(!$uid)return false;
	$model1=T('cart')->set_field('productname,v.addtime,price,specs,v.productid,smallimg1,nums,originalprice,pflag,product.status,shelves,count,nowprice,cid,product.muid,merchantname,merchant.phone')->join_table(array('t'=>'product','v.productid','productid'),1)->join_table(array('t'=>'merchant','product.muid','muid'),1)->order_by(array('s'=>'down','f'=>'v.muid,v.addtime'))->set_global_where(array('uid'=>$uid,'yhtype'=>0,'old'=>0))->get_all();
		$model2=T('cart')->set_field('productname,v.addtime,gprice as price,gcheck,specs,v.productid,smallimg1,nums,originalprice,pflag,product.status,shelves,count,nowprice,cid,product.muid,merchantname,merchant.phone')->join_table(array('t'=>'product','v.productid','productid'),1)->join_table(array('t'=>'groupon','v.yhtype','gpid'),1)->join_table(array('t'=>'merchant','product.muid','muid'),1)->order_by(array('s'=>'down','f'=>'v.muid,v.addtime'))->set_global_where(array('uid'=>$uid,'yhtype'=>1,'old'=>0))->get_all();
		foreach($model1 as $data){
			if($data['price']!=$data['nowprice'] ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			
			if($data['shelves']==0 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['status']!=0 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['pflag']!=1 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
		}
			foreach($model2 as $data){
			if($data['price']!=$data['nowprice'] ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['gcheck']!=1 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['shelves']==0 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['status']!=0 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
			if($data['pflag']!=1 ){
				T('cart')->update(array('old'=>1),array('cid'=>$data['cid']));break;
			}
		}
		
		
		
		
}


 public function getcount(){
 	$uid=$this->getuid();
 	if(!$uid)return 0;
 	/*$count=T('cart')->set_field('sum(nums) as  num')->get_one(array('uid'=>$uid));*/
 	$count=T('cart')->set_field('count(*) as  num')->get_one(array('uid'=>$uid));
 	
 	if($count['num'])return($count['num']);
			return 0;
 }
 public function getlist(){
 	$uid=$this->getuid();
 	if(!$uid)return 0;
 	$count=T('cart')->order_by(array('s'=>'down','f'=>'v.addtime'))->set_field('productname,price,specs,v.productid,smallimg1,nowprice,cid')->join_table(array('t'=>'product','v.productid','productid'))->set_limit(8)->get_all(array('uid'=>$uid));
 	if(sizeof($count))return $count;
 	return false;
 }
}

?>
