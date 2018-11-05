<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/muser/message_index.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-15 03:32:30 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<link href="<?php echo $this->_vars['usertpl']; ?>
css/collect.css" rel="stylesheet" type="text/css" />

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
											<span class="header-title">我的消息</span>

										</div>
									</div>
								
								<div onclick="_go_url('<?php echo url(array('mod' => 'index','group' => 'index','action' => 'run'), $this);?>')" class="jd-header-icon-new-shortcut ">
									<span></span>
								</div>
							</div>
						</header>


					</div>


					<div>
						<div style="display: block;" class="search-bar">


							<span class="category on" onclick="_go_url('<?php echo url(array('action' => 'run'), $this);?>')">系统消息</span>
							<span class="category " onclick="_go_url('<?php echo url(array('mod' => 'msg'), $this);?>')">聊天消息</span>

						</div>

						<div class="product-list" style="display: block;">
							<div class="list-items">
								<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
								<a href="#" class="msgbox" >
									<div class="msg-title" >
										<span  class="mtitle <?php if ($this->_vars['volist']['uread'] == 0): ?>new<?php endif; ?>"><?php echo $this->_vars['volist']['title']; ?>
</span>
										<span class="time"><?php echo $this->_run_modifier($this->_vars['volist']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</span>
									</div>
									<div class="msg-content" ><?php echo $this->_vars['volist']['content']; ?>

										</div>
									<div class="msg-more" >
										<div class="btn-more" onclick="_go_url('<?php echo url(array('action' => 'show','args' => "msgid:" . $this->_vars['volist']['msgid'] . ""), $this);?>')" >查看</div>
									
									<div class="cancel" do="_go_url('<?php echo url(array('action' => 'del','args' => "msgid:" . $this->_vars['volist']['msgid'] . ""), $this);?>')"  onclick='boxyn($(this))'></div>

								</div>
								</a>
								<?php endforeach; endif; ?>
							</div>
						</div>

					</div>
				</div>
				<div class="page">
					<?php echo $this->_vars['page']; ?>

				</div>






			</div>










		</div>












	</div>

	</div>

	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['usertpl']."foot.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>