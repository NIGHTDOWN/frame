<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/user/msg_show.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 02:36:46 �й���׼ʱ�� */ ?>

<!DOCTYPE html>

<html ><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
   
   <meta charset="utf-8">
  

<script src="<?php echo $this->_vars['staticjs']; ?>
jquery.min.js" type="text/javascript"></script>

<script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ajaxfileupload.js'>
    </script>
<script src="<?php echo $this->_vars['staticjs']; ?>
night_Trad.v1.0.js" type="text/javascript"></script>
<script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/kindeditor.js'>
    </script>
 <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/zh_CN.js'>
    </script>
    <script>
 var editor;
 DEBUG=true;
        _ajax_edit_url = '<?php echo url(array('action' => "json_up",'mod' => "upimg",'group' => "user"), $this);?>';
 $use_K_item=[   "fontsize", "|", "forecolor", "hilitecolor", "bold",  "|", "image", "multiimage", "emoticons"];
 KindEditor.options.items =  $use_K_item;

	 KindEditor.ready(function(K) {
                editor = K.create('#editor_id', { uploadJson: _ajax_edit_url, afterBlur: function () { this.sync();},afterCreate : function() { //设置编辑器创建后执行的回调函数  
                                    var self = this;  
                                    var $txt = $("iframe").contents().find("body");  
                                    $txt.keydown(function (event) {  
                                        if(event.keyCode==13&&!event.ctrlKey){  
                                            self.sync();  
                                             $form = _find_parent($(this), 'form');
            //触发离开事件
            $('.s2 button').click();
           
        
                                           /* alert("回车事件");  */
                                        }  
                                    });  
                                    /*K.ctrl($txt[0], 13, function(e) {  
                                        K.insertHtml('textarea[name="message"]','<br/>');  
                                    });  */
   
                                }   });
editor= K.create('.editor_id', { uploadJson: _ajax_edit_url, afterBlur: function () { this.sync(); } });

            });
           $(function(){
           	gobuttom($('.content'));
           });
</script>
<style>
*{
	outline:none; 
	border:none;
}
	.content {
    width: 100%;
    height: 500px;
       overflow-y: scroll;
    overflow-x: hidden;
}

li {
    list-style:  none;
    display: block;
}

.user {
    color:  blue;
}
.user .mine{
	color: #f90a62;
}
span.time {
    color: green;
}

.user-msg {
    margin: 5px;
    width: 100%;
    overflow: hidden;    margin-left: 20px;
}
ul {
    margin: 0px;
    padding: 0px;
    
}
.s1{display: block;width: 89.5% ;height: 150px;float: left;}
.s2{display: block;width: 10%; height: 150px;float: right;}
.s1 textarea{
	    width: 100%;height: 130px;
}
.s1 .ke-toolbar {
    background: #fff;
    border-bottom: 1px solid #cccccc2e;
}
.s1  .ke-toolbar .ke-outline{
	border: #fff;
}.s1  .ke-statusbar{
 display:none;
}
.s2 button{
	       display: inline;
    float: left;
    /* margin-right: 5px; */
    width: 100%;
    height: 158px;
    text-align: center;
    color: #666;
    line-height: 28px;
    border: 1px solid #ffe2a6;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    background: #fff4d8;
    float: right;
  font-size
}
.content li .addmore{    width: 100%;
    text-align: center;
    cursor: pointer;
     -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;}
</style></head>
<body>
<div>

<div class="content">
<ul>
<?php if ($this->_vars['history']): ?>
<li>
	<div class="addmore" dataid="<?php echo $this->_vars['lastid']; ?>
">点击加载更多历史消息</div>
</li>
<?php endif; ?>
	<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
	<li>
		<div class="user">
		<span class="name <?php if ($this->_vars['volist']['fid'] == $this->_vars['user']['uid']): ?>mine<?php endif; ?>"><?php echo $this->_vars['sname'][$this->_vars['volist']['fid']]; ?>
</span>
		<span class="time"><?php echo $this->_run_modifier($this->_vars['volist']['sendtime'], 'date_format', 'plugin', 1, '%Y-%m-%d %H:%M:%S'); ?>
</span></div>
		<div class="user-msg"><?php echo $this->_vars['volist']['msg']; ?>
</div>
	</li>
	<?php endforeach; endif; ?>
	</ul>
</div>
<div class="send">

<form method="post" tag='jqform' fun='hd' action="<?php echo url(array('action' => 'send','args' => "id:" . $this->_vars['sname']['id'] . ""), $this);?>">
<div class="s1"><textarea name='msg' id="editor_id" ></textarea></div>
	<div class="s2"><button type="button" tag='submit'>发送</button></div>
</form>
	
