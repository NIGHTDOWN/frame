<?php


namespace ng169\control\admin;

use ng169\control\adminbase;


checktop();

class adminlog extends adminbase
{
    private $db_name = 'admins_log';
    private $key='logid';
    public function control_run()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
       $model=T($this->db_name)->join_table(array('t'=>'admins','opuser','adminid'))->set_global_where(array('ip'=>'127.0.0.1'),'!=')->order_by(array('f'=>'logid','s'=>'down'));
       
        $model=$this->init_where($model);
        $model=$this->init_order($model);
        $page=$this->make_page($model);
        $data= $model->set_limit($this->get_page_limit())->get_all();
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
        $mod=T($this->db_name)->join_table(array('t'=>'admins','opuser','adminid'));;
       
        $data=$mod->get_one($where);
        
        if(!$data){
            YOut::page404();
        }
        
       
            
        
        
          $var_array=array($c=>$data);
          $this->view(null,$var_array);

    }
   
    
   
    public function control_add()
    {
        
        $mod=T($this->db_name);
     
        
      
        
        $allkey=array();
        
        
        
        $flag=$mod->add($insert);
        
     
        
        
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
        
     
        
        
        if($flag){
        out('保存成功');
        }else{
            out('保存失败',null,0);
        }

  }
    public function control_del()
    {
	/*	if(parent::$wrap_admin['super']!=1){
			error('无权限操作');
		}*/
        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T($this->db_name)->del($where);
    
        out('删除成功',null,$model);
    }   
    public function control_clear()
    {

 /*   if(parent::$wrap_admin['super']!=1){
	error('无权限操作');
}*/


        $model = T($this->db_name)->del();
    
        out('清空成功',null,$model);
    }   
  
}

?>
