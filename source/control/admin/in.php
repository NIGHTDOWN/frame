<?php





checktop();

class control extends adminbase
{
	private $db = 'in';
    private $key= 'iid';

	public function control_run()
	{
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db)->join_table(array('t'=>'user','uid','uid'));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        $total=T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>0,'alloc'=>1))->get_one();
        $total=intval($total['count']);
        $queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>0,'alloc' =>0))->get_one();
        $queue = intval($queue['count']);
	    $var_array=array($c=>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
        $this->view(null,$var_array);
    }
public function control_waitalloc()
	{
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_global_where(array('alloc'=>array(0,1),'status'=>array(0,3,4),))->order_by(array('f'=>array('addtime')));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        $total=T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>array(0,3,4),'alloc'=>1))->get_one();
        $total=intval($total['count']);
        $queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('alloc'=>array(0,1),'status'=>array(0,3,4)))->get_one();
        $queue = intval($queue['count']);
	    $var_array=array($c=>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
        $this->view('in_index',$var_array);
    }
  public function control_alloc()
	{
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_global_where(array('alloc'=>2,'status'=>array(0,3,4)));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        $total=T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>array(0,3,4),'alloc'=>2))->get_one();
        $total=intval($total['count']);
        $queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('alloc' =>2,'status'=>array(0,3,4)))->get_one();
        $queue = intval($queue['count']);
	    $var_array=array($c=>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
        $this->view('in_index',$var_array);
    }
  public function control_end()
	{
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_global_where(array('status'=>1));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        $total=T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>0,'alloc'=>1))->get_one();
        $total=intval($total['count']);
        $queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>1))->get_one();
        $queue = intval($queue['count']);
	    $var_array=array($c=>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
        $this->view('in_index',$var_array);
    }
  public function control_over()
	{
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_global_where(array('status'=>2));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
        $model = M('log','am')->log(1);
        $total=T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>0,'alloc'=>1))->get_one();
        $total=intval($total['count']);
        $queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>2))->get_one();
        $queue = intval($queue['count']);
	    $var_array=array($c=>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
        $this->view('in_index',$var_array);
    }


}

?>
