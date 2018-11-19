<?php


namespace ng169\control\admin;

use ng169\control\adminbase;


checktop();
class group extends adminbase
{
    private $db_name = "user";
    private $key = 'uid';



    public function control_run()
    {
        $uid = getGET('uid');
        if (!$uid) {
            error('用户ID丢失');
        }
        $model = T($this->db_name);
        $where = array('uid'=>$uid);
        $p2id = T('user_tree')->get_one($where);
        if ($p2id['treeid']) {
            $tree = explode(G_BREAK,$p2id['treeid']);
            
            $tree = array_slice($tree,sizeof($tree) - 2,sizeof($tree) );
            $tree = array_filter($tree);
        
        }
     
        $cid = T('user')->set_field(array('uid'));
    
        
        
         $cid= $cid->get_all(array('gid'=>$uid));

        

        $var_array = array('parent'=> & $tree,'child' => $cid,'size'  =>sizeof($tree));

        $this->view(null,$var_array);
    }
     public function control_getchild(){
     	$uid = getGET('uid');
        if (!$uid) {
            error('用户ID丢失');
        }
	 	 $cid = T('user')->set_field(array('uid','username','realname'))->get_all(array('gid'=>$uid));

        

      

       
	 	out($cid);
	 }
}

?>
