<?php
/**
 * Custom Taxonomy Handler
 *
 * @package NICABM\Utility
 * @author  Tim Jensen <tim@timjensen.us>
 * @license GNU General Public License 2.0+
 * @link    https://nicabm.com/
 * @since   0.1.0
 */

namespace NICABM\Utility;

/**
 * Class Custom_Taxonomy
 *
 * @package NICABM\Utility
 * @since   0.1.0
 */
class Custom_Taxonomy {

	/**
	 * Taxonomy configuration array.
	 *
	 * @since 0.1.2
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * Taxonomy key, must not exceed 32 characters.
	 *
	 * @since 0.1.2
	 *
	 * @var string
	 */
	private $taxonomy = '';

	/**
	 * Array of object types with which the taxonomy should be associated.
	 *
	 * @since 0.1.2
	 *
	 * @var array
	 */
	private $object_type = [];

	/**
	 * Array of arguments for registering a taxonomy.
	 *
	 * @since 0.1.2
	 *
	 * @var array
	 */
	private $args = [];

	/**
	 * Custom_Taxonomy constructor.
	 *
	 * @param array $config Configuration array for the taxonomy.
	 *
	 * @since 0.1.2
	 */
	public function __construct( array $config ) {
		$this->config      = $config;
		$this->taxonomy    = empty( $this->config['taxonomy'] ) ? false : $this->config['taxonomy'];
		$this->object_type = empty( $this->config['object_type'] ) ? false : $this->config['object_type'];
		$this->args        = empty( $this->config['args'] ) ? null : (array) $this->config['args'];
	}

	/**
	 * Hooks into the lifecycle to register the taxonomy.
	 *
	 * @since 0.1.2
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'init', [ $this, 'register_custom_taxonomy' ] );
	}

	/**
	 * Register the custom post type.
	 *
	 * @since 0.1.2
	 *
	 * @return void
	 */
	public function register_custom_taxonomy() {

		$singular_label = empty( $this->config['args']['labels']['singular'] ) ? $this->taxonomy : (string) $this->config['args']['labels']['singular'];
		$plural_label   = empty( $this->config['args']['labels']['plural'] ) ? $this->taxonomy : (string) $this->config['args']['labels']['plural'];

		$this->args['labels'] = $this->get_taxonomy_labels( $singular_label, $plural_label );

		register_taxonomy( $this->taxonomy, $this->object_type, $this->args );
	}

	/**
	 * Get the post type labels.
	 *
	 * @since 0.1.2
	 *
	 * @param string $singular_label Singular label for the Custom Post Type.
	 * @param string $plural_label Plural label for the Custom Post Type.
	 *
	 * @return array
	 */
	protected function get_taxonomy_labels( $singular_label, $plural_label ) {

		return [
			'name'                  => _x( $plural_label, 'taxonomy general name', 'nicabm-utility-plugin' ),
			'singular_name'         => _x( $singular_label, 'taxonomy singular name', 'nicabm-utility-plugin' ),
			'search_items'          => __( 'Search ' . $plural_label, 'nicabm-utility-plugin' ),
			'popular_items'         => __( 'Popular ' . $plural_label, 'nicabm-utility-plugin' ),
			'all_items'             => __( 'All ' . $plural_label, 'nicabm-utility-plugin' ),
			'parent_item'           => __( 'Parent ' . $singular_label, 'nicabm-utility-plugin' ),
			'parent_item_colon'     => __( 'Parent ' . $singular_label . ':', 'nicabm-utility-plugin' ),
			'edit_item'             => __( 'Edit ' . $singular_label, 'nicabm-utility-plugin' ),
			'view_item'             => __( 'View ' . $singular_label, 'nicabm-utility-plugin' ),
			'update_item'           => __( 'Update ' . $singular_label, 'nicabm-utility-plugin' ),
			'add_new_item'          => __( 'Add New ' . $singular_label, 'nicabm-utility-plugin' ),
			'new_item_name'         => __( 'New ' . $singular_label . ' Name', 'nicabm-utility-plugin' ),
			'not_found'             => __( 'No ' . $plural_label . ' found.', 'nicabm-utility-plugin' ),
			'no_terms'              => __( 'No ' . $plural_label, 'nicabm-utility-plugin' ),
			'items_list_navigation' => __( $plural_label . ' list navigation', 'nicabm-utility-plugin' ),
			'items_list'            => __( $plural_label . ' list', 'nicabm-utility-plugin' ),
			'menu_name'             => __( $plural_label, 'nicabm-utility-plugin' ),
			'name_admin_bar'        => __( $singular_label, 'nicabm-utility-plugin' ),
			'archives'              => __( 'All ' . $plural_label, 'nicabm-utility-plugin' ),
		];
	}
}
