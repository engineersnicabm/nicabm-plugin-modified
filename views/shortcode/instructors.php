<?php
/**
 * Shortcode [nicabm-instructors] view file.
 *
 * @var $atts
 */

namespace NICABM\Utility;

$posts = get_cached_posts( $atts, [ 'post_type' => 'nicabm_instructor' ] );

if ( empty( $posts ) ) {
	return '';
}

$show_bio = filter_var( $atts['show_bio'], FILTER_VALIDATE_BOOLEAN );

$classes[] = 'text-align--left nicabm-instructors__single';

$width_lookup = [
	'one-sixth'     => 'col-xs-12 col-sm-6 col-md-2',
	'one-fourth'    => 'col-xs-12 col-sm-6 col-md-3',
	'one-third'     => 'col-xs-12 col-sm-6 col-md-4',
	'one-half'      => 'col-xs-12 col-sm-6 col-md-6',
	'two-thirds'    => 'col-xs-12 col-sm-6 col-md-8',
	'three-fourths' => 'col-xs-12 col-sm-6 col-md-9',
	'five-sixths'   => 'col-xs-12 col-sm-6 col-md-10',
	'full'          => 'col-xs-12 col-sm-6 col-md-12',
];

$classes[] = $width_lookup[ $atts['width'] ] ?? 'col-xs-12 col-sm-6 col-md-3';

$row_classes = 'row center-xs nicabm-instructors';
if ( $show_bio ) {
	$row_classes .= ' nicabm-instructors--scroll';
}

?>

<div class="<?php echo esc_attr( $row_classes ); ?>">
	<?php foreach ( $posts as $post ) : ?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="nicabm-instructors__profile">
				<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
			</div>
			<div class="nicabm-instructors__bio-wrap">
				<?php $credentials = get_post_meta( $post->ID, 'nicabm_instructor_credentials', true ) ?? ''; ?>
				<h3 class="nicabm-instructors__name">
					<?php echo esc_html( $post->post_title . ' ' . $credentials ); ?>
				</h3>
				<?php if ( true === $show_bio ) : ?>
					<?php remove_filter( 'meta_content', 'wpautop' ); ?>
					<p class="nicabm-instructors__bio">
						<?php echo apply_filters( 'meta_content', wp_kses_post( $post->post_content ) ); // WPCS: XSS ok. ?>
					</p>
					<?php add_filter( 'meta_content', 'wpautop' ); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
