<?php
/**
 * {class-name}_Frontend
 *
 * @package   {class-name}_Frontend
 * @author    {your-name}
 * @license   GPL-2.0+
 * @link      
 * @copyright {year} LightSpeedDevelopment
 */

if ( ! class_exists( '{class-name}_Frontend' ) ) {

	/**
	 * Front-end plugin class.
	 *
	 * @package {class-name}_Frontend
	 * @author  {your-name}
	 */
	class {class-name}_Frontend extends {class-name} {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
		}

		/**
		 * Enques the assets
		 */
		public function assets() {
			if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
				$min = '';
			} else {
				$min = '.min';
			}

			wp_enqueue_script( '{prefix_small}', {PREFIX_CAPS}_URL . 'assets/js/{plugin-name}' . $min . '.js', array( 'jquery' ), {PREFIX_CAPS}_VER, true );

			$params = apply_filters( '{prefix_small}_js_params', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			));

			wp_localize_script( '{prefix_small}', '{prefix_small}_params', $params );

			wp_enqueue_style( '{prefix_small}', {PREFIX_CAPS}_URL . 'assets/css/{plugin-name}.css', array(), {PREFIX_CAPS}_VER );
		}

	}

	new {class-name}_Frontend();

}