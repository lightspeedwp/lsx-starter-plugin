<?php
namespace lsx_starter_plugin\classes;

use lsx_starter_plugin\classes;

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
	 * An array of the classes initiated, the filename is the index.
	 *
	 * $classes['setup']     = \lsx_starter_plugin\classes\Setup();
	 * $classes['admin']     = \lsx_starter_plugin\classes\Admin();
	 * $classes['templates'] = \lsx_starter_plugin\classes\Templates();
	 * 
	 * @var array
	 */
	public $classes = [];

	/**
	 * Contructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'load_vendor' ], 9 );
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
	 * Registers our block patterns with the 
	 *
	 * @return void
	 */
	public function load_classes() {
		$directory = LSX_STARTER_PLUGIN_PATH . 'classes/';
		
		foreach ( glob( $directory . '*.php') as $file ) {
			if ( 'class-core.php' === $file ) {
				continue;
			}

			// Extract the filename and classname without the directory path and extension
			$filename  = basename( $file, '.php' );
			$filename  = str_replace( 'class-', '', $filename );

			// Initiate the class.
			$this->classes[ $filename ] = require_once $file;
			if ( 'templates' === $filename ) {
				$this->classes['templates']->set_path( LSX_STARTER_PLUGIN_PATH );
			}
		}
	}

	/**
	 * Load the vendors
	 *
	 * @return void
	 */
	public function load_vendor() {
		require_once LSX_STARTER_PLUGIN_PATH . 'vendors/create-content-model/create-content-model.php';
	}
}
