<?php

namespace ng169\control\admin;

use ng169\control\adminbase;

class singlepage extends adminbase
{
	private $mod = null;
	private $tablename = 'singlepage';
	public function control_run()
	{
		$model = T($this->tablename)->join_table(array('t'=>'singlepage_category','catid','catid'));
		$model=$this->init_where($model);
        $model=$this->init_order($model);
        $page=$this->make_page($model);
        $data= $model->set_limit($this->get_page_limit())->get_all();
	    $var_array=array('singlepage'=>$data,'page'=>$page);
        $this->view(null,$var_array);
	}

	
	public function control_show()
	{
		$get = G(array('int' => array('abid' => 1)))->get();

		$model = T($this->tablename)->get_one($get);
		$var_array = array('singlepage' => $model);
		
	 $this->view(null,$var_array);

	}
	public function control_save()
	{
		if ($_POST)
		{
			
		
			$need = array('content' => 'html', 'drawing', 'flag', 'catid',
				'metadescription', 'metatitle', 'metakeyword', 'title' => 1, 'tplname',
				'orders', 'useurl', 'drawimg', 'drawimg');
			$m = G(array('string' => $need))->get();
			$id = G(array('int' => array('abid')))->get();

			$model = T($this->tablename);


			$id = $model->updata(array('v' => $m, 'w' => $id));

			if ($id)
			{
			
				out('添加成功');
			}
			else
			{
			
				error('添加失败');
			}
		}
		

	}
public function control_add_view()
	{
		
		$this->view();
		
	}
	public function control_add()
	{
		if ($_POST)
		{
			
			$need = array('content' => 'html', 'drawing', 'flag', 'catid',
				'metadescription', 'metatitle', 'metakeyword', 'title' => 1, 'tplname',
				'orders', 'useurl');
			$m = G(array('string' => $need))->get();


			$model = T($this->tablename);

			$m['addtime'] = time();
			$id = $model->add($m);
			if ($id)
			{
				
			out('添加成功');
			}
			else
			{
				
				error('添加失败');
			}
		}
		


	}
	
	public function control_del()
	{

		$w = array('abid' => 1);
		$where = G(array('array' => $w))->get();

		if (sizeof($where) == 0)
		{
			$where = G(array('int' => $w))->get();
		}


		$model = T($this->tablename)->del(array('abid' => $where['abid']));
		
		out('删除成功');
	}

}

?>
