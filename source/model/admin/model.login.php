<?php




checktop();
class loginModel extends Y {
    public function login($recv){
        
        $where=array('adminname' => $recv['username']);
        $mod=T('admins');
		$admin_db_data = $mod->check_exist($where);
     
		if (!$admin_db_data )
		{
			$status = 0;
			$mark = '用户不存在!';
			
		} elseif ($admin_db_data['password'] != md5($recv['password']))
		{
			$status = 0;
			$mark = '密码错误!';
			
		} elseif ($admin_db_data['adminstatus'] == 1)
		{
			$status = 0;
			$mark = '帐号已经被锁定!';
		}
		else
		{
			$status = 1;
           
			
            
			parent::$wrap_admin = $admin_db_data;
		}
    
        M('log','am')->log($status,$where,null,null,$mark);
        return array('flag'=>$status,'mark'=>$mark);
    }

}
?>
