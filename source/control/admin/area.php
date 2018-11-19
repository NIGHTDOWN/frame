<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();
class area extends adminbase
{
  
    public function control_run()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('area')->join_table(array('t'=>'city','fatherID','cityID'));
        
        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();

	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
       
       
       
    }
	public function control_addarea()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('area');
        
       if($_POST){
	   	$f=$insert=get(array('string'=>array('fatherID'=>1,'orders','flag','area')));
	   $model->add($insert);
	   if($f)out('添加成功');
	   error('添加失败');
	   }
        $this->view('area_editarea',$var_array);
       
    }
      public function control_delarea()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
         $model=T('area');
	   	$f=$insert=get(array('int'=>array('areaID'=>1)));
	   $model->del($insert);
	   if($f)out('删除成功');
	   error('删除失败');
	 
       
       
    }
     public function control_editarea()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('area');
        $where=get(array('int'=>array('areaID')));
        
       if($_POST){
	   		$f=$insert=get(array('string'=>array('fatherID'=>1,'orders','flag','area')));
	   $model->update($insert,$where);
	   if($f)out('修改成功');
	   error('修改失败');
	   }else{
	   	$info=$model->get_one($where);
	   
	   	 if(!$info){
		 	error('城市ID丢失');
		 }
	   }
       $this->view(null,$info);
       
    }
     public function control_city()                                                                                                       
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('city')->join_table(array('t'=>'province','fatherID','provinceID'));
        
        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();

	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
	public function control_addcity()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('city');
        
       if($_POST){
	   	$f=$insert=get(array('string'=>array('fatherID'=>1,'orders','flag','city')));
	   $model->add($insert);
	   if($f)out('添加成功');
	   error('添加失败');
	   }
        $this->view('area_editcity',$var_array);
       
    }
      public function control_delcity()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
         $model=T('city');
	   	$f=$insert=get(array('int'=>array('cityID'=>1)));
	   $model->del($insert);
	   if($f)out('删除成功');
	   error('删除失败');
	 
       
       
    }
     public function control_editcity()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('city');
        $where=get(array('int'=>array('cityID')));
        
       if($_POST){
	   		$f=$insert=get(array('string'=>array('fatherID'=>1,'orders','flag','city')));
	   $model->update($insert,$where);
	   if($f)out('修改成功');
	   error('修改失败');
	   }else{
	   	$info=$model->get_one($where);
	   	 if(!$info){
		 	error('省份ID丢失');
		 }
	   }
       $this->view(null,$info);
       
    }
     public function control_province()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('province');
        
        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();

	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
       
    }
     public function control_addprovince()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('province');
        
       if($_POST){
	   	$f=$insert=get(array('string'=>array('province'=>1,'orders','flag')));
	   $model->add($insert);
	   if($f)out('添加成功');
	   error('添加失败');
	   }
        $this->view(null,$var_array);
       
    }
      public function control_delprovince()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
         $model=T('province');
	   	$f=$insert=get(array('int'=>array('provinceID'=>1)));
	   $model->del($insert);
	   if($f)out('删除成功');
	   error('删除失败');
	 
       
       
    }
     public function control_editprovince()
    {
    	 $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T('province');
        $where=get(array('int'=>array('provinceID')));
        
       if($_POST){
	   	$f=$insert=get(array('string'=>array('province'=>1,'orders','flag')));
	   $model->update($insert,$where);
	   if($f)out('修改成功');
	   error('修改失败');
	   }else{
	   	$info=$model->get_one($where);
	   	 if(!$info){
		 	error('省份ID丢失');
		 }
	   }
       $this->view(null,$info);
       
    }
}

?>
