<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class hotword extends Y
{

    public function get()
    {
    	return T('keyword')->order_by(array('f'=>array('elite','hits'),'s'=>'down'))->set_limit(15)->get_all(array('flag'=>0));
      
    }

}

?>
