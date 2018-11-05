<?php





checktop();

class messageModel extends Y
{
private function getuid(){
	$uid=parent::$wrap_user['uid'];
	if($uid)return $uid;
	error('用户ID不存在');
	return false;
}
//获取广播消息
public function getbordcase(){
	$w=T('sysmsg')->set_field('mid')->set_where(array('uid'=>$this->getuid()))->get_sql();
$bordcase=T('sysbordcase')->set_limit(20)->order_by(array('s'=>'mid','f'=>'mid'))->set_where(array('flag'=>1))->set_where("mid not  in ({$w})")->get_all();

foreach($bordcase as $volist){
	$inid['title']=$volist['title'];
	$inid['addtime']=$volist['careatetime'];
	$inid['mid']=$volist['mid'];
	$inid['content']=$volist['content'];
	$inid['msgflag']=1;
	$inid['type']=1;
	$inid['uid']=$this->getuid();
	T('sysmsg')->add($inid);
}
return true;
}

}

?>
