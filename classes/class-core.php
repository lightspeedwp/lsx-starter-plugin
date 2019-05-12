<?php
namespace \lsx_starter_plugin\classes;

/**
 * LSX Starter Plugin Main Class.
 *
 * @package lsx-starter-plugin
 */
class Core {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_starter_plugin\classes\Core()
	 */
	protected static $instance = null;	

	/**
	 * @var object \lsx_starter_plugin\classes\Setup();
	 */
	public $admin;

	/**
	 * Contructor
	 */	
	public function __construct() {
		$this->load_classes();
		$this->load_includes();
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

	/**
	 * Loads the variable classes and the static classes.
	 */
	private function load_classes() {
		require_once( LSX_STARTER_PLUGIN_PATH . 'classes/class-admin.php' );
		$this->admin = Admin::get_instance();

		require_once( LSX_STARTER_PLUGIN_PATH . '/classes/class-lsx-starter-plugin-frontend.php' );
		require_once( LSX_STARTER_PLUGIN_PATH . '/includes/functions.php' );		
	}	

	/**
	 * Loads the plugin functions.
	 */
	private function load_includes() {
		require_once( LSX_STARTER_PLUGIN_PATH . '/includes/functions.php' );		
	}	
}
