<?php






checktop();

class control extends userbase{
	public function control_mobilecz(){
	
		$api=T('payapi')->get_all(array('flag'=>0));
		$get=get(array('int'=>array('payment_type'=>1,'amount'=>1)),array('payment_type'=>'支付方式','amount'=>'充值金额'));
		if($get['payment_type']){
			//支付
			$apiid=array_column($api,'apiid');
			$title=parent::$wrap_user['username'].'余额充值';
				$pay=$get['amount'];
			$index=array_search($get['payment_type'],$apiid);
			if($index!==false){
				//支付接口支付	
				$api=$api[$index];
				$insert['ordernums']='';
				$insert['for']=1;
				$insert['uid']=$this->get_userid(1);
				$insert['paytype']=$get['payment_type'];
				$insert['paycash']=$pay;
				$insert['paystatus']=0;
				$insert['addtime']=time();
				$insert['paytypestring']=$api['name'];
				$insert['soleid']=$this->get_soleid();
				$insert['title']=$title;
				$insert['payduan']='web';
				$payid=T('pay')->add($insert);
				
				if($payid){
						//加载api
						Y::loadAPI('m'.$api['apiid']);
						$name=$api['api_name'];
						$key=$api['api_key'];
				
						if($insert['paytype']==3 ){
						
							$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$api->pay($insert['soleid'],$title,$pay);
					
						
					}
					
					if( $insert['paytype']==2){
						
						$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$url=$api->pay($insert['soleid'],$title,$pay);
					if($url){
						$data['url']=($url);
						
						gourl($data['url']);
						// $data['orderid']=$insert['soleid'];
						// $this->view('wx_buy',array('data'=>$data));
					}
						die();
					}
					
					
					elseif($insert['paytype']==4){
						$api=new payapi($name,$key);	
					  $api->pay($insert['soleid'],$title,$pay);	
					}
					}else{
						error('支付失败');
					}
			}else{
				error('支付方式不存在');
			}
		}	
	}
	public function control_run(){
	
		$api=T('payapi')->get_all(array('flag'=>0));
		$get=get(array('int'=>array('payment_type'=>1,'amount'=>1)),array('payment_type'=>'支付方式','amount'=>'充值金额'));
		if($get['payment_type']){
			//支付
			$apiid=array_column($api,'apiid');
			$title=parent::$wrap_user['username'].'余额充值';
				$pay=$get['amount']*100;
			$index=array_search($get['payment_type'],$apiid);
			if($index!==false){
				//支付接口支付	
				$api=$api[$index];
				$insert['ordernums']='';
				$insert['for']=1;
				$insert['uid']=$this->get_userid(1);
				$insert['paytype']=$get['payment_type'];
				$insert['paycash']=$pay;
				$insert['paystatus']=0;
				$insert['addtime']=time();
				$insert['paytypestring']=$api['name'];
				$insert['soleid']=$this->get_soleid();
				$insert['title']=$title;
				$insert['uid']=$this->get_userid();
				$insert['payduan']='pc';
				$payid=T('pay')->add($insert);
				
				if($payid){
						//加载api
						Y::loadAPI($api['apiid']);
						$name=$api['api_name'];
						$key=$api['api_key'];
						
						if($insert['paytype']==3 ){
						/*	d($apiid[0]);*/
							$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$api->pay($insert['soleid'],$title,$pay);
					
						
					}
					
					if( $insert['paytype']==2){
						/*	d($apiid[0]);*/
						$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$url=$api->pay($insert['soleid'],$title,$pay);
					if($url){
						/*$img=M('qr','im')->get($url);*/
						$data['url']=urlencode($url);
						$data['orderid']=$insert['soleid'];
						
						
						$this->view('wx_buy',array('data'=>$data));
					}
						die();
					}
					
					
					elseif($insert['paytype']==4){
						$api=new payapi($name,$key);	
					  $api->pay($insert['soleid'],$title,$pay);	
					}
					}else{
						error('支付失败');
					}
			}else{
				error('支付方式不存在');
			}
		}	
	}
	//确认余额密码

	
	public function control_product(){
			/*Y::import('socket','tool');*/
			/*Y::loadLib('socket');*/
	
		$get=get(array('string'=>array('oid'=>1)));
		$f=preg_match('/^[0-9|]*$/', $get['oid']);
		if(!$f)error('数据错误');
		$ordernum1=explode('|',$get['oid']);
		$ordernum=implode(',',$ordernum1);
		$where['uid']=$this->get_userid(1);
		$where['status']=0;
		$data=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'),1)->join_table(array('t'=>'merchant','order_product.muid','muid'),1)->group_by('order_product.muid')->set_where($where)->set_where("v.ordernum in ($ordernum)")->get_all();
		if(sizeof($data)!=sizeof($ordernum1)){
			error('订单已失效');
		}
		
		if(sizeof($data)!=1){
			$title="合并".sizeof($data)."笔订单付款[{$ordernum}]";
		}else{
			$title=tostr($data[0]['productname']);
			
		}
		
		$pay=array_sum(array_column(($data),'paytotal'));
		$api=T('payapi')->get_all(array('flag'=>0));
		
		$array=array('data'=>$data,'money'=>$pay,'api'=>$api);
		$get=get(array('int'=>array('payment_type')));
		
		if($get['payment_type']){
			//支付
			$apiid=array_column($api,'apiid');
			switch($get['payment_type']){
				case '-1':
				//余额支付
				/*$api=$api[$index];*/
				$insert['ordernums']=$ordernum;
				$insert['uid']=$this->get_userid(1);
				$insert['paytype']=$get['payment_type'];
				$insert['paycash']=$pay;
				$insert['paystatus']=0;
				$insert['addtime']=time();
				$insert['paytypestring']='余额支付';
				$insert['soleid']=$this->get_soleid();
				$insert['title']=$title;
				$payid=T('pay')->add($insert);
				gourl(geturl(array('soleid'=>$insert['soleid']),'balance','pay','pay'));
				break;
				
				default:
				
				$index=array_search($get['payment_type'],$apiid);
				if($index!==false){
					//支付接口支付	
				
					$api=$api[$index];
					$insert['ordernums']=$ordernum;
					$insert['paytype']=$get['payment_type'];
					$insert['paycash']=$pay;
					$insert['paystatus']=0;
					$insert['addtime']=time();
					$insert['paytypestring']=$api['name'];
					$insert['soleid']=$this->get_soleid();
					$insert['title']=$title;
					$insert['uid']=$this->get_userid();
					if(YUrl::ismoible()){$insert['payduan']='web';}else{$insert['payduan']='pc';}
					$payid=T('pay')->add($insert);
					if($payid){
						//加载api
						if(YUrl::ismoible()){Y::loadAPI('m'.$api['apiid']);}else{Y::loadAPI($api['apiid']);}
						
						$name=$api['api_name'];
						$key=$api['api_key'];
						
						if($insert['paytype']==3 ){
						/*	d($apiid[0]);*/
							$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$api->pay($insert['soleid'],$title,$pay);
					
						
					}
					
					if( $insert['paytype']==2){
						/*	d($apiid[0]);*/
							$public_key=$api['public_key'];
						$api=new payapi($name,$key,$public_key);	
						
					$url=$api->pay($insert['soleid'],$title,$pay);
					if($url){
						/*$img=M('qr','im')->get($url);*/
						if(YUrl::ismoible()){
						$data['url']=($url);
						
						gourl($data['url']);	
						}else{
							$data['url']=urlencode($url);
						$data['orderid']=$insert['soleid'];
						
						
						$this->view('wx_buy',array('data'=>$data));
						}
						
						
						
						
					}
						die();
					}
					
					
					elseif($insert['paytype']==4){
						$api=new payapi($name,$key);	
					  $api->pay($insert['soleid'],$title,$pay);	
					}
					}else{
						error('支付失败');
					}
				}else{
					error('支付方式不存在');
				}
				break;
			}
			
			
		}
		$this->view('pay_index',$array);
		
	}
	private function get_soleid(){
		$insert['soleid']='ng169'.date('ymdHis').rand(9999,99999);
		if(T('pay')->get_one($insert)){
			return $this->get_ordernum();
		}
		return $insert['soleid'];
	}

