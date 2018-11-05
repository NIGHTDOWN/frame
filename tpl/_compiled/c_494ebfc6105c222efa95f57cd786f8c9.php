<?php /* "tpl/user/msg_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 23:59:05 �й���׼ʱ�� */ ?>

  <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script>
	_ajax_file_url='<?php echo url(array('group' => 'user','mod' => 'upimg'), $this);?>';
</script>
<style>
	.none
	{
		display: none;
		
	}

.layout .left_con li{
	width: 100%;
}
.layout .left_con li.opencheat {
	-moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	box-shadow:inset 0px 1px 0px 0px #fce2c1;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25));
	background:-moz-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-webkit-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-o-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-ms-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
	
	background-color:#ffc477;
	/*-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;*/
	border:1px solid #eeb44f;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #cc9f52;
}
.layout .left_con li.opencheat:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
	background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
	background-color:#fb9e25;
	
	
	
}
.layout .left_con li.opencheat.active {
	
	-moz-box-shadow:inset 0px 1px 0px 0px #ffe8cc;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffe8cc;
	box-shadow:inset 0px 1px 0px 0px #ffe8cc;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb8e00 ), color-stop(1, #bd6c04 ));
	background:-moz-linear-gradient(top, #fb8e00  5%, #bd6c04  100%);
	background:-webkit-linear-gradient(top, #fb8e00  5%, #bd6c04  100%);
	background:-o-linear-gradient(top, #fb8e00  5%, #bd6c04  100%);
	background:-ms-linear-gradient(top, #fb8e00  5%, #bd6c04  100%);
	background:linear-gradient(to bottom, #fb8e00  5%, #bd6c04  100%);
	
}
	.layout .left_con li.opencheat a{
		text-decoration:none;
		color:#fff;
	}
/*.layout .left_con li.light{  
    -webkit-animation-duration: 4s;  
    animation-duration: 4s;  
    -webkit-animation-fill-mode: both;  
    animation-fill-mode: both  
}  */
	.layout .left_con li.opencheat.light{  
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
	background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
	background-color:#fb9e25;
    -webkit-animation: twinkling 1s infinite ease-in-out;  
}  
@-webkit-keyframes twinkling{  
    0%{  
        -moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	box-shadow:inset 0px 1px 0px 0px #fce2c1;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25));
	background:-moz-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-webkit-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-o-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-ms-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
    }  
    100%{  
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
	background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
	background-color:#fb9e25;
    }  
}  

@-moz-keyframes twinkling{  
    0%{  
        -moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	box-shadow:inset 0px 1px 0px 0px #fce2c1;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25));
	background:-moz-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-webkit-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-o-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-ms-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);  
    }  
    100%{  
         background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
	background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
	background-color:#fb9e25;
    }  
}  
@keyframes twinkling{  
    0%{  
         -moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
	box-shadow:inset 0px 1px 0px 0px #fce2c1;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25));
	background:-moz-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-webkit-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-o-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:-ms-linear-gradient(top, #ffc477 5%, #fb9e25 100%);
	background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
    }  
    100%{  
	 background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477));
	background:-moz-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-webkit-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-o-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:-ms-linear-gradient(top, #fb9e25 5%, #ffc477 100%);
	background:linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477',GradientType=0);
	background-color:#fb9e25;
    }  
}  
</style>


<div class="left_con">
	<div class="business_handle" id="my_menu">
		<h3 style="text-indent:20px;">
			在线聊天
		</h3>
		<ul class="cheatuserlist">
			<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['k'] => $this->_vars['volist']): ?>
			<?php  $this->_vars['id']=$this->_vars['volist']['uid']==$this->_vars['user']['uid']?1:2; ?>
			<?php  $this->_vars['idnum']='u'.$this->_vars['id'].'num'; ?>
			<li class="opencheat  <?php if ($this->_vars['volist']['id'] == $this->_vars['select']['id'] || ( $this->_vars['k'] == 0 && $this->_vars['select']['id'] == null )): ?>active<?php endif; ?> <?php if ($this->_vars['volist'][$this->_vars['idnum']]): ?>light<?php endif; ?>" attr_id='<?php echo $this->_vars['volist']['id']; ?>
'>
				<a   href="###">
					<?php if ($this->_vars['volist']['uid'] == $this->_vars['user']['uid']): ?>
					<?php echo $this->_vars['volist']['u2name']; ?>

					<?php else:  echo $this->_vars['volist']['u1name']; ?>

					<?php endif; ?>
					
				</a>
			</li>
			<?php endforeach; endif; ?>
		</ul>
	</div>
</div>







<div class="right_con">





	<div class="main">
		<div class="wrap">
			<div class="hd">
				<ul class="tabs">



				</ul>
			</div>
			<div id="content">
				<iframe
					id="ifr<?php echo $this->_vars['data']['0']['id']; ?>
" src="<?php echo url(array('action' => 'show','args' => "id:" . $this->_vars['data']['0']['id'] . ""), $this);?>">
				</iframe>




			</div>

		</div>
	</div>
</div>
<audio  id='recvaudio' src="" >
 
</audio>
<style>
	iframe
	{
		width: 100%;
		min-height: 700px;
		border: none;
	}
</style>



<script>
	$(function()
		{
			$readurl='<?php echo url(array('action' => 'read','mod' => 'msg'), $this);?>';
			$('.opencheat').live('click',function()
				{
					$(this).addClass('active').siblings().removeClass('active');
					$(this).removeClass('light');
					$id=$(this).attr('attr_id');
					$findid="#ifr"+$id;
					$findobj=$('#content').find($findid);
					
					$('#content').find('iframe').hide();
					if($findobj.length>0)
					{
						$findobj.show();
						//异步标记已读
						yAjax($readurl,{'id':$id},function($daa){
							
						});
					}else
					{
						addifr($id);
					}


				});
		});
	var ifrurl="<?php echo url(array('action' => 'show'), $this);?>";

	//添加新的ifr
	function addifr($id)
	{
		$url=ifrurl+"&id="+$id;
		$html=" <iframe id=ifr"+$id+" src="+$url+"></iframe>";
		$('#content').append($html);
	}
	function addli($id,$name)
	{
		$html=" <li attr_id="+$id+" class='opencheat' ><a href='###'>"+$name+"</a></li>";
		$('.cheatuserlist').append($html);
	}
	function lilight($id){
		$fobj=$('.cheatuserlist').find('[attr_id='+$id+']');
		if($fobj.length){
			$fobj.addClass('light');
		}
	}
	ywebsock('<?php echo $this->_vars['ip']; ?>
','<?php echo $this->_vars['port']; ?>
','cheat',
		{},function($data)
		{
			$info=$data.data.data;
			if($data.data.action=='cheat' )
			{
				$id=$info.id;
				$fobj=$('.cheatuserlist').find('[attr_id='+$id+']');
				if($fobj.length)
				{

					//闪烁
					lilight($id);
				}else
				{
					addli($id,$info.name);
					lilight($id);
					//闪烁
				}
play();

			}
		});
		
		function play(){
			 
			 $audio="<?php echo $this->_vars['static']; ?>
/audio/recv.wav";
      music_play($audio);
			
			
		}
</script>




<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>	