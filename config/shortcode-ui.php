<?php
/**
 * Shortcodes configuration array.
 *
 * @package     NICABM\Utility
 * @author      Tim Jensen <tim@timjensen.us>
 * @license     GNU General Public License 2.0+
 * @link        https://nicabm.com
 * @since       0.2.0
 */

namespace NICABM\Utility;

/**
 * Shortcode UI configuration.
 *
 * @see https://github.com/wp-shortcake/Shortcake/blob/master/dev.php
 */
return [
	[
		'tag'  => 'nicabm-testimonial',
		'args' => [
			'label'         => 'Testimonial',
			'listItemImage' => 'dashicons-thumbs-up',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => [
				[
					'label' => 'Choose Testimonial',
					'attr'  => 'post_id',
					'type'  => 'post_select',
					'query' => [
						'post_type' => 'nicabm_testimonial',
					],
				],
				[
					'label'   => 'Align image left or right?',
					'attr'    => 'image_align',
					'type'    => 'radio',
					'options' => [
						[
							'value' => '',
							'label' => 'Left',
						],
						[
							'value' => '1',
							'label' => 'Right',
						],
					],
				],
			],
		],
	],
	[
		'tag'  => 'nicabm-instructors',
		'args' => [
			'label'         => 'Instructors',
			'listItemImage' => 'dashicons-groups',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => repeat_shortcode_ui_atts(
				[
					'label' => 'Choose Instructor #%s',
					'attr'  => 'post_id_%s',
					'type'  => 'post_select',
					'query' => [
						'post_type' => 'nicabm_instructor',
					],
				],
				range( 1, 30 ),
				[
					[
						'label'   => 'Width',
						'attr'    => 'width',
						'type'    => 'radio',
						'options' => [
							[
								'value' => 'one-sixth',
								'label' => 'One Sixth',
							],
							[
								'value' => '',
								'label' => 'One Fourth',
							],
							[
								'value' => 'one-third',
								'label' => 'One Third',
							],
							[
								'value' => 'one-half',
								'label' => 'One Half',
							],
						],
					],
					[
						'label'   => 'Show Bio?',
						'attr'    => 'show_bio',
						'type'    => 'radio',
						'options' => [
							[
								'value' => '',
								'label' => 'Yes',
							],
							[
								'value' => 'false',
								'label' => 'No',
							],
						],
					],
				]
			),
		],
	],
	[
		'tag'  => 'nicabm-table',
		'args' => [
			'label'         => 'Table',
			'listItemImage' => 'dashicons-list-view',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => repeat_shortcode_ui_atts(
				[
					'label' => 'Table Row #%s',
					'attr'  => 'table_row_%s',
					'type'  => 'textarea',
				],
				range( 1, 10 )
			),
		],
	],
	[
		'tag'  => 'nicabm-guarantee',
		'args' => [
			'label'         => '30 Day Guarantee',
			'listItemImage' => 'dashicons-awards',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => [],
		],
	],
	[
		'tag'  => 'nicabm-ruth-bio',
		'args' => [
			'label'         => 'Ruth Buczynski bio',
			'listItemImage' => 'dashicons-id',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => [],
		],
	],
	[
		'tag'  => 'nicabm-courses',
		'args' => [
			'label'         => 'Courses',
			'listItemImage' => 'dashicons-id-alt',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => [
				[
					'label' => 'Choose a Course',
					'attr'  => 'post_id',
					'type'  => 'post_select',
					'query' => [
						'post_type' => 'nicabm_course',
					],
				],
			],
		],
	],
	[
		'tag'  => 'nicabm-image-lightbox',
		'args' => [
			'label'         => 'Image Lightbox',
			'listItemImage' => 'dashicons-editor-expand',
			'post_type'     => [ 'page', 'post', 'nicabm_program', 'nicabm_offer' ],
			'attrs'         => [
				[
					'label' => 'Image URL',
					'attr'  => 'url',
					'type'  => 'url',
				],
				[
					'label' => 'Thumbnail Image URL',
					'desc' => 'Optional. Enter the thumbnail image URL. Defaults to the Image URL.',
					'attr'  => 'thumbnail',
					'type'  => 'url',
				],
			],
		],
	],
];
