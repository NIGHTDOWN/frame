<?php





checktop();
class control extends shopbase{
	private $db_name = 'product';
	private $key = 'productid';
	 public function control_del()
    {

        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }

      /*  T($this->db_name)->delfile($where,array('drawimg','thumbimg'));*/
        $model = T($this->db_name)->update(array('status'=>1),$where);
        M('mcount','im')->delprocount($this->get_muid());
       /* M('log','am')->log($model, $where);*/
        out('删除成功',null,$model);
    }  
public function control_addspecs(){
	$name=get(array('string'=>array('name'=>1,'catid'=>1)),array('name'=>'规格名称','catid'=>'分类ID'));
	$data=M('pcate','im')->addspec($this->get_muid(),$name['catid'],$name['name']);
	out($data);
} 
	public
	function control_add(){
		
		$this->view(null, $var_array);
	}
	public
	function control_upshelves(){
		$get=get(array('int'=>array($this->key=>1)));
		$get['muid']=$this->get_muid();
		$get['shelves']=0;
		$data=T($this->db_name)->get_one($get);
		if($data){
			T($this->db_name)->update(array('shelves'=>1),$get);
			out('上架成功');
		}else{
			error('上架失败');
		}
		
	}
	public
	function control_downshelves(){
		$get=get(array('int'=>array($this->key=>1)));
		$get['muid']=$this->get_muid();
		$get['shelves']=1;
		$data=T($this->db_name)->get_one($get);
		if($data){
			T($this->db_name)->update(array('shelves'=>0),$get);
			out('下架成功');
		}else{
			error('下架失败');
		}
		
	}
	public
	function control_upmelite(){
		$get=get(array('int'=>array($this->key=>1)));
		$get['muid']=$this->get_muid();
		$get['melite']=0;
		$data=T($this->db_name)->get_one($get);
		if($data){
			T($this->db_name)->update(array('melite'=>1),$get);
			out('更新成功');
		}else{
			error('更新失败');
		}
		
	}
	public
	function control_downmelite(){
		$get=get(array('int'=>array($this->key=>1)));
		$get['muid']=$this->get_muid();
		$get['melite']=1;
		$data=T($this->db_name)->get_one($get);
		if($data){
			T($this->db_name)->update(array('melite'=>0),$get);
			out('更新成功');
		}else{
			error('更新失败');
		}
		
	}
	public
	function control_cgcate(){
		$get=get(array('int'=>array('pid'=>1)));
		$where=array($this->key=>$get['pid'],'muid'=>$this->get_muid());
		$info=T($this->db_name)->join_table(array('t'=>'product_category','catid','catid'))->get_one($where);
		if(!$info)YOut::page404();
		if($info['pflag']==2){
			error('商品不可编辑');
		}
		if($_POST){
			$get=get(array('int'=>array('catid'=>1)));
			
			if($get['catid']!=$info['catid']){
				
				$get['pflag']=0;
				T($this->db_name)->update($get,$where);
				T($this->db_name.'_attribute')->del(array($this->key=>$info[$this->key]));
				T($this->db_name.'_specs')->del(array($this->key=>$info[$this->key]));
			}
			
			gourl(geturl(array('pid'=>$info[$this->key]),'edit'));
		}
		$var_array=array('data'=>$info);
		$this->view('product_add', $var_array);
	}
	public
	function control_sell(){
		/*$c         = D_MEDTHOD;    $a         = D_FUNC;*/

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'muid'=>$this->get_muid(),'pflag'=>1,'shelves'=>1))->order_by(array('s'=>'down','f'=>'productid'));

		$model     = $this->init_where($model);

		$page      = $this->make_page($model);
		$model->order_by(array('f'=>'productid','s'=>'down'));


		
		
		
		$data      = $model->set_field('*')->set_limit($this->get_page_limit())->get_all();
		
		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
	
	}
	public
	function control_depot(){
		/*$c         = D_MEDTHOD;    $a         = D_FUNC;*/

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'muid'=>$this->get_muid(),'pflag'=>1,'shelves'=>0));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);
		$model->order_by(array('f'=>'productid','s'=>'down'));


		
		
		
		$data      = $model->set_field('*')->set_limit($this->get_page_limit())->get_all();
		
		$var_array = array('data'  =>$data,'page'=>$page);
		/*$this->view(null,$var_array);*/
		$this->view('product_sell',$var_array);
	
	}
