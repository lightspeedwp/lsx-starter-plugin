<?php
/*
 * Plugin Name:	LSX Starter Plugin
 * Plugin URI:	https://github.com/lightspeeddevelopment/lsx-starter-plugin
 * Description:	LSX Starter Plugin for building LSX theme extensions.
 * Author:		LightSpeed
 * Version: 	2.0.0
 * Author URI: 	https://www.lsdev.biz/
 * License: 	GPL3
 * Text Domain: lsx-starter-plugin
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'LSX_STARTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'LSX_STARTER_PLUGIN_CORE', __FILE__ );
define( 'LSX_STARTER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LSX_STARTER_PLUGIN_VER', '2.0.0' );

global $CONTENT_MODEL_JSON_PATH;
$CONTENT_MODEL_JSON_PATH[] = LSX_STARTER_PLUGIN_PATH;

/* ======================= Below is the Plugin Class init ========================= */

require_once LSX_STARTER_PLUGIN_PATH . '/classes/class-core.php';

/**
 * Plugin kicks off with this function.
 *
 * @return void
 */
function lsx_starter_plugin() {
	return \lsx_starter_plugin\classes\Core::get_instance();
}
lsx_starter_plugin();
