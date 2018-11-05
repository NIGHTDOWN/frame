<?php



checktop();
class control extends adminbase{
	private $db_name = 'message';
	private $key='msgid';
    
	public function control_recv(){
		$c=D_MEDTHOD;	$a=D_FUNC;
        
		$model=T($this->db_name)->order_by(array('s'=>'down','f'=>array($this->key)))->set_global_where(array('fdel'=>0,'pid'=>0,'creatid'=>parent::$wrap_admin['adminid']));
        
		$model=$this->init_where($model);
		$model=$model->set_where(array('toid'=>0));
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();

		$var_array=array($c=>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	public function control_run(){
		$c=D_MEDTHOD;	$a=D_FUNC;
        
		$model=T($this->db_name)->join_table(array('t'=>'admins','creatid','adminid'))->order_by(array('s'=>'down','f'=>array($this->key)));
        
		$model=$this->init_where($model);
		$model=$model->set_where(array('toid'=>0,'pid'=>0));
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		
		$this->view(null,$var_array);
	}
	
	public function control_sjb(){
		$c=D_MEDTHOD;	$a=D_FUNC;
        
		$model=T($this->db_name)->order_by(array('s'=>'down','f'=>array($this->key)))->set_global_where(array('fdel'=>0,'pid'=>0,'creatid'=>0));
        
		$model=$this->init_where($model);
		$model=$model->set_where(array('toid'=>0));
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();

		$var_array=array($c=>$data,'page'=>$page);
		$this->view('message_recv',$var_array);
	}
	public function control_closelist(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->order_by(array('s'=>'down','f'=>array($this->key)))->set_global_where(array('fdel'=>1,'pid'=>0));
		$model=$this->init_where($model);
		$model=$model->set_where(array('toid'=>0));
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('message_recv',$var_array);
	}
	public function control_putsjb(){
		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		$model = T($this->db_name)->update(array('creatid'=>0),$where);
		out('移交成功',null,$model);
	}
	public function control_send(){
		$get=get(array('int'=>array('msgid')));
		$data=T($this->db_name)->get_one($get);
		if($_POST){
			$get=get(array('int'=>array('pid'),'string'=>array('title','content','toid','fj')));
			
			if($get['pid']){
			$m=T($this->db_name)->get_one(array('msgid'=>$get['pid']));
			if(!$m)error('信息不存在');
		/*	$d=M('user','am')->name($m['fromid']);
			if(!$d){error('收件人不存在');}*/
			$get['toid']=$m['fromid'];
			$get['title']=$m['title'];
			$get['addtime']=time();
			$get['creatid']=parent::$wrap_admin['adminid'];
			$v=T($this->db_name)->add($get);
				
				
			}else{
				$d=M('user','am')->name($get['toid']);
			if(!$d){error('收件人不存在');}
			$get['toid']=$d['uid'];
			$get['addtime']=time();
			$get['creatid']=parent::$wrap_admin['adminid'];
			$v=T($this->db_name)->add($get);
			}
			
			if($v){
				if($get['pid']){
					T($this->db_name)->update(array('status'=>1),array('msgid'=>$get['pid'],'status'=>0));
				}
            	
				msg('发送成功');
			}else{
              
				msg('发送失败');
			}
		}
		$this->view(null,array('data'=>$data)); 
	}
    
	public function control_show(){
		$c=D_MEDTHOD;	$a=D_FUNC;
        
		$where=get(array('int'=>array($this->key=>1)));
        T($this->db_name)->update(array('flag'=>1),$where);
		/*$model=T($this->db_name)->order_by(array('s'=>'down','f'=>array($this->key)));
        
		$data=$model->get_one($where);
		$model->update(array('flag'=>1),$where);
        
		if(!$data){
			YOut::page404();
		}*/
		$main=T('message')->set_where(array('msgid'=>$where['msgid'],'pid'=>0),'=')->get_one();
      
		if(!$main) $main=T('message')->set_where(array('msgid'=>$where['msgid'],'toid'=>$main['fromid'],'pid'=>0),'=')->get_one();
		if(!$main)error('信息不存在');
		$data=T('message')->join_table(array('t'=>'admins','creatid','adminid'))->get_all(array('pid'=>$where['msgid']));
		T('message')->update(array('flag'=>1),array('msgid'=>$where['msgid']));
		T('message')->update(array('flag'=>1),array('pid'=>$where['msgid']));
		$var_array=array('data'=>$data,'page'=>$page,'main'=>$main);
		$this->view(null,$var_array);
		/*$var_array=array('data'=>$data);
		$this->view(null,$var_array);*/
	}

	public function control_history(){
		$c=D_MEDTHOD;	$a=D_FUNC;
        
		$model=T($this->db_name)->order_by(array('s'=>'down','f'=>array($this->key)))->set_global_where(array('creatid'=>0));
      
		$model=$this->init_where($model);
		$model=$model->set_where(array('fromid'=>0));
        
		$model=$this->init_order($model);
        
		$page=$this->make_page($model);
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
      
		$var_array=array($c=>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	public function control_close(){

		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
        
		$model = T($this->db_name)->update(array('fdel'=>1),$where);
       
		out('关闭成功',null,$model);
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
}
?>