	public function control_balance(){
		if(!parent::$wrap_user['safepwd']){
			YOut::out('请设置支付密码',geturl(null,'pwd2','payset','pay'),0,1);
		}
		$id=get(array('string'=>array('soleid'=>'1')));
		$order=T('pay')->get_one($id);
		if(!$order)error('订单不存在');
		if($order['paystatus']==1)error('订单已经支付');
		if($order['paystatus']!=0)error('订单已经无法支付');
		$data=array('data'=>$order);
		if($_POST){
			$pwd=get(array('string'=>array('pay_passwd'=>'md5')));
			if(parent::$wrap_user['safepwd']!=$pwd['pay_passwd']){
				error('支付密码不正确');
			}
			else{
				$bool=M('cash','im')->reduce($order['paycash'],$order['soleid'],tostr($order['title']));
		
		
				if(!$bool)error('支付失败');
				$where=array('soleid'=>$order['soleid']);
		
				$info=$order;
				$data=null;
				if($info['paystatus']==0){
					$data['paystatus']=1;
					$data['paytime']=time();
					$data['thirduser']=$this->get_userid(1);
				
					$f=T('pay')->update($data,$where);
					
					$ordernum=explode(',',$info['ordernums']);
					$orderwhere=array('ordernum'=>$ordernum);
					$update['status']=1;
					$update['payflag']=1;
					$update['paytime']=$data['paytime'];
					$update['soleid']=$data['soleid'];
					$update['autocommenttime']=time()+7*G_DAY;
			
					T('order')->update($update,$orderwhere);
					$product=T('product')->join_table(array('t'=>'order_product','productid','productid'))->get_all($orderwhere);
					$productlist=array_column($product,'productid');
					$upwhere['productid']=$productlist;
					$upwhere['status']=0;
					$upwhere['pflag']=1;
					$up=array('sells'=>'sells+1','count'=>'count-1');
				
					T('product')->updata(array('w'=>$upwhere,'v'=>$up),0);
					$orderurl=geturl('',null,'order','user');
					out('支付成功',$orderurl,null,1);
				}
			
				

				
			}
		}
		$this->view(null,$data);
	}








}
?>
