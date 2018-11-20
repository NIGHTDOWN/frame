<?php


namespace ng169\control\index;
use ng169\control\indexbase;
use ng169\tool\Request as YRequest;



checktop();

class buy extends indexbase{
	private function summoney($prices,$nums){
		$money=0;
		if(is_array($prices) && is_array($nums)){
			foreach($prices as $k=>$v){
				$money+=$v*$nums[$k];
			}
			return $money;
		}
		return false;
	}
	public function control_run(){
		$randid=T('outtime')->add(array('ip'=>YRequest::getip()));
		$this->seoadd('确认订单');
		$uid=$this->get_userid(1);
		
		$get=get(array('int'=>array('num'=>1,'pid'=>1,'gpid'),'string'=>array('spec')),array('num'=>'数量','pid'=>'产品编号','spec'=>'产品规格'));
		$product=T('product')->join_table(array('t'=>'merchant','muid','muid'))->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'productid'=>$get['pid']))->get_one();
		$groupon=T('groupon')->set_where(array('gcheck'=>1,'gpid'=>$get['gpid'],'pid'=>$get['pid']))->get_one();
		if($groupon){
			$total=$groupon['gprice']*$get['num'];
		}else{
			$total=$product['price']*$get['num'];
		}
	
		if(!$product){
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->order_by(array('f'=>'addtime','s'=>'down'))->get_all(array('uid'=>$uid));
		$logisfee=M('logisfee','im')->getprice($product['productid'],$get['num']);
		$this->view(null,array('data'=>$product,'address'=>$address,'get'=>$get,'logisfee'=>$logisfee,'randid'=>$randid,'groupon'=>$groupon,'sumtatal'=>$total));
	}
	public function control_cartsure(){
		$randid=T('outtime')->add(array('ip'=>YRequest::getip()));
	
		$uid=$this->get_userid(1);
		M('cart','im')->check($uid);
		$hj=0;
		$get=get(array('array'=>array('product_id'=>1)));
		$cid='cid in ('.implode(',',$get['product_id']).')';
		
		$order=T('cart')->join_table(array('t'=>'merchant','muid','muid'),1)->group_by('v.muid')->set_field('v.muid,merchantname')->set_where(array('uid'=>$uid,'old'=>0))->set_where($cid)->get_all();
		
	if(!sizeof($order)){
		error('商品已经失效');
		
	}
	
		foreach($order as $i=>$v){
			$plist=T('product')->join_table(array('t'=>'cart','productid','productid'),1)->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'muid'=>$v['muid'],'cart.uid'=>$uid))->set_where($cid)->order_by(array('s'=>'down','f'=>'v.muid'))->get_all();

			//先获取productid组
			$pids = array_column($plist, 'productid');
			$order[$i]['logisfee']=M('logisfee','im')->getprices($pids);
			$price = array_column($plist, 'nowprice');
			$nums = array_column($plist, 'nums');
			$order[$i]['sumcash']=$this->summoney($price,$nums);
			$hj+=$order[$i]['sumcash'];
			$order[$i]['plist']=$plist;
		}

		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->order_by(array('f'=>'addtime,mflag','s'=>'down'))->get_all(array('uid'=>$uid));
		
		$this->view(null,array('data'=>$order,'address'=>$address,'get'=>$get,'logisfee'=>$logisfee,'randid'=>$randid,'total'=>$hj));
	}
	public function control_sureforcart(){
		$get=get(array('int'=>array('id')));
		if(!$get['id'])error('页面超时，请重新下单');
		$get['ip']=YRequest::getip();
		$get['do']=0;
		if(!T('outtime')->get_one($get)){
			error('请勿重复提交订单',geturl(null,null,'cart','index'),1);
		}
		T('outtime')->update(array('do'=>1),$get);
		$uid=$this->get_userid(1);
		$get=get(array('array'=>array('cid'=>1,'mark','logis'),'int'=>array('addid'=>1)),array('addid'=>'收货信息','cid'=>"订单ID",'logis'=>'物流信息','mark'=>'备注'));
		if(sizeof($get['cid'])==0){
			error('ID错误');
		}
		$ordernums=array();
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->order_by(array('f'=>'addtime','s'=>'down'))->get_one(array('uid'=>$uid,'addid'=>$get['addid']));
		if(!$address)error('地址未选中');
		$addressstring=$address['province'].$address['city'].$address['area'].$address['address'];
		//分组创建订单；在生成合并付款链接
		$where=array('cid'=>$get['cid'],'uid'=>$uid);
		$cid=implode(',',$get['cid']);
		$order=T('cart')->group_by('muid')->set_where(array('uid'=>$uid,'old'=>0))->set_where("cid in ($cid)")->get_all();
	
		foreach($order as $i=>$v){
			$insert=array();
			$plist=T('product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'cart','productid','productid'),1)->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'muid'=>$v['muid'],'cart.uid'=>$uid))->set_where("cid in ($cid)")->order_by(array('s'=>'down','f'=>array('muid','cart.addtime')))->get_all();
			
			$index=$v['muid'];
			//先获取productid组
			$insert['ordernum']=$this->get_ordernum();
			array_push($ordernums,$insert['ordernum']);
			$insert['uid']=$uid;
			$insert['address']=$addressstring;
			$insert['createtime']=time();
			$insert['addid']=$address['addid'];
		/*	$insert['addid']=$address['addid'];*/
			$insert['mark']=$get['mark']["'".$index."'"];
			$insert['status']=0;
			$insert['phone']=$address['recvphone'];
			$insert['mobile']=$address['recvmobile'];
			$insert['realname']=$address['realname'];
			$pids = array_column($plist, 'productid');
			
			$order[$i]['logisfee']=M('logisfee','im')->getprices($pids);
			
			if($order[$i]['logisfee'] && is_array($order[$i]['logisfee']))				{
				$logis=$get['logis']['\''.$index.'\''];
				if(isset($order[$i]['logisfee'][$logis])){
					$insert['logisfee']=$order[$i]['logisfee'][$logis];
					$insert['logis']=$logis;
				}else{
					error('运送方式错误');
				}
				
			}
			$price = array_column($plist, 'nowprice');
			$nums = array_column($plist, 'nums');
			
			$insert['totals']=$this->summoney($price,$nums)+$insert['logisfee'];
			$insert['muid']=$v['muid'];
			$insert['paytotal']=$insert['totals'];
			T('order')->add($insert);
			foreach($plist as $lists){
				$insert2=array();
				$insert2['ordernum']=$insert['ordernum'];
				$insert2['productid']=$lists['productid'];
				$insert2['productname']=$lists['productname'];
				$insert2['spec']=$lists['specs'];
				$insert2['bid']=M('snapshot','im')->make($lists['productid']);;
				$insert2['muid']=$lists['muid'];
				$insert2['price']=$lists['nowprice'];
				$insert2['num']=$lists['nums'];
				$insert2['subtotal']=$lists['nowprice']*$insert2['num'];
				$insert2['smallimg']=$lists['smallimg1'];
				T('order_product')->add($insert2);
				T('cart')->del(array('uid'=>$uid,'cid'=>$lists['cid']));
			}
			
			
		}
		
		$ordernums=implode('|',$ordernums);
		$url=geturl(array('oid'=>$ordernums),'product','pay','pay');
		gourl($url);
		
		
	}
	public function control_sure(){
		
		/*$get=get(array('int'=>array('id')));
		if(!$get['id'])error('页面超时，请重新下单');
		$get['ip']=YRequest::getip();
		$get['do']=0;
		if(!T('outtime')->get_one($get)){
			error('请勿重复提交订单');
		}*/
		T('outtime')->update(array('do'=>1),$get);
		$this->seoadd('确认订单');
		$uid=$this->get_userid(1);
		$get=get(array('int'=>array('num'=>1,'pid'=>1,'addid'=>1,'gpid'),'string'=>array('spec','logis','mark')),
		array('num'=>'数量','mark'=>'备注','addid'=>'收货地址','pid'=>'产品编号','spec'=>'产品规格','logis'=>'物流类型'));
		$product=T('product')->join_table(array('t'=>'merchant','muid','muid'))->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'productid'=>$get['pid']))->get_one();
		$groupon=T('groupon')->set_where(array('gcheck'=>1,'gpid'=>$get['gpid'],'pid'=>$get['pid']))->get_one();
		
		if(!$product){
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		
		$logisfee=M('logisfee','im')->getprice($product['productid'],$get['num']);
		if($logisfee){
			if(!$logisfee[$get['logis']]){
				error('物流选择错误');
			}
			$logisfee=$logisfee[$get['logis']];
		}
		
		
		$insert['uid']=$uid;
		$insert['addid']=$get['addid'];
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->get_one($insert);
		if(!$address)error('收货地址错误');
		
		$insert['muid']=$product['muid'];
		$insert['ordernum']=$this->get_ordernum();
		$insert['addid']=$address['addid'];
		$insert['address']=$address['province'].$address['city'].$address['area'].$address['address'];
		$insert['realname']=$address['realname'];
		$insert['phone']=$address['recvphone'];
		$insert['mobile']=$address['recvmobile'];
		$insert['status']=0;
		$insert['logisfee']=$logisfee;
		$insert['logis']=$get['logis'];
		$insert['mark']=$get['mark'];
		$insert['createtime']=time();
		T('order')->add($insert);
		$insert2['ordernum']=$insert['ordernum'];
		$insert2['productid']=$product['productid'];
		$insert2['productname']=$product['productname'];
		$insert2['smallimg']=$product['smallimg1'];
		$insert2['spec']=$get['spec'];
		$insert2['num']=$get['num'];
		$insert2['muid']=$product['muid'];
		 $insert2['price']=$product['price'];
		$insert2['bid']=M('snapshot','im')->make($product['productid']);
		if($groupon){
			$insert2['subtotal']=$groupon['gprice']*$get['num']+$logisfee;
		}else{
			$insert2['subtotal']=$product['price']*$get['num']+$logisfee;
		}
		
		
		T('order_product')->add($insert2);
		T('order')->update(array('totals'=>$insert2['subtotal'],'paytotal'=>$insert2['subtotal']),array('ordernum'=>$insert['ordernum']));
		//支付成功在减库存
		/*T('product')->update(array('count'=>$product['count']-$insert2['num']),array('productid'=>$product['productid']));*/
		//跳转到支付页面
		gourl(geturl(array('oid'=>$insert['ordernum']),'product','pay','pay'));
	}
