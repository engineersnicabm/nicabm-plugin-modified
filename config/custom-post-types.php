<?php
/**
 * Custom Post Types Configuration
 *
 * @package     NICABM\Utility\CustomPostTypes
 * @since       0.1.0
 * @author      Tim Jensen
 * @link        https://nicabm.com/
 * @license     GNU General Public License 2.0+
 */

namespace NICABM\Utility;

/**
 * The configuration array for registering custom post types.
 * The args array follows the same format as the Codex except for labels,
 * which are auto generated based upon the values for 'singular' and 'plural'
 *
 * @see https://codex.wordpress.org/Function_Reference/register_post_type
 */
return [
	[
		'post_type' => 'nicabm_course',
		'args'      => [
			'labels'            => [
				'singular'  => 'Course',
				'plural'    => 'Courses',
				'menu_name' => 'Courses',
			],
			'public'            => true,
			'supports'          => [
				'title',
				'revisions',
			],
			'has_archive'       => false,
			'rewrite'           => [
				'slug' => 'courses',
			],
			'menu_icon'         => 'dashicons-book-alt',
			'show_in_rest'      => true,
			'menu_position'     => 25,
			'title_placeholder' => 'Enter Course title here',
		],
	],
	[
		'post_type' => 'nicabm_program',
		'args'      => [
			'labels'            => [
				'singular'  => 'Program',
				'plural'    => 'Programs',
				'menu_name' => 'Programs',
			],
			'public'            => true,
			'supports'          => [
				'editor',
				'genesis-scripts',
				'genesis-seo',
				'page-attributes',
				'revisions',
				'thumbnail',
				'title',
			],
			'has_archive'       => false,
			'rewrite'           => [
				'slug' => 'programs',
			],
			'menu_icon'         => 'dashicons-welcome-learn-more',
			'show_in_rest'      => true,
			'menu_position'     => 25,
			'title_placeholder' => 'Enter Program name here',
		],
	],
	[
		'post_type' => 'nicabm_offer',
		'args'      => [
			'labels'            => [
				'singular'  => 'Offer',
				'plural'    => 'Offers',
				'menu_name' => 'Offers',
			],
			'public'            => true,
			'supports'          => [
				'editor',
				'genesis-scripts',
				'genesis-seo',
				'page-attributes',
				'revisions',
				'thumbnail',
				'title',
			],
			'has_archive'       => false,
			'rewrite'           => [
				'slug' => 'offers',
			],
			'menu_icon'         => 'dashicons-migrate',
			'show_in_rest'      => true,
			'menu_position'     => 25,
			'title_placeholder' => 'Enter Offer title here',
		],
	],
	[
		'post_type' => 'nicabm_instructor',
		'args'      => [
			'labels'            => [
				'singular'  => 'Instructor',
				'plural'    => 'Instructors',
				'menu_name' => 'Instructors',
			],
			'public'            => true,
			'supports'          => [
				'title',
				'editor',
				'thumbnail',
				'revisions',
			],
			'has_archive'       => false,
			'rewrite'           => [
				'slug' => 'instructors',
			],
			'menu_icon'         => 'dashicons-businessman',
			'show_in_rest'      => true,
			'menu_position'     => 25,
			'title_placeholder' => 'Enter Instructor name here',
		],
	],
	[
		'post_type' => 'nicabm_testimonial',
		'args'      => [
			'labels'            => [
				'singular'  => 'Testimonial',
				'plural'    => 'Testimonials',
				'menu_name' => 'Testimonials',
			],
			'public'            => true,
			'supports'          => [
				'title',
				'editor',
				'thumbnail',
				'revisions',
			],
			'has_archive'       => false,
			'rewrite'           => [
				'slug' => 'testimonials',
			],
			'menu_icon'         => 'dashicons-thumbs-up',
			'show_in_rest'      => true,
			'menu_position'     => 25,
			'title_placeholder' => 'Enter Testimonial headline here',
		],
	],
];
