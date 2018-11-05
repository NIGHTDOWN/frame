<?php




checktop();

class control extends adminbase
{
    private $db_name = 'users_log';
    private $key='logid';
    public function control_run()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
      $model=T($this->db_name)->order_by(array('f'=>'logid','s'=>'down'))->join_table(array('t'=>'user','opuser','uid'))->order_by(array('f'=>'logid','s'=>'down'));
           
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        
	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
    public function control_add_view(){
        
        $this->view(); 
    }
    
    public function control_show()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
      
        $where=G(array('int'=>array($this->key=>1)))->get();
        
        $mod=T($this->db_name)->join_table(array('t'=>'user','opuser','uid'));
        
        
        $data=$mod->get_one($where);
        
        if(!$data){
            YOut::page404();
        }
        
        M('log','am')->log($data,$where);
            
        
        
          $var_array=array($c=>$data);
          $this->view(null,$var_array);

    }
 
    public function control_add()
    {
        
        $mod=T($this->db_name);
     
        
      
        
        $allkey=array();
        
        
        
        $flag=$mod->add($insert);
        
        M('log','am')->log($flag,null,$insert);
        
        
        if($flag){
        out('添加成功');
        }else{
        out('添加失败',null,0);}
    }

    public function control_save()
    {
          
        $mod=T($this->db_name);
        
        
        $where=G(array('int'=>array($key=>1)))->get();
       
        
        $allkey=array();
        
        
        
        $flag=$mod->updata(array('v'=>$insert,'w'=>$where));
        
        M('log','am')->log($flag,null,$insert);
        
        
        if($flag){
        out('保存成功');
        }else{
            out('保存失败',null,0);
        }

  }
    public function control_del()
    {
if(parent::$wrap_admin['super']!=1){
	error('无权限操作');
}
        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }


        $model = T($this->db_name)->del($where);
        M('log','am')->log($model, $where);
        out('删除成功',null,$model);
    }   
    public function control_clear()
    {

    if(parent::$wrap_admin['super']!=1){
	error('无权限操作');
}


        $model = T($this->db_name)->del();
        M('log','am')->log($model, $where);
        out('清空成功',null,$model);
    }   
  
}

?>
