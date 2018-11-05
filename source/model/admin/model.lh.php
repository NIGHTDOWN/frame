<?php




checktop();
class lhModel extends Y
{
    private $db_name = 'lh';

    public function add($oid)
    {
        if (!$oid)return false;
        $w = array('oid'=>$oid);
        $iinfo = T('out')->get_one($w);
        $in    = array('cash'   =>$iinfo['cash'],'addtime'=>time(),'uid'    =>$iinfo['uid'],'oid'    =>$oid);
        $false = ( T($this->db_name)->add($in));
        return  $false;
    }
    public function complete($uid)
    {
        if (!$uid)return false;
        $w = array('uid'   =>$uid,'status'=>0);
        $mod = T($this->db_name);
        $data= $mod->get_all($w);
        

        foreach ($data as $v) {
            M('award','am')->load($lid);
            
        }

        M('level','am')->load($uid);
    }

}

?>
