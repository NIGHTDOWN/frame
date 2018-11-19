<?php


namespace ng169\control\admin;

use ng169\control\adminbase;
checktop();
class article extends adminbase
{
    private $db_name = 'article';
    private $key='articleid';
    private $allkey=array(
     'int'=>array('catid','cityid','comments','elite','flag','hits','orders'),
     'string'=>array('title'=>1,'author','comefrom','content'=>3,'metatitle','metadesc','metakeyword','summary','pic'),
    
        );
    public function control_run()
    {
    	 
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'),1)->join_table(array('t'=>'area','cityid','areaid'),1)->order_by(array('f'=>'articleid','s'=>'down'));
        
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
        
        $model=T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'),1)->join_table(array('t'=>'area','cityid','areaid'),1);
        
        $data=$model->get_one($where);
        
        if(!$data){
            YOut::page404();
        }

        
        $var_array=array($c=>$data);
        $this->view(null,$var_array);
    }

    public function control_add()
    {
        
        $mod=T($this->db_name);
        
        
        
        
        $s=G($this->allkey);
       $insert= $s->get();
       $insert['thumbimg']=$s->getattr('drawimg');
        
        $more=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);
      
        $insert=array_merge($insert,$more);
        
        $insert['content']=preg_replace('/\\{2,}/','',$insert['content']);
        $flag=$mod->add($insert);
        
       
        
        
        if($flag){
            out('添加成功');
        }else{
            out('添加失败',null,0);
        }
    }

    public function control_save()
    {
        
        $mod=T($this->db_name);
        
        
        $where=G(array('int'=>array($this->key=>1)))->get();
        
        $s=G($this->allkey);
        $insert= $s->get();
        $insert['thumbimg']=$s->getattr('drawimg');
        
        $more=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);
        $insert=array_merge($insert,$more);
        
        
        $mod->delfile($where,array('drawimg','thumbimg'));
        
        
        $flag=$mod->updata(array('v'=>$insert,'w'=>$where));
        $insert['content']=preg_replace('/\\{2,}/','',$insert['content']);
     
        
        
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

        T($this->db_name)->delfile($where,array('drawimg','thumbimg'));
        $model = T($this->db_name)->del($where);
        M('log','am')->log($model, $where);
        out('删除成功',null,$model);
    }   
    
    public function control_category()
    {
    	 
       /* $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'),1)->join_table(array('t'=>'area','cityid','areaid'),1);
        
        $model=$this->init_where($model);
        
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
       
        
	    $var_array=array($c=>$data,'page'=>$page);
        $this->view(null,$var_array);*/
    gourl(geturl(null,null,'articlecategory'));
    }
    
    
    
    
    
    
    
}
?>
