<?php require_once('E:\www\ng169\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "/tpl/templets/default/pmenu.html" //NG框架模板引擎;仅适用本系统框架; 2018-10-11 22:05:18 �й���׼ʱ�� */ ?>

		
	<script type="text/javascript">
	var cheaturl="<?php echo url(array('mod' => 'msg','group' => 'user','action' => 'cheat'), $this);?>";
				$(document).ready(function(){
						$(".add-cart").click(function(){
							if ('<?php echo $this->_vars['user']['uid']; ?>
'=='')
								{
									alert('请登入用户');
									window.location.href='<?php echo url(array('mod' => 'login','action' => 'run'), $this);?>';
									return;
								}
								if ('<?php echo $this->_vars['data']['muid']; ?>
'=='<?php echo $this->_vars['user']['muid']; ?>
')
								{
									alert('不能购买自己店铺的商品！');
									return;
								}
								flag=buy();
							
								if(flag)
								{
									
									var num=$('#nums').val();
									var pid='<?php echo $this->_vars['data']['productid']; ?>
';
									var gpid='<?php echo $this->_vars['groupon']['gpid']; ?>
';
									var spec=goodsspec.getSpecstring();
									
								
									$arr={'pid':pid,'num':num,'spec':spec};
									yAjax('<?php echo url(array('group' => 'user','mod' => 'cart','action' => 'add'), $this);?>',$arr,function(data){
										
						if(data.flag){
							$('#cart_show').fadeIn(500);
							$('#cartnum').text(data.data);
						x=$(".buy_box").offset();
						$("#cart_show").offset({top:x.top,left:x.left});return true;
						}else{
							showd(data.error.errormsg);return false;
						}
							
									});
								
									return false;
								}
							});
						$("#low_num").click(function(){
								var num=$('#nums').val()*1;
								if(num>1)
								$('#nums').val(num-1);
								check_nums()
								
							});
						$("#add_num").click(function(){
								var num=$('#nums').val()*1;
								if(num<$('#stock').html())
								$('#nums').val(num+1);
								check_nums()
							});
					});
			
			
				function buy()
				{
					var flag = false;
					$('ul[genre="property"]').each(function(){
							if(!$(this).find('a').hasClass('checked')){
								flag = true;
							}
						});
					if (goodsspec.getSpec() == null || flag)
					{
						alert('请选择相关规格');
						return !flag;
					}
					else
					{
						return !flag;
					}
				}
			</script>	

		<script type="text/javascript">
			function getfavshop($id)
			{	
				var url = '<?php echo url(array('mod' => 'shop','action' => 'collect'), $this);?>';
	
				var uname='<?php echo $this->_vars['user']['username']; ?>
';
				if(uname=='')
				{
					alert('请登录以后再进行本操作！');
					window.location.href='<?php echo url(array('mod' => 'login','action' => 'run'), $this);?>';
					return false;
				}
				
				/*$.post(url, pars,showResponse);*/
				yAjax(url,{'muid':$id},showResponse);
				function showResponse(data)
				{
					if(data.flag){
						showd(data.data);
					}else{
						showd(data.error.errormsg);
					}
				}
	
			}
			function getfavp($id)
			{	
				var url = '<?php echo url(array('mod' => 'product','action' => 'collect'), $this);?>';
	
				var uname='<?php echo $this->_vars['user']['username']; ?>
';
				if(uname=='')
				{
					alert('请登录以后再进行本操作！');
					window.location.href='<?php echo url(array('mod' => 'login','action' => 'run'), $this);?>';
					return false;
				}
				
				/*$.post(url, pars,showResponse);*/
				yAjax(url,{'productid':$id},showResponse);
				function showResponse(data)
				{
					if(data.flag){
						showd(data.data);
					}else{
						showd(data.error.errormsg);
					}
				}
	
			}
			function like($id)
			{	
				var url = '<?php echo url(array('mod' => 'product','action' => 'like'), $this);?>';
	
			
				
				/*$.post(url, pars,showResponse);*/
				yAjax(url,{'productid':$id},showResponse);
				function showResponse(data)
				{
					if(data.flag){
						showd(data.data);
					}else{
						showd(data.error.errormsg);
					}
				}
	
			}
			<?php $this->assign('kf', vo_list("fun=@!get!@ type=@!im!@ mod=@!kf!@   param1=@!{$this->_vars['data']['muid']}!@")); ?>
			$(function(){
				$str='<?php if (count((array)$this->_vars['kf'])): foreach ((array)$this->_vars['kf'] as $this->_vars['volist']):  echo $this->_vars['volist']['num']; ?>
|<?php echo $this->_vars['volist']['name']; ?>
|<?php echo $this->_vars['volist']['type']+1;  if ($this->_vars['i'] != ( $this->_run_modifier($this->_vars['kf'], 'sizeof', 'PHP', 1) )): ?>,<?php endif;  endforeach; endif; ?>';
				$str=trim($str,',');
					$("body").Sonline({
							Qqlist:$str //多个QQ用','隔开，QQ和客服名用'|'隔开
						});
				});
  	
	
		</script>
		
	</head>
	<body>

		<div class="site-nav">
			<div class="w">
				<ul class="left">
				<?php if (! $this->_vars['user']): ?>
					<li><a class="login" href="<?php echo url(array('mod' => 'login'), $this);?>">亲，请登录</a>
					<a class="reg" href="<?php echo url(array('mod' => 'reg'), $this);?>">免费注册</a></li>
					<?php else: ?>
					
<LI sizcache="3" sizset="0">

欢迎来<A class=name href="<?php echo url(array('mod' => 'index','group' => 'user','args' => "uid:" . $this->_vars['user']['uid'] . ""), $this);?>">
<?php echo $this->_vars['user']['username']; ?>
</A> ！&nbsp;<A href="<?php echo url(array('mod' => 'login','action' => 'logout'), $this);?>">退出</A> </li>
					
					<?php endif; ?>
				</ul>
				<ul class="right">
					<li class="nbr"><a href="<?php echo url(array('group' => 'user','mod' => 'message'), $this);?>" class="note">站内消息</a></li>
					<li><a href="<?php echo url(array('mod' => 'clloct'), $this);?>">收藏夹</a></li>
					<li><a href="<?php echo url(array('mod' => 'cart'), $this);?>" class="shopping">购物车<span>
					<?php if ($this->_vars['user']): ?>
					<?php  echo vo_list("fun=@!getcarts!@ type=@!im!@ mod=@!ucount!@ param1=@!{$this->_vars['user']['uid']}!@"); ?>
						<?php else: ?>0<?php endif; ?>
					</span>件</a></li>
					<?php if ($this->_vars['user']['muid']): ?>
					<li><a href="<?php echo url(array('mod' => 'shop','group' => 'shop'), $this);?>">卖家中心</a></li>
					
					<li><a href="<?php echo url(array('mod' => 'index','group' => 'user'), $this);?>">我的商城</a></li>
					<?php else: ?>
					<li><a href="<?php echo url(array('mod' => 'index','group' => 'user','args' => "uid:" . $this->_vars['user']['uid'] . ""), $this);?>">买家中心</a></li>
					<?php endif; ?>
					<li><a href="<?php echo url(array('mod' => 'index'), $this);?>" class="index">首页</a></li>
				</ul>
			</div>
		</div>


		<div class="header">
			<div class="w">
				<div class="logo" style='padding:0px'>
					<a href="<?php echo url(array('mod' => 'index'), $this);?>">
       
						<img width="170"  src="<?php echo $this->_vars['static']; ?>
logo/logo.png">
					</a>
				</div>
         
				<div class="shop_info">
					<div class="shop_info_simple">
						<p><a class="shop_name" href="<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><?php echo $this->_vars['data']['merchantname']; ?>
</a></p>
						<div class="shop_credit">
						<?php $this->assign('shoplevel', vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!shoplevel!@  param1=@!{$this->_vars['data']['muid']}!@")); ?>
							<span><img alt="<?php echo $this->_vars['data']['slevel']; ?>
" title="<?php echo $this->_vars['data']['slevel']; ?>
" align="absmiddle" src="<?php echo $this->_vars['shoplevel']; ?>
"></span>
						</div>
					</div>
					<div class="shop_info_details">
						<dl style="width:190px">
							<dt>描述相符：</dt>
							<dd><span class="star"><em style=" width: <?php  echo ($this->_vars['data']['mspf'])/0.05; ?>%"><?php echo $this->_vars['data']['mspf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['mspf']; ?>
分</span></dd>
							<dt>服务态度：</dt>
							<dd><span class="star"><em style=" width: <?php  echo ($this->_vars['data']['fwpf'])/0.05; ?>%"><?php echo $this->_vars['data']['fwpf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['fwpf']; ?>
分</span></dd>
							<dt>发货速度：</dt>
							<dd><span class="star"><em style=" width: <?php  echo ($this->_vars['data']['wlpf'])/0.05; ?>%"><?php echo $this->_vars['data']['wlpf']; ?>
</em></span><span class="num"><?php echo $this->_vars['data']['wlpf']; ?>
分</span></dd>
						</dl>
						<dl style="width:160px">
							<dt>店主：</dt>
							<dd><?php echo $this->_vars['data']['username']; ?>
</dd>
							<dt>创店时间：</dt>
							<dd><?php echo $this->_run_modifier($this->_vars['data']['createtime'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</dd>
						</dl>
						<dl style="width:150px">
							<dt>商品数量：</dt>
							<dd><?php  echo vo_list("fun=@!get_count!@ mod=@!product!@  array=@!'pflag:1,muid:'{$this->_vars['data']['muid']}!@}"); ?></dd>
                   
						</dl>
						<dl style="width:150px">
						<dt>认证信息：</dt>
               <dd> <?php if ($this->_vars['data']['rzflag'] == 2): ?>
                <img src="<?php echo $this->_vars['indextpl']; ?>
res/ico/certification_no.gif">
                 <?php elseif ($this->_vars['data']['rzflag'] == 1): ?>
                <img src="<?php echo $this->_vars['indextpl']; ?>
res/ico/certautonym_no.gif">
                <?php endif; ?></dd>
					</dl>	
						
						<dl style="width:320px">
							<dt>所在地区：</dt>
							<dd><?php echo $this->_run_modifier($this->_vars['data']['provinceid'], 'getprovince', 'PHP', 1); ?>
 <?php echo $this->_run_modifier($this->_vars['data']['cityid'], 'getcity', 'PHP', 1); ?>
 <?php echo $this->_run_modifier($this->_vars['data']['areaid'], 'getarea', 'PHP', 1); ?>
 <?php echo $this->_vars['data']['address']; ?>
</dd>
						</dl>
						
						
						
					</div>
				</div>
        
				<div class="shop-search">
					<div>
						<form action="" method="post" id="search_form">
						<script>
							$(function(){
							$('.search_btn').click(
		function(){
				$url='<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>';
							$('#search_form').attr('action',$url);
							$('#search_form').submit();
		}
							);	
							$('.search_btn_platform').click(function(){
								$url='<?php echo url(array('mod' => 'search'), $this);?>';
							$('#search_form').attr('action',$url);
							$('#search_form').submit();	
								
							});	
							
							});
							
						</script>
							<input type="text" autocomplete="off"  value="" id="keyword" name="word" class="search_input">
							<input type="button" value="搜本店" class="search_btn">
							<input type="button" value="搜平台" class="search_btn_platform">
							

						</form>
					</div>
					<div id="key_select"></div>
				</div>
			</div>
		</div>
		<?php if ($this->_vars['data']['header']): ?>
		<div style="background:url(<?php echo $this->_vars['data']['header']; ?>
) center top no-repeat;">
		<?php endif; ?>
			<div id="nav">
				<div class="banner"></div>
				<div class="nav_bg">
					<div class="w">
						<ul class="clearfix">
							
							<li class="normal"><a href="<?php echo url(array('mod' => 'shop','action' => 'show','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><span>店铺首页</span></a></li>
							<li class="normal"><a href="<?php echo url(array('mod' => 'product','action' => 'list','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><span>产品展厅</span></a></li>
							<li class="normal"><a href="<?php echo url(array('mod' => 'shop','action' => 'intro','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><span>店铺介绍</span></a></li>
							<li class="normal"><a href="<?php echo url(array('mod' => 'shop','action' => 'comment','args' => "id:" . $this->_vars['data']['muid'] . ""), $this);?>"><span>信用评价</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
			<script type="text/javascript">
			$(function(){
				$(".sell-counter").click(function(){
						$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
						$(".inner-wrap li").eq(2).addClass("cur").siblings().removeClass("cur");
						$(".con .i-con").eq(2).show().siblings(".i-con").hide();
					});
				$(".rate-counter").click(function(){
						$("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
						$(".inner-wrap li").eq(1).addClass("cur").siblings().removeClass("cur");
						$(".con .i-con").eq(1).show().siblings(".i-con").hide();
					});
					$(".inner-wrap li").click(function(){
						var b=$(".inner-wrap li").index($(this));
						$(this).addClass("cur").siblings().removeClass("cur");
						$(".con .i-con").eq(b).show().siblings(".i-con").hide();
					});
				$('#jqzoom li').hover(function(){
						$(this).addClass("hover").siblings().removeClass("hover");;
					});
				$(".jqzoom").imagezoom();
				$("#jqzoom li").mouseover(function(){
						$(".jqzoom").attr('src',$(this).find("img").attr("big"));
						$(".jqzoom").attr('rel',$(this).find("img").attr("big"));
					});
				$('.ercode a').click(function(){
					
						if($('.qrcode').css('display')=='block')
						$('.qrcode').hide();
						else
						$('.qrcode').show();
					});
			
				
				$(".btn-buy").click(function(){
					$("#form").find('[name=num]').val($('#nums').val());
					$("#form").find('[name=spec]').val(goodsspec.getSpecstring());
						$("#form").submit();
					});
					});
				function check_nums()
				{
					var v=document.getElementById('nums').value*1;
					var stock = $('#stock').html()*1;
					var maxbuy = ""

					if(maxbuy > 0 && maxbuy<stock)
					{
						stock = maxbuy;
					}
					if(!v)
					document.getElementById('nums').value=1;
					if(v>stock)
					{
						document.getElementById('nums').value=stock;
						return false;
					}
				}
				function spec(id, spec, price, stock)
				{
					this.id    = id;
					this.spec  = spec;
					this.price = price;
					this.stock = stock;
				}
				function goodsspec(specs, specQty, defSpec)
				{
					this.specs = specs;
					this.value = new Array();
					this.name = new Array();
					this.specQty = specQty;
					this.defSpec = defSpec;
					/*this.spec1 = null;
					this.spec2 = null;*/
					if (this.specQty >= 1)
					{
						for(var i = 0; i < this.specs.length; i++)
						{
							if (this.specs[i].id == this.defSpec)
							{
								break;
							}
						}
					}
					this.getSpec = function()
					{
						for (var i = 0; i < this.specs.length; i++)
						{
							return this.specs[i];
						}
						return null;
					}
				this.getSpecstring = function()
					{
						var string='';
for(var key in goodsspec.name){string+=goodsspec.name[key]+':'+goodsspec.value[key]+',';}  
						string=trim(string,',');
						return string;
					}
				}
				function selectSpec(num,obj, name,SID)
				{
					goodsspec['name'][num] = name;
					goodsspec['value'][ num] = SID;
					/*var id = $(obj).parent().parent().parent().parent().attr('id');
					if(id=='color')
					{
						var data_str = $(obj).attr('data-param');
						if(data_str)
						{
							eval("data_str = "+data_str);
							$('.jqzoom').attr("src",data_str.src);
							$('.jqzoom').attr("rel",data_str.src);
						}
						else{
							var src="";
							$('.jqzoom').attr("src",src);
							$('.jqzoom').attr("rel",src);
						}
					}*/

					$(obj).addClass("checked");
					$(obj).parents('li').siblings().find('a').removeClass("checked");

					var spec = goodsspec.getSpec();
					
					var sign = 't';
					$('ul[genre="property"]').each(function(){
							if(!$(this).find('a').hasClass('checked')){
								sign = 'f';
							}
						});
					if (spec != null && sign == 't')
					{
						/*$('#stock').html(spec.stock);*/
						/*$('#price').html(spec.price.toFixed(2));*/
					/*	$('#sid').val(spec.id);*/

						if(parseInt(spec.stock) == 0)
						{
							$('.choose_result').show().html('<div class="dd"><em>库存量不足，请选择其它。</em></div>');
							$('#addcart_submit').attr('disabled',true).css('cursor','pointer');
						}
						else
						{
							SP_V = '';
							$('ul[genre="property"]').find('li > .checked').each(function(i){
									SP_V += '<strong>"'+$(this).text()+'"</strong>，';
								});
							SP_V = SP_V.substr(0,SP_V.length-1);
							$('.choose_result').show().html('<em>您选择了：</em>'+SP_V+'');
							$('#addcart_submit').attr('disabled',false).css('cursor','auto');
							$('#nums').val("1");
						}
					}

				}
				
				
			
			</script>
			<script type="text/javascript">
			$(".block_ico,.none_ico").click(function(e){
					var xx = e.originalEvent.x || e.originalEvent.layerX || 0; 
					var lo = $(this).offset().left

					if($(this).parents("li").find("ul").length > 0)
					{
						if($(this).parents("li").find("ul").is(":visible"))
						{

							$(this).parents("li").find("ul").slideUp()
							$(this).removeClass("none_ico").addClass("block_ico")
						}
						else
						{
							$(this).parents("li").find("ul").slideDown()
							$(this).removeClass("block_ico").addClass("none_ico")
						}
					}
        
					if(xx*1 - lo*1 < 22)
					{
						return false
					}
				})


			$(".search_btn").mouseover(function(e){
					$('#search_form').attr('action', "");
				})

			$(".search_btn_platform").mouseover(function(e){
					$('#search_form').attr('action', "");
				})


			function get_search_word(k)
			{
				if(k!='')
				{
					var url = '';
					var sj = Math.random();
					var pars = 'shuiji=' + sj+'&search_flag=1&key='+k;
					$.post(url, pars,showResponse);
				}

				function showResponse(originalRequest)
				{
					if(originalRequest)
					{
						$('#key_select').show();
						//$('#key_select').css("display",'block');
						$('#key_select').html(originalRequest);
					}
					else
					$('#key_select').hide();
				}

			}
			function select_word(v)
			{
				$('#keyword').val(v);
				$('#key_select').hide();
			}

		</script>