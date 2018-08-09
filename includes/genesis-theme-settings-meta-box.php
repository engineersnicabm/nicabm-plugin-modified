<?php
/**
 * Initialize Genesis Theme Settings Meta Box
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @since       0.2.0
 */

namespace NICABM\Utility;

add_action( 'plugins_loaded', __NAMESPACE__ . '\\do_genesis_theme_settings_meta_boxes' );
/**
 * Initialize the custom Genesis Theme Settings meta boxes.
 *
 * @since 0.2.0
 * @return void
 */
function do_genesis_theme_settings_meta_boxes() {
	if ( ! is_admin() ) {
		return;
	}

	$genesis_settings_config = include NICABM_UTILITY_CONFIG_DIR . '/genesis-theme-settings-meta-box.php';

	foreach ( (array) $genesis_settings_config as $metabox ) {
		( new Genesis_Theme_Settings_Meta_Box( $metabox ) )->init();
	}
}
