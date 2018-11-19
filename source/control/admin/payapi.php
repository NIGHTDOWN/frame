<?php


namespace ng169\control\admin;

use ng169\control\adminbase;


checktop();

class payapi extends adminbase
{
 public function control_run()
  {
        $data=T('payapi')->get_all();
        $var_array=array('data'=>$data);
        $this->view(null, $var_array);
    }
 public function control_set(){
 	 $this->view(null, $var_array);
 }
 public function control_add(){
 	if($_POST){
		$get=get(array('string'=>array('name'=>1,'logo'=>1)));
		$get['addtime']=time();
		T('payapi')->add($get);
		out('接口添加完毕');
	}
 	$this->view(null, $var_array);
 }

}

?>
