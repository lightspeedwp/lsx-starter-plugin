<?php
namespace lsx_starter_plugin\classes;

/**
 * LSX Starter Plugin Admin Class.
 *
 * @package lsx-starter-plugin
 */
class Admin {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_starter_plugin\classes\Admin()
	 */
	protected static $instance = null;

	/**
	 * Contructor
	 */
	public function __construct() {
		// Enqueue scripts for all admin pages.
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx\member_directory\classes\Admin()    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	/**
	 * Various assest we want loaded for admin pages.
	 *
	 * @return void
	 */
	public function assets() {
		// wp_enqueue_media();
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );

		wp_enqueue_script( 'lsx-starter-plugin-admin', LSX_STARTER_PLUGIN_URL . 'assets/js/lsx-starter-plugin-admin.min.js', array( 'jquery' ), LSX_STARTER_PLUGIN_VER, true );
		wp_enqueue_style( 'lsx-starter-plugin-admin', LSX_STARTER_PLUGIN_URL . 'assets/css/lsx-starter-plugin-admin.css', array(), LSX_STARTER_PLUGIN_VER );
	}

}
