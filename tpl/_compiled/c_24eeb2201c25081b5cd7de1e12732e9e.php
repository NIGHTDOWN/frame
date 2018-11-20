<?php /* "ngtpl[start]:/tpl/admin/top/headerjs.html:[end]" 

	//NG框架模板引擎;仅适用本系统框架; 2018-11-20 09:45:17 */ ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_vars['page_charset']; ?>
" />
    <title>
        <?php echo $this->_vars['data']['title'];  echo $this->_vars['config']['site_name']; ?>

    </title>

    <meta name="author" content="NG" />
    <!--ȫ�ֵĊS-->
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/jquery.min.js'>
    </script>
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/manhuaDate.js'>
    </script>
    
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/night_Trad.v1.0.js'>
    </script>
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/kindeditor.js'>
    </script>
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/zh_CN.js'>
    </script>
    <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ajaxfileupload.js'>
    </script>
     <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/TableOrder.js'>
    </script>
     <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/ZhCN_Pinyin.min.js'>
    </script>
     <script
        type='text/javascript' src='<?php echo $this->_vars['static']; ?>
js/data2.js'>
    </script>
    <!--ȫ�ֵĊS-->
    <!--ҳæ�ĊS-->
    <script
        type='text/javascript' src="<?php echo $this->_vars['admintpl']; ?>
js/page.js" >
    </script>
    <!--ȫ�ֵĊS-->
    <!--ҳæ�ĊS-->
    <!--ȫ�ֵăSS--> 
      <link rel="stylesheet" type="text/css" href='<?php echo $this->_vars['static']; ?>
js/data2.css' />
    <link rel="stylesheet" type="text/css" href='<?php echo $this->_vars['static']; ?>
css/date.css' />
    <link rel="stylesheet" type="text/css" href='<?php echo $this->_vars['static']; ?>
css/global.css' />
    <!--ȫ�ֵăSS-->
    <!--ҳæ�ăSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['urlpath']; ?>
tpl/admin/css/oemain.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['urlpath']; ?>
tpl/admin/css/oeadmin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['urlpath']; ?>
tpl/admin/css/font_icon.css" />
    <!--ҳæ�ăSS-->


    <link type="image/x-icon" href="/favicon.ico" rel="icon">


    <script>
        //��ʼ��ͼƬɏ��·��
        _ajax_file_url='<?php echo \ng169\hook\url(array('group' => 'index','mod' => 'upimg'), $this);?>';
        //��ʼ��ajax�ٗ�·��
        _admin_ajax_url='<?php echo \ng169\hook\url(array('group' => "admin",'mod' => "ajax",'action' => "run"), $this);?>';
        _ajax_area_url = '<?php echo \ng169\hook\url(array('action' => "ajax",'mod' => "area",'group' => "index"), $this);?>';
        _ajax_edit_url = '<?php echo \ng169\hook\url(array('action' => "json_up",'mod' => "upimg",'group' => "index"), $this);?>';
        // ��ʼ��404ͼƬ
        $(function(){
                $('img').error(function(){
                        this.src='<?php echo $this->_vars['img404']; ?>
';
                    });
            });
        $use_K_item=[ "fullscreen","source", "quickformat", "justifyleft", "justifycenter", "justifyright", "justifyfull", "insertorderedlist", "insertunorderedlist",  "formatblock", "fontname", "fontsize", "|", "forecolor", "hilitecolor", "bold", "italic", "underline", "strikethrough", "removeformat", "|", "image", "multiimage", "emoticons"];
        //afterBlur: function () { this.sync(); } ���攚,ԲӃjq̡����,��ȡ����΄��ǸӲ�Ė�
        //   KindEditor.options.items =  $use_K_item;
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id', { uploadJson: _ajax_edit_url, afterBlur: function () { this.sync(); } });
window.editor = K.create('.editor_id', { uploadJson: _ajax_edit_url, afterBlur: function () { this.sync(); } });
            });
        //KindEditor.sync();
        var prevshow = null;


        function openurl($url,$obj){
            closebox();
            $top=($obj.offset().top)+20;
            $html="<iframe src='"+$url+"' onload='SetCwinHeight(this);'></iframe>";
            if($top>($(window).height())){$top=($(window).height())/2;}
            msgbox('',$html,$('body').width(),'auto',1,$top,0,999);
         
        }
        function SetCwinHeight(obj)
        {
            var cwin=obj;
            if (document.getElementById)
            {
                if (cwin && !window.opera)
                {
                    if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight)
                    cwin.height = cwin.contentDocument.body.offsetHeight + 20;
                    else if(cwin.Document && cwin.Document.body.scrollHeight)
                    cwin.height = cwin.Document.body.scrollHeight + 10;
                }
            }
        }

        
    </script>
    <style>
    	.jtu{background:url('<?php echo $this->_vars['admintpl']; ?>
images/jtu.png') no-repeat right center; background-size: 5%}
    	.jtd{background:url('<?php echo $this->_vars['admintpl']; ?>
images/jtd.png') no-repeat right center; background-size: 5%}
    </style>
</head>
