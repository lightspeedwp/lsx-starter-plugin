<?php
namespace lsx_starter_plugin\classes;

/**
 * LSX Starter Plugin Frontend Class.
 *
 * @package lsx-starter-plugin
 */
class Frontend {
	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @return    null
	 */
	public function enqueue_scripts() {
		if ( ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) || ( defined('WP_LOCALSITE') && WP_LOCALSITE ) ) {
			$prefix = 'src/';
			$suffix = '';
		} else {
			$prefix = '';
			$suffix = '.min';
		}

		wp_enqueue_script( 'lsx-starter-plugin-script', LSX_STARTER_PLUGIN_URL . 'assets/js/' . $prefix . 'lsx-starter-plugin' . $suffix . '.js', array( 'jquery' ), LSX_STARTER_PLUGIN_VER, true );
		wp_enqueue_style( 'lsx-starter-plugin-style', LSX_STARTER_PLUGIN_URL . 'assets/css/lsx-starter-plugin.css', array(), LSX_STARTER_PLUGIN_VER );
	}
}

return new Frontend();
