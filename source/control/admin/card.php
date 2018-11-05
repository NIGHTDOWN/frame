<?php



checktop();
class control extends adminbase
{
    private $db_name = 'card';
    private $key = 'id';
    private $gd = array('type'=>1);
    private $allkey = array(

        'string'=>array('accountname'    =>1,'accountaddress' =>1,'account'        =>'1','accountrealname'=>'1','uid'      ,'zfb'      ),);
    public
    function control_run()
    {
        $c         = D_MEDTHOD;    $a         = D_FUNC;

        $model     = T($this->db_name);
        $model     = $this->init_where($model);
        $model     = $this->init_order($model);
        $page      = $this->make_page($model);
        $data      = $model->set_limit($this->get_page_limit())->get_all();
        $var_array = array($c    =>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
    public
    function control_save()
    {
        $where = get(array('int'=>array($this->key=>1)));
        $insert = get($this->allkey);
        unset($insert['uid']);
        $mod_attr = T($this->db_name);

        $id       = $mod_attr->update($insert,$where);
        if ($id) {
            out('修改成功');

        }else {
            out('修改失败',null,0);
        }
    }
    public
    function control_del()
    {

        $w = array($this->key=> 1);
        $where = G(array('array'=> $w))->get();
   

        if (sizeof($where) == 0) {
            $where = G(array('int'=> $w))->get();
        }
     
        $model = T($this->db_name)->del($where);
        M('log','am')->log($model, $where);
        out('删除成功',null,$model);
    }
  
}
?>
