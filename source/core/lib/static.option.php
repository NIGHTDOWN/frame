<?php





checktop();
class YOption extends Y
{

	
	public static function get($optionname)
	{
		$need_unserialize = array('active_plugins', 'site_base', 'upload_config',
			'global_config', );
		if (!empty($optionname))
		{
			$cache = parent::import('cache', 'lib');
			$data = $cache->readCache('options');
			unset($cache);
			
			if (!empty($data))
			{

				return $data;
			}
			else
			{
				return array();
			}
		}
	}

	
	public static function updateOption($name, $value, $isSyntax = false)
	{
		parent::$obj->update(DB_PREFIX . "options", array('optionvalue' => $value),
			"optionname='{$name}'");
		
		$cache = parent::import('cache', 'lib');
		$cache->updateCache('options');
		unset($cache);
	}
}

?>
