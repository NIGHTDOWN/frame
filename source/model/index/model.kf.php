<?php





checktop();

class kfModel extends Y
{

    public function get($muid)
    {
     if(!$muid)return false;
       $list=T('kf')->set_where('muid='.$muid)->set_limit(6)->order_by(array('s'=>'down','f'=>'type'))->get_all();
       if(sizeof($list)>0)return  $list;
       $store=T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_field('username,merchantname,muid')->get_one(array('muid'=>$muid));
       if(!$store)return false;
     return  array(array('muid'=>$muid,'name'=>$store['merchantname'],'num'=>$store['username'],'type'=>3));
    }


}

?>
