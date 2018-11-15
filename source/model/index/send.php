<?php



namespace ng169\model\index;
use ng169\Y;


checktop();

class send extends Y
{


	public function sendsms($user, $template, $msg = null)
	{
        if(Y::$conf['smsflag']){
            
            return false;
        }
		$m = M('template', 'im');
		if (is_array($msgarray))
		{
			$msg = array_merge($msgarray, Y::$conf, array('tplpath' => parent::$tplpath,
				'cpfile' => parent::$urlpath));
		}
		else
		{
			$msg = array_merge(Y::$conf, array('tplpath' => parent::$tplpath,
				'cpfile' => parent::$urlpath));
		}
		$msg0 = $m->getmsg($template, $msg);
        
		if ($mag0)
		{
			error('模版不存在');
		}
		if ($test)
		{
			$mail = $test;
		}
		else
		{
			$mail = array('smtp' => Y::$conf['smtp'], 'port' => Y::$conf['port'],
				'sendname' => Y::$conf['sendname'], 'sendmail' => Y::$conf['sendmail'],
				'sendpassword' => Y::$conf['sendpassword'], 'sendtype' => Y::$conf['sendtype'], );
		}
		
		
		
		
		$sms = M('smssdk2', 'am');
		list($flag, $msg) = $sms->sdkSend($user['to'], $msg0['template']);
		error($msg);
	}
	public function check($user,$code){
        	$codeobj=T('tmpcode');
        	$where=array('who'=>$user,'code'=>$code,'flag'=>0);
        	if(!$user || !$code) error('邮箱验证码不能留空');
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
	
	
	public function sendmail($user, $template, $msgarray = null, $test = null)
	{
     
        if(!Y::$conf['mailflag']){
            
            return false;
        }
  
		$m = M('template', 'im');
		if (is_array($msgarray))
		{
			$msg = array_merge($msgarray, Y::$conf);
		}
		else
		{
			$msg = (Y::$conf);
		}
		$msg0 = $m->getmsg($template, $msg);
		
		if (!$msg0)
		{
			out($template.'模版不存在',null,0);
		}
		
		if ($test)
		{
			$mail = $test;
		}
		else
		{
			$mail = array('smtp' => Y::$conf['smtp'], 'port' => Y::$conf['port'],
				'sendname' => Y::$conf['sendname'], 'sendmail' => Y::$conf['sendmail'],
				'sendpassword' => Y::$conf['sendpassword'], 'sendtype' => 1,'ssl'=> Y::$conf['mailssl'] );
		}
    
		$mymail =Y::import('mail', 'tool');
		
		$s = $mymail->sendMail($mail, $user['to'], $msg0['title'], $msg0['content']);
		return $s;
		

	}
    public function sendsite($user,$template,$msgarray = null)
	{
		$m = M('template', 'im');
		if (is_array($msgarray))
		{
			$msg = array_merge($msgarray, Y::$conf, array('tplpath' => parent::$tplpath,
				'cpfile' => parent::$urlpath));
		}
		else
		{
			$msg = array_merge(Y::$conf, array('tplpath' => parent::$tplpath,
				'cpfile' => parent::$urlpath));
		}
		$msg0 = $m->getmsg($template, $msg);
        
		if (!$msg0)
		{
			out($template.'模版不存在',null,0);
		}
        
        $mod=T('message');
        
        $insert=array('addtime'=>time(),'creatid'=>parent::$wrap_admin['adminid']);
        
        $insert['fromid']=0; 
        $insert['toid']=$user; 
        $insert['msgtype']=0; 
        $insert['title']=$msg0['title']; 
        $insert['content']=$msg0['content']; 
        $msgid=$mod->add($insert);
        $key='msgid';
        if(!$msgid) {
            
            $id=G(array('int'=>array($key=>1)))->get();
            $msgid=$id[$key];
            
        } 
        $where=array($key=>$msgid);
        $msg=$mod->check_exist($where);
        if($msg){
            
            $msg['status']=1;
            $mod->update($msg,$where);
            $flag= M('message','am')->send($msgid,$msg['toid']);
            
            
            return true;
        }else{
            return false;
          
        }
   

	}

}

?>
