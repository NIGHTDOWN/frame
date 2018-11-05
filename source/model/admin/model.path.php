<?php





checktop();

class pathModel extends Y
{

    public function getc()
    {
        global $mod_admin;
        global $c;
        $info=$mod_admin[$c]['alias'];
        
       
        if($info==''){
            $info=$c;
        }
        return $info;

    }
    public function geta()
    {
        global $mod_admin;
        $c=D_MEDTHOD;	$a=D_FUNC;
        $info=$mod_admin[$c]['action'][$a]['alias'];
       
        if($info==''){
            $info=$a;
        }
       
        return $info;
    }
    public function geto()
    {
        global $mod_admin;
        return $this->cname[$o];
    }

    public function getpath()
    {

    }

}

?>
