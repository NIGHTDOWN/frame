<?php /* "/tpl/templets/default/nav.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:10 �й���׼ʱ�� */ ?>

<div class="site-nav">
	<div class="w fn-clear">
		<ul class="fn-left">
			<?php if (! $this->_vars['user']): ?>
			<li class="nav user">
				<div class="nav-fore1">
					<a class="login" href="<?php echo url(array('mod' => 'login'), $this);?>">
						亲，请登录
					</a>
					<a class="reg" href="<?php echo url(array('mod' => 'reg'), $this);?>">
						免费注册
					</a>
				</div>
			</li>
			<?php else: ?>

			<li class="nav drop-down user">
				<div class="nav-fore1">
					<a class="name" href="<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>">
						<?php echo $this->_vars['user']['username']; ?>

						
					</a><img align="absmiddle" src="<?php  echo vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!userlevel!@  param1=@!{$this->_vars['user']['uid']}!@"); ?>">
					<i>
						<em>
						</em>
					</i>
				</div>
				<div class="nav-fore2">
					<ul>
						<li>
							<a href="<?php echo url(array('mod' => 'set','group' => 'user'), $this);?>">
								账号管理
							</a>
						</li>
						<li>
							<a href="<?php echo url(array('mod' => 'login','action' => 'logout','group' => 'index'), $this);?>">
								退出
							</a>
						</li>
					</ul>
					<div>
					</div>
				</div>
			</li>
			<li class="nav msg">
				<div class="nav-fore1">
					<a class="name" href="<?php echo url(array('mod' => 'message','group' => 'user'), $this);?>">
						<span>
							消息
						</span>
					</a>
				</div>
			</li>

			<?php endif; ?>
			<li class="nav drop-down">
				<div class="nav-fore1">
					<a>
						手机逛
					</a>
					<i>
						<em>
						</em>
					</i>
				</div>
				<div class="nav-fore2">
					<ul>
						<li>
							<a href="<?php echo $this->_vars['config']['mobile_url']; ?>
">
								直接进入
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<ul class="fn-right">
			<li class="nav drop-down">
				<div class="nav-fore1">
					<a href="<?php echo url(array('group' => 'user','mod' => 'index'), $this);?>">
						我的商城
					</a>
					<i>
						<em>
						</em>
					</i>
				</div>
				<div class="nav-fore2">
					<ul>
						<li>
							<a href="<?php echo url(array('group' => 'user','mod' => 'order'), $this);?>">
								已买到的商品
							</a>
						</li>
						<li>
							<a href="<?php echo url(array('group' => 'user','mod' => 'collect','action' => 'history'), $this);?>">
								我的足迹
							</a>
						</li>

					</ul>
				</div>
			</li>
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."cart.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
			<li class="nav collect drop-down">
				<div class="nav-fore1">
					<a href="<?php echo url(array('group' => 'user','mod' => 'collection'), $this);?>">
						<span>
							收藏夹
						</span>
					</a>
					<i>
						<em>
						</em>
					</i>
				</div>
				<div class="nav-fore2">
					<ul>
						<li>
							<a href="<?php echo url(array('group' => 'user','mod' => 'collect'), $this);?> ">
								收藏的商品
							</a>
						</li>
						<li>
							<a href="<?php echo url(array('group' => 'user','mod' => 'collect','action' => 'shop'), $this);?>">
								收藏的店铺
							</a>
						</li>
					</ul>
				</div>
			</li>

			<li class="site-nav-pipe">
				|
			</li>
			<li class="nav drop-down">
				<div class="nav-fore1">
					<a href="<?php echo url(array('group' => 'shop','mod' => 'shop'), $this);?>">
						卖家中心
					</a>
					<i>
						<em>
						</em>
					</i>
				</div>
				<div class="nav-fore2">
					<ul>
						<li>
							<a href="<?php echo url(array('mod' => 'shop','group' => 'user'), $this);?>">
								免费开店
							</a>
						</li>
						<li>
							<a href="<?php echo url(array('mod' => 'sells','group' => 'shop'), $this);?>">
								已卖出的商品
							</a>
						</li>
						<li>
							<a href="<?php echo url(array('mod' => 'product','action' => 'sell','group' => 'shop'), $this);?>">
								出售中的商品
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav">
				<div class="nav-fore1">
					<a href="<?php echo url(array('mod' => 'category'), $this);?>">
						商品分类
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>


