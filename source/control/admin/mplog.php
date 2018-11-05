<?php




checktop();
class control extends adminbase
{
	private $db= 'mp';
    private $key='logid';
	public function control_run(){
        $mod=T($this->db)->join_table(array('t'=>'user','uid','uid'))->set_field(array('v.*','user.username','user.realname'));
        $mod=$this->init_where($mod);
        $mod=$this->init_order($mod);
        
        $page=$this->make_page($mod);
        
        $data= $mod->set_limit($this->get_page_limit())->get_all();
        
        $mod = M('log','am')->log(1);
        
	    $var_array=array('data'=>$data,'page'=>$page);

        $this->view(null,$var_array);
    }
  
    public function control_del()
    {
        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T($this->db)->del($where);
        M('log','am')->log($model, $where);
        out('删除成功',null,$model);
    }   
    public function control_clear()
    {
        $model = T($this->db)->del();
        M('log','am')->log($model, $where);
        out('清空成功',null,$model);
    }   

}

?>
