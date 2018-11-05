<?php

checktop();
class control extends userbase
{

    public function control_run()
    {
        $c = D_MEDTHOD;
        $a = D_FUNC;
        M('message', 'im')->getbordcase();
        $model = T('sysmsg');

        $model = $model->set_where(array('uid' => $this->get_userid(1),'udel'=>0));

        $model = $model->order_by(array('f' => 'addtime', 's' => 'down'));

        $page = $this->make_page($model);

        $data = $model->set_limit($this->get_page_limit())->get_all();

        $var_array = array('data' => $data, 'page' => $page);

        $this->view(null, $var_array);
    }
	public function control_del()
    {
		$get=get(array('int'=>array('msgid'=>1)),array('msgid'=>'ID'));
		$get['udel']=0;
		$get['uid']=$this->get_userid();
        $model = T('sysmsg');
		$model->update(array('udel'=>1),$get);
       out('删除成功',geturl(null,null,'message','user'));
	}
	public function control_show()
    {
		$get=get(array('int'=>array('msgid'=>1)),array('msgid'=>'ID'));
		$get['udel']=0;
		$get['uid']=$this->get_userid();
        $data = T('sysmsg')->get_one($get);
        T('sysmsg')->update(array('uread'=>1,'readtime'=>time()),$get);
		if(!$data)error('数据不存在');
		$var_array = array('data' => $data, 'page' => $page);

        $this->view(null, $var_array);
    }
}