<div class="" style="padding: 10px 0 0px;background: #FFF;">
	<div class="w fn-clear" >
		<div class="logo">
			<a title="NG" href="<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>">
				<img src="<?php echo $this->_vars['static']; ?>
logo/logo.png">
			</a>
		</div>
		<dl class="code noborder">
			<dd>
				<img width="100" src="<?php echo $this->_vars['indextpl']; ?>
res/down.png">
			</dd>
			<div class="hidden showDown" style="width:232px;height:124px;padding:5px;border:1px solid #AAAAAA;background:#fff;position: absolute;z-index: 9999;">
				<div style="float:left;">
					<img class=" andimg1" src="<?php echo url(array('mod' => 'login','action' => 'qr','args' => "url:" . $this->_vars['config']['android_down'] . ""), $this);?>" width="124" height="124">
					<img class="hidden iosimg1" src="<?php echo url(array('mod' => 'login','action' => 'qr','args' => "url:" . $this->_vars['config']['mac_down'] . ""), $this);?>" width="124" height="124">
				</div>
				<div style="text-align: center; float: right; width: 107px;">
					<p style="color:#DB3407;font-weight: 600; font-family: &#39;微软雅黑&#39;; font-size: 16px;line-height:30px;">
						扫描二维码
					</p>
					<p style="color:#676266;font-weight: 600; font-size: 13px; font-family: &#39;微软雅黑&#39;;line-height:20px;">
						下载手机客户端
					</p>
					<div class="android" style="width:90px;margin:6px auto 0;cursor: pointer;">
						<img class="hidden andimg1" src="<?php echo $this->_vars['indextpl']; ?>
res/Android.png" width="95">
						<img class="andimg2" src="<?php echo $this->_vars['indextpl']; ?>
res/Android-3-1.png" width="95">
					</div>
					<div class="ios" style="width:90px;margin:5px auto 0;cursor: pointer;">
						<img class="iosimg1" src="<?php echo $this->_vars['indextpl']; ?>
res/iOS.png" width="95">
						<img class="hidden iosimg2" src="<?php echo $this->_vars['indextpl']; ?>
res/iOS-3-2.png" width="95">
					</div>
				</div>
			</div>
		</dl>
		<div class="search" style="margin-right: 35px">
			<form action="<?php echo url(array('mod' => 'search'), $this);?>" class="form" method="post">
				<div class="i-search">

					<input autocomplete="off" onkeyup="get_search_word(this.value);" value="" type="text" class="text" id="key" name="word">
				</div>
				<div id="key_select">
				</div>
				<input type="submit" value="搜 索" class="button">
			</form>
			<div class="hotwords">
				<strong>
					热门搜索：
				</strong>
				<?php $this->assign('hot', vo_list("fun=@!get!@ mod=@!hotword!@ type=@!im!@")); ?>
				
				<?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['k'] => $this->_vars['volist']): ?>
				<?php if ($this->_vars['k'] == 0): ?>
				<a
					class="first" target="_blank" href="<?php echo url(array('mod' => 'search','args' => "word:" . $this->_vars['volist']['word'] . ""), $this);?>"><?php echo $this->_vars['volist']['word']; ?>

				</a>
				<?php else: ?>
				<a
					target="_blank" href="<?php echo url(array('mod' => 'search','args' => "word:" . $this->_vars['volist']['word'] . ""), $this);?>"><?php echo $this->_vars['volist']['word']; ?>

				</a>
				<?php endif; ?>
				<?php endforeach; endif; ?>

			</div>
			<script>

				function get_search_word(k)
				{
					if(k!='')
					{
						var url = '<?php echo url(array('mod' => 'search','group' => 'index','action' => 'getmore'), $this);?>';
						var sj = Math.random();
						var pars = 'shuiji=' + sj+'&key='+k;
						$.post(url, pars,showResponse);
					}

					function showResponse(originalRequest)
					{
						originalRequest=jta(originalRequest);
						$html='';
						if(originalRequest.flag)
						{
							$.each(originalRequest.data,function(n,i)
								{

									$html+="<a onclick=\"select_word('"+i.word+"')\" href='#'>"+i.word+"</a>";

								});
						}else
						{
							return 0;
						}

						if(originalRequest)
						{
							$('#key_select').show();
							/*$('#key_select').css("display",'block');*/
							$('#key_select').html($html);
						}
						else
						$('#key_select').hide();
					}

				}
				function select_word(v)
				{
					$('#key').val(v);
					$('#key_select').hide();
				}
			</script>
		</div>

	</div>
