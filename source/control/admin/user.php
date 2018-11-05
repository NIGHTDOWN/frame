<?php



checktop();
class control extends adminbase
{
	private $db_name = 'user';
	private $key = 'uid';
	private $gd = array('type'=>1);
	private $allkey = array(
		'int'              =>array('emailrz','mobilerz','mobile'=>1,'flag'  ,'ulevel' ,'ubad','ugood','ucenter'),
		'string'=>array('username'=>1,'password'=>'md5','nickname','safepwd' =>'md5','email'   ),        );
	private $attr = array(

		'string'=>array(
			'address',
			'wx',
			'qq',
			'gender',
			'provinceid',
			'areaid',
			'cityid',
			'address',
			'headimg',
		),        );
	public
	function control_clearmp()
	{
		T('user')->update(array('mp'=>0),array());
		msg('清空完毕');
	}

	public
	function control_run()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T($this->db_name)->order_by(array('f'=>'uid','s'=>'down'));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	public
	function control_black()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T($this->db_name)->set_global_where(array('flag'=>1));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('user_index',$var_array);
	}
	function control_activity()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T($this->db_name)->set_global_where(array('logtime'=>array($_SERVER['REQUEST_TIME'] - 7 * G_DAY,$_SERVER['REQUEST_TIME'])));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('user_index',$var_array);
	}
	public
	function control_add_view()
	{
		$this->view();
	}
	public
	function control_show()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$where = G(array('int'=>array($this->key=>1)))->get();

		$model = T($this->db_name)->join_table(array('t'=>'user_attr','uid','uid'));
		$data = $model->get_one($where);
		if(!$data)
		{
			YOut::page404();
		}

		$var_array = array('data'=>$data);
		$this->view(null,$var_array);
	}
	public
	function control_wiatcheck()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T('user_rz')->join_table(array('t'=>$this->db_name,'uid','uid'))->order_by(array('f'=>'uid','s'=>'down'))->set_field('v.*,username,email,mobile')->set_global_where(array('ckflag'=>1));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	public
	function control_over()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T('user_rz')->join_table(array('t'=>$this->db_name,'uid','uid'))->order_by(array('f'=>'uid','s'=>'down'))->set_field('v.*,username,email,mobile')->set_global_where(array('ckflag'=>3));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('user_wiatcheck',$var_array);
	}
	public
	function control_close()
	{
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$model = T('user_rz')->join_table(array('t'=>$this->db_name,'uid','uid'))->order_by(array('f'=>'uid','s'=>'down'))->set_field('v.*,username,email,mobile')->set_global_where(array('ckflag'=>2));
		$model     = $this->init_where($model);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('user_wiatcheck',$var_array);
	}
	public
	function control_checkinfo()
	{
		$get = get(array('int'=>array('uid'=>1)));
		$data = T('user_rz')->join_table(array('t'=>$this->db_name,'uid','uid'),1)->join_table(array('t'=>'admins','adminid','adminid'),1)->order_by(array('f'=>'uid','s'=>'down'))->set_field('v.*,username,adminname,user.email,user.mobile')->set_global_where($get)->get_one();
		if(!$data)error('数据不存在');
		if($_POST)
		{
			if($data['ckflag'] != 1)
			{
				error('当前状态已经不能审核');
			}
			$get2 = get(array('int'   =>array('status'=>1),'string'=>array('desc')),array('status'=>'审核状态'));
			switch($get2['status'])
			{
				case 3:
				$in = array('checktime'=>time(),'ckflag'   =>2,'adminid'  =>parent::$wrap_admin['adminid'],'desc'     =>$get2['desc']);

				T('user_rz')->update($in,$get);
				$url = geturl(null,'user_check_0','asyn','admin');
				$array = array('uid'=>$data['uid']);
				YAsyn::start($url,$array);
				out('操作完成');
				//异步发送通知
				break;
				case 2:
				$in = array('checktime'=>time(),'ckflag'   =>3,'adminid'  =>parent::$wrap_admin['adminid'],'desc'     =>$get2['desc']);
				T('user_rz')->update($in,$get);
				$u = array('realname'=>$data['realname'],'userrz'  =>1);
				T('user')->update($u,$get);
				$url = geturl(null,'user_check_1','asyn','admin');
				$array = array('uid'=>$data['uid']);
				YAsyn::start($url,$array);
				out('操作完成');
				break;
				default:error('操作错误');
				break;
			}
		}
		$var_array = array('data'=>$data);
		$this->view(null,$var_array);


	}
	public
	function control_cgpwd()
	{
		$where = G(array('int'=>array($this->key=>1)))->get();
		TPL::assign(array('select'=>$where));
		if($_POST)
		{
			$pw = G(array('string'=>array('password','safepwd')))->get();
			if($pw['password'])$pw['password'] = md5($pw['password']);
			if($pw['safepwd'])$pw['safepwd'] = md5($pw['safepwd']);
			$flag = T($this->db_name)->updata(array('v'=>$pw,'w'=>$where));

			if($flag)
			{
				out('修改成功',geturl(null,'run'));
			}
			else
			{
				out('修改失败',null,0);
			}
		}
		else
		{
			$this->view(null,array('member'=>$where));
		}
	}
	public
	function control_add()
	{
		$insert   = get($this->allkey);
		$mod_attr = T($this->db_name);

		if($mod_attr->check_exist(array('username'=>$insert['username'])) && $insert['username'])
		{
			out('用户名已经被注册',NULL,0);
		}
		if($mod_attr->check_exist(array('mobile'=>$insert['mobile'])) && $insert['mobile'])
		{
			out('手机存在',NULL,0);
		}
		if($mod_attr->check_exist(array('email'=>$insert['email'])) && $insert['email'])
		{
			out('邮箱存在',NULL,0);
		}

		$more = array('regtime'=>time(),'regip'  =>YRequest::getip());

		$insert = array_merge($insert,$more);
		$id     = $mod_attr->add($insert);
		if($id)
		{
			$attr = get($this->attr);
			$attr['uid'] = $id;
			T('user_attr')->add($attr);

			T('user_tree')->add($tree);

			out('添加成功',geturl());
		}
		else
		{
			out('添加失败',null,0);
		}
	}
	public
	function control_save()
	{
		unset($this->allkey['string']['password']);
		unset($this->allkey['string']['safepwd']);
		$where = get(array('int'=>array($this->key=>1)));
		$insert   = get($this->allkey);
		
		$mod_attr = T($this->db_name);



		/*$img = get(array('img'=>array('headimg'=>array(Y::$conf['head_img_size'],0,1))));*/
		/*$insert = array_merge($insert);*/

		$id       = $mod_attr->update($insert,$where);
		$attr     = get($this->attr);
		$attrobj  = T('user_attr');
		$bool     = $attrobj->get_one($where);
		if($bool)
		{
			$attrobj->update($attr,$where);
		}
		else
		{
			$attrobj->add(array_merge($attr,$where));
		}
		out('修改成功',geturl());
		/*if($id){

		$tree = array();

		$treeid = T('user_tree')->set_where(array('uid'=>$insert['gid']))->get_one();

		$isexist = T('user_tree')->set_where(array('uid'=>$where[$this->key]))->get_one();
		if($isexist){

		$treeid = $treeid['treeid']?$treeid['treeid']:$insert['gid'];
		$tree['treeid'] = $treeid.G_BREAK.$where[$this->key];

		$flag = T('user_tree')->update($tree,$where);

		}else{
		$tree = array('uid'=>$where[$this->key]);
		$treeid = $treeid['treeid']?$treeid['treeid']:$insert['gid'];
		$tree['treeid'] = $treeid.G_BREAK.$where[$this->key];

		T('user_tree')->add($tree);
		}


		}else{
		out('修改失败',null,0);
		}*/
	}
	public
	function control_del()
	{

		$w = array($this->key=> 1);
		$where = G(array('array'=> $w))->get();
		$where1 = array_merge($where,array('status'=>0));

		$in = T('in')->get_one($where1);
		if($in)
		{
			error('用户还有未完成的提款订单');
		}
		$in = T('out')->get_one($where1);
		if($in)
		{
			error('用户还有未完成的付款款订单');
		}

		if(sizeof($where) == 0)
		{
			$where = G(array('int'=> $w))->get();
		}
		T($this->db_name)->delfile($where,array('headimg'));
		$model = T($this->db_name)->del($where);
		M('log','am')->log($model, $where);
		out('删除成功',null,$model);
	}
	public
	function control_edit()
	{

		$where = G(array('int'=>array($this->key=>1)))->get();
		$info = T('user')->get_one($where);
		if(!$info)
		{
			error('用户不存在');
		}
		TPL::assign(array('select'=>$info));
		if($_POST)
		{
			$pw = G(array('int'=>array('cash')))->get();
			if($pw['cash'] <= 0)
			{
				error('充值金额错误');
			}
			$flag = M('cash','im')->setuid($info['uid'])->add($pw['cash'],null,'后台管理员充值');

			if($flag)
			{
				out('充值成功',geturl(null,'run'));
			}
			else
			{
				out('充值失败',null,0);
			}
		}
		else
		{
			$this->view(null,array('member'=>$where));
		}
	}
	public function control_excel()
	{


		header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=csat.xls" );
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		</head>
		<body>
		{$_POST['html']}
		</body>
		</html>
		";
	}
	public function control_isexist()
	{
		$uid = get(array('string'=>array('username'=>1)));

		$bool = T('user')->get_one($uid);

		if($bool)
		{
			out('');
		}
		else
		{
			error('不存在');
		}
	}
}
?>
