<?php require_once('F:\www\ds\source\core\template\src\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format");  /* "tpl/mtpl/comment_list.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-14 22:27:29 �й���׼ʱ�� */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['indextpl']."top.html", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<style>
	.lib-rates {
    color: #061b28;
    background-color: #fff;
    height: 100%;
    font-family: Helvetica,sans-serif;
    padding:  .82rem;
    font-weight: 400;
    color: #051b28;
   
}
.lib-rates .lib-rates-tags {
    padding-bottom: .32rem;
    border-bottom: .013333rem solid #e7e7e7;
}
.lib-rates .lib-rates-tags .cur {
    background: #f50;
    color: #fff;
}

.lib-rates .lib-rates-tags li {
    display: inline-block;
	margin: .26rem 0 0.36rem .46rem;
    padding: .053333rem .16rem;
    background: #ffefef;
    border-radius: .106667rem;    padding: .1rem 0.8rem;
}
.lib-rates .rates_content_box li {
    padding-bottom: .32rem;
    border-bottom: .013333rem solid #e7e7e7;
}
.lib-rates .lib-rates-header {
    padding: .32rem 0;
}
.lib-rates .lib-rates-header .rates_header_img {
	width: 2.5rem;
    height: 2.5rem;
    border-radius: 100%;
    overflow: hidden;
}
.lib-rates .lib-rates-header>div {
    display: inline-block;
    vertical-align: middle;
    font-size: .32rem;
}
.lib-rates-feedbackDate {
    padding-top: .16rem;
    font-size: .266667rem;
    color: #999;
}
.lib-rates .lib-rates-feexPic img {
    min-width: 3rem;
    min-height: 3rem;
    height: 3rem;
}
</style>
<div class="pop-main hide">
		<div class="lib-rates">
			<div class="lib-rates-tags">
				<ul>

					<li class="rates_tag_feedAllCount <?php if ($this->_vars['im'] == 0 && $this->_vars['cm'] == -1): ?>cur<?php endif; ?>"  onclick="_go_url('<?php echo url(array('action' => 'list','mod' => 'comment','args' => "productid:" . $this->_vars['get']['productid'] . ""), $this);?>')">全部</li>
					<li class="rates_tag_feedGoodCount <?php if (( $this->_vars['get']['cmlevel'] ) == 1): ?>cur<?php endif; ?>"  onclick="_go_url('<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:1,productid:" . $this->_vars['get']['productid'] . ""), $this);?>')">好评</li>
					<li class="rates_tag_feedNormalCount <?php if ($this->_vars['im'] == 0 && $this->_vars['cm'] == 0): ?>cur<?php endif; ?>"  onclick="_go_url('<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:0,productid:" . $this->_vars['get']['productid'] . ""), $this);?>')">中评</li>
					<li class="rates_tag_feedBadCount <?php if (( $this->_vars['get']['cmlevel'] ) == 2): ?>cur<?php endif; ?>"  onclick="_go_url('<?php echo url(array('action' => 'list','mod' => 'comment','args' => "cmlevel:2,productid:" . $this->_vars['get']['productid'] . ""), $this);?>')">差评</li>
					<li class="rates_tag_feedBadCount <?php if (( $this->_vars['get']['img'] ) == 1): ?>cur<?php endif; ?>"  onclick="_go_url('<?php echo url(array('action' => 'list','mod' => 'comment','args' => "img:1,productid:" . $this->_vars['get']['productid'] . ""), $this);?>')">有图</li>

				</ul>
			</div>
			<div class="rates_content">
				<div class="rates_content_box" >
					<div class="rates_content_list">
						<ul>
						<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['volist']): ?>
							<li>
								<div class="lib-rates-header" data-spm-anchor-id="a2141.7c.0.i49">
									<div class="rates_header_img">
										<img src="<?php echo $this->_vars['volist']['headimg']; ?>
" style='    width: 100%;'>
									</div>
									<div class="rates_header_nick"><?php echo $this->_run_modifier($this->_vars['volist']['username'], 'incode', 'PHP', 1); ?>
</div>
									<div class="rates_header_star">
										<img src="<?php  echo vo_list("fun=@!getlevelimg1!@ type=@!am!@ mod=@!userlevel!@  param1=@!{$this->_vars['volist']['uid']}!@"); ?>">
									</div>
								</div>

								<div class="lib-rates-content" ><?php echo $this->_vars['volist']['cmcontent']; ?>
</div>

								<div class="lib-rates-feedbackDate"><?php echo $this->_run_modifier($this->_vars['volist']['cmtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
<span style="margin-left: 20px"><?php echo $this->_vars['volist']['specs']; ?>
</span></div>
							
								
								 <?php if ($this->_vars['volist']['cmimg']): ?>	<div class="lib-rates-feexPic" ><span>
				<?php if (count((array)$this->_run_modifier(",", 'explode', 'PHP', 1, $this->_vars['volist']['cmimg']))): foreach ((array)$this->_run_modifier(",", 'explode', 'PHP', 1, $this->_vars['volist']['cmimg']) as $this->_vars['value']): ?>
            	<img src='<?php echo $this->_run_modifier($this->_vars['value'], 'imgsize', 'PHP', 1, '40,40'); ?>
'  onclick="window.open('<?php echo $this->_vars['value']; ?>
')"  class="rates_pic"/>
            	<?php endforeach; endif; ?></span>
            	<?php endif; ?>
								</div>
							</li>
						
							<?php endforeach; endif; ?>
						</ul>
					</div>
					<div class="page" >
						<?php echo $this->_vars['page']; ?>

					</div>
				</div>
			</div>
		</div>
	</div>