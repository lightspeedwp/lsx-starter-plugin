<?php
namespace lsx_starter_plugin\classes;
/**
 * LSX Starter Plugin Admin Class.
 *
 * @package lsx-starter-plugin
 */
class Setup {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_starter_plugin\classes\Setup()
	 */
	protected static $instance = null;

	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'load_plugin_textdomain' ] );

		// Enqueue the assets.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );
	}

	/**
	 * Adds text domain.
	 */
	function load_plugin_textdomain() {
		load_plugin_textdomain( 'lsx-starter-plugin', false, basename( LSX_STARTER_PLUGIN_PATH ) . '/languages' );
	}

	/**
	 * Various assest we want loaded for admin pages.
	 *
	 * @return void
	 */
	public function admin_assets() {
		wp_enqueue_script( 'lsx-starter-plugin-admin', LSX_STARTER_PLUGIN_URL . 'assets/js/lsx-starter-plugin-admin.min.js', array( 'jquery' ), LSX_STARTER_PLUGIN_VER, true );
		wp_enqueue_style( 'lsx-starter-plugin-admin', LSX_STARTER_PLUGIN_URL . 'assets/css/lsx-starter-plugin-admin.css', array(), LSX_STARTER_PLUGIN_VER );
	}
}
