<?php
/**
 * Genesis Theme Settings Meta Box configuration.
 *
 * @package   NICABM\Utility
 * @since     0.2.0
 * @author    Tim Jensen
 * @link      https://nicabm.com/
 * @license   GNU General Public License 2.0+
 */

/**
 * Config array.
 *
 * 'metabox' (array) => Configuration array to pass to `CMB2()`.
 * 'fields'  (array) => Configuration arrays to pass to
 *                      `CMB2->add_field()`.
 *
 * @see https://github.com/CMB2/CMB2/blob/master/example-functions.php
 *
 * @return array
 */
return [
	[
		'metabox' => [
			'title'      => 'Site Footer',
			'priority'   => 'high', // 'high' or 'low'.
			'show_names' => true,
			'closed'     => false,
//			'classes'    => 'extra-classes',
		],
		'fields'  => [
			[
				'name' => 'Credits/Copyright',
				'id'   => 'footer_credits',
				'type' => 'wysiwyg',
			],
		],
	],
];
