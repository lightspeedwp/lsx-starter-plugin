<?php
namespace lsx_starter_plugin\classes;
/**
 * Contains all the classes for 3rd party Integrations
 *
 * @package lsx-starter-plugin
 */
class Integrations {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 *
	 * @var      object \lsx_starter_plugin\classes\Integrations()
	 */
	protected static $instance = null;

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 *
	 * @return    object \lsx_starter_plugin\classes\Integrations()    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}
}
