<?php



checktop();
class control extends adminbase
{
    private $db_name = 'friendlink';
    private $key='id';
    private $allkey=array(
     'int'=>array('flag','etime'=>'time','stime'=>'time'),
     'string'=>array('name'=>1,'url'=>1,'img'),
        );
    public function control_run()
    {
    	 
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db_name);
        
        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
       
        
	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
    public function control_add(){
        if($_POST){
			$this->add();
		}
        $this->view(); 
    }
    
    public function control_edit()
    {
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $where=G(array('int'=>array($this->key=>1)))->get();
        if($_POST){
			$this->save();
		}
        $model=T($this->db_name);
        
        $data=$model->get_one($where);
        
        if(!$data){
            YOut::page404();
        }

        $var_array=array($c=>$data);
        $this->view('friendlink_add',$var_array);
    }

    public function add()
    {
        $mod=T($this->db_name);
        $s=G($this->allkey);
       $insert= $s->get();
        $more=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);
        $insert=array_merge($insert,$more);
        $flag=$mod->add($insert);

        if($flag){
            out('添加成功');
        }else{
            out('添加失败',null,0);
        }
    }

    public function save()
    {
        
        $mod=T($this->db_name);
        $s=G($this->allkey);
        $insert= $s->get();
       /* $more=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);*/
       /* $insert=array_merge($insert,$more);*/
        $where=G(array('int'=>array($this->key=>1)))->get();
        $flag=$mod->update($insert,$where);
     
        
        
        if($flag){
            out('保存成功');
        }else{
            out('保存失败',null,0);
        }

    }
    public function control_del()
    {

        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }

   /*     T($this->db_name)->delfile($where,array('drawimg','thumbimg'));*/
        $model = T($this->db_name)->del($where);
     
        out('删除成功',null,$model);
    }   
    
}
?>
