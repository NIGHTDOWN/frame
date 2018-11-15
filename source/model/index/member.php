<?php


namespace ng169\model\index;
use ng169\Y;

checktop();

class memberModel extends Y
{
    public function getbespoke(){
        $var_array=array();
        $where=array('userid'=>parent::$wrap_user['userid']);
        $where2=array('userid'=>parent::$wrap_user['userid'],'status'=>0);
        $var_array['bstore']=T('bespoke_store')->get_count($where);
        $var_array['bserver']=T('bespoke_product')->get_count($where);
        $var_array['bactivity']=T('bespoke_activity')->get_count($where);
        $var_array['unbstore']=T('bespoke_store')->get_count($where2);
        $var_array['unbserver']=T('bespoke_product')->get_count($where2);
        $var_array['unbactivity']=T('bespoke_activity')->get_count($where2);
      
        return $var_array;
    }
    public function getinfo(){
        $var_array=array();
        $where=array('userid'=>parent::$wrap_user['userid']);
        $where2=array('userid'=>parent::$wrap_user['userid'],'status'=>0);
        $var_array['unbstore']=T('bespoke_store')->get_count($where2);
        $var_array['unmessage']=T('messagebox')->get_count(array('userid'=>parent::$wrap_user['userid'],'readflag'=>0));
        $var_array['cstore']=T('merchant_comment')->get_count(array('userid'=>parent::$wrap_user['userid']));
        $var_array['cserver']=T('comment_bespoke')->get_count(array('userid'=>parent::$wrap_user['userid']));
        $var_array['cactivity']=T('comment_activity')->get_count(array('userid'=>parent::$wrap_user['userid']));
        return $var_array;
    }
}

?>
