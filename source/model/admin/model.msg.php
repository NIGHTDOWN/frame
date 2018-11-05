<?php




checktop();
class msgModel  extends Y {
    public function sysmsg($uid,$title,$reson){
    	if(!$uid)return false;
		$data['uid']=$uid;
		$data['content']=$reson;
		$data['title']=$title;
		$data['addtime']=time();
		$flag= T('sysmsg')->add($data);
		if($flag){
			M('ucount','im')->addmsg($uid);
		}
		return 1;
	}
   public function weigui_msg($uid,$pid,$reson){
   	$title='[违规消息]';
//   	http://ds.com/index.php?m=shop&c=product&a=Illegal
$url=geturl(array('productid'=>$pid),'Illegal','product','shop');
$data=$reson.'<a href='.$url.'>查看</a>';
   	$this->sysmsg($uid,$title,$data);
   }
   public function weigui_msg_jc($uid,$pid,$reson){
   	$title='[商品解除禁销消息]';
//   	http://ds.com/index.php?m=shop&c=product&a=Illegal
$url=geturl(array('productid'=>$pid),'depot','product','shop');
$data=$reson.'<a href='.$url.'>查看</a>';
   	$this->sysmsg($uid,$title,$data);
   } 
//提醒发货
public function txfh($ordernm){
   	$title='[用户发起提醒发货请求]';
$muser=T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('merchant.uid')->get_one(array('ordernum'=>$ordernm));

if(!$muser)return false;
$url=geturl(array('ordernum'=>$ordernm),'waitsend','sells','shop');
$reson='订单'.$ordernm.'已经支付;请及时发货.';
$data=$reson.'<a href='.$url.'>查看</a>';

   	$this->sysmsg($muser['uid'],$title,$data);
   } 
}
?>
