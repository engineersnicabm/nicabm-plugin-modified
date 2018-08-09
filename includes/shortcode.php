<?php
/**
 * Shortcodes module.
 *
 * @package     NICABM\Utility
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://nicabm.com/
 * @license     GNU General Public License 2.0+
 */

namespace NICABM\Utility;

add_action( 'init', __NAMESPACE__ . '\\register_shortcodes' );
/**
 * Register shortcodes.
 *
 * @return void
 */
function register_shortcodes() {

	$config = include NICABM_UTILITY_CONFIG_DIR . '/shortcode.php';

	foreach ( (array) $config as $shortcode_config ) {
		( new Shortcode( $shortcode_config ) )->init();
	}
}

/**
 * Returns repeated shortcode attributes.
 *
 * @param array $repeat Array to repeat.
 * @param array $range  Array of integers to loop through.
 * @param array $merge  Non-repeating array to merge with the repeated arrays.
 * @return array
 */
function repeat_shortcode_atts( array $repeat, array $range, $merge = [] ) {
	$repeated_array = [];
	foreach ( $range as $i ) {

		foreach ( $repeat as $key => $value ) {
			$key   = str_replace( '%s', $i, $key );
			$value = str_replace( '%s', $i, $value );

			$repeated_array[ $key ] = $value;
		}
	}

	return array_merge( $repeated_array, $merge );
}
