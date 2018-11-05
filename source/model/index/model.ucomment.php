<?php





checktop();

class ucommentModel extends Y
{
public function getcount($uid){
	if(!$uid)return false;
	$where=array('uid'=>$uid);

$data=T('comment_user_count')->get_one($where);
return $data;
}
public function getcountlist($uid){

$count=$this->getcount($uid);

if(!$count)return false;

$mouth=date('n');
$field="muoth".$mouth;

$list['m1']['good']=$count[$field.'good'];
$list['m1']['center']=$count[$field.'center'];
$list['m1']['bad']=$count[$field.'bad'];
$mouths=array(12,11,10,9,8,7,6,5,4,3,2,1);
$f1=array_slice($mouths,-$mouth,3);
if(sizeof($f1)<3){
	$f2=array_slice($mouths,0,3-sizeof($f1));
	$f1=array_merge($f1,$f2);
}
$field1="muoth".$f1[0];
$field2="muoth".$f1[1];
$field3="muoth".$f1[2];
$list['m3']['good']=$count[$field1.'good']+$count[$field2.'good']+$count[$field3.'good'];
$list['m3']['center']=$count[$field1.'center']+$count[$field2.'center']+$count[$field3.'center'];
$list['m3']['bad']=$count[$field1.'bad']+$count[$field2.'bad']+$count[$field3.'center'];
$f1=array_slice($mouths,-$mouth,6);
if(sizeof($f1)<6){
	$f2=array_slice($mouths,0,6-sizeof($f1));
	$f1=array_merge($f1,$f2);
}
$field4="muoth".$f1[3];
$field5="muoth".$f1[4];
$field6="muoth".$f1[5];
$list['m6']['good']=$count[$field1.'good']+$count[$field2.'good']+$count[$field3.'good']+$list['m3']['good'];
$list['m6']['center']=$count[$field1.'center']+$count[$field2.'center']+$count[$field3.'center']+$list['m3']['center'];
$list['m6']['bad']=$count[$field1.'bad']+$count[$field2.'bad']+$count[$field3.'center']+$list['m3']['center'];
$user=T('user')->set_field('ugood,ucenter,ubad')->get_one(array('uid'=>$uid));
$list['m7']['good']=$user['ugood']-$list['m6']['good'];
$list['m7']['center']=$user['ucenter']-$list['m6']['center'];
$list['m7']['bad']=$user['ubad']-$list['m6']['bad'];

return $list;
}

}

?>
