<?php




checktop();
class control extends adminbase{
	private $db_name = 'task';
	private $key='taskid';
	private $allkey=array('string'=>array('title'=>1,'desc'=>'html','content'=>'html','num'=>1));
	public function control_run(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->set_global_where(array('flag'=>0))->order_by(array('f'=>'addtime','s'=>'down'));
		$model=$this->init_where($model);
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
  
    
	public function control_show(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$where=G(array('int'=>array($this->key=>1)))->get();
		$model=T($this->db_name);
		$data=$model->get_one($where);
		if(!$data){
			YOut::page404();
		}
		$var_array=array($c=>$data);
		$this->view('task_add',$var_array);
	}
	private function checkuser($username){
		$user=T('user')->set_where(array('flag'=>0,'username'=>$username,'distributor'=>1),'=')->get_one();
  
		if(!$user)error('用户不存在；或者不是经销商');
		$have=T($this->db_name)->set_where(array('uid'=>$user['uid'],'flag'=>array(0,1)),'=')->get_one();
		if($have)error('用户还有未完成的任务');
		return $user['uid'];
	}
	public function control_add(){
		if($_POST){
			$mod=T($this->db_name);
     
			$s=get($this->allkey);
       
			$more=array('addtime'=>time());
			$insert=array_merge($s,$more);
			$flag=$mod->add($insert);
			if($flag){
				out('添加成功',geturl());
			}else{
				error('添加失败',geturl());
			}
		}else{
			$this->view(null,$_GET); 
		}
       
	}

	public function control_save(){
		$url=geturl();
		$mod=T($this->db_name);
		$flag=get(array('string'=>array('title'=>1,'desc'=>'html','content'=>'html','num'=>1)));
		$where=get(array('int'=>array('taskid'=>1)));
		$mod->update($flag,$where);
		if($flag){
			out('保存成功',$url);
		}else{
			error('保存失败',$url);
		}
	}
	public function control_del(){

		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
     
		$model = T($this->db_name)->update(array('flag'=>1),$where);
       
		out('删除成功',null,$model);
	}   
    
}
?>
