<?php
namespace \lsx_starter_plugin\classes;

/**
 * LSX Starter Plugin Frontend Class.
 *
 * @package lsx-starter-plugin
 */
class Frontend {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_starter_plugin\classes\Frontend()
	 */
	protected static $instance = null;		

	/**
	 * Contructor
	 */		
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ), 999 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx\member_directory\classes\Core()    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}	

	public function assets() {
		wp_enqueue_script( 'lsx-starter-plugin', LSX_STARTER_PLUGIN_URL . 'assets/js/lsx-starter-plugin.min.js', array( 'jquery' ), LSX_STARTER_PLUGIN_VER, true );

		$params = apply_filters( 'lsx_starter_plugin_js_params', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		));

		wp_localize_script( 'lsx-starter-plugin', 'lsx_customizer_params', $params );

		wp_enqueue_style( 'lsx-starter-plugin', LSX_STARTER_PLUGIN_URL . 'assets/css/lsx-starter-plugin.css', array(), LSX_STARTER_PLUGIN_VER );
		wp_style_add_data( 'lsx-starter-plugin', 'rtl', 'replace' );
	}

}
