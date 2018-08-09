<?php
/**
 * Shortcode UI post select field.
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @since       0.0.0
 */

namespace NICABM\Utility;

add_action( 'init', __NAMESPACE__ . '\\replace_shortcode_ui_ajax_callback' );
/**
 * Hook in to remove the Shortcode UI post field AJAX callback, then add our custom callback.
 *
 * @since 0.2.0
 * @return void
 */
function replace_shortcode_ui_ajax_callback() {
	if ( ! class_exists( 'Shortcode_UI_Field_Post_Select' ) ) {
		return;
	}

	$shortcode_ui_instance = \Shortcode_UI_Field_Post_Select::get_instance();
	remove_action( 'wp_ajax_shortcode_ui_post_field', array( $shortcode_ui_instance, 'action_wp_ajax_shortcode_ui_post_field' ), 10 );

	add_action( 'wp_ajax_shortcode_ui_post_field', __NAMESPACE__ . '\\post_field_prefix_title_with_testimonial_name', 12 );
}

/**
 * Show the Testimonial person's name when searching through testimonials.
 *
 * The bulk of this function is taken from the function action_wp_ajax_shortcode_ui_post_field found in Shortcode UI core.
 * Since there is no way to filter that function we have to override it with this one.
 *
 * @since 0.2.0
 * @return void
 */
function post_field_prefix_title_with_testimonial_name() {

	$nonce               = isset( $_GET['nonce'] ) ? sanitize_text_field( $_GET['nonce'] ) : null;
	$requested_shortcode = isset( $_GET['shortcode'] ) ? sanitize_text_field( $_GET['shortcode'] ) : null;
	$requested_attr      = isset( $_GET['attr'] ) ? sanitize_text_field( $_GET['attr'] ) : null;

	$response = array(
		'items'          => array(),
		'found_items'    => 0,
		'items_per_page' => 0,
	);

	$shortcodes = \Shortcode_UI::get_instance()->get_shortcodes();

	if ( ! wp_verify_nonce( $nonce, 'shortcode_ui_field_post_select' ) ) {
		wp_send_json_error( $response );
	}

	// Shortcode not found.
	if ( ! isset( $shortcodes[ $requested_shortcode ] ) ) {
		wp_send_json_error( $response );
	}

	$shortcode = $shortcodes[ $requested_shortcode ];

	foreach ( $shortcode['attrs'] as $attr ) {
		if ( $attr['attr'] === $requested_attr && isset( $attr['query'] ) ) {
			$query_args = $attr['query'];
		}
	}

	// Query not found.
	if ( empty( $query_args ) ) {
		wp_send_json_error( $response );
	}

	// Hardcoded query args.
	$query_args['fields'] = 'ids';
	$query_args['perm']   = 'readable';

	if ( isset( $_GET['page'] ) ) {
		$query_args['paged'] = sanitize_text_field( $_GET['page'] );
	}

	if ( ! empty( $_GET['s'] ) ) {
		$query_args['s'] = sanitize_text_field( $_GET['s'] );
	}

	if ( ! empty( $_GET['include'] ) ) {
		$post__in                          = is_array( $_GET['include'] ) ? $_GET['include'] : explode( ',', $_GET['include'] );
		$query_args['post__in']            = array_map( 'intval', $post__in );
		$query_args['orderby']             = 'post__in';
		$query_args['ignore_sticky_posts'] = true;
	}

	if ( 'nicabm_testimonial' === $query_args['post_type'] ) {
		add_post_meta_to_search( 'nicabm_testimonial_name' );
	}

	$query                  = new \WP_Query( $query_args );
	$post_types             = $query->get( 'post_type' );
	$is_multiple_post_types = count( $post_types ) > 1 || 'any' === $post_types;

	foreach ( $query->posts as $post_id ) {
		$post_type     = get_post_type( $post_id );
		$post_type_obj = get_post_type_object( $post_type );

		$text = html_entity_decode( get_the_title( $post_id ) );

		$testimonial_name = get_post_meta( $post_id, 'nicabm_testimonial_name', true );

		if ( $testimonial_name ) {
			$text = $testimonial_name . ': ' . $text;
		}

		if ( $is_multiple_post_types && $post_type_obj ) {
			$text .= sprintf( ' (%1$s)', $post_type_obj->labels->singular_name );
		}
		array_push( $response['items'],
			array(
				'id'   => $post_id,
				'text' => $text,
			)
		);
	}

	$response['found_items']    = $query->found_posts;
	$response['items_per_page'] = $query->query_vars['posts_per_page'];

	wp_send_json_success( $response );
}

/**
 * Allows the specified post meta to be searchable during search queries.
 *
 * @param string $meta_key Meta key to add to the search query.
 */
function add_post_meta_to_search( $meta_key ) {
	add_filter( 'posts_join', function() {
		global $wpdb;

		return "LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)";
	} );

	add_filter( 'posts_where', function( $where ) use ( $meta_key ) {
		global $wpdb;

		$where .= "AND $wpdb->postmeta.meta_key = '$meta_key' ";

		return $where;
	} );

	add_filter( 'posts_search', function( $search, $query ) use( $meta_key ) {
		global $wpdb;

		$search_term = $query->get('s');

		$search = ' AND (';

		//point 1
		$search .= $wpdb->prepare( "($wpdb->posts.post_title LIKE '%%%s%%')", $search_term );

		//need to add an OR between search conditions
		$search .= " OR ";

		//point 2
		$search .= $wpdb->prepare( "($wpdb->posts.post_excerpt LIKE '%%%s%%')", $search_term );

		//need to add an OR between search conditions
		$search .= " OR ";

		//point 3
		$search .= $wpdb->prepare( "($wpdb->posts.post_content LIKE '%%%s%%')", $search_term );


		//need to add an OR between search conditions
		$search .= " OR ";

		//point 4
		$search .= $wpdb->prepare( "($wpdb->postmeta.meta_key = '%s' AND $wpdb->postmeta.meta_value LIKE '%%%s%%')", $meta_key, $search_term );

		$search .= ') ';

		return $search;
	}, 10, 2  );
}
