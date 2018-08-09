<?php
/**
 * Initializes the Shortcode UI elements.
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @since       0.1.0
 */

namespace NICABM\Utility;


add_action( 'register_shortcode_ui', __NAMESPACE__ . '\\register_shortcode_ui' );
/**
 * Register shortcode UI.
 *
 * @return void
 */
function register_shortcode_ui() {
	$config = include NICABM_UTILITY_CONFIG_DIR . '/shortcode-ui.php';

	array_walk( $config, function( $shortcode_ui_config ) {
		( new Shortcode_UI( $shortcode_ui_config ) )->init();
	} );
}

/**
 * Returns repeated shortcode attributes.
 *
 * @param array $repeat Array to repeat.
 * @param array $range  Array of integers to loop through.
 * @param array $merge  Non-repeating array to merge with the repeated arrays.
 * @return array
 */
function repeat_shortcode_ui_atts( array $repeat, array $range, $merge = [] ) {
	foreach ( $range as $i ) {

		foreach ( $repeat as $key => $value ) {
			if ( is_string( $value ) ) {
				$value = str_replace( '%s', $i, $value );
			}

			$repeated[ $key ] = $value;

		}

		$repeated_array[] = $repeated;
	}

	return array_merge( $repeated_array, $merge );
}
