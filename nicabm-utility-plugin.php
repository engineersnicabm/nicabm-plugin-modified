<?php
/**
 * Plugin Name: NICABM Utility Plugin
 * Plugin URI: https://bitbucket.org/nicabm/nicabm-utility-plugin
 * Description: The NICABM core functionality plugin.
 *
 * Version: 0.2.1
 *
 * Author: Tim Jensen
 * Author URI: https://www.timjensen.us
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.  You may NOT assume that you can use any other
 * version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * Text Domain: nicabm-utility-plugin
 *
 * @package NICABM\Utility
 *
 * BitBucket Plugin URI: https://bitbucket.org/nicabm/nicabm-utility-plugin
 * PHP Version 7.0+
 */

namespace NICABM\Utility;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'NICABM_UTILITY_DIR', __DIR__ );
define( 'NICABM_UTILITY_CONFIG_DIR', __DIR__ . '/config' );
define( 'NICABM_UTILITY_VIEWS_DIR', __DIR__ . '/views' );
define( 'NICABM_UTILITY_FILE', __FILE__ );
define( 'NICABM_UTILITY_URL', plugins_url( null, __FILE__ ) );

function load_frontend_files() {
	$files = [
		'vendor/autoload.php',
		'includes/advanced-custom-fields.php',
		'includes/custom-post-types.php',
		'includes/enqueue.php',
		'includes/formatting.php',
		'includes/genesis-theme-settings-meta-box.php',
		'includes/helper-functions.php',
		'includes/plugin.php',
		'includes/post-metabox.php',
		'includes/settings-page.php',
		'includes/shortcode-ui.php',
		'includes/shortcode.php',
		'includes/shortcode-ui-post-select-field.php',
	];

	array_walk( $files, function( $file ) {
		require_once NICABM_UTILITY_DIR . '/' . $file;
	} );
}

function load_admin_files() {
	require_once NICABM_UTILITY_DIR . '/vendor/CMB2/init.php';
}

load_frontend_files();

if ( is_admin() ) {
	load_admin_files();
}
