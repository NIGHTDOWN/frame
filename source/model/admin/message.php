<?php

namespace ng169\model\admin;
use ng169\Y;


checktop();
class message  extends Y {
    
    private $db_name="messagebox";
    private $key="msgid";
    
    public function send($msgid,$to){
        $mod=T($this->db_name);
        if(is_numeric($to)){
            
            if($to<=0){
                switch ($to )
                {
                    case '0':
                        $k='userid';
                        $userdb=T('user')->set_field(array($k));
                        break;
                    case '-1':
                        $k='muid';
                        $userdb=T('merchant')->set_field(array($k));
                        
                        break;
                    case '-2':
                        $k='userid';
                        $userdb=T('member')->set_field(array($k));
                        break;
                	
                }
                $uids=$userdb->get_all();
                
                
                foreach($uids as $u){
                    $this->_send($msgid,$u[$k]);
                }
                
            }else{
                return $this->_send($msgid,$to);
            }
            
            
        }else{
            $uid=explode(',',$to);
            foreach($uid as $u){
                $this->send($msgid,$u);  
            }
        }
        return true;
    }
    private function _send($msgid,$to){
        
        
        $self=array('fromid'=>$to,'msgid'=>$msgid);
        if(T('message')->check_exist($self)){
            return false;
        }
        $insert=array('msgid'=>$msgid,'sendtime'=>time(),'userid'=>$to);
        $flag=T($this->db_name)->add($insert);
        return $flag;
        
    }
    
}
?>
