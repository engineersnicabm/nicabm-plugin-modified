<?php
/**
 * Helper Functions
 *
 * @package       NICABM\Utility
 * @since         0.1.0
 * @author        Tim Jensen
 * @link          https://nicabm.com/
 * @license       GNU General Public License 2.0+
 */

namespace NICABM\Utility;

/**
 * Returns a generated post excerpt of the specified length or the manual excerpt if it has been set.
 *
 * @param int    $post_id     Required. Post ID.
 * @param int    $word_length Optional. Length of the automatic except.
 *                            Does not affect the manual excerpt length.  Defaults to 50.
 * @param string $ellipsis    Optional. Text that appends the excerpt.  Defaults to '...'.
 * @param bool   $more_link   Optional. Includes a link to the singular post.  Defaults to true.
 *
 * @return string
 */
function get_post_excerpt( $post_id, $word_length = 50, $ellipsis = '&hellip;', $more_link = true ) {

	$post = get_post( $post_id );

	if ( $post->post_excerpt ) {

		$excerpt = $post->post_excerpt;
	} else {

		$excerpt = strip_tags( strip_shortcodes( $post->post_content ) );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );

		$words = explode( ' ', $excerpt, $word_length + 1 );

		if ( count( $words ) > $word_length ) {

			array_pop( $words );

			$excerpt = implode( ' ', $words ) . $ellipsis;
		}
	}

	$excerpt = apply_filters( 'get_post_excerpt_excerpt', $excerpt );

	if ( ! $more_link ) {
		return $excerpt;
	}

	$more_link = sprintf( '<a href="%s" class="more-link read-more-link">%s</a>',
		get_the_permalink( $post->ID ),
		apply_filters( 'get_post_excerpt_read_more_text', 'Read More' )
	);

	return $excerpt . apply_filters( 'get_post_excerpt_read_more_link', $more_link );
}

/**
 * Loads the object cache and returns the requested post object.
 *
 * @param string|int $post_id    Post ID.
 * @param array      $query_args WP_Query arguments.
 * @return mixed
 */
function get_cached_post( $post_id, array $query_args ) {
	$cached_post = wp_cache_get( (int) $post_id, 'posts' );

	if ( $cached_post ) {
		return $cached_post;
	}

	$defaults = [
		'ignore_sticky_posts'    => true,
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'posts_per_page'         => 500,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
	];

	$args = wp_parse_args( $query_args, $defaults );

	// Query results are loaded into WP Object Cache by default.
	$query = new \WP_Query( $args );

	return wp_cache_get( (int) $post_id, 'posts' );
}

/**
 * Loads the object cache and returns the requested post objects.
 *
 * @param array $post_ids   Post IDs.
 * @param array $query_args WP_Query arguments.
 * @return array
 */
function get_cached_posts( array $post_ids, array $query_args ) {
	$cached_posts = [];

	foreach ( $post_ids as $post_id ) {

		if ( empty( $post_id ) || ! is_numeric( $post_id ) ) {
			continue;
		}

		$cached_posts[] = get_cached_post( (int) $post_id, $query_args );
	}

	return $cached_posts;
}
