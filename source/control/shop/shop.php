<?php

checktop();
class control extends shopbase
{
    private function get7day_visit()
    {
		$where['muid']=$this->get_muid();
		$where['date']=array(date("Ymd")-7,date("Ymd"));

	  $t1=T('visit_log')->set_where($where)->set_field('count(date) as num,date')->group_by('date,ip')->get_sql();

$sql="SELECT COUNT(num) as usernum ,`date` FROM (". $t1.") as c group by date";

$data=T('')->dosql($sql);

return $data;

	}
	private function getnews()
    {
		

$data=M('index','im')->scnews();

return $data;

	}
    public function control_run()
    {

        if (parent::$wrap_user['rzflag'] == 1 || parent::$wrap_user['rzflag'] == 2) {
            $muid = $this->get_muid();
            $uid = $this->get_userid();
            $data['cknum'] = M('storeinfo', 'im')->getcknum($muid);
            $data['csnum'] = M('storeinfo', 'im')->getcsnum($muid);
            $data['wgnum'] = M('storeinfo', 'im')->getwgnum($muid);
            $data['xxnum'] = M('storeinfo', 'im')->getxxnum($uid);
            $data['wchnum'] = M('storeinfo', 'im')->getwcknum($muid);
            $data['oallnum'] = M('storeinfo', 'im')->getoallnum($muid);
            $data['wfknum'] = M('storeinfo', 'im')->getowfknum($muid);
            $data['yfknum'] = M('storeinfo', 'im')->getoyfknum($muid);
            $data['yfhnum'] = M('storeinfo', 'im')->getoyfhnum($muid);
            $data['thnum'] = M('storeinfo', 'im')->getothnum($muid);
            $data['pjnum'] = M('storeinfo', 'im')->getopjnum($muid);
            $data['doingnum'] = M('storeinfo', 'im')->getodoingnum($muid);
            $data['cashall'] = M('storeinfo', 'im')->getocashall($muid);
            $data['cashsjall'] = M('storeinfo', 'im')->getocashsjall($muid);
            $data['visit'] = $this->get7day_visit();
            $data['scnews'] = $this->getnews();
            $var_array = array('data' => $data);
            $this->view(null, $var_array);
        } else {
            error('店铺未认证');
        }

    }

}
