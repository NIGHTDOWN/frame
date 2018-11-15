<?php

namespace ng169\model\index;
use ng169\Y;
checktop();
function getword($name)
{
	global $info;
	return $info[$name[2]];
}
class template extends Y
{
	private $tablename = "template";
	private $info = null;
	
	private function gettemplate($idenfity)
	{
		$table = T($this->tablename);
		$tmp = $table->get_one(array('idenfity' => $idenfity));

		return $tmp;
	}
	

	private function create($tmp, $infoi)
	{


		global $info;
		$info = $infoi;

		if (is_array($tmp))
		{
			$msg['title'] = preg_replace_callback("/(【([^】]+)】)/", "getword", $tmp['title']);
			$msg['content'] = preg_replace_callback("/(【([^】]+)】)/", "getword", $tmp['content']);
		}

		return $msg;
	}
	
	public function getmsg($idenfity, $info)
	{
		$tmp = $this->gettemplate($idenfity);

		$ret = $this->create($tmp, $info); 
		return $ret;
	}
}

?>
