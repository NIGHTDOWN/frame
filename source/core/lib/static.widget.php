<?php



checktop();
class YWidget extends Y
{

    #初始化 widget
    public static
    function __loading()
    {
        self::_assembleConfig();
    }

    #载入options config
    private static
    function _assembleConfig()
    {
        parent::loadLib('option');
        #模板风格
        #基础设置
      
        $site_base     = YOption::get('site_base');
        #图片设置
        $upload_config = YOption::get('upload_config');
        #全局设置
        $global_config = YOption::get('global_config');
        #组合配置
        $config_array  = array();
    
        if (is_array($site_base)) {
            $config_array = array_merge($config_array, $site_base);
        }

        if (is_array($upload_config)) {
            $config_array = array_merge($config_array, $upload_config);
        }

        if (is_array($global_config)) {
            $config_array = array_merge($config_array, $global_config);
        }

        $config_array['sitefooter'] = $site_footer;
        $config_array['templet'] = 'default';
        parent::$tplpath = 'tpl/templets/'.$config_array['templet'].'/';
        parent::$skinpath = parent::$urlpath.parent::$tplpath;
        parent::$conf = $config_array;

        unset($config_array);
    }
    public static
    function init()
    {
        $name = 'option';
		im(CORE.'cache/cache.file.php');
        $cache= new cfileClass();
        list($bool,$data) = $cache->get($name);
        if ($bool && $data ) {
            return $data;
        }else {
			$dao=new daoClass();
            $data = T('options')->get_all(array('flag'=>0));
            $cache->set($name,$data);
            return $data;

        }

    }
}
?>
