<?php
/**
 * Shortcodes configuration array.
 *
 * @package        NICABM\Utility\Shortcodes
 * @author         Tim Jensen <tim@timjensen.us>
 * @license        GNU General Public License 2.0+
 * @link           https://www.timjensen.us
 * @since          0.1.0
 */

namespace NICABM\Utility;

/**
 * Shortcode configuration.
 *
 * @see https://codex.wordpress.org/Function_Reference/add_shortcode
 */
return [
	[
		'tag'     => 'recent-posts',
		'args'    => [
			'count'     => 1,
			'post_type' => 'post',
		],
		'view'    => NICABM_UTILITY_VIEWS_DIR . '/shortcode/recent-posts.php',
		'scripts' => [
			[
				'handle' => 'nicabm-scripts',
				'src'    => 'https://code.jquery.com/jquery-3.2.1.min.js',
				'ver'    => '0.1.0',
//				'localize_script' => [
//					'data'   => defaults to shortcode atts,
//					'encode' => optional encoding,
//				],
			],
		],
	],
	[
		'tag'  => 'nicabm-testimonial',
		'args' => [
			'post_id'     => 0,
			'image_align' => 'left',
		],
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/testimonial.php',
	],
	[
		'tag'  => 'nicabm-instructors',
		'args' => repeat_shortcode_atts(
			[ 'post_id_%s' => 0 ],
			range( 1, 30 ),
			[
				'width'    => 'one-fourth',
				'show_bio' => 'true',
			]
		),
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/instructors.php',
	],
	[
		'tag'  => 'nicabm-table',
		'args' => repeat_shortcode_atts(
			[ 'table_row_%s' => '' ],
			range( 1, 10 )
		),
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/table.php',
	],
	[
		'tag'  => 'nicabm-guarantee',
		'args' => [],
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/guarantee.php',
	],
	[
		'tag'  => 'nicabm-courses',
		'args' => [
			'post_id' => '',
		],
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/courses.php',
	],
	[
		'tag'  => 'nicabm-ruth-bio',
		'args' => [],
		'view' => NICABM_UTILITY_VIEWS_DIR . '/shortcode/ruth-bio.php',
	],
	[
		'tag'     => 'nicabm-image-lightbox',
		'args'    => [
			'url'       => '',
			'thumbnail' => '',
		],
		'view'    => NICABM_UTILITY_VIEWS_DIR . '/shortcode/image-lightbox.php',
		'scripts' => [
			[
				'handle' => 'featherlight',
				'src'    => 'https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.13/featherlight.min.js',
				'ver'    => '1.7.13',
				'deps'   => [ 'jquery' ],
			],
			[
				'handle' => 'featherlight',
				'src'    => 'https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.13/featherlight.min.css',
				'ver'    => '1.7.13',
				'deps'   => [],
			],
		],
	],
];
