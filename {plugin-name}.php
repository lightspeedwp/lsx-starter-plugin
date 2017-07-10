<?php
/*
 * Plugin Name:	{plugin-label}
 * Plugin URI:	{plugin-url}
 * Description:	{plugin-description}
 * Author:		{your-name}
 * Version: 	1.0.0
 * Author URI: 	{your-url}
 * License: 	GPL2+
 * Text Domain: {plugin-name}
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( '{PREFIX_CAPS}_PATH', plugin_dir_path( __FILE__ ) );
define( '{PREFIX_CAPS}_CORE', __FILE__ );
define( '{PREFIX_CAPS}_URL',  plugin_dir_url( __FILE__ ) );
define( '{PREFIX_CAPS}_VER',  '1.0.0' );

/**
 * Runs once when the plugin is activated.
 */
function {prefix_small}_activate_plugin() {
	// Insert code here
}
register_activation_hook( __FILE__, '{prefix_small}_activate_plugin' );

/* ======================= Below is the Plugin Class init ========================= */

require_once( {PREFIX_CAPS}_PATH . 'includes/{plugin-name}.php' );