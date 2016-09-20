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

/**
 * Main plugin class.
 *
 * @package {class-name}_Admin
 * @author  {your-name}
 */

class {class-name}_Admin extends {class-name}{	

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action('lsx_framework_dashboard_tab_content',array($this,'settings'),11);
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
					<label for="text"><?php _e('Text Input','lsx-tour-operators'); ?></label>
				</th>
				<td>
					<input type="text" {{#if text}} value="{{text}}" {{/if}} name="text" />
				</td>
			</tr>				
			<tr class="form-field">
				<th scope="row">
					<label for="checkbox"><?php _e('Checkbox','lsx-tour-operators'); ?></label>
				</th>
				<td>
					<input type="checkbox" {{#if checkbox}} checked="checked" {{/if}} name="checkbox" />
					<small><?php _e('An example of a checkbox',$this->plugin_slug); ?></small>
				</td>
			</tr>				
		<?php	
	}	
}
new {class-name}_Admin();