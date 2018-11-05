function showtime($timenum)
{
	$data=getTimeText($timenum);
	return $data;
}
function getTimeText(argument)
{
	argument=formattime2(argument);
	var timeS = argument;

	var todayT = ''; //
	var yestodayT = '';
	var timeCha = getTimeS(timeS);

	timeS = timeS.slice(-8);
	todayT = new Date().getHours()*60*60*1000 + new Date().getMinutes()*60*1000 + new Date().getSeconds()*1000;
	yestodayT = todayT + 24*60*60*1000;
	if(timeCha > yestodayT)
	{
		return argument.slice(0,11);
	}
	if(timeCha > todayT && timeCha < yestodayT)
	{
		return timeS.slice(0,2)>12?'昨天 下午'+(timeS.slice(0,2)==12 ? 12 : timeS.slice(0,2) - 12)+timeS.slice(2,5):'昨天 上午'+timeS.slice(0,5);
	}
	if(timeCha < todayT)
	{
		return timeS.slice(0,2)>=12?'下午'+(timeS.slice(0,2)==12 ? 12 : timeS.slice(0,2) - 12)+timeS.slice(2,5):'上午'+timeS.slice(0,5);
	}

}
function formattime2(now)
{

	now=new Date(parseInt(now) * 1000);

	var year=now.getFullYear();

	var month=buling(now.getMonth()+1);
	var date=buling(now.getDate());
	var hour=buling(now.getHours());
	var minute=buling(now.getMinutes());
	var second=buling(now.getSeconds());

	return year+"年"+month+"月"+date+"日 "+hour+":"+minute+":"+second;
}
function getTimeS(argument)
{
	var timeS = argument;
	timeS = timeS.replace(/[年月]/g,'/').replace(/[日]/,'');
	return new Date().getTime() - new Date(timeS).getTime() - 1000; //有一秒的误差

}
function buling(s)
{
	return s< 10 ? '0' +
	s: s;
}
function getlastmsg($obj){
		
	$id=$($obj).attr('attr_id');
	yAjax(lasturl,{id:$id},function($data){
		if($data.flag){
			
			$($obj).find('.u-msg msg').html($data.data.msg);
			
			$time=showtime($data.data.sendtime);
			$($obj).find('.u-chtime').text($time);
			
		}else{
			//无聊天数据
		}
	});
	}
	
	function  loaduser($obj){
	//数量检测
	
	$obj=$($obj);
	$numobj=$obj.find('.u-msgnum');
	$numobj.hide();
	$num=$numobj.attr('data');
	if($num>99){
		$numobj.text('99+');
	}else{
		$numobj.text($num);
	}
	if($num>0){
		$numobj.removeClass('none');
		$numobj.show();
	}
	}
	function inituser(){
		$.each($('.opencheat'),function($i,$v){
			loaduser($v);
			/*getlastmsg($v);*/
			/*$string.replace(/<img(.*?)>/g, "[图片]")*/
			/*d($($v).find('.u-msg .sl').eq(0).text());
			
			$($v).find('.u-msg .sl').text($($v).find('.u-msg .sl').text().replace(/<img(.*?)>/g, "[图片]"));*/
			getlastmsg($v);
			$img=$($v).find('.u-head img');
			gethead($img,$img.attr('data'));
		});
	}
	var headimg=new Array;
	var headdo=new Array;
	function gethead($obj,$uid){
		/*d(headimg[$uid]);*/
		
		if(headimg[$uid] ){
			$obj.attr('src',headimg[$uid]);
			return  headimg[$uid];
		}
		
		if( headdo[$uid]==1){
			
		$obj.attr('src',headimg[$uid]);
			return  headimg[$uid];
		}
			headdo[$uid]=1;
		//ajax获取头像
		$url=headurl;
		$data={uid:$uid}
		yAjax($url,$data,function($data){
			if($data.flag){
				headimg[$uid]=$data.data;
				
				$obj.attr('src',headimg[$uid]);
			}
		},null,1);
		
		return headimg[$uid];
	}
	function sethead($obj){
		$id=$obj.find('.head').attr('data');
		$img=gethead($obj.find('.head'),$id);
		/*$obj.find('img').attr('src',$img);*/
	}
	var lasttime=0;
	function init_msg($obj){
		if(!$obj.length)return false;
		
	$.each($obj,function($i,$v){
		$ob=$($v);
		sethead($ob);
		$timeobj=$ob.find('.time');
		$time=$timeobj.attr('data');
		
		if(($time-lasttime)>1200){
			$data=showtime($time);
			
			$timeobj.text($data);
		}
			lasttime=$time;
		
		
	});	
	}