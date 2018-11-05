<?php





checktop();

class control extends adminbase
{
 

    public function control_run()
    {
   $data=T('payapi')->get_all();
   $var_array=array('data'=>$data);
        $this->view(null, $var_array);
    }
  public function control_edit()
    {
    	$get=get(array('int'=>array('apiid'=>1)));
 	  	$data=T('payapi')->get_one($get);
 	  	if(!$data)error('接口不存在');
 	  	
   		$var_array=array('data'=>$data);
   		if($data['apiid']==2){
			$this->view('pay2', $var_array);
		}else{
			$this->view(null, $var_array);
		}
        
    }
 public function control_save()
    {
    	$get=get(array('int'=>array('apiid'=>1,'flag'),'string'=>array('api_key'=>1,'api_name'=>1,'public_key')));
    	$where=array('apiid'=>$get['apiid']);
 	  	$data=T('payapi')->get_one($where);
 	  	if(!$data)error('接口不存在');
 	  	T('payapi')->update($get,$where);
   		/*$var_array=array('data'=>$data);
        $this->view(null, $var_array);*/
        out('保存成功');
    }

}

?>
