<?php




checktop();
class control extends adminbase{
	private $db = 'out';
	private $key = 'oid';

	public function control_run(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->order_by(array('f'=>array('oid'),'s'=>'down'));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$model = M('log','am')->log(1);
        
      
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>0,'alloc' =>0))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view(null,$var_array);
	}
	public function control_ypd(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_global_where(array('waiting'=>0))->order_by(array('f'=>array('waitingmp','addtime'),'s'=>array('down','up')));

		$model = $this->init_where($model);

		$model = $this->init_order($model);
		
		$page  = $this->make_page($model);

		$data  = $model->set_limit($this->get_page_limit())->get_all();

		$model = M('log','am')->log(1);
       
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>0,'alloc' =>0,'waiting'=>0))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view('out_index',$var_array);
	}
	public function control_alloc(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->order_by(array('f'=>array('waitingmp','starttime','addtime')))->set_global_where(array('alloc'=>2,'status'=>array(0,3,4)));

		$model = $this->init_where($model);

		$model = $this->init_order($model);

		$page  = $this->make_page($model);

		$data  = $model->set_limit($this->get_page_limit())->get_all();

		$model = M('log','am')->log(1);
		$total = T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>array(0,3,4),'alloc' =>1))->get_one();
		$total     = intval($total['count']);
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('alloc' =>2,'status'=>array(0,3,4)))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view('out_index',$var_array);
	}
	public function control_waitalloc(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->order_by(array('f'=>array('starttime','addtime')))->set_global_where(array('waiting'=>1,'status'=>array(0,3,4),'alloc'=>array(0,1)));
		$model = $this->init_where($model);

		$model = $this->init_order($model);

		$page  = $this->make_page($model);

		$data  = $model->set_limit($this->get_page_limit())->get_all();

		$model = M('log','am')->log(1);
     
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('waiting'=>1,'status'=>array(0,3,4),'alloc'=>array(0,1)))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view('out_index',$var_array);
	}
	public function control_over(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->order_by(array('f'=>array('waitingmp','starttime','addtime')))->set_global_where(array('status'=>2));

		$model = $this->init_where($model);

		$model = $this->init_order($model);

		$page  = $this->make_page($model);

		$data  = $model->set_limit($this->get_page_limit())->get_all();

		$model = M('log','am')->log(1);
		$total = T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>0,'alloc' =>1))->get_one();
		$total     = intval($total['count']);
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>2))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view('out_index',$var_array);
	}
	public function control_end(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'))->order_by(array('f'=>array('waitingmp','starttime','addtime')))->set_global_where(array('status'=>1));

		$model = $this->init_where($model);

		$model = $this->init_order($model);

		$page  = $this->make_page($model);

		$data  = $model->set_limit($this->get_page_limit())->get_all();

		$model = M('log','am')->log(1);
		$total = T($this->db)->set_field('sum(allocmoney) as count',0)->set_where(array('status'=>0,'alloc' =>1))->get_one();
		$total     = intval($total['count']);
		$queue=T($this->db)->set_field('sum(cash) as count',0)->set_where(array('status'=>1))->get_one();
		$queue = intval($queue['count']);
		$var_array = array($c    =>$data,'page'=>$page,'total'=>$total,'queue'=>$queue);
		$this->view('out_index',$var_array);
	}
	public function control_cgtime(){
		$w = get(array('int'=>array('oid'=>1)));
		$data = T('out')->get_one($w);
		if($_POST && $data){
			$time = get(array('string'=>array('addtime'=>'time')));
			if($w['oid']){
				$time=array('starttime'=>$time['addtime']);
				$flag = T('out')->update($time,$w);
			}
			M('log','am')->log($flag,$time,$w);
			if($flag){
				out("修改成功");
			}else{
				error("修改失败");
			}
		}

		$this->view(null,array('data'=>$data));
	}
	public function control_cgcash(){
		$w = get(array('int'=>array('oid'=>1)));
		$data = T('out')->get_one($w);
		if($data['alloc']!=0){
			error('订单已经分配或者在分配中；无法修改金额');
		}
		if($_POST && $data){
			$time = get(array('string'=>array('cash'=>'1')));
			if($w['oid']){
				$flag = T('out')->update($time,$w);
			}
			M('log','am')->log($flag,$time,$w);
            
			if($flag){
				out("修改成功",geturl());
			}else{
				error("修改失败");
			}
		}
		$this->view(null,array('data'=>$data));
	}
	public function control_del(){
		$w = get(array('int'=>array('oid'=>1)));
		$data = T('out')->get_one($w);
		if($data['alloc']!=0){
			error("已经匹配的订单不能删除");
		}
		$info=T('out')->get_one($w);
		if($info){
			T('wallet')->del(array('fromlid'=>$info['lid']));
			$flag=T('out')->del($w);
		}
	
		if($flag){
			out("删除成功");
		}else{
			error("删除失败");
		}

       
	}
	public function control_cgwait(){
		$w = get(array('array'=>array('oid'=>1)));
		$model= T('out');
		$w['waiting']=0;
		$insert=array('waiting'=>1,'starttime'=>$_SERVER['REQUEST_TIME']);
		$obj=M('mfl','am');
		if(is_array($w['oid']) && sizeof($w['oid'])>0){
		 	
		 	
			foreach($w['oid'] as $id){
				$obj->start($id);
			}

		}elseif(!is_array($w['oid']) && sizeof($w['oid'])>0){
			$obj->start($w['oid']);
		 
		}else{
			error("转换失败");
		}
		
		out("转换成功");
	}
    
    

}

?>
