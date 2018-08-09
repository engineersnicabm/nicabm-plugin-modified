<?php
/**
 * Post metaboxes.
 *
 * @package   NICABM\Utility\PostMetaboxes
 * @since     0.1.0
 * @author    Tim Jensen
 * @link      https://nicabm.com/
 * @license   GNU General Public License 2.0+
 */

namespace NICABM\Utility;

/**
 * This is an example config array.
 *
 * 'metabox'  (array) => The CMB2 meta box configuration array.
 * 'fields'   (array) => The CMB2 fields that will display within the meta box.
 *
 * @see https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types
 */
return [
	[
		'metabox' => [
			'object_types' => [ 'nicabm_testimonial' ],
			'title'        => 'Testimonial Details',
		],
		'fields'  => [
			[
				'name'    => 'Name',
				'id'      => 'nicabm_testimonial_name',
				'type'    => 'text',
				'default' => false,
			],
			[
				'name'    => 'Position/title',
				'id'      => 'nicabm_testimonial_credentials',
				'type'    => 'text',
				'default' => false,
			],
			[
				'name'    => 'Location',
				'id'      => 'nicabm_testimonial_location',
				'type'    => 'text',
				'default' => false,
			],
		],
	],
	[
		'metabox' => [
			'object_types' => [ 'nicabm_instructor' ],
			'title'        => 'Instructor Details',
		],
		'fields'  => [
			[
				'name'    => 'Position/title',
				'id'      => 'nicabm_instructor_credentials',
				'type'    => 'text',
				'default' => false,
			],
		],
	],
	[
		'metabox' => [
			'object_types' => [ 'nicabm_program' ],
			'title'        => 'Custom Page Style/CSS',
		],
		'fields'  => [
			[
				'name'                => '',
				'description'         => 'Add custom CSS here. Do not include opening & closing style tags.',
				'id'                  => 'nicabm_page_css',
				'type'                => 'textarea_code',
				'syntax_highlighting' => true,
			],
		],
	],
];
