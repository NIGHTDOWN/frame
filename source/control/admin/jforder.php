<?php




checktop();
class control extends adminbase{
	private $db= 'order_jf';
	private $key='orderid';
	public function control_run(){
		$mod=T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'jfproduct','productid','productid'),1);
		$mod=$this->init_where($mod);
		$mod=$this->init_order($mod);
        
		$page=$this->make_page($mod);
        
		$data= $mod->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array('data'=>$data,'page'=>$page);

		$this->view(null,$var_array);
	}
  
	public function control_del(){
		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		$model = T($this->db)->del($where);
		M('log','am')->log($model, $where);
		out('删除成功',null,$model);
	}   
	public function control_show(){
		$get=get(array('int'=>array('orderid'=>1)));
		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'admins','adminid','adminid'),1)->join_table(array('t'=>'jfproduct','productid','productid'),1)->get_one($get);
		if(!$model)error('订单不存在');
		$this->view(null,array('data'=>$model));       
        
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