public
	function control_Illegal(){
		/*$c         = D_MEDTHOD;    $a         = D_FUNC;*/

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'muid'=>$this->get_muid(),'pflag'=>array(2,3)));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);
		$model->order_by(array('f'=>'productid','s'=>'down'));


		
		
		
		$data      = $model->set_field('*')->set_limit($this->get_page_limit())->get_all();
		
		$var_array = array('data'  =>$data,'page'=>$page);
		/*$this->view(null,$var_array);*/
		$this->view('product_sell',$var_array);
	}
	public
	function control_waitcheck(){
		/*$c         = D_MEDTHOD;    $a         = D_FUNC;*/

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'muid'=>$this->get_muid(),'pflag'=>0));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);
		$model->order_by(array('f'=>'productid','s'=>'down'));


		
		
		
		$data      = $model->set_field('*')->set_limit($this->get_page_limit())->get_all();
		
		$var_array = array('data'  =>$data,'page'=>$page);
		/*$this->view(null,$var_array);*/
		$this->view('product_sell',$var_array);
	
	}
	public
	function control_ck(){
		
		$this->view(null, $var_array);
	}
	
	public
	function control_weigui(){
		
		$this->view(null, $var_array);
	}
	public function control_edit(){
		$get=get(array('int'=>array('pid'=>1)));
		
		$where['productid']=$get['pid'];
		$mod    = T('merchant');
		$where1['muid']=$this->get_muid();
		$where1['productid']=$get['pid'];
		$info=T('product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->get_one($where1);
		
		if(!$info)error('数据不存在');
		if($info['pflag']==2){
			error('商品不可编辑');
		}
		if(!$_POST){
			
			$this->view('',array('data'=>$info,'pid'=>$info['productid'],'cat'=>$info));
			die();
		}

		$insert=get(array('string'=>array('productname'=>1,'content'=>'html','smallimg1'=>1,'unit'=>1,'price'=>1,'smallimg2','smallimg3','smallimg4','smallimg5'),'int'=>array('logistempid'=>1,'weight','cubage','invoice'=>1,'shelves'=>1,'melite'=>1,'count'=>1)));
		
$insert['price']*=100;
		$insert['temptype']    = 1;
		if(parent::$conf['auto_check_pro']){
			$insert['pflag']    = 1;
		}else{
			$insert['pflag']    = 0;
		}
		
		
		$insert['edittime']    = time();
	$insert['productname']=tohex($insert['productname']);
		$flag   = T('product')->update($insert,$where);
	
		if($flag){
			$attribute=get(array('array'=>array('aname','avalue','weights')));
			
			T('product_attribute')->del($where);
			$inatt['productid']=$info['productid'];
			T('product_attr')->del($inatt);
			if(is_array($attribute['aname'])){
					
				
				foreach($attribute['aname'] as $k=>$list){
					if($k<5){
						/*$index='att'.($k+1);*/
						$key=intval($attribute['weights'][$k]);
						
						if($key<=5 && $key>=1){
							$index='att'.$key;
						$inatt[$index]=$attribute['avalue'][$k];
						}
						
					}
					$l=array();
					$l['productid']=$info['productid'];
					$l['aname']=$list;
					$l['avalue']=$attribute['avalue'][$k];
			
					T('product_attribute')->add($l);
				}}
				T('product_attr')->add($inatt);
				
			$attribute=get(array('array'=>array('sname','svalue')));
			T('product_specs')->del($where);
			if(is_array($attribute['sname'])){
				$i=0;
				foreach($attribute['sname'] as $k=>$list){
					
					
					if($i>=6){break;}
					$i++;
					$l=array();
					$l['productid']=$info['productid'];
					$l['sname']=$list;
					$l['svalue']=$attribute['svalue'][$k];
				
					T('product_specs')->add($l);
				}
			}
			
			out('保存成功',geturl(null,'sell','product'));
			/*gourl();*/
		}else{
			error('保存失败',null,0);
		}
	}
public function control_save(){
		$get=get(array('int'=>array('pid'=>1)));
		
		$where['pid']=$get['pid'];
		
		$where1['muid']=$this->get_muid();
		$where1['pid']=$get['pid'];
		$info=T('product_tmp')->get_one($where1);
		
		if(!$info)error('数据不存在');
		
		

		$insert=get(array('string'=>array('productname'=>1,'content'=>'html','smallimg1'=>1,'unit'=>1,'price'=>1,'smallimg2','smallimg3','smallimg4','smallimg5'),'int'=>array('logistempid'=>1,'weight','cubage','invoice'=>1,'shelves'=>1,'melite'=>1,'count'=>1)));
		
$insert['price']*=100;
		$insert['temptype']    = 1;
		if(parent::$conf['auto_check_pro']){
			$insert['pflag']    = 1;
		}else{
			$insert['pflag']    = 0;
		}
		
		
		$insert['addtime']    = time();
		$insert['muid']    = $info['muid'];
		$insert['catid']    = $info['catid'];
	$insert['productname']=tohex($insert['productname']);
		$flag   = T('product')->add($insert);
	
		if($flag){
			$attribute=get(array('array'=>array('aname','avalue','weights')));
			/*T('product_attribute')->del($where);*/
			if(is_array($attribute['aname'])){
					
				
				foreach($attribute['aname'] as $k=>$list){
					if($k<5){
						$key=intval($attribute['weights'][$k]);
						if($key<=5 && $key>=1){
							$index='att'.$key;
						$inatt[$index]=$attribute['avalue'][$k];
						}
						/*$index='att'.($attribute[$k]['weights']);
						$inatt[$index]=$attribute['avalue'][$k];*/
					}
					$l=array();
					$l['productid']=$flag;
					$l['aname']=$list;
					$l['avalue']=$attribute['avalue'][$k];
					T('product_attribute')->add($l);
				}}
				$inatt['productid']=$flag;
				T('product_attr')->add($inatt);
				
			$attribute=get(array('array'=>array('sname','svalue')));
			/*T('product_specs')->del($where);*/
			if(is_array($attribute['sname'])){
				$i=0;
				foreach($attribute['sname'] as $k=>$list){
					
					if($i>=6){break;}
					$i++;
					$l=array();
					$l['productid']=$flag;
					$l['sname']=$list;
					$l['svalue']=$attribute['svalue'][$k];
				
					T('product_specs')->add($l);
				}
			}
			
			M('mcount','im')->addprocount($this->get_muid());
			out('添加成功',geturl(null,'sell','product'));
			/*gourl();*/
		}else{
			error('添加失败',null,0);
		}
	}
	public
	function control_addtemp(){
		$productcount=M('mcount','im')->getprocount($this->get_muid());
		$type=(parent::$wrap_merchant['rzflag']);
		switch($type){
			case 0:error('店铺未认证');break;
			case 1:
			$num=parent::$conf['yh_shop_pro_num'];
			if($productcount>$num){
				error('个人商户只能发布'.$num.'个商品');
			}
			
			break;
			case 2:
			$num=parent::$conf['qy_shop_pro_num'];
			if($productcount>$num){
				error('个人商户只能发布'.$num.'个商品');
			};break;
		}
		$get=get(array('int'=>array('catid'=>1)));
		$cat=T('product_category')->get_one(array('flag'=>0,'catid'=>$get['catid']));
		if(!$cat)error('分类不存在');
		$pid=T('product_tmp')->add(array('catid'=>$cat['catid'],'muid'=>$this->get_muid()));
		$var_array=array('cat'=>$cat,'pid'=>$pid);
		$this->view(null, $var_array);
	}
	public
	function control_cate(){
		$where=get(array('int'=>array('catid'=>1,'depth'=>1)));
		$int=array('flag'=>0,'parentid'=>$where['catid'],'depth'=>$where['depth']+1);
		$list=T('product_category')->get_all($int);
		out($list);
	}
	public
	function control_searchcate(){
		
		$where=get(array('string'=>array('catname'=>1)));
		$where['flag']=0;
		/*$int=array('parentid'=>$where['catid'],'depth'=>$where['depth']+1);*/
		$list=T('product_category')->get_all($where);
		out($list);
	}
}
?>
