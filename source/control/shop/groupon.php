<?php



namespace ng169\control\shop;

use ng169\control\shopbase;

checktop();
class groupon extends shopbase
{
	private $db_name = 'groupon';
	public function control_box()
	{


		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T('product')->set_global_where(array('temptype'=>1,'status'  =>0,'shelves' =>1,'pflag'   =>1,'muid'    =>$this->get_muid(1)));

		$model     = $this->init_where($model);

		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}

	public
	function control_run()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T('groupon')->join_table(array('t'=>'product','pid','productid'));
		$model = $this->init_where($model);
		$where['gflag'] = 1;
		$where['gmuid'] = $this->get_muid(1);
		$model = $model->set_where(array('muid'=>$this->get_muid(1)))->set_where($where);

		$model = $model->order_by(array('f'=>'gpid','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'=>$data,'page'=>$page);
		$this->view(null,$var_array);
		die();







		$where['shelves'] = 1;
		$where['status'] = 0;
		$where['pflag'] = 1;
		$where['gcheck'] = 1;

		$where['muid'] = $this->get_muid(1);
		$get = get(array('string'=>array('word'),'int'   =>array('price1','price2')));
		if($get['word'])
		{
			$where['productname'] = $get['word'];
		}
		if($get['price1'])
		{
			$where['price'] = array($get['price1']);
		}
		if($get['price2'])
		{
			$where['price'] = array('1'=>$get['price2']);
		}





		$model = T('groupon')->join_table(array('t'=>'product','pid','productid'))->order_by(array('f'=>'product.productid','s'=>'down'))->set_global_where($where)->join_table(array('t'=>'product_attribute','product.productid','productid'),1);





		////////////////////
		$nsql = $model->get_sql();
		$sql  = preg_replace("/select([\s\S]*?)from/is", "select count(DISTINCT v.pid) as num from", $nsql);

		$num  = T('product')->dosql($sql);

		$num  = sizeof($num);
		$agrs = $_GET;
		unset($agrs['page']);
		$a   = D_FUNC;
		$url = geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total'] = $num;
		$pagearray['szie'] = $pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum'] = $this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, $maxpage);

		$model= $this->init_order($model);
		//////////////////////
		$data = $model->set_limit($this->get_page_limit())->get_all();

		$where2['word'] = $get['word'];
		$where2['price1'] = $get['price1'];
		$where2['price2'] = $get['price2'];



		$this->view(null,array('data'       =>$data,'page'       =>$page,'where'      =>$where2,'by'         =>$by,'attribute'  =>$attribute,'wherestring'=>$wstring,'attrwhere'  =>$attrwhere,'hot'        =>$hot));

	}
	public
	function control_waitcheck()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T('groupon')->join_table(array('t'=>'product','pid','productid'));
		$model = $this->init_where($model);
		$where['gflag'] = 0;
		$where['gmuid'] = $this->get_muid(1);
		$model = $model->set_where($where);

		$model = $model->order_by(array('f'=>'gpid','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'=>$data,'page'=>$page);
		$this->view('groupon_index',$var_array);
		die();

		$where['shelves'] = 1;
		$where['status'] = 0;
		$where['pflag'] = 1;

		$where['muid'] = $this->get_muid(1);
		$get = get(array('string'=>array('word'),'int'   =>array('price1','price2')));
		if($get['word'])
		{
			$where['productname'] = $get['word'];
		}
		if($get['price1'])
		{
			$where['price'] = array($get['price1']);
		}
		if($get['price2'])
		{
			$where['price'] = array('1'=>$get['price2']);
		}





		$model = T('groupon')->join_table(array('t'=>'product','pid','productid'))->order_by(array('f'=>'product.productid','s'=>'down'))->set_global_where($where)->join_table(array('t'=>'product_attribute','product.productid','productid'),1)->set_where(array('gcheck'=>1),'!=');

		$nsql = $model->get_sql();
		$sql  = preg_replace("/select([\s\S]*?)from/is", "select count(DISTINCT v.pid) as num from", $nsql);

		$num  = T('product')->dosql($sql);

		$num  = sizeof($num);
		$agrs = $_GET;
		unset($agrs['page']);
		$a   = D_FUNC;
		$url = geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total'] = $num;
		$pagearray['szie'] = $pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum'] = $this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, $maxpage);

		$model= $this->init_order($model);
		//////////////////////
		$data = $model->set_limit($this->get_page_limit())->get_all();

		$where2['word'] = $get['word'];
		$where2['price1'] = $get['price1'];
		$where2['price2'] = $get['price2'];



		$this->view('groupon_index',array('data'       =>$data,'page'       =>$page,'where'      =>$where2,'by'         =>$by,'attribute'  =>$attribute,'wherestring'=>$wstring,'attrwhere'  =>$attrwhere,'hot'        =>$hot));

	}
	public function control_del()
	{


		$w = array('gpid'=> 1);

		$where = G(array('array'=> $w))->get();

		$where['gmuid'] = $this->get_muid(1);

		$model = T('groupon')->del($where);

		out('删除成功',null,$model);
	}
	public function control_add()
	{
		$where = get(array('int'=>array('gpid')));
		$data = T($this->db_name)->get_one($where);
		if(!$_POST)
		{
			$this->view(null,array('select'=>$where));
			die();
		}

		$insert = get(array('string'=>array('gtitle'=>1,'gimg'  =>1,'gprice'=>1,'gstime'=>'time','getime'=>'time'),'int'   =>array('pid'=>1)));
		$pro = T('product')->set_global_where(array('temptype' =>1,'status'   =>0,'shelves'  =>1,'pflag'    =>1,'muid'     =>$this->get_muid(1),'productid'=>$insert['pid']))->get_one();
		if(!$pro)error('商品不存在');
		if($insert['gprice'] >= $pro['price'])
		{
			error('团购商品价格必须小于原商品价格');
		}
		if($insert['getime'] <= $insert['gstime'] )
		{
			error('团购结束时间不能小于团购开始时间');
		}
		if($insert['gstime'] <= time())
		{
			error('团购开始时间不能小于当前时间');
		}
		$insert['gaddtime'] = time();
		$insert['gmuid'] = $this->get_muid(1);


		if(!$where['gpid'])
		{
			$is = T($this->db_name)->get_one(array('pid'   =>$insert['pid'],'gcheck'=>array(0,1)));
			if($is)
			{
				error('当前商品已经存在团购');
			}
			T($this->db_name)->add($insert);
			out('添加成功');
		}
		else
		{


			T($this->db_name)->update($insert,$where);
			out('修改成功');
		}
	}
	public function control_edit()
	{
		$where = get(array('int'=>array('gpid'=>1)));

		$where['muid'] = $this->get_muid(1);
		$data = T($this->db_name)->join_table(array('t'=>'product','pid','productid'))->set_where($where,'=')->get_one();

		if($data)
		{
			$this->view('groupon_add',array('data'=>$data));

		}
		else
		{
			error('数据不存在');
		}
	}
}
?>
