<?php
/**
 * @var array $atts Shortcode attributes, mainly 'url'.
 */

$url       = $atts['url'] ?? '';
$thumbnail = $atts['thumbnail'] ?? $url;

if ( ! $url ) {
	return '';
}
?>

<a href="<?php echo esc_url( $url ); ?>" data-featherlight="image">
	<img src="<?php echo esc_url( $thumbnail ); ?>" alt="Image opens in lightbox"/>
</a>
