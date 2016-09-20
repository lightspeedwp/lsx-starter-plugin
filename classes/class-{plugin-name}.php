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
if (!class_exists( '{class-name}' ) ) {

	/**
	 * Main plugin class.
	 *
	 * @package {class-name}
	 * @author  {your-name}
	 */	
	class {class-name} {
		
		/** @var string */
		public $plugin_slug = '{plugin-name}';

		/**
		 * Constructor
		 */
		public function __construct() {
			require_once({PREFIX_CAPS}_PATH . '/classes/class-{plugin-name}-admin.php');
			require_once({PREFIX_CAPS}_PATH . '/classes/class-{plugin-name}-frontend.php');
		}		
	}
	new {class-name}();
}