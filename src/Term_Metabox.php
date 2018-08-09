<?php
/**
 * CMB2 Term Metaboxes
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://nicabm.com
 * @since       0.1.0
 */

namespace NICABM\Utility;

use NICABM\Utility\Post_Metabox;

/**
 * Class Term_Metabox
 *
 * @version 0.1.0
 *
 * @package NICABM\Utility
 */
class Term_Metabox extends Post_Metabox {

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param array $config Metabox configuration array.
	 */
	public function __construct( array $config ) {
		parent::__construct( $config );

		$this->metabox_config['object_types'] = [ 'term' ];
	}
}
