<?php





checktop();

class control extends adminbase
{
  private $all=array('string'=>array('slogo','blogo','name'=>1),'int'=>array('level'=>1));
    public function control_run()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
      	$model=T('ulevel');
        $model=$this->init_where($model);
        $model=$this->init_order($model);
        $page=$this->make_page($model);
        $data= $model->set_limit($this->get_page_limit())->get_all();
	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
     public function control_merchant()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
      	$model=T('mlevel');
        $model=$this->init_where($model);
        $model=$this->init_order($model);
        $page=$this->make_page($model);
        $data= $model->set_limit($this->get_page_limit())->get_all();
	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
       public function control_addmlevel()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
      	if($_POST){
			$insert=get($this->all);
			$insert['addtime']=time();
			$f=T('mlevel')->add($insert);
			out('添加成功');
		}
        $this->view('level_add',$var_array);
    }
    public function control_editmlevel()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        $where=get(array('int'=>array('level'=>1)));
        $info=T('mlevel')->get_one($where);
        if(!$info){
			/*YOut::page404();*/
			error('等级不存在');
		}
      	if($_POST){
			$insert=get($this->all);
			unset($insert['level']);
			$f=T('mlevel')->update($insert,$where);
			out('修改成功');
		}
		$var_array=array('data'=>$info);
        $this->view('level_add',$var_array);
    }
    
    
     public function control_add()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
      	if($_POST){
			$insert=get($this->all);
			$insert['addtime']=time();
			$f=T('ulevel')->add($insert);
			out('添加成功');
		}
        $this->view(null,$var_array);
    }
    public function control_edit()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        $where=get(array('int'=>array('level'=>1)));
        $info=T('ulevel')->get_one($where);
        if(!$info){
			/*YOut::page404();*/
			error('等级不存在');
		}
      	if($_POST){
			$insert=get($this->all);
			unset($insert['level']);
			$f=T('ulevel')->update($insert,$where);
			out('修改成功');
		}
		$var_array=array('data'=>$info);
        $this->view('level_add',$var_array);
    }
  
  
}

?>
