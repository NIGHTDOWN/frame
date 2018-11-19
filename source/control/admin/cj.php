<?php



namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class cj extends adminbase
{
	
	public function control_pro()
	{
		
		Y::loadTool('catchhtml','tool');
		$cj=new catchhtml();
		
		$data = T('tmp2')->order_by(array('s'=>'down','f'=>'id'))->join_table(array('t'=>'tmp1','lid','lid'))->set_where('flag=1  ')->set_limit(array(20000,100),'id','<')->get_one();
		
		$cj->startpro($data['tid']);
		return 1;
		
		out('采集完成了');

		die();
	}
	public function control_fixstore()
	{
		
		Y::loadTool('catchhtml','tool');
		$cj=new catchhtml();
//		$data=get(array('int'=>array('tid'=>1)));
		/*$data = T('tmp2')->order_by(array('s'=>'down','f'=>'id'))->join_table(array('t'=>'tmp1','lid','lid'))->set_where('flag=1  ')->set_limit(array(20000,100),'id','<')->get_one();*/
		/*$data=T('product')->get_one(array('productid'=>$data['tid']));
		if(!$data)error('商品部存在');*/
		/*$data=T('product')->set_field('tbid')->set_where('content=""')->get_all();*/
		$id=314;
	
		$list=T('product')->set_where('muid='.$id)->set_limit(10)->get_all();
		/*SELECT v.muid,count(productid) as num from a_merchant as v left JOIN a_product as b ON  v.muid=b.muid GROUP BY b.muid ORDER BY num desc*/
		//这里要吧上面的分开
		$muid="(1197,1196,1195,1194,1193,1192,1191,1190,1189,1188,1187,1186,1185,1184,1183,1182,1181,1180,1179,1178,1177,1176,1175,1174,1173,1172,1171,1170)";
		$data=T('product')->set_field('tbid,muid,productid')->set_where('muid in '.$muid)->group_by('muid')->get_all();
		d($data,1);
		foreach($data as   $list){
			$cj->dofixstore($list['tbid']);
		/*$cj->dofixpro($list['tbid']);	*/
		}
		
		/*return 1;*/
		
		die('修复完成');

		die();
	}
	public function control_del()
	{
		
		Y::loadTool('catchhtml','tool');
		$cj=new catchhtml();
		
		$cj->del();
		/*return 1;*/
		
		die('清空');

		die();
	}
public function control_dealimg()
	{
		//取出主图
		//取出content
		//移动到pcs
$data=		T('product')->set_field('productid,smallimg1,smallimg2,smallimg3,smallimg4,smallimg5,content')->get_all(array('temptype'=>1));
Y::loadTool('file');
 foreach($data as $pro){
 /*	$match_str = '/src=[\"|\']{0,1}((.*\.{1}[\w]{3,4}))[\"|\']{0,1}/i';*/
 T('product')->update(array('temptype'=>2),array('productid'=>$pro['productid']));
 	$match_str = '/src=[\"|\']{0,1}([\S]*)[\"|\']{0,1}/i';
 	/*$match_str = '/\"(.*?)\"/';*/
preg_match_all ($match_str,$pro['content'],$out,PREG_PATTERN_ORDER);

 	foreach($out[1] as $ll){
		if($this->islocal($ll)){
			$dest="/ned/".$ll;
 		YFile::copyFile($ll,$dest);
		}
	}
 	/*d($out);
 	d($pro['content'],1);*/
 	
 	if($this->islocal($pro['smallimg1'])){
 		$dest="/ned/".$pro['smallimg1'];
 		YFile::copyFile($pro['smallimg1'],$dest);
	}
 	if($this->islocal($pro['smallimg2'])){
 		$dest="/ned/".$pro['smallimg2'];
 		YFile::copyFile($pro['smallimg2'],$dest);
	}
 	if($this->islocal($pro['smallimg3'])){
 		$dest="/ned/".$pro['smallimg3'];
 		YFile::copyFile($pro['smallimg3'],$dest);
	}
	if($this->islocal($pro['smallimg4'])){
 		$dest="/ned/".$pro['smallimg4'];
 		YFile::copyFile($pro['smallimg4'],$dest);
	}
	if($this->islocal($pro['smallimg5'])){
 		$dest="/ned/".$pro['smallimg5'];
 		YFile::copyFile($pro['smallimg5'],$dest);
	}
	
	
	
	
	
	
	
	
	
 }
 
		die();
	}
	private function islocal($file){
		return preg_match('/data.*/',$file);
		
	}
	public function control_run()
	{

		/*$str=urlencode('衣服');*/
		if(!$_POST){
			$this->view('cj');
			die();
		}
		$num = 1000;
		$word=get(array('string'=>array('word'=>1)));
		Y::loadTool('catchhtml','tool');
		$cj=new catchhtml();
		$cj->start($word['word']);
		
		
		out('采集完成了');

		die();

	}
public function control_auto()
	{
		$s=360000;
		while($s>=5000){
			$s-=5000;
			d(geturl(array('s'=>$s),'catch_pro','aysn','admin'));
			YAsyn::start(geturl(array('s'=>$s),'catch_pro','aysn','admin'));
		}
		

		die('商品采集咯');

	}
public function control_do()
	{

		/*$str=urlencode('衣服');*/
		$data=$data=T('tmp1')->set_where('s<1008')->get_all();
		/*d(sizeof($data));
		d($data,1);*/
		foreach($data as $volist){
			YAsyn::start(geturl(array('word'=>$volist['word']),'catch','aysn','admin'));
		}
		/*foreach($data as $list){
			
		}*/
die();
	}

public function control_getmuid(){
	$id=get(array('int'=>array('id'=>1)));
	$data=T('merchant')->get_one(array('muid'=>$id['id']));
	if(!$data)return false;
	$word=iconv('utf-8','gb2312',$data['merchantname']);
	$str=urlencode($word);
	/*$s=$data['s'];*/
	$url="https://tmatch.simba.taobao.com/?name=tbuad&count=1&pid=1&keyword=+$str+";
	echo $url;die();
}
public function control_geturl(){
	$id=get(array('int'=>array('id'=>1)));
	$data=T('tmp1')->get_one(array('lid'=>$id['id']));
	if(!$data)return false;
	$str=urlencode($data['word']);
	$s=$data['s'];
	$url="https://s.taobao.com/api?ajax=true&m=customized&q=$str&s=$s";
	echo $url;die();
}
}

?>
