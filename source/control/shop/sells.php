<?php





checktop();
class control extends shopbase{
	public
	function control_comment(){
		$get=get(array('string'=>array('ordernum'=>1)));
		gourl(geturl($get,'user','comment','index'));
	}
	public function getlist($where){
		$c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.muid='.$this->get_muid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('muid' => $this->get_muid(1)))->set_global_where(array('sdelflag' => 0));
        if($where){
			$model->set_where($where);
		}
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
            return $var_array;
	}
	public
	function control_run(){	
	$c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.muid='.$this->get_muid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('muid' => $this->get_muid(1)))->set_global_where(array('sdelflag' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
        $this->view(null,
            $var_array);
	}
public
	function control_waitpay(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>0));
	
	    /*$var_array=array('data'=>$data,'page'=>$page);*/
        $this->view('sells_index',$var_array);
	}
public
	function control_waitsend(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>1));
	
	    /*$var_array=array('data'=>$data,'page'=>$page);*/
      
        $this->view('sells_index',$var_array);
	}
public
	function control_waitsure(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>2));
	
	    
      
      
        $this->view('sells_index',$var_array);
	}
	public
	function control_wpj(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>3,'scflag'=>0));
	
	    
      
      
        $this->view('sells_index',$var_array);
	
	}
public
	function control_over(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>3));
	
	    
      
      
        $this->view('sells_index',$var_array);
	}
public
	function control_close(){	
	$var_array=$this->getlist(array('sdelflag'=>0,'status'=>4));
	
	    
      
      
        $this->view('sells_index',$var_array);
	}
public function control_closeorder(){
	$get=get(array('string'=>array('ordernum'=>1)));
	$model=$this->getorder();
	
		
	if($model['status']!=0){
	error('订单已经不能关闭');	
	}
/*$paytotal=get(array('int'=>array('paytotal'=>1)));*/
			$paytotal['status']=4;
			$paytotal['closetype']=2;
			T('order')->update($paytotal,$get);
		/*$url=geturl(null,'user_product_changecash','asyn','admin');
		$array=array('uid'=>$model['uid'],'ordernum'=>$model['ordernum']);
		YAsyn::start($url,$array);*/
			out('订单已经关闭',geturl(null,'run'));
		
}
private function getorder(){
	$get=get(array('string'=>array('ordernum'=>1)));
	$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('user'),'uid','uid'),1)->set_field('productname,v.muid,productid,order_product.ordernum,username,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,scflag,logisfee,smallimg,price,logis,v.realname,v.address,v.mobile,nickname,user.email,sendtime,sender,sendnum')->set_where(array('order_product.muid'=>$this->get_muid()))->set_where(array('productid'=>0),'!=')->set_global_where(array('sdelflag'=>0))->group_by('v.ordernum')->get_one($get); 
		if(!$model)error('订单信息不存在');
	$model['productlist']=T('order_product')->set_field(('v.*,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid'))->join_table(array('t'=>'product','v.productid','productid'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->order_by(array('f'=>'id','s'=>'down'))->get_all($get);	
	return $model;
}
public
	function control_detail(){
		$model=$this->getorder();
		$var_array=array('data'=>$model,'page'=>$page);
        $this->view(null,$var_array);
	}
public function control_changecash(){
	$get=get(array('string'=>array('ordernum'=>1)));
	$model=$this->getorder();
	
		if($_POST){
			if($model['status']!=0){
	error('订单已经不能修改价格');	
	}
$paytotal=get(array('int'=>array('paytotal'=>1)));
			T('order')->update($paytotal,$get);
		$url=geturl(null,'user_product_changecash','asyn','admin');
		$array=array('uid'=>$model['uid'],'ordernum'=>$model['ordernum']);
		YAsyn::start($url,$array);
			out('价格已经更新',geturl($get,'detail'));
		}$var_array=array('data'=>$model,'page'=>$page);
		$this->view('sells_detail',$var_array);
}
public function control_send(){
	$get=get(array('string'=>array('ordernum'=>1)));
	$model=$this->getorder();
	
		if($_POST){
			if($model['status']!=1){
	error('订单已经无法操作');	
	}
		$paytotal=get(array('string'=>array('sender'=>1,'sendnum'=>1)));
		$paytotal['status']=2;
		$paytotal['sendtime']=time();
		$paytotal['autosuretime']=time()+Y::$conf['order_sure_day']*G_DAY;
		T('order')->update($paytotal,$get);
		//通知
		$url=geturl(null,'user_product_send','asyn','admin');
		$array=array('uid'=>$model['uid'],'ordernum'=>$model['ordernum']);
		YAsyn::start($url,$array);
		
		
		out('订单已经更新',geturl($get,'detail'));
		}$var_array=array('data'=>$model,'page'=>$page);
		$this->view('sells_detail',$var_array);
}
public function control_print(){
	$get=get(array('string'=>array('ordernum'=>1)));
	$model=$this->getorder();
	$var_array=array('data'=>$model,'page'=>$page);
	$this->view('',$var_array);
}
public
	function control_suretimeadd(){
		$get=get(array('string'=>array('ordernum'=>1)));
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('user'),'uid','uid'),1)->set_field('productname,v.muid,productid,order_product.ordernum,username,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,scflag,logisfee,smallimg,price,v.realname,v.address,v.mobile,nickname,user.email,sautosure')->set_where(array('order_product.muid'=>$this->get_muid()))->set_where(array('productid'=>0),'!=')->set_global_where(array('sdelflag'=>0))->group_by('v.ordernum')->get_one($get); 
		if(!$model)error('订单信息不存在');
		$up['autosuretime']=$model['autosuretime']+Y::$conf['order_sure_more_day']*G_DAY;
		$up['sautosure']=$up['sautosure']+1;
		T('order')->update($up,$get);
		out('延迟确认时间完成');
	
	
	}
}
?>