</div>
<script>
	$(function()
		{
			if($('.menumove').length>0){
				
			$('.menumove').mousemove(function()
				{

					$(this).find('dd').show();
					$(this).bind('mouseleave',function()
						{
							$(this).find('dd').hide();
						});
				});
}

		});

</script>
<script
	src="<?php echo $this->_vars['indextpl']; ?>
res/kissy.js" type="text/javascript">
</script>

<div class="menu">
	<div class="w">
		<dl class="dl <?php if ($this->_vars['c'] != 'index'): ?>menumove<?php endif; ?>">
			<dt class="dt">
				<h2>
					<a href="javascript:void(0);" >
						全部商品分类
					</a>
				</h2>
			</dt>
			<script>

				$(function()
					{
					/*	document.body.onmousewheel = function(event) {
    event = event || window.event;
    console.dir(event);	
};
document.body.addEventListener("DOMMouseScroll", function(event) {
    console.dir(event);	
});*/
/*
window.addEventListener("mousewheel", (e) => {if (e.deltaY === 1) {e.preventDefault();}})*/
						
						$u='<?php echo url(array('mod' => 'index','action' => 'menu'), $this);?>';
						$jsurl='<?php echo $this->_vars['indextpl']; ?>
res/kissy.menu.js';
						$.get($u,function(data)
							{
								
								$dom=$(data);
								
								if($('.menumove').get(0))
								{
									/*$('.menu dl').find('dd').hide();*/
									$dom.hide();
								}
								/*$('.menu dl').append(data);*/
								$('.menu dl ').append($dom);
								$.getScript($jsurl,null) ;
								
							});

					});
			</script>








		</dl>
		<ul class="menu-items">
			<li class="">
				<a href="<?php echo url(array('mod' => 'index','action' => 'run'), $this);?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo url(array('mod' => 'product','action' => 'category'), $this);?>">
					商品
				</a>
			</li>
			<li>
				<a href="<?php echo url(array('mod' => 'shop','action' => 'run'), $this);?>">
					店铺
				</a>
			</li>
			<li>
				<a href="<?php echo url(array('mod' => 'jfstore','action' => 'run'), $this);?>">
					积分商城
				</a>
			</li>

			<li>
				<a href="<?php echo url(array('mod' => 'purchase','action' => 'run'), $this);?>">
					团购
				</a>
			</li>
			<li>
				<a href="<?php echo url(array('mod' => 'article','action' => 'run'), $this);?>">
					资讯
				</a>
			</li>

			<li class="cart">
				<a href="<?php echo url(array('mod' => 'cart','group' => 'user','action' => 'run'), $this);?>">
					<b>
						<?php  echo vo_list("fun=@!getcount!@ mod=@!cart!@ type=@!im!@ "); ?>
					</b>
					我的购物车
				</a>
			</li>
		</ul>
	</div>
</div>

<script type="text/javascript">
	$('.menu-items li').hover(function()
		{
			$(this).addClass("hover");
		},function()
		{
			$(this).removeClass("hover");
		});
	$(".code").hover(function()
		{
			$(this).find(".showDown").css({"display":"block"})
		},function()
		{
			$(this).find(".showDown").css({"display":"none"})
		})

	$(".android").hover(function()
		{
			$(".androidimg").css({"display":"block"});
			$(".iosimg").css({"display":"none"});

			$(".andimg2").css({"display":"block"});
			$(".andimg1").css({"display":"none"});

			$(".iosimg1").css({"display":"block"});
			$(".iosimg2").css({"display":"none"});
		});

	$(".ios").hover(function()
		{
			$(".androidimg").css({"display":"none"});
			$(".iosimg").css({"display":"block"});

			$(".iosimg2").css({"display":"block"});
			$(".iosimg1").css({"display":"none"});

			$(".andimg1").css({"display":"block"});
			$(".andimg2").css({"display":"none"});
		});
</script>
<script type="text/javascript">
	$('.drop-down').hover(function()
		{
			$(this).addClass("hover");
			if($(this).hasClass("cart"))
			{

			}
		},function()
		{
			$(this).removeClass("hover");
		});
</script>