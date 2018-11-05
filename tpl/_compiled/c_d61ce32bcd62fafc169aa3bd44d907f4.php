<?php /* "tpl/muser/msg_show.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 13:30:37 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<link href="<?php echo $this->_vars['usertpl']; ?>
css/cheat.css" rel="stylesheet" type="text/css" />


<script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ajaxfileupload.js'>
    </script>
<script
        type='text/javascript' src='<?php echo $this->_vars['usertpl']; ?>
js/timecacl.js'>
    </script>
<script
        type='text/javascript' src='<?php echo $this->_vars['usertpl']; ?>
js/iscroll.js'>
    </script><script
        type='text/javascript' src='<?php echo $this->_vars['usertpl']; ?>
js/navbarscroll.js'>
    </script>
<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">
			<div class="mui-page-cont">

				<div class="a-msp-index" style="height: 100%;">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="back()" class="jd-header-icon-back ">
									<span>
									</span>
								</div>



								<div class="jd-header-new-title">
									<div class="header-content">
										<span class="header-title">
											<?php echo $this->_vars['sname']['dxname']; ?>

										</span>

									</div>
								</div>

								<div onclick="_go_url('<?php echo url(array('mod' => 'index','group' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span>
									</span>
								</div>
							</div>
						</header>


					</div>
<div class="scroll_content">
					<div class="message">
					<?php if ($this->_vars['history']): ?>
						<div>
							<div class="addmore" dataid="<?php echo $this->_vars['lastid']; ?>
">
								点击加载更多历史消息
							</div>
						</div>
						<?php endif; ?>
						<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
						
						<div class="msglist <?php if ($this->_vars['volist']['fid'] == $this->_vars['user']['uid']): ?>send<?php else: ?>show<?php endif; ?>">
							<div class="time" data="<?php echo $this->_vars['volist']['sendtime']; ?>
">
							</div>
							<div class="msg">
								<img class="head" src="<?php echo $this->_vars['static']; ?>
images/head.png" alt="<?php echo $this->_vars['sname'][$this->_vars['volist']['fid']]; ?>
" data='<?php echo $this->_vars['volist']['fid']; ?>
'>
								<pp>
									<i class="msg_input">
									</i><?php echo $this->_vars['volist']['msg']; ?>

								</pp>
							</div>
						</div>
						<?php endforeach; endif; ?>
					
						
					</div>
<div class="footer">
			<form method="post" tag='jqform' fun='hd' action="<?php echo url(array('action' => 'send','args' => "id:" . $this->_vars['sname']['id'] . ""), $this);?>">
			<div class='bq nots'>
				<img src="<?php echo $this->_vars['usertpl']; ?>
images/bq.png" class='bq'>
			</div>
			
			
			<div   class="msgdiv">
				<span tag='edit'  name='msg'  id="sendmsg"></span>
			</div>
			<div class='hc nots'>
			<div class='add'><img src="<?php echo $this->_vars['usertpl']; ?>
images/add.png"  tag='img_up' imgname='img' url="<?php echo url(array('mod' => 'upimg'), $this);?>" fun='upimagessss'></div>
			
					<button style="display:none"  type="button" class="nots" onclick="submitfrom($('#sendmsg'))">发送</button>
			</div>
		
		</form>
		</div>
</div>




				</div>



			</div>

		</div>


	</div>


</body>
<box id='box' style='display: none'>
	<div class="msglist ">
							<div class="time" data="">
							</div>
							<div class="msg">
								<img src="<?php echo $this->_vars['static']; ?>
images/head.png" class="head" data=''>
								<pp>
									<i class="msg_input">
									</i>
								</pp>
							</div>
						</div>
						
				<div class="bqlist" data='0'>
				<div class="bqs"></div>
				<ul class="biaozhi" ></ul>	
				</div>		
						
</box>
<script>
function showbqlist(){
	/*$('#box .bqlist').find('.bqlist');*/
	if($('.footer .bqlist').length<=0){
		loadbqlist();
		$('.footer').append($('#box .bqlist'));
	}else{
		$('.footer .bqlist').toggle();
	}
	fix();
	
	$('.message').height($(window).height()-$('.footer').height()-54);
	return true;
	
}
function selectbq($obj){
	$data=$obj.find('img').clone();
	$('#sendmsg').append($data);
	checkssubmit();
	return true;
	
}
function loadbqlist(){
	$load=$('.bqlist').attr('data');
	if(parseInt($load)==0){
		$imgw=44;
		$maxnum=134;
		$w=$(window).width();
		$hg=parseInt($w/$imgw);
		$pagenum=$hg*3;
		$page=Math.ceil(134/$pagenum);
		$pagediv='';
		var $index=0;
		$bz="";
		for(var i=0;i<$page;i++){
		$pagediv+="<div class='bqpages bqpage"+i+"'>";
		$bqimg='';
		if(i==0){$bz+="<li class='on'></li>";}else{$bz+="<li></li>";}
		
			for(var b=0;b<$pagenum;b++){
				if($maxnum<$index){break;}
				$bqimg+="<div class='imgbox'><img  src='<?php echo $this->_vars['staticjs']; ?>
/plugins/emoticons/images/"+$index+".gif'></div>";
				$index++;
			}
			$pagediv+=$bqimg+"</div>";
		}
		
		$('.bqlist').find('.bqs').append($pagediv);
		$('.bqlist').find('.biaozhi').append($bz);
		$('.bqlist').find('.bqs').width($page*$w);
		$('.bqlist').find('.bqpages').width($w);
		$('.bqlist').find('.biaozhi').width($w);
		huandong();

	}
	$('.bqlist').attr('data',1);
	/*d($(window).height());
	d($('.footer').outerHeight());*/
	/**/
}
 
 function fix(){
 	var winw=$(window).width();
        	var marginstop=$('.bqs').width()-winw; 
        	$margin=parseInt($('.bqs').css('margin-left'));
        	if($margin>=0 || $margin<=marginstop){

        		setpage(0);
        	}
        	
        }
        function setpage($num){
        	/*d($num);return 1;*/
        	$max=$('.bqlist .biaozhi').children().length-1;
        	
        	$num=$num>$max?$max:$num;
        	$num=$num<0?0:$num;
        	var winw=$(window).width();
        	$c1=$num*winw;
        	
        	/*$('.bqs').css('margin-left',margins-$c1);*/
        	$bh=-$c1;
        	$(".bqs").animate({ 
    'margin-left': $bh
  
  }, 500 );

        	$('.bqlist .biaozhi').children().eq($num).addClass('on').siblings().removeClass('on');
        	
        }
    function huandong() {  
        var startx;//让startx在touch事件函数里是全局性变量。  
        var endx;  
        var sx,sy,fixflag;
        
        var el = $('.bqs').get(0);//触摸区域。 
        var marginstart=0; 
        var margins=0; 
        var winw=$(window).width();
        var marginstop=$('.bqs').width()-winw; 
        function cons() {   //独立封装这个事件可以保证执行顺序，从而能够访问得到应该访问的数据。 
        
        	$c1=endx-startx;
        	
        	$margin=margins;
        	
        	if($margin<=0 || $margin>=marginstop){
        		if($margin==0 && $c1>0){
        			
        		}else{
        			$('.bqs').css('margin-left',$margin+$c1);
        		}
        		
        	}
        	
          /*setpage(0);*/
        }  
        
        
  		function stop(){
  			/*if(!fixflag)return false;*/
  		$margin=parseInt($('.bqs').css('margin-left'));
  		$thispage=parseInt(Math.abs(margins/winw));
  		
  		$c1=endx-startx;
  		
  		
  		if(Math.abs($c1)>winw*0.3){
  			if($c1<0){
  				setpage($thispage+1);
  			}else{
  				setpage($thispage-1);
  			}
  		}else{
  			
  			setpage($thispage);
  		}
  		
  		startx=0;
  		endx=0;
  		
  		}
        el.addEventListener('touchstart', function (e) {  
        	
            var touch = e.changedTouches;  
            startx = touch[0].clientX;  
            starty = touch[0].clientY;  
            margins=parseInt($('.bqs').css('margin-left'));
         
        });  
        
         el.addEventListener('touchmove', function (e) {  
            var touch = e.changedTouches;  
            endx = touch[0].clientX;  
            sy = touch[0].clientY;  
            
            cons();
        }); 
        el.addEventListener('touchend', function (e) {  
            var touch = e.changedTouches;  
            endx = touch[0].clientX;  
            endy = touch[0].clientY; 
            stop() ;
        
        });  
    }  
  
      

