<?php
/**
 * Formatting
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://nicabm.com
 * @since         0.1.0
 */

namespace NICABM\Utility;

$wp_embed = new \WP_Embed();

add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies', 20 );
add_filter( 'meta_content', 'convert_chars' );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode', 11 );
add_filter( 'meta_content', [ $wp_embed, 'run_shortcode' ], 8 );
add_filter( 'meta_content', [ $wp_embed, 'autoembed' ], 8 );
