<?php
namespace lsx_starter_plugin\classes;

/**
 * This class loads the other classes and function files
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
	public $setup;

	/**
	 * @var object \lsx_starter_plugin\classes\Admin();
	 */
	public $admin;

	/**
	 * Contructor
	 */
	public function __construct() {
		$this->load_vendor();
		$this->load_classes();
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_starter_plugin\classes\Core()    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Loads the variable classes and the static classes.
	 */
	private function load_classes() {
		// Load plugin settings related functionality.
		require_once LSX_STARTER_PLUGIN_PATH . 'classes/class-setup.php';
		$this->setup = new Setup();

		// Load plugin admin related functionality.
		/*require_once LSX_STARTER_PLUGIN_PATH . 'classes/class-admin.php';
		$this->admin = new Admin();*/
	}

	/**
	 * Load the vendors
	 *
	 * @return void
	 */
	private function load_vendor() {
		require_once LSX_STARTER_PLUGIN_PATH . 'vendors/create-content-model/create-content-model.php';
	}
}
