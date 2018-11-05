<?php



checktop();
class control extends adminbase{
	private $db_name = 'withdraw';
	private $key='id';
	
	public function control_wait(){ 
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'),1)->set_global_where(array('v.status'=>0))->order_by(array('s'=>'down','f'=>'addtime'));
        
		$model=$this->init_where($model);
        
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('withdraw',$var_array);
	}
	public function control_over(){ 
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'),1)->set_global_where(array('v.status'=>1))->order_by(array('s'=>'down','f'=>'addtime'));
        
		$model=$this->init_where($model);
        
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('withdraw',$var_array);
	}
	public function control_close(){ 
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'),1)->set_global_where(array('v.status'=>2))->order_by(array('s'=>'down','f'=>'addtime'));
        
		$model=$this->init_where($model);
        
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
      
        
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('withdraw',$var_array);
	}
   
	public function control_del(){

		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}

     
		$model = T($this->db_name)->del($where);
     
		out('删除成功',null,$model);
	}   
	public function control_show(){
		$get=get(array('string'=>array('soleid'=>1)));
		$data=T($this->db_name)->join_table(array('t'=>'admins','adminid','adminid'),1)->join_table(array('t'=>'user','uid','uid'),1)->set_field('v.*,adminname,username,cash,realname,user.mobile,user.email')->get_one($get);
		if(!$data)error('交易号不存在');
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('withdraw_show',$var_array);
	}
    public function control_deal(){
		$get=get(array('string'=>array('soleid'=>1)));
		$data=T($this->db_name)->get_one($get);
		if(!$data)error('交易不存在');
		$get2=get(array('string'=>array('adminimg','admindesc')));
		$type=intval($_POST['type']);
		switch($type){
			case 1:
			$get2['paytime']=time();
			$get2['status']=1;
			$get2['adminid']=parent::$wrap_admin['adminid'];
			T($this->db_name)->update($get2,$get);
			out('操作完成',geturl(null,'wait','withdraw'));
				break;
			case 2:
			$get2['paytime']=time();
			$get2['status']=2;
			$get2['adminid']=parent::$wrap_admin['adminid'];
			T($this->db_name)->update($get2,$get);
			
			$money=$data['money']+$data['fee'];
			M('cash','im')->setuid($data['uid'])->add($money,$data['soleid'],'提现关闭退回款项');
out('操作完成',geturl(null,'wait','withdraw'));
				break;
			default:
			error('操作无法识别');
				break;
		}
		
		
	}
    
    
    
    
    
    
}
?>
