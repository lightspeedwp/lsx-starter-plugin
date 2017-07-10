<?php
/**
 * {class-name}_Admin
 *
 * @package   {class-name}_Admin
 * @author    {your-name}
 * @license   GPL-2.0+
 * @link      
 * @copyright {year} LightSpeedDevelopment
 */

if ( ! class_exists( '{class-name}_Admin' ) ) {

	/**
	 * Admin plugin class.
	 *
	 * @package {class-name}_Admin
	 * @author  {your-name}
	 */
	class {class-name}_Admin extends {class-name} {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts',               array( $this, 'assets' ) );
			add_action( 'to_framework_dashboard_tab_content', array( $this, 'settings' ), 11 );
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

			wp_enqueue_script( '{prefix_small}_admin', {PREFIX_CAPS}_URL . 'assets/js/{plugin-name}-admin' . $min . '.js', array( 'jquery' ), {PREFIX_CAPS}_VER, true );

			$params = apply_filters( '{prefix_small}_admin_js_params', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			));

			wp_localize_script( '{prefix_small}_admin', '{prefix_small}_params', $params );

			wp_enqueue_style( '{prefix_small}_admin', {PREFIX_CAPS}_URL . 'assets/css/{plugin-name}-admin.css', array(), {PREFIX_CAPS}_VER );
		}

		/**
		 * Outputs the dashboard tabs settings
		 */
		public function settings() {
			?>	
				<tr class="form-field">
					<th scope="row" colspan="2"><label><h3>{plugin-label}</h3></label></th>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="text"><?php esc_html_e( 'Text Input', '{plugin-name}' ); ?></label>
					</th>
					<td>
						<input type="text" {{#if text}} value="{{text}}" {{/if}} name="text" />
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="checkbox"><?php esc_html_e( 'Checkbox', '{plugin-name}' ); ?></label>
					</th>
					<td>
						<input type="checkbox" {{#if checkbox}} checked="checked" {{/if}} name="checkbox" />
						<small><?php esc_html_e( 'An example of a checkbox', $this->plugin_slug ); ?></small>
					</td>
				</tr>
			<?php
		}

	}

	new {class-name}_Admin();

}
