<?php



namespace ng169\model\index;
use ng169\Y;


checktop();
class sms extends Y
{

    
	public function sendcode($user){
     	 	$smspai = Y::import('SMS','tool');
			$m      = M('tmpcode', 'am');
			$code   = $m->make($user);
		
			if($code){
				$msg = M('template','im')->getmsg('sms_code',array('code'=>''.$code.''));
			
				$key = $smspai->send($user,$msg['content']);
				if($key['code'] == 2){
					out('发送成功');
				}else{
					error('发送失败');
				}
			} else{
				error($m->geterror());
			}
    }
 
    public function check($user,$code){
        	$codeobj=T('tmpcode');
        	$where=array('who'=>$user,'code'=>$code,'flag'=>0);
        	if(!$user || !$code) error('短信验证码不能留空');
			$i=$codeobj->order_by(array('f'=>array('addtime'),'down'))->get_one($where);
            $long=600;
			if($i){
				if(($i['addtime']+$long)<=(time())){
                    error('验证码已经失效；请重新获取');
				/*	error('链接失效,请重新获取',geturl(null,'login'),1);*/
				}
				$codeobj->update(array('flag'=>1),$where);
				return true;
			}else{
				error('无效验证码');
			}
   
    }

}

?>
