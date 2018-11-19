<?php


namespace ng169\control\admin;

use ng169\control\adminbase;
checktop();

class template extends adminbase
{
    private $mod = null;
    private $tablename = 'template';
    public function control_run()
    {
         $c=D_MEDTHOD;
        $model = T($this->tablename)->set_global_where(array('type'=>0));

        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
       
        
        
	    $var_array=array($c=>$data,'page'=>$page);
       
        $this->view(null,$var_array);
       
    }
public function control_mail()
    {
        $c=D_MEDTHOD;
        $model = T($this->tablename)->set_global_where(array('type'=>1));

        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
       
        
        
	    $var_array=array($c=>$data,'page'=>$page);
       
        $this->view('template_index',$var_array);
       
    }
    
    public function control_show()
    {
       $c=D_MEDTHOD;
        $get = G(array('int' => array('tmpid' => 1)))->get();


        $data = T($this->tablename)->get_one($get);
     
        $var_array=array($c=>$data);
        $this->view(null,$var_array);
  

    }
    public function control_save()
    {
        if ($_POST) {
            
            $need = array(
                'orders',
                'flag' => 1,
                'title' => 1,
                'content'=>1);
            $m = G(array('string' => $need))->get();
            $id = G(array('int' => array('tmpid'=>1)))->get();
            $model = T($this->tablename);
            $flag = $model->updata(array('v' => $m, 'w' => $id));
            M('log','am')->log($flag,$id,$m);
            if ($flag) {
                
                out('添加成功',geturl(null,'run'),1);
            } else {
                out('添加失败',null,0);
            }
        }
        

    }
    
   
}

?>
