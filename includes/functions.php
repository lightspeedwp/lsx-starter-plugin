<?php
/**
 * LSX Starter Plugin functions.
 *
 * @package lsx-starter-plugin
 */

/**
 * Adds text domain.
 */
function lsx_starter_plugin_load_plugin_textdomain() {
	load_plugin_textdomain( 'lsx-starter-plugin', false, basename( LSX_STARTER_PLUGIN_PATH ) . '/languages' );
}
add_action( 'init', 'lsx_starter_plugin_load_plugin_textdomain' );

// CMB2 framework usage example.
function register_businessdirectory_metabox() {
	$prefix = 'businessdirectory';

	$cmb_demo = new_cmb2_box(
		array(
			'id'           => $prefix . '_metabox',
			'title'        => esc_html__( 'Business Directory CMB2 Metabox', 'lsx-starter-plugin' ), // Doesn't output for user boxes
			'object_types' => array( 'page' ), // Tells CMB2 to use user_meta vs post_meta
			// 'show_on'      => array(
			// 'id' => array( 2 ),
			// ), // Specific post IDs to display this metabox
		)
	);

	$cmb_demo->add_field(
		array(
			'name' => esc_html__( 'Business Name', 'lsx-starter-plugin' ),
			'desc' => esc_html__( 'your business name', 'lsx-starter-plugin' ),
			'id'   => $prefix . '_business_name',
			'type' => 'text',
		)
	);

	$cmb_demo->add_field(
		array(
			'name'    => esc_html__( 'Business Description', 'lsx-starter-plugin' ),
			'desc'    => esc_html__( 'describe your business', 'lsx-starter-plugin' ),
			'id'      => $prefix . '_business_description',
			'type'    => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 5,
			),
		)
	);

	$cmb_demo->add_field(
		array(
			'name' => esc_html__( 'Business Logo', 'lsx-starter-plugin' ),
			'desc' => esc_html__( 'select your business logo', 'lsx-starter-plugin' ),
			'id'   => $prefix . '_business_logo',
			'type' => 'file',
		)
	);

	$cmb_demo->add_field(
		array(
			'name'       => esc_html__( 'Business Email', 'lsx-starter-plugin' ),
			'desc'       => esc_html__( 'your business email', 'lsx-starter-plugin' ),
			'id'         => $prefix . '_business_email',
			'type'       => 'text_email',
			'repeatable' => true,
		)
	);

	$cmb_demo->add_field(
		array(
			'name'       => esc_html__( 'Business Phone', 'lsx-starter-plugin' ),
			'desc'       => esc_html__( 'your business phone', 'lsx-starter-plugin' ),
			'id'         => $prefix . '_business_phone',
			'type'       => 'text',
			'repeatable' => true,
		)
	);
}
// add_action( 'cmb2_init', 'register_businessdirectory_metabox' );
