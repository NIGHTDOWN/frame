<?php




checktop();
class control extends adminbase{
	private $db= 'order_refund';
	private $key='refundid';
	public function control_tk(){
		$mod=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->set_global_where(array('stype'=>0));
		$mod=$this->init_where($mod);
		$mod=$this->init_order($mod);
        
		$page=$this->make_page($mod);
        
		$data= $mod->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array('data'=>$data,'page'=>$page);

		$this->view(null,$var_array);
	}
  public function control_sh(){
		$mod=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->set_global_where(array('stype'=>1));
		$mod=$this->init_where($mod);
		$mod=$this->init_order($mod);
        
		$page=$this->make_page($mod);
        
		$data= $mod->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array('data'=>$data,'page'=>$page);

		$this->view('depot_tk',$var_array);
	}
public function control_shneed(){
		$mod=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->set_global_where(array('stype'=>1,'jr'=>array(1,9)));
		$mod=$this->init_where($mod);
		$mod=$this->init_order($mod);
        
		$page=$this->make_page($mod);
        
		$data= $mod->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array('data'=>$data,'page'=>$page);

		$this->view('depot_tk',$var_array);
	}
public function control_tkneed(){
		$mod=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->set_global_where(array('stype'=>0,'jr'=>array(1,9)));
		$mod=$this->init_where($mod);
		$mod=$this->init_order($mod);
        
		$page=$this->make_page($mod);
        
		$data= $mod->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array('data'=>$data,'page'=>$page);

		$this->view('depot_tk',$var_array);
	}
	public function control_del(){
		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		$model = T($this->db)->del($where);
		
		out('删除成功',null,$model);
	} 
	public
	function control_tkhd(){
		
		
		
		if($_POST){
			$get=get(array('string'=>array('refundid'=>1,'remark'=>1),'array'=>array('userimg')));
			/*$where['adminid']=Y::$wrap_admin['adminid'];
			$where['issystem']=1;*/
			$where['refundid']=$get['refundid'];
			$id=T('order_refund')->join_table(array('t'=>'order_product','refundid','refundid'))->get_one($where);
if(!$id)error('信息不存在');
			$up=$where;
			$up['apptime']=time();	$up['remark']=$get['remark'];
			if($get['userimg']){
				$up['userimg']=implode(',',$get['userimg']);
			}
			$up['adminid']=Y::$wrap_admin['adminid'];
			$up['issystem']=1;
			T('refund_detail')->add($up);
		
			$ids['refundid']=$id['refundid'];
	
		}
		gourl(geturl($ids,'show','depot'));
	
	}  
	public function control_show(){
		$get=get(array('int'=>array('refundid'=>1)));
		$data=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->set_global_where($get)->get_one();
		if(!$data)error('记录不存在');
		$data['list']=T('refund_detail')->order_by(array('s'=>'down','f'=>'apptime'))->join_table(array('t'=>'user','uid','uid'))->join_table(array('t'=>'admins','adminid','adminid'),1)->get_all(array('refundid'=>$data['refundid']));
		$var_array=array('data'=>$data);
		$this->view(null,array('data'=>$data));       
        
	}   
public function control_close(){
		$get=get(array('int'=>array('refundid'=>1)));
		$data=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->set_global_where($get)->get_one();
		if(!$data)error('记录不存在');
		T($this->db)->update(array('orderstatus'=>5),$get); 
		if($data['stype']){
		T('order_product')->update(array('shflag'=>4),$get);     
		}   else{
		T('order_product')->update(array('tkflag'=>4),$get);     	
		} 
		M('refund','am')->addmsg($data['refundid'],$data['uid'],'系统关闭申请');
		out('操作完成');
        
	} 
	public function control_qr(){
		$get=get(array('int'=>array('refundid'=>1)));
		$data=T($this->db)->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','orderid','orderid'),1)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->set_global_where($get)->get_one();
		if(!$data)error('记录不存在');
		/*T($this->db)->update(array('orderstatus'=>5),$get); 
		if($data['stype']){
		T('order_product')->update(array('shflag'=>4),$get);     
		}   else{
		T('order_product')->update(array('tkflag'=>4),$get);     	
		} */
		M('refund','am')->tk($data['refundid']);
		M('refund','am')->addmsg($data['refundid'],$data['uid'],'系统完成申请');
		
		out('操作完成');
        
	} 
public function control_save(){
		$get2=get(array('int'=>array('orderid'=>1)));
		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'admins','adminid','adminid'),1)->join_table(array('t'=>'jfproduct','productid','productid'),1)->get_one($get2);
		if(!$model)error('订单不存在');
		$get=get(array('int'=>array('status'=>1),'string'=>array('sender','sendnum')));
		
		if($model['status']==2 || $model['status']==3){
			error('订单已经不能编辑');
		}
		if($get['status']==1){
			if(!$get['sender'])error('物流名称不能留空');
			if(!$get['sendnum'])error('物流单号不能留空');
			$get['adminid']=parent::$wrap_admin['adminid'];
			$get['sendtime']=time();
			T($this->db)->update($get,$get2);
		}else{
			T($this->db)->update(array('status'=>$get['status']),$get2);
		}
		
		out('操作完成');
		
		
		
		
		$this->view(null,array('data'=>$model));       
        
	}   
}

?>
