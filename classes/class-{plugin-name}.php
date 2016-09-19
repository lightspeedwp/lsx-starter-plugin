<?php
if (!class_exists( '{class-name}' ) ) {
	/**
	 * {plugin-label} Main Class
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