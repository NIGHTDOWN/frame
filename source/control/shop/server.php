<?php


namespace ng169\control\shop;

use ng169\control\shopbase;


checktop();
class server extends shopbase{

	
	public
	function control_tkhd(){
		
		
		
		if($_POST){
			$get=get(array('string'=>array('refundid'=>1,'remark'=>1),'array'=>array('userimg')));
			$where['muid']=$this->get_muid(1);
			$where['refundid']=$get['refundid'];
			$id=T('order_refund')->join_table(array('t'=>'order_product','refundid','refundid'))->get_one($where);
if(!$id)error('信息不存在');
			$up['uid']=$this->get_userid(1);
			$up['refundid']=$where['refundid'];
			$up['ismerchant']=1;
			$up['apptime']=time();
			$up['remark']=$get['remark'];
			if($get['userimg']){
				$up['userimg']=implode(',',$get['userimg']);
			}
			
			T('refund_detail')->add($up);
			$ids['ordernum']=$id['ordernum'];
			$ids['id']=$id['id'];
			gourl(geturl($ids,'detail','server'));
		}
		gourl(geturl(null,'run','index'));
	/*	$var_array=array('data'=>$data);
		
		
		
		$this->view(null, $var_array);*/
	}

public
	function control_detail(){
		$get=get(array('string'=>array('ordernum'=>1,'id'=>1)));
		$where['id']=$get['id'];
		$data=T('order_refund')->join_table(array('t'=>'order_product','refundid','refundid'),1)->set_where($where)->get_one();
		if($_POST){
			$get=get(array('int'=>array('do'=>1)));
			switch($get['do']){
				case 0:
				if($data['orderstatus']!=0)error('无法执行操作');
				T('order_refund')->update(array('orderstatus'=>2),array('refundid'=>$data['refundid']));
				M('refund','am')->addmsg($data['refundid'],$data['uid'],'卖家已经拒绝了您申请');
				out('拒绝用户申请成功');
					break;
				case 1:
				if($data['orderstatus']==0){
				T('order_refund')->update(array('orderstatus'=>1),array('refundid'=>$data['refundid']));				
				M('refund','am')->addmsg($data['refundid'],$data['uid'],'卖家已经同意用户申请');		   	
				out('已经同意用户申请');	
				}
				break;
				case 2:	
				if($data['orderstatus']==1 && $data['stype']==0){
				if(M('refund','am')->tk($data['refundid']))
				{out('操作完成');}
				else{error('操作失败');}
				}
				break;
			}
		}
		$where['ordernum']=$get['ordernum'];
		$where['muid']=$this->get_muid(1);
		$data=T('order_refund')->join_table(array('t'=>'order','ordernum','ordernum'),1)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'user','order.uid','uid'),1)->set_field('*,v.*')->set_where($where)->get_one();
		if(!$data)error('数据不存在');
		$data['list']=T('refund_detail')->order_by(array('s'=>'down','f'=>'apptime'))->join_table(array('t'=>'user','uid','uid'))->get_all(array('refundid'=>$data['refundid']));
		$var_array=array('data'=>$data);
		$this->view(null, $var_array);
	}
}
?>
