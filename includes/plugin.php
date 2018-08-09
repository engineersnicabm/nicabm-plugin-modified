<?php
/**
 * Plugin activation and deactivation functions.
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://nicabm.com
 * @since       0.1.0
 */

namespace NICABM\Utility;

register_activation_hook( NICABM_UTILITY_FILE, __NAMESPACE__ . '\activate_the_plugin' );
/**
 * Initialize the rewrites for our new custom post type
 * upon activation.
 *
 * @since 0.1.0
 *
 * @return void
 */
function activate_the_plugin() {
	flush_rewrite_rules();
}

register_deactivation_hook( NICABM_UTILITY_FILE, __NAMESPACE__ . '\deactivate_plugin' );
/**
 * The plugin deactivation cleanup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function deactivate_plugin() {
	delete_option( 'rewrite_rules' );
}
