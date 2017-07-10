<?php
/**
 * {class-name}
 *
 * @package   {class-name}
 * @author    {your-name}
 * @license   GPL-2.0+
 * @link      
 * @copyright {year} LightSpeedDevelopment
 */
namespace {namespace};

if ( ! class_exists( '{class-name}' ) ) {

	/**
	 * Main plugin class.
	 *
	 * @package {class-name}
	 * @author  {your-name}
	 */	
	class {class-name} {

		/**
		 * Holds instance of the class
		 *
		 * @since   1.1.0
		 * @var     \{namespace}\{class-name}
		 */
		private static $instance;

		/**
		 * Plugin slug
		 *
		 * @var string
		 */
		public $plugin_slug = '{plugin-name}';

		/**
		 * Constructor
		 */
		public function __construct() {

		}

		/**
		 * Return an instance of this class.
		 *
		 * @since 1.1.0
		 * @return  {class-name}  A single instance
		 */
		public static function init() {

			// If the single instance hasn't been set, set it now.
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}

}