</div>
<div style='display: none' id='msg'>

	<li>
		<div class="user">
		<span class="name"><?php echo $this->_vars['sname'][$this->_vars['volist']['fid']]; ?>
</span>
		<span class="time"><?php echo $this->_run_modifier($this->_vars['volist']['sendtime'], 'date_format', 'plugin', 1, '%Y-%m-%d %H:%M:%S'); ?>
</span></div>
		<div class="user-msg"><?php echo $this->_vars['volist']['msg']; ?>
</div>
	</li>
</div>
</div>
<script>
var $user=new Array;
 <?php if (count((array)$this->_vars['sname'])): foreach ((array)$this->_vars['sname'] as $this->_vars['k'] => $this->_vars['volist']): ?>
 $user['<?php echo $this->_vars['k']; ?>
']='<?php echo $this->_vars['volist']; ?>
';
 <?php endforeach; endif; ?>
 $user['uid']='<?php echo $this->_vars['user']['uid']; ?>
';
function addmsg($uid,$time,$msg){
	$time=formattime($time);
	$name=$user[$uid];
	if(!$name)return false;
	$('#msg').find('.name').text($name);
	
	if($uid==$user['uid']){
		$('#msg').find('.name').addClass('mine');
	}else{
		$('#msg').find('.name').removeClass('mine');
	}
	$('#msg').find('.time').text($time);
	$('#msg').find('.user-msg').html($msg);
	$('.content ul').append($('#msg').find('li').html());
	gobuttom($('.content'));
}
function addhistory($uid,$time,$msg){
	$time=formattime($time);
	$name=$user[$uid];
	if(!$name)return false;
	$('#msg').find('.name').text($name);
	
	if($uid==$user['uid']){
		$('#msg').find('.name').addClass('mine');
	}else{
		$('#msg').find('.name').removeClass('mine');
	}
	$('#msg').find('.time').text($time);
	$('#msg').find('.user-msg').html($msg);
	$('.addmore').after($('#msg').find('li').html());
	
}
	function hd($data){
		if($data.flag){
			KindEditor.instances[0].html("");
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
	/*var iceServer = {
    "iceServers": [{
        "url": "stun:stun.l.google.com:19302"
    }]
};
	var getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
var PeerConnection = (window.PeerConnection ||
                    window.webkitPeerConnection00 || 
                    window.webkitRTCPeerConnection || 
                    window.mozRTCPeerConnection);
                    var pc = new PeerConnection(iceServer);
                    pc.onicecandidate = function(event){
    socksend(JSON.stringify({
        "event": "__ice_candidate",
        "data": {
            "candidate": event.candidate
        }
    }));
};
  //发送ICE候选到其他客户端
pc.onicecandidate = function(event){
    socket.send(JSON.stringify({
        "event": "__ice_candidate",
        "data": {
            "candidate": event.candidate
        }
    }));
};
//如果检测到媒体流连接到本地，将其绑定到一个video标签上输出
pc.onaddstream = function(event){
    someVideoElement.src = URL.createObjectURL(event.stream);
};
//获取本地的媒体流，并绑定到一个video标签上输出，并且发送这个媒体流给其他客户端
getUserMedia.call(navigator, {
    "audio": true,
    "video": true
}, function(stream){
    //发送offer和answer的函数，发送本地session描述
    var sendOfferFn = function(desc){
            pc.setLocalDescription(desc);
            socket.send(JSON.stringify({ 
                "event": "__offer",
                "data": {
                    "sdp": desc
                }
            }));
        },
        sendAnswerFn = function(desc){
            pc.setLocalDescription(desc);
            socket.send(JSON.stringify({ 
                "event": "__answer",
                "data": {
                    "sdp": desc
                }
            }));
        };
    //绑定本地媒体流到video标签用于输出
    myselfVideoElement.src = URL.createObjectURL(stream);
    //向PeerConnection中加入需要发送的流
    pc.addStream(stream);
    //如果是发送方则发送一个offer信令，否则发送一个answer信令
    if(isCaller){
        pc.createOffer(sendOfferFn);
    } else {
        pc.createAnswer(sendAnswerFn);
    }
}, function(error){
    //处理媒体流创建失败错误
});
//处理到来的信令
socket.onmessage = function(event){
    var json = JSON.parse(event.data);
    //如果是一个ICE的候选，则将其加入到PeerConnection中，否则设定对方的session描述为传递过来的描述
    if( json.event === "__ice_candidate" ){
        pc.addIceCandidate(new RTCIceCandidate(json.data.candidate));
    } else {
         pc.setRemoteDescription(new RTCSessionDescription(json.data.sdp));
    }
};
	*/
	
</script>



</body>
</html>