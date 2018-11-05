<?php /* "tpl/muser/msg_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 13:30:35 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/collect.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_vars['usertpl']; ?>
js/timecacl.js"></script>
<body class="bgee">

	<div style="background: #f5f5f5;">
		<div id="content">




			<div class="mui-page-cont">





				<div class="a-msp-index">
					<div id="bodyCont" class="fullscreen index">

						<header class="jd-header header-section-search header-banner">
							<div class="jd-header-new-bar">
								<div onclick="_go_url('<?php echo url(array('mod' => 'index'), $this);?>')" class="jd-header-icon-back ">
									<span></span>
								</div>
								


									<div class="jd-header-new-title">
										<div class="header-content">
											<span class="header-title">易沟通</span>

										</div>
									</div>
								
								<div onclick="_go_url('<?php echo url(array('mod' => 'index','group' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>


					<div>
						<div style="display: block;" class="cheat_list">

<ul class="cheatuserlist">
			<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['k'] => $this->_vars['volist']): ?>
			<?php  $this->_vars['id']=$this->_vars['volist']['uid']==$this->_vars['user']['uid']?1:2; ?>
			<?php  $this->_vars['uid']=$this->_vars['volist']['uid']==$this->_vars['user']['uid']?$this->_vars['volist']['touid']:$this->_vars['volist']['uid']; ?>
			<?php  $this->_vars['idnum']='u'.$this->_vars['id'].'num'; ?>
			<li class="opencheat  " attr_id='<?php echo $this->_vars['volist']['id']; ?>
'>
			<div class="u-head">
				<img src="<?php echo $this->_vars['static']; ?>
images/head.png" data="<?php echo $this->_vars['uid']; ?>
">
			</div>
			<div class="u-body">
			<div class="u-name ">
			<span   class="u-name sl">
					<?php if ($this->_vars['volist']['uid'] == $this->_vars['user']['uid']): ?>
					<?php echo $this->_vars['volist']['u2name']; ?>

					<?php else:  echo $this->_vars['volist']['u1name']; ?>

					<?php endif; ?>
					
				</span>
				<span   class="u-chtime" attr-time="<?php echo $this->_vars['volist']['chtime']; ?>
">
					
				</span>
				
				</div>
				<div class="u-msgs">
					<span class="u-msg "><msg class='sl'></msg><div class="zz"></div></span>
					<span class="u-msgnum none" data="<?php echo $this->_vars['volist'][$this->_vars['idnum']]; ?>
"></span>
				</div>
				</div>
			</li>
			<?php endforeach; endif; ?>
		</ul>

						</div>

						

					</div>
				</div>
				<div class="page">
					<?php echo $this->_vars['page']; ?>

				</div>


			</div>

		</div>


	</div>
	<box id="box" style="display: none">
		<li class="opencheat" attr_id=''>
			<div class="u-head">
				<img src="<?php echo $this->_vars['static']; ?>
images/head.png" >
			</div>
			<div class="u-body">
			<div class="u-name ">
			<span   class="u-name sl">
					
					
				</span>
				<span   class="u-chtime" attr-time="<?php echo $this->_vars['volist']['chtime']; ?>
">
					
				</span>
				
				</div>
				<div class="u-msgs">
					<span class="u-msg "><msg class='sl'></msg><div class="zz"></div></span>
					<span class="u-msgnum none" data="<?php echo $this->_vars['volist'][$this->_vars['idnum']]; ?>
"></span>
				</div>
				</div>
			</li>
			<iframe  class="u-iframe">
				</iframe>
	</box>
<audio  id='recvaudio' src="" >
 
</audio>
<div class="ucontent">
	
</div>
	</div>
<script>
var headurl="<?php echo url(array('mod' => "msg",'action' => "gethead"), $this);?>";
var lasturl="<?php echo url(array('action' => "getlast"), $this);?>";
	
	$(function(){
		inituser();
		$readurl='<?php echo url(array('action' => 'read','mod' => 'msg'), $this);?>';
		$showurl='<?php echo url(array('action' => 'show','mod' => 'msg'), $this);?>';
			$('.opencheat').live('click',function()
				{
					$id=$(this).attr('attr_id');
					$findid="#ifr"+$id;
					$numobj=$(this).find('.u-msgnum');
					$num=$numobj.attr('data');
					if($num>0)
					{
						yAjax($readurl,{'id':$id},function($daa){
							$numobj.attr('data',0);
							$numobj.text();
							$numobj.hide();
						});
						
					}
					opencheat($id);
						/*_go_url_new($opurl);*/
				});



	});
	function hideifr(){
		
	$content=$('.ucontent');
	$content.find('iframe').hide();	
	/*$content.hide();	*/
	}
	function opencheat($id){
		if(!$id)return false;
		$sid="#ifr"+$id;
		$content=$('.ucontent').eq(0);
		$findobj=$content.find($sid);
		hideifr();
		
		if($findobj.length<=0){
			/*d('执行s');*/
			$opurl=$showurl+"&id="+$id;
			$ifr=$('#box').find('iframe').clone();
			$ifr.attr('id',"ifr"+$id);
			$ifr.attr('src',$opurl);
			$content.eq(0).append($ifr);
			$findobj=$content.find($sid);
		
		}
		/*$content.show();*/
		$findobj.show();
		
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
					gxlast($id,$info);
				}else
				{
					addli($id,$info);
					gxlast($id,$info);
					//闪烁
				}
			play();

			}
		});
		function addli($id,$info){
		$addli=$('#box').find('li').clone();
		$addli.attr('attr_id',$info['id']);	
		
		$addli.find('span.u-name').text($info.name);
		$addli.find('msg.zz').html($info.msg);	
		/*$addli.find('msg.zz').html($info.msg);	*/
		$addli.find('.u-msgnum').attr('data','0');	
		/*$addli.find('.u-msgnum').attr('data','1');*/
		//还没写完
		$img=$addli.find('.u-head img');
		
			gethead($img,$info.fid);
			$('ul.cheatuserlist').prepend($addli);
			
		}
		function gxlast($id,$data){
			$fobj=$('.cheatuserlist').find('[attr_id='+$id+']');
			$string=$data.msg;
			
			$string.replace(/<img(.*?)>/g, "[图片]")
			$fobj.find('.u-msg msg').html($string);
			$num=$fobj.find('.u-msgnum').attr('data');
			$fobj.find('.u-msgnum').attr('data', parseInt($num)+1);
			$fobj.find('.u-chtime').attr('data-time',$data.sendtime);
			
			$fobj.find('.u-chtime').text(showtime($data.sendtime));
			loaduser($fobj[0]);
			$par=$fobj.parent();
			$index=$par.find($fobj).index();

			if($index>0){
				$html=$fobj.html();
				$fobj.remove();
				$par.prepend($fobj);
			}
			play();
		}
	
		function play(){
			  $audio="<?php echo $this->_vars['static']; ?>
/audio/recv.wav";
      music_play($audio);
			return true;
			
			
		}
	
</script>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>