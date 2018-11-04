<?php
/**
* googlemaps plugin
* allows you to include one or more google maps
* right inside Joomla content item or article
* Author: kksou
* Copyright (C) 2006-2011. kksou.com. All Rights Reserved
* License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
* Website: http://www.kksou.com/php-gtk2
* v1.5 April 16, 2009
* v1.51 April 30, 2009 added support for mod_googlemaps
* v1.52 May 3, 2009 improved javascript
* v1.6 Feb 23, 2011 support for Joomla 1.6
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
@session_start();
jimport( 'joomla.event.plugin' );
$lib = dirname(__FILE__).'/googlemaps.lib.php';
require_once($lib);

global $joomla_ver;
require_once('googlemaps_joomla_ver.php');

class plgContentgooglemaps extends JPlugin {

		public function __construct( &$subject, $params ) {
		parent::__construct( $subject, $params );
		$lang = JFactory::getLanguage();
        $lang->load('plg_content_googlemaps', dirname(__FILE__));
 	}


	// constructor to support PHP 4
	function plgContentgooglemaps( &$subject, $params ) {
		self::__construct( $subject, $params );
 	}


	function onContentPrepare( $context, &$row, &$params, $limitstart ) {

		#$plugin =& JPluginHelper::getPlugin('content', 'googlemaps');
		$pluginParams = $this->params;

		/*if ( !$pluginParams->get( 'enabled', 1 ) ) {
			$row->text = preg_replace( $regex, '', $row->text );
			return true;
		}*/
		

		$param = new stdClass;
		$param->api_key = $pluginParams->get('api_key');
		$param->width = $pluginParams->get('width');
		$param->height = $pluginParams->get('height');
		$param->zoom = $pluginParams->get('zoom');
		$param->template_uses_jquery = $pluginParams->get('template_uses_jquery');
		$param->poi = $pluginParams->get('poi');
		$is_mod = 0;
		if (isset($params->is_mod)) $is_mod = 1;

		$plugin = new Plugin_googlemaps($row, $param, $is_mod);
		return true;
	}
}

?>