var $user=new Array;
 <?php if (count((array)$this->_vars['sname'])): foreach ((array)$this->_vars['sname'] as $this->_vars['k'] => $this->_vars['volist']): ?>
 $user['<?php echo $this->_vars['k']; ?>
']='<?php echo $this->_vars['volist']; ?>
';
 <?php endforeach; endif; ?>
 $user['uid']='<?php echo $this->_vars['user']['uid']; ?>
';
 function setsend($img){
 	$imghtml="<img src='"+$img+"'>";
 	$('#sendmsg').html($('#sendmsg').html()+$imghtml);
 	
 	submitfrom($('#sendmsg'));
 }
 function upimagessss($data){
 	if($data.flag){
 		setsend($data.data);
 		
 	}else{
 		showd('图片发送失败了(┬＿┬)');
 	}

 return true;
 }
function addmsg($uid,$time,$msg){
	/*$time=formattime($time);*/
	$obi=$('#box').find('.msglist').clone();
	$obi.find('.time').attr('data',$time);
	
	if(($time-lasttime)>1200){
			$data=showtime($time);
			
			$obi.find('.time').text($data);
		}
		lasttime=$time;
	$name=$user[$uid];
	if(!$name)return false;
	$obi.find('.name').text($name);
	$obi.find('img').attr('alt',$name);
	if($uid==$user['uid']){
		$obi.addClass('send');
		$obi.find('img').attr('data',$uid);
	}else{
		$obi.addClass('show');
		$obi.find('img').attr('data',$uid);
	}
	gethead($obi.find('.head'),$uid);
	$obi.find('pp').append($msg);
	
	$('.message').append($obi);
	gobuttom($('.message'));
	
}
function checkssubmit(){
	$val=$('#sendmsg').html();
	$tj=$('.hc button');
	$addimg=$('.hc .add');
	if($val==''){
		$tj.hide();
		$addimg.show();
	}else{
		$tj.show();
		$addimg.hide();
	}
}

var histime=0;
function addhistory($uid,$time,$msg){
	
	$obi=$('#box').find('.msglist').clone();
	$obi.find('.time').attr('data',$time);
	
	if((histime-$time)>1200){
			$data=showtime($time);
			
			$obi.find('.time').text($data);
		}
		histime=$time;
		/*$data=showtime($time);
			
			$obi.find('.time').text($data)*/
		
	$name=$user[$uid];
	if(!$name)return false;
	$obi.find('.name').text($name);
	$obi.find('img').attr('alt',$name);
	if($uid==$user['uid']){
		$obi.addClass('send');
		$obi.find('img').attr('data',$uid);
	}else{
		$obi.addClass('show');
		$obi.find('img').attr('data',$uid);
	}
	gethead($obi.find('.head'),$uid);
	$obi.find('pp').append($msg);
	
	$('.addmore').after($obi);

	
}
	function hd($data){
		if($data.flag){
			$('#sendmsg').val('');
			
			addmsg($data.data.fid,$data.data.sendtime,$data.data.msg);
			
		}
	}
	ywebsock('<?php echo $this->_vars['ip']; ?>
','<?php echo $this->_vars['port']; ?>
','cheat',{id:<?php echo $this->_vars['sname']['id']; ?>
},function($data){
		
		if($data.data.action=='cheat' && $user['id']==$data.data.data.id){
			
			$msg=($data.data.data);
		addmsg($msg.fid,$msg.sendtime,$msg.msg); }
		
		
	});
	$moreurl="<?php echo url(array('action' => "history"), $this);?>";
	$('.addmore').live('click',function(){
		$cid=$(this).attr('dataid');
		
		$id=$user['id'];
		$data={id:$id,cid:$cid};
		if($cid<=0){
			
			return false;
		}
		yAjax($moreurl,$data,function($data){
			if($data.flag ){
				$list=$data.data.data;
				$.each($list,function($i,$v){
					
					addhistory($v.fid,$v.sendtime,$v.msg);
				});
				$('.addmore').attr('dataid',$data.data.last);
					if($data.data.last){	
					}else{
						$('.addmore').text('已经显示全部历史消息');
					}
			}else{
				/*$('.addmore').remove();*/
				d('木有消息了;别瞎几把点了');
			}
			
		});
	});
	
	

