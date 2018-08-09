<?php
/**
 * Initialize plugin functionality
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @since       0.1.0
 */

namespace NICABM\Utility;

init_cpts();

/**
 * Initialize the CPTs.
 *
 * @since 0.1.0
 */
function init_cpts() {
	$config = include NICABM_UTILITY_CONFIG_DIR . '/custom-post-types.php';

	array_walk( $config, function( $cpt ) {
		$cpt = new Custom_Post_Type( $cpt );
		$cpt->init();
	} );
}
