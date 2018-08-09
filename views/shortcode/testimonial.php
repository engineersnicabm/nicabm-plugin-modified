<?php
/**
 * Shortcode [nicabm-testimonial] view file.
 *
 * @var $atts
 */

namespace NICABM\Utility;

if ( empty( $atts['post_id'] ) ) {
	return '';
}

$post = get_cached_post( $atts['post_id'], [ 'post_type' => 'nicabm_testimonial' ] );

if ( empty( $post ) ) {
	return '';
}

$name      = get_post_meta( $post->ID, 'nicabm_testimonial_name', true );
$title     = get_post_meta( $post->ID, 'nicabm_testimonial_credentials', true );
$signature = $name && $title ? $name . ', ' . $title : $name;
$location  = get_post_meta( $post->ID, 'nicabm_testimonial_location', true );
?>

<div class="row<?php echo 'left' === $atts['image_align'] ? '' : ' reverse'; ?> nicabm-testimonials">
	<div class="col-xs-12 col-md-3 nicabm-testimonials__image">
		<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
	</div>
	<div class="col-xs-12 col-md-9 nicabm-testimonials__content">
		<h4><?php echo esc_html( $post->post_title ); ?></h4>
		<?php echo apply_filters( 'meta_content', wp_kses_post( $post->post_content ) ); // WPCS: XSS ok. ?>
		<?php if ( $signature ) : ?>
			<h5>
				<?php echo esc_html( $signature ); ?><br>
				<?php echo esc_html( $location ); ?>
			</h5>
		<?php endif; ?>
	</div>
</div>
