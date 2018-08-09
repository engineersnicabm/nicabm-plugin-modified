<?php
/**
 * Custom Post Type Handler
 *
 * @package     NICABM\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://nicabm.com/
 * @license     GNU General Public License 2.0+
 */

namespace NICABM\Utility;

/**
 * Class Custom_Post_Type
 *
 * @since   0.1.0
 *
 * @package NICABM\Utility\CustomPostType
 */
class Custom_Post_Type {

	/**
	 * CPT configuration array.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * Post type key. Must not exceed 20 characters and may
	 * only contain lowercase alphanumeric characters, dashes,
	 * and underscores.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	private $post_type = '';

	/**
	 * Array of arguments for registering a post type.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	private $args = [];

	/**
	 * Custom_Post_Type constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Configuration array for the custom post type.
	 */
	public function __construct( array $config ) {
		$this->config    = $config;
		$this->post_type = empty( $this->config['post_type'] ) ? false : $this->config['post_type'];
		$this->args      = empty( $this->config['args'] ) ? null : (array) $this->config['args'];
	}

	/**
	 * Hook into the WordPress lifecycle to register the CPT.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'init', [ $this, 'register_custom_post_type' ] );
	}

	/**
	 * Register the custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function register_custom_post_type() {
		$singular_label = empty( $this->config['args']['labels']['singular'] ) ? $this->post_type : (string) $this->config['args']['labels']['singular'];
		$plural_label   = empty( $this->config['args']['labels']['plural'] ) ? $this->post_type : (string) $this->config['args']['labels']['plural'];

		$this->args['labels'] = $this->get_post_type_labels( $singular_label, $plural_label );

		\register_post_type( $this->post_type, $this->args );

		add_filter( 'enter_title_here', [ $this, 'title_field_placeholder_text' ] );
	}

	/**
	 * Get the post type labels.
	 *
	 * @since 0.1.0
	 *
	 * @param string $singular_label Singular label for the Custom Post Type.
	 * @param string $plural_label Plural label for the Custom Post Type.
	 *
	 * @return array
	 */
	protected function get_post_type_labels( $singular_label, $plural_label ) {

		$menu_name = empty( $this->config['args']['labels']['menu_name'] ) ? $plural_label : $this->config['args']['labels']['menu_name'];

		return [
			'name'                  => _x( $plural_label, 'post type general name', 'nicabm-utility-plugin' ),
			'singular_name'         => _x( $singular_label, 'post type singular name', 'nicabm-utility-plugin' ),
			'add_new'               => _x( 'Add New', $this->post_type, 'nicabm-utility-plugin' ),
			'add_new_item'          => __( 'Add New ' . $singular_label, 'nicabm-utility-plugin' ),
			'edit_item'             => __( 'Edit ' . $singular_label, 'nicabm-utility-plugin' ),
			'new_item'              => __( 'New ' . $singular_label, 'nicabm-utility-plugin' ),
			'view_item'             => __( 'View ' . $singular_label, 'nicabm-utility-plugin' ),
			'view_items'            => __( 'View ' . $plural_label, 'nicabm-utility-plugin' ),
			'search_items'          => __( 'Search ' . $plural_label, 'nicabm-utility-plugin' ),
			'not_found'             => __( 'No ' . $plural_label . ' found.', 'nicabm-utility-plugin' ),
			'not_found_in_trash'    => __( 'No ' . $plural_label . ' found in Trash.', 'nicabm-utility-plugin' ),
			'parent_item_colon'     => __( 'Parent ' . $singular_label . ':', 'nicabm-utility-plugin' ),
			'all_items'             => __( 'All ' . $plural_label, 'nicabm-utility-plugin' ),
			'archives'              => __( 'All ' . $plural_label, 'nicabm-utility-plugin' ),
			'attributes'            => __( $singular_label . ' Attributes', 'nicabm-utility-plugin' ),
			'insert_into_item'      => __( 'INSERT INTO ' . $singular_label, 'nicabm-utility-plugin' ),
			'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular_label, 'nicabm-utility-plugin' ),
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'filter_items_list'     => __( 'Filter ' . $plural_label . ' list', 'nicabm-utility-plugin' ),
			'items_list_navigation' => __( $plural_label . ' list navigation', 'nicabm-utility-plugin' ),
			'items_list'            => __( $plural_label . ' list', 'nicabm-utility-plugin' ),
			'menu_name'             => __( $menu_name, 'nicabm-utility-plugin' ),
			'name_admin_bar'        => _x( $singular_label, 'add new on admin bar', 'nicabm-utility-plugin' ),
		];
	}

	/**
	 * Change the placeholder text for the post title field.
	 *
	 * @param string $title Default placeholder text.
	 * @return string
	 */
	public function title_field_placeholder_text( $title ) : string {
		$post_type_object = get_post_type_object( get_post_type() );

		if ( empty( $post_type_object->title_placeholder ) ) {
			return $title;
		}

		return $post_type_object->title_placeholder;
	}
}
