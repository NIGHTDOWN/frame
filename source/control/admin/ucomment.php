<?php
namespace ng169\control\admin;

use ng169\control\adminbase;
checktop();
class ucomment extends adminbase
{
    private $db = 'product_comment';
    private $key = 'commid';
    public function control_good()
    {
        $mod = T($this->db)->join_table(array('t' => 'user', 'uid', 'uid'), 1)->join_table(array('t' => 'merchant', 'muid', 'muid'), 1)->join_table(array('t' => 'order_product', 'id', 'id'), 1)->set_global_where(array('cmlevel' => 1));
        $mod = $this->init_where($mod);
        $mod = $this->init_order($mod);

        $page = $this->make_page($mod);

        $data = $mod->set_limit($this->get_page_limit())->get_all();
        $var_array = array('data' => $data, 'page' => $page);

        $this->view('ucomment_index', $var_array);
    }
    public function control_bad()
    {
        $mod = T($this->db)->join_table(array('t' => 'user', 'uid', 'uid'), 1)->join_table(array('t' => 'merchant', 'muid', 'muid'), 1)->join_table(array('t' => 'order_product', 'id', 'id'), 1)->set_global_where(array('cmlevel' => 2));
        $mod = $this->init_where($mod);
        $mod = $this->init_order($mod);

        $page = $this->make_page($mod);

        $data = $mod->set_limit($this->get_page_limit())->get_all();
        $var_array = array('data' => $data, 'page' => $page);

        $this->view('ucomment_index', $var_array);
    }
    public function control_center()
    {
        $mod = T($this->db)->join_table(array('t' => 'user', 'uid', 'uid'), 1)->join_table(array('t' => 'merchant', 'muid', 'muid'), 1)->join_table(array('t' => 'order_product', 'id', 'id'), 1)->set_global_where(array('cmlevel' => 0));
        $mod = $this->init_where($mod);
        $mod = $this->init_order($mod);

        $page = $this->make_page($mod);

        $data = $mod->set_limit($this->get_page_limit())->get_all();
        $var_array = array('data' => $data, 'page' => $page);

        $this->view('ucomment_index', $var_array);
    }
    public function control_del()
    {
        $w = array($this->key => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T($this->db)->del($where);

        out('删除成功', null, $model);
    }
    public function control_show()
    {
        $get = get(array('int' => array('commid' => 1)));
        $model = T($this->db)->join_table(array('t' => 'order', 'ordernum', 'ordernum'), 1)->join_table(array('t' => 'product', 'productid', 'productid'), 1)->join_table(array('t' => 'merchant', 'muid', 'muid'), 1)->join_table(array('t' => 'user', 'uid', 'uid'), 1)->get_one($get);
        if (!$model) {
            error('订单不存在');
        }

        $this->view(null, array('data' => $model));

    }

}