public function control_jfsure(){
		
		$get=get(array('int'=>array('id')));
		if(!$get['id'])error('页面超时，请重新下单');
		$get['ip']=YRequest::getip();
		$get['do']=0;
		if(!T('outtime')->get_one($get)){
		/*	error('请勿重复提交订单');*/
		}
		T('outtime')->update(array('do'=>1),$get);
		$this->seoadd('确认订单');
		$uid=$this->get_userid(1);
		$get=get(array('int'=>array('num'=>1,'pid'=>1,'addid'=>1),'string'=>array('spec','logis','mark')),array('num'=>'数量','mark'=>'备注','addid'=>'收货地址','pid'=>'产品编号','spec'=>'产品规格','logis'=>'物流类型'));
		$product=T('jfproduct')->set_where(array('shelves'=>1,'productid'=>$get['pid']))->get_one();
		if(!$product){
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		
		
	
		
		
		$insert['uid']=$uid;
		$insert['addid']=$get['addid'];
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->get_one($insert);
		if(!$address)error('收货地址错误');
		
	
		$insert['ordernum']=$this->get_ordernum();
		$insert['addid']=$address['addid'];
		$insert['address']=$address['province'].$address['city'].$address['area'].$address['address'];
		$insert['realname']=$address['realname'];
		$insert['phone']=$address['recvphone'];
		$insert['mobile']=$address['recvmobile'];
		$insert['status']=0;
		
		$insert['mark']=$get['mark'];
		$insert['createtime']=time();
		$insert['spec']=$get['spec'];
		$insert['num']=$get['num'];
		$insert['price']=$product['originalprice'];
		$insert['productid']=$product['productid'];
			$insert['bid']=M('snapshot','im')->make($product['productid']);
			$insert['totals']=$product['originalprice']*$get['num'];
		/*T('order_jf')->add($insert);*/
	/*	$insert2['ordernum']=$insert['ordernum'];
		
		$insert2['productname']=$product['productname'];
		$insert2['smallimg']=$product['smallimg1'];
		
		
		$insert2['muid']=$product['muid'];*/
	
		
		if(parent::$wrap_user['points']<$insert['totals']){
			error('积分不足');
		}
		T('order_jf')->add($insert);
		/*T('order')->update(array('totals'=>$insert2['subtotal'],'paytotal'=>$insert2['subtotal']),array('ordernum'=>$insert['ordernum']));*/
		//支付成功在减库存
		/*T('product')->update(array('count'=>$product['count']-$insert2['num']),array('productid'=>$product['productid']));*/
		//跳转到支付页面
		/*gourl(geturl(array('oid'=>$insert['ordernum']),'product','pay','pay'));*/
		M('jf','am')->add($this->get_userid(),-$insert['totals'],'积分换购商品');
		out('兑换成功',geturl(null,'product','jf','user'));
	}
	private function get_ordernum(){
		$insert['ordernum']=date('ymdHis').rand(9999,99999);
		if(T('order')->get_one($insert)){
			return $this->get_ordernum();
		}
		return $insert['ordernum'];
	}

public function control_jf(){
		$randid=T('outtime')->add(array('ip'=>YRequest::getip()));
		$this->seoadd('确认订单');
		$uid=$this->get_userid(1);
		
		$get=get(array('int'=>array('num'=>1,'pid'=>1),'string'=>array('spec')),array('num'=>'数量','pid'=>'产品编号','spec'=>'产品规格'));
		$product=T('jfproduct')->set_where(array('shelves'=>1,'productid'=>$get['pid']))->get_one();
		if(!$product){
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->order_by(array('f'=>'addtime','s'=>'down'))->get_all(array('uid'=>$uid));
		
		$this->view(null,array('data'=>$product,'address'=>$address,'get'=>$get,'logisfee'=>$logisfee,'randid'=>$randid));
	}


}
?>