DEBUG=true;
	var $user=new Array;
	var headurl="<?php echo url(array('mod' => "msg",'action' => "gethead"), $this);?>";
	<?php if (count((array)$this->_vars['sname'])): foreach ((array)$this->_vars['sname'] as $this->_vars['k'] => $this->_vars['volist']): ?>
	$user['<?php echo $this->_vars['k']; ?>
']='<?php echo $this->_vars['volist']; ?>
';
	<?php endforeach; endif; ?>
	$user['uid']='<?php echo $this->_vars['user']['uid']; ?>
';
	$(document).ready(function()
		{
			if (window.history && window.history.pushState)
			{
				$(window).on('popstate', function ()
					{
						window.history.pushState('forward', '#');
						/* showd('返回');*/
						window.history.forward(1);
						location.replace(document.referrer);
					});
			}
			window.history.pushState('forward' , '#'); //在IE中必须得有这两行
			/* showd('返回');*/
			window.history.forward(1);
			$('#sendmsg').on('keypress',function(event){
				checkssubmit();
				
			});$('#sendmsg').on('click',function(event){
				$('.footer .bqlist').hide();
				
			});
			$('#sendmsg').on('keyup',function(event){
				checkssubmit();
			});
			$('pp img').live('click',function(){
				_go_url_new($(this).attr('src'));
				return false;
			});
			$('.bq').live('click',function(){
				showbqlist();
				return false;
			});
			$('.imgbox').live('click',function(){
				
				selectbq($(this));
				return false;
			});
			$('#sendmsg').on('keydown',function(event){
				checkssubmit();
				if (event.keyCode == 13 )
        {
           
submitfrom($(this));

            return false;
        }
				
				
			});
		});
	document.onkeydown = function (e)
	{
		var ev = window.event || e;
		var code = ev.keyCode || ev.which;
		if (code == 116)
		{
			ev.keyCode ? ev.keyCode = 0 : ev.which = 0;
			cancelBubble = true;
			return false;
		}
	} //禁止f5刷新
	document.oncontextmenu=function()
	{
		return false
	};
	window.addEventListener("popstate", function(e)
		{
			back();
			return false;
		}, false);
	/*window.addEventListener("beforeunload", function(event) {

	event.returnValue = "不要随便刷新...";
	return false;
	},false);*/
	function submitfrom($obj){
		
		$obj.parents('form').submit();
		$obj.text('');
		$obj.next('input:hidden').val('');
		checkssubmit();
	}
	function back()
	{
	

		if(top == self)
		{
			/*window.location.href="about:blank";
			window.close();*/
			
			_go_url('<?php echo url(array('mod' => "msg",'action' => "run"), $this);?>');
		}else
		{


 window.parent.hideifr();
			
		}


	}
	$(function(){
		$('.message').height($(window).height());
			init_msg($('.msglist'));
			gobuttom($('.message'));
	});
</script>