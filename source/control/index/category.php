<?php



namespace ng169\control\index;
use ng169\control\indexbase;


checktop();

class category extends indexbase
{
	
    public function control_run()
    {
        
        $this->vlog($this->get_userid());

		$data     = T('product_category')->get_all(array('flag'=>0,'depth'=>1));

		

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
      
    }
    public function control_level2()
    {
        
	if(!YUrl::ismoible())error('非法访问');
$get=(get(array('int'=>array('id'=>1)),array('分类ID')));


		$data     = T('product_category')->get_all(array('flag'=>0,'parentid'=>$get['id'],'depth'=>2));

		

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array,null,1);
      
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
