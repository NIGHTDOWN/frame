<?php


namespace ng169\control\index;
use ng169\control\indexbase;



checktop();

class article extends indexbase
{
	private $db_name='article';
    public function control_run()
    {
       
		$c         = D_MEDTHOD;    $a         = D_FUNC;
        $this->vlog($this->get_userid());
		$model     = T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'));

		$model     = $this->init_where($model);

		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
      
    }
   
     public function control_show()
    {

        $c=D_MEDTHOD;	$a=D_FUNC;
        $this->vlog($this->get_userid());
        $where=G(array('int'=>array('articleid'=>1)))->get();
        
        $model=T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'),1)->join_table(array('t'=>'area','cityid','areaid'),1);
        
        $data=$model->get_one($where);
        
        if(!$data){
            YOut::page404();
        }
  
        $var_array=array('data'=>$data);
        $this->view(null,$var_array);
      
    }
}
?>
