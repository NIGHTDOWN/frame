<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class login_user extends adminbase
{
    private $comeurl = null;
    
    public function control_login()
    {
        $server = G(array('int' => array('uid' => 1)));
        $getinfo = $server->get();
        
        $info = T('user')->get_one($getinfo);
       
        if ($info) {
         /*   switch ($info['type']) {
                case '1':
                    $url = 'member';
                    break;
                case '2':
                    $url = 'frame';
                    break;
            }*/
            $url = geturl(null,null,'index','user');
            $this->usersavecookie($info);
            YOut::redirect($url);
        } else {
            error('登入失败');
        }
    }
public function control_shop()
    {
        $server = G(array('int' => array('muid' => 1)));
        $getinfo = $server->get();
        
        $info = T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_field('user.*')->get_one($getinfo);
       
        if ($info) {
        /*    switch ($info['type']) {
                case '1':
                    $url = 'member';
                    break;
                case '2':
                    $url = 'frame';
                    break;
            }*/
            $url = geturl(null,null,'shop','shop');
            $this->usersavecookie($info);
            YOut::redirect($url);
        } else {
            error('登入失败');
        }
    }
    public function usersavecookie($infoarr)
    {
        $Xcode =Y::import('code', 'tool');
        $infostr = serialize($infoarr);
        $infocode = $Xcode->authCode($infostr, 'ENCODE');
        Y::loadTool('cookie');
        YCookie::set('userinfo', $infocode);
    }
}

?>
