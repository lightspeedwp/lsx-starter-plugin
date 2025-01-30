<?php
/**
 * Manages the existing content models.
 *
 * @package create-content-model
 */

declare( strict_types = 1 );

/**
 * Represents a block from a content model template.
 */
final class Content_Model_Taxonomy_Loader {

	/**
	 * The instance.
	 *
	 * @var ?Content_Model_Taxonomy_Loader
	 */
	private static $instance = null;

	/**
	 * Inits the singleton of the Content_Model_Taxonomy_Loader class.
	 *
	 * @return Content_Model_Taxonomy_Loader
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initializes the Content_Model instance with the given WP_Post object.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'maybe_register_content_models_from_json' ] );
	}

	/**
	 * Register the content models from JSON files if the current version is not the latest.
	 */
	public function maybe_register_content_models_from_json() {

		global $CONTENT_MODEL_JSON_PATH;
		if ( ! isset( $CONTENT_MODEL_JSON_PATH ) ) {
			return;
		}

		$post_types = [];
		
		foreach ( $CONTENT_MODEL_JSON_PATH as $json_path ) {
			$types = glob( $json_path . '/post-types/*.json' );
			$types = array_map(
				fn( $file ) => json_decode( file_get_contents( $file ), true ),
				$types
			);
			$post_types = array_merge( $post_types, $types );
		}

		foreach ( $post_types as $post_type ) {
			if ( isset( $post_type['taxonomies'] ) ) {
				$this->postType = $post_type['postType'];
				$this->register_taxonomies( $post_type['taxonomies'] );
			}
		}
	}

	private function register_taxonomies( $taxonomies ) {
		if ( isset( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {

				if ( taxonomy_exists( $taxonomy['slug'] ) ) {
					register_taxonomy_for_object_type( $taxonomy['slug'], $this->postType );
					continue;
				}

				$hierarchical = false;
				if ( isset( $taxonomy['hierarchical'] ) ) {
					$hierarchical = (bool) $taxonomy['hierarchical'];
				}

				$public = true;
				if ( isset( $taxonomy['public'] ) ) {
					$public = (bool) $taxonomy['public'];
				}

				$rewrite = array( $taxonomy['slug'] );
				if ( isset( $taxonomy['hasArchive'] ) ) {
					$rewrite = [ $taxonomy['hasArchive'] ];
				}

				$plural_name   = $taxonomy['pluralName'];
				$singular_name = $taxonomy['singularName'];

				$taxonomy_args = array(
					'hierarchical'        => $hierarchical,
					'labels'              => array(
						'name'              => $plural_name,
						'menu_name'         => $plural_name,
						'singular_name'     => $singular_name,
						// translators: %s is the plural name of the post type.
						'search_items'      => sprintf( __( 'Search %s' ), $plural_name ),
						// translators: %s is the plural name of the post type.
						'all_items'         => sprintf( __( 'All %s' ), $plural_name ),
						'parent_item'       => esc_html__( 'Parent', 'to-team' ),
						'parent_item_colon' => esc_html__( 'Parent:', 'to-team' ),
						// translators: %s is the singular name of the post type.
						'edit_item'         => sprintf( __( 'Edit %s' ), $singular_name ),
						// translators: %s is the singular name of the post type.
						'update_item'       => sprintf( __( 'Update %s' ), $singular_name ),
						// translators: %s is the singular name of the post type.
						'add_new_item'      => sprintf( __( 'Add New %s' ), $singular_name ),
						// translators: %s is the singular name of the post type.
						'new_item_name'     => sprintf( __( 'New %s' ), $singular_name ),
					),
					'public'              => $public,
					'rewrite'             => $rewrite,
				);

				do_action( 'qm/debug', [ $taxonomy['slug'], $this->postType, $taxonomy_args ] );

				register_taxonomy( $taxonomy['slug'], $this->postType, $taxonomy_args );
			}
		}
	}
}