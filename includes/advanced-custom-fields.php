<?php
/**
 * advanced-custom-fields.php
 *
 * @package     NICABM\\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @since       0.1.0
 */

namespace NICABM\Utility;

add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\\acf_json_save_path' );
/**
 * Changes the default path for saving ACF field group configuration files.
 *
 * @param string $path Path where ACF JSON files are saved.
 *
 * @return string
 */
function acf_json_save_path( $path ) {

	return get_acf_json_dir();
}

add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\\acf_json_load_path' );
/**
 * Adds the theme's ACF JSON directory to ACF's JSON load points.
 *
 * @param array $paths Paths to the ACF JSON load points.
 *
 * @return array
 */
function acf_json_load_path( $paths ) {

	$paths[] = get_acf_json_dir();

	return $paths;
}

/**
 * Returns the path where we want to save/load ACF JSON files.
 *
 * @return string
 */
function get_acf_json_dir() {
	return NICABM_UTILITY_CONFIG_DIR . '/acf-json';
}

add_filter( 'acf/fields/flexible_content/layout_title/name=nicabm_rows', __NAMESPACE__ . '\\change_nicabm_rows_layout_title', 10, 4 );
/**
 * Change the layout title for nicabm_rows.
 *
 * @param string $title Layout title.
 * @param array $field ACF field.
 * @param array $layout ACF layout.
 * @param string $i ACF field index.
 * @return string
 */
function change_nicabm_rows_layout_title( $title, $field, $layout, $i ) {

	if ( 'rows_with_columns' !== $layout['name'] ) {
		return $title;
	}

	$title = get_sub_field( 'heading' ) ?: $title;

	return $title;
}
