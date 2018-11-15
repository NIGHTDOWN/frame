<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class pathI  extends Y
{

	private $cname = array('photo_list' => '图库', 'store' => '商家', 'product' => '服务',
		'need' => '需求', 'article' => '资讯', 'index' => '首页','search'=>'搜索','activity'=>'活动');

	private $aname = array('show' => '详情', 'edit' => '编辑', 'add' => '添加', 'del' =>
		'删除', 'run' => '列表','list'=>'列表');
	private $oname = array('');
	public function getc()
	{
		global $c;
		return $this->cname[$c];

	}
	public function geta()
	{
		global $a;
       
		return $this->aname[$a];
	}
	public function geto()
	{
		global $o;
		return $this->cname[$o];
	}

	public function getpath()
	{
      
	}

}

?>
