<?php
/**
 * Shortcode [nicabm-courses] view file.
 *
 * @var $atts
 */

namespace NICABM\Utility;

$post_id = $atts['post_id'];

if ( empty( $post_id ) ) {
	return '';
}

$config = json_decode( file_get_contents( get_acf_json_dir() . '/group_5a54f8e42e14d.json' ), true );

$acf_meta = get_all_custom_field_meta( $post_id, $config );

$course_rows = empty( $acf_meta['nicabm_course_videos'] ) ? false : $acf_meta['nicabm_course_videos'];

if ( ! $course_rows ) {
	return '';
}

?>

<?php foreach ( $course_rows as $row ) : ?>
	<div class="row course-row">
		<div class="col-xs-12 col-sm-4 course-row__image row__content--padding-normal">
			<?php echo wp_get_attachment_image( $row['image'], 'medium', false, [ 'width' => 335 ] ); ?>
		</div>
		<div class="col-xs-12 col-sm-8 course-row__content row__content--padding-normal">
			<?php echo apply_filters( 'meta_content', wp_kses_post( $row['content'] ) ); // WPCS: XSS ok. ?>
		</div>
	</div>
<?php endforeach; ?>
