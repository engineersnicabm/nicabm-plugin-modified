<?php
/**
 * Renders the [nicabm-ruth-bio] shortcode.
 */

$nicabm_settings = get_option( 'nicabm_settings' );

$ruth_bio = $nicabm_settings['shortcodes'][0]['ruth_bio'] ?? '';

if ( ! $ruth_bio ) {
	return;
}

echo apply_filters( 'meta_content', wp_kses_post( $ruth_bio ) );
