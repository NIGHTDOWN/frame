<?php


namespace ng169\control\index;
use ng169\control\indexbase;



checktop();

class comment extends indexbase{
	public function control_list(){
		$get=get(array('int'=>array('productid'=>1,'cmlevel')));
		$img=get(array('int'=>array('img')));
		$get['cmflag']=0;
		$model=T('product_comment')->join_table(array('t'=>'user','uid','uid'))->set_where($get,'=');
		if($img['img']){
			$model=$model->set_global_where(array('cmimg'=>''),'!=');
			$im=1;
		}else{
			$im=0;
		}
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$get['img']=$img['img'];
		
		$cm=isset($get['cmlevel'])?($get['cmlevel']):-1;
		$var_array = array('data'  =>$data,'page'=>$page,'get'=>$get,'cm'=>$cm,'im'=>$im);

		$this->vlog($this->get_userid(),M('vlog','im')->getpromuid($get['productid']),$get['productid']);
		$this->view(null,$var_array);
	}
	//评价用户
	public function control_user()
	{
		$get=get(array('string'=>array('ordernum'=>1)));
		/*$where['uid']=$this->get_userid(1);*/
		$where['ordernum']=$get['ordernum'];
		$where['muid']=$this->get_muid(1);
		$where['status']=3;
		$where['scflag']=0;
		$order=T('order')->join_table(array('t'=>'user','uid','uid'))->set_where($where)->get_one();
		$product=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->get_all($where);
		
		if(!$order)error('订单已经无法评价了',geturl(null,null,'order','user'));
		if($_POST){
			//用户等级积分更新
			//用户评价更新
			$get2=get(array(
					'array'=>
					array('cmcontent',
						'g')));
			foreach($product as $volist){
				switch($_POST['g'][$volist['id']]){
					case -1:
					$good=2;
					$order['ubad']+=1;
					$up2['ubad']=$order['ubad'];
					
					break;
					case 0:
					$good=0;
					$order['ucenter']+=1;
					$up2['ucenter']=$order['ucenter'];
					break;
					case 1:
					$good=1;
					$order['ugood']+=1;
					$up2['ugood']=$order['ugood'];
					
					break;
				}
			
				$desc=$get2['cmcontent'][$volist['id']];
				$insert['ordernum']=$order['ordernum'];
				$insert['muid']=$this->get_muid(1);
				$insert['uid']=$order['uid'];
				$insert['id']=$volist['id'];
				$insert['cmcontent']=$desc;
				$insert['cmtime']=time();
				$insert['cmip']=YRequest::getip();
				$insert['cmlevel']=$good;
				$insert['specs']=$volist['specs'];
				$insert['productid']=$volist['productid'];
				$index='proimg_'.$volist['id'];
			
				T('comment_user')->add($insert);
			}
			
			T('user')->update($up2,array('uid'=>$order['uid']));	
			$up3['scflag']=1;
			T('order')->update($up3,array('ordernum'=>$order['ordernum']));
		//推送信息；
		
			M('level','im')->checkuser($order['uid']);
			$where=array('ordernum'=>$order['ordernum']);
			$u=geturl(null,'shop_comment_user','asyn','admin');
			YAsyn::start($u,$where);
			out('评价完成',geturl(null,null,'sells','shop'));
		
		
		}
	
	
		$array=array('data'=>$order,'product'=>$product);
		$this->view(null,$array);
	}
	private function score($num){
		if($num>5)return 5;
		if($num<0)return 0;	
		return $num;
	}
	//评价商户
	public function control_shop(){
		$get=get(array('string'=>array('oid'=>1)));
		$where['uid']=$this->get_userid(1);
		$where['ordernum']=$get['oid'];
		$where['uid']=$this->get_userid(1);
		$where['status']=3;
		$where['cflag']=0;
		$order=T('order')->join_table(array('t'=>'merchant','muid','muid'))->get_one($where);
		$product=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->get_all($where);
		if(!$order)error('订单已经无法评价了',geturl(null,null,'order','user'));
		if($_POST){
			//订单评价状态更新；
			//产品表评价更新
			//商户评价更新
			//评价表更新；
			$get2=get(array('int'=>
					array('snuma'=>1,
						'snumb'=>1,
						'snumc'=>1,
						'snumd'=>1),
					'array'=>
					array('cmcontent',
						'g')));
					
			foreach($product as $volist){
				switch($_POST['g'][$volist['productid']]){
					case -1:
					$good=2;
					$order['bad']+=1;
					$up2['bad']=$order['bad'];
					if($volist['plpjf']>0){
						$up['plpjf']=$volist['plpjf']-1;
					}
					break;
					case 0:
					$good=0;$order['center']+=1;
					$up2['center']=$order['center']+1;
					break;
					case 1:
					$good=1;$order['good']+=1;
					$up2['good']=$order['good'];
					if($volist['plpjf']<5){
						$up['plpjf']=$volist['plpjf']+1;
					}
					break;
				}
			
				$desc=$get2['cmcontent'][$volist['productid']];
				
				$insert['ordernum']=$order['ordernum'];
				$insert['muid']=$volist['muid'];
				$insert['id']=$volist['id'];
				$insert['uid']=$this->get_userid(1);
				$insert['cmcontent']=$desc;
				$insert['cmtime']=time();
				$insert['cmip']=YRequest::getip();
				$insert['cmlevel']=$good;
				
				$insert['specs']=$volist['specs'];
				$insert['productid']=$volist['productid'];
				$index='proimg_'.$volist['productid'];
				
				$img=get(array('string'=>array($index)));
				
				
				
			
				if(is_array($img[$index])){
					$img[$index]=implode(',',$img[$index]);
				}
				
				$insert['cmimg']=$img[$index];
				
		
				T('product_comment')->add($insert);
				$up['pls']='pls+1';
				$upwhere=array('productid'=>$volist['productid']);
				T('product')->updata(array('w'=>$upwhere,'v'=>$up),0);
			}

			$in2['ordernum']=$order['ordernum'];
			$in2['muid']=$order['muid'];
			$in2['uid']=$this->get_userid(1);
			$in2['cmip']=YRequest::getip();
			$in2['cmtime']=time();
			$in2['ms']=$this->score($get2['snuma']);
			$in2['fw']=$this->score($get2['snumb']);
			$in2['wl']=$this->score($get2['snumc']);
			$in2['fh']=$this->score($get2['snumd']);
			
			T('merchant_comment')->add($in2);	
			$fm=$order['center']+$order['good']+$order['bad'];	
			$sg=(($order['good']+$order['center'])/$fm);
			$sb=($order['bad']/$fm);
			
			$up2['mspf']=($this->score($order['mspf'])*$sg+$in2['ms']*$sb);		
			$up2['fwpf']=($this->score($order['fwpf'])*$sg+$in2['fw']*$sb);		
			$up2['wlpf']=($this->score($order['wlpf'])*$sg+$in2['wl']*$sb);		
			$up2['fhpf']=($this->score($order['fhpf'])*$sg+$in2['fh']*$sb);
			/*d(($up2['mspf']));
			d("$sg,$sb,$fm");
			d($up2,1);	*/
			T('merchant')->update($up2,array('muid'=>$order['muid']));	
			
			$up3['cflag']=1;
			T('order')->update($up3,array('ordernum'=>$order['ordernum']));
			M('level','im')->checkshop($order['muid']);
		//推送信息；
			$where=array('ordernum'=>$get['oid']);
			$u=geturl(null,'user_product_comment','asyn','admin');
			YAsyn::start($u,$where);
			out('评价完成',geturl(null,null,'order','user'));
		
		
		}
	
	
		$array=array('data'=>$order,'product'=>$product);
		$this->view(null,$array);
	}
}
?>
