<?php /* "/tpl/shop/search.html" //NG框架模板引擎;仅适用本系统框架; 2018-07-23 19:48:33 �й���׼ʱ�� */ ?>

<style>
	 #key_select {
    background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    border-top: none;
    margin-left: 0px;
    width: 390px;
    height: auto;
    float: left;
    z-index: 10000;
    position: absolute;
    display: none;
    top:30px;
}
	
	
</style>
<div class="search">
        <div class="i-search ld">
        <form method="post" class="form" action="<?php echo url(array('group' => 'index','mod' => 'search'), $this);?>">
          
            <input type="text" autocomplete="off" placeholder="" id="key" name="word" onkeyup="get_search_word(this.value);" class="text">
              <div id="key_select"></div>
            <input type="submit" class="search_button" value="搜索">
        </form>
        </div>
        <div class="hotwords">
            <strong>热门搜索：</strong>
              <?php $this->assign('hot', vo_list("fun=@!get!@ mod=@!hotword!@ type=@!im!@")); ?>
                <?php if (count((array)$this->_vars['hot'])): foreach ((array)$this->_vars['hot'] as $this->_vars['volist']): ?>
                <?php if ($this->_vars['i'] == 1): ?>
                <a class="first" target="_blank" href="<?php echo url(array('group' => 'index','mod' => 'search','args' => "word:" . $this->_vars['volist']['word'] . ""), $this);?>"><?php echo $this->_vars['volist']['word']; ?>
</a>
                <?php else: ?>
<a target="_blank" href="<?php echo url(array('mod' => 'search','group' => 'index','args' => "word:" . $this->_vars['volist']['word'] . ""), $this);?>"><?php echo $this->_vars['volist']['word']; ?>
</a>
<?php endif;  endforeach; endif; ?>

        </div>
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
    	if(originalRequest.flag){
    		$.each(originalRequest.data,function(n,i){
    			$html+="<a onclick=\"select_word('"+i.word+"')\" href='#'>"+i.word+"</a>";
    			
    		});
    	}else{return 0;}
    	
    	        if(originalRequest)
        {
            $('#key_select').show();
        
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
