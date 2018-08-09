<?php
/**
 * Settings Page module.
 *
 * @package     NICABM\Utility
 * @since       0.2.1
 * @author      Tim Jensen
 * @link        https://nicabm.com/
 * @license     GNU General Public License 2.0+
 */

namespace NICABM\Utility;

add_action( 'init', __NAMESPACE__ . '\\register_settings_pages' );
/**
 * Register settings pages.
 *
 * @return void
 */
function register_settings_pages() {

	$config = include NICABM_UTILITY_CONFIG_DIR . '/settings-page.php';

	foreach ( (array) $config as $settings_config ) {
		( new Settings_Page( $settings_config ) )->init();
	}
}
