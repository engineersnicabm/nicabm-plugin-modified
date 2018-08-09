<?php
/**
 * Enqueue Assets
 *
 * @package       NICABM\Utility
 * @author        Tim Jensen <tim@timjensen.us>
 * @license       GNU General Public License 2.0+
 * @link          https://nicabm.com
 * @since         0.1.0
 */

namespace NICABM\Utility;

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts' );

function enqueue_admin_scripts() {

	wp_enqueue_style( 'nicabm-cmb2-admin-styles', NICABM_UTILITY_URL . '/assets/css/cmb2-admin-styles.css', [], '0.1.0' );

}
