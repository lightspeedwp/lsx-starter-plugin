<?php
namespace lsx_starter_plugin\classes;

/**
 * Registers our Block Templates
 * 
 * @link http://url.com
 */
class Templates {

	/**
	 * Holds array of out templates to be registered.
	 *
	 * @var array
	 */
	public $templates = [];

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_post_type_templates' ] );
	}

	/**
	 * Registers our plugins templates.
	 *
	 * @return void
	 */
	public function register_post_type_templates() {

		/**
		 * The slugs of the built in post types we are using.
		 */
		$post_types = [
			'single-post-type'  => [
				'title'       => __( 'Single Post Type', 'tour-operator' ),
				'description' => __( 'Displays a single', 'tour-operator' ),
				'post_types'  => ['post-type'],
			],
			'archive-post-type' => [
				'title'       => __( 'Accommodation Post Type', 'tour-operator' ),
				'description' => __( 'Displays all the Post Type.', 'tour-operator' ),
				'post_types'  => ['post-type'],
			]
		];

		foreach ( $post_types as $key => $labels ) {
			$args = [
				'title'       => $labels['title'],
				'description' => $labels['description'],
				'content'     => $this->get_template_content( $key . '.html' ),
			];
			if ( isset( $labels['post_types'] ) ) {
				$args['post_types'] = $labels['post_types'];
			}

			if ( function_exists( 'register_block_template' ) ) {
				register_block_template( 'lsx-starter-plugin//' . $key, $args );
			}
		}
	}

	/**
	 * Gets the PHP template file and returns the content.
	 *
	 * @param [type] $template
	 * @return void
	 */
	protected function get_template_content( $template ) {
		ob_start();
		include LSX_TO_PATH . "/templates/{$template}";
		return ob_get_clean();
	}
}
