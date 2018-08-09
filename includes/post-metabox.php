<?php
/**
 * Post metabox module.
 *
 * @package     NICABM\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://nicabm.com/
 * @license     GNU General Public License 2.0+
 */

namespace NICABM\Utility;

add_action( 'init', __NAMESPACE__ . '\\register_metaboxes' );
/**
 * Register post meta boxes.
 *
 * @return void
 */
function register_metaboxes() {

	$config = include NICABM_UTILITY_CONFIG_DIR . '/post-metabox.php';

	foreach ( (array) $config as $shortcode_config ) {
		( new Post_Metabox( $shortcode_config ) )->init();
	}
}

/**
 * Returns a list of instructors for a select field.
 *
 * @param \CMB2_Field $field CMB2 field object.
 * @return array
 */
function course_instructors_select_options( $field ) : array {
	$args = [
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'order'                  => 'ASC',
		'orderby'                => 'post_title',
		'post_status'            => 'publish',
		'post_type'              => 'nicabm_instructor',
		'posts_per_page'         => 500,
		'update_post_term_cache' => false,
	];

	$query = new \WP_Query( $args );

	if ( empty( $query->posts ) ) {
		return [ 'No instructors found' ];
	}

	$select_options = [ 0 => 'Select instructor' ];
	foreach ( $query->posts as $post ) {
		// Append the credentials to the instructor's name.
		$credentials = get_post_meta( $post->ID, 'nicabm_instructor_credentials', true );
		$title       = $credentials ? $post->post_title . ', ' . $credentials : $post->post_title;

		$select_options[ $post->ID ] = $title;
	}

	return $select_options;
}
