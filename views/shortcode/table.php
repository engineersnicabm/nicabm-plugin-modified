<?php
/**
 * Shortcode [nicabm-table] view file.
 *
 * @var $atts
 */

namespace NICABM\Utility;

$classes = [
	'nicabm-table',
	'text-align--left',
];

?>
<div class="row center-xs">
	<div class="col-xs-12 col-sm-10">
		<table class="nicabm-table">
			<tbody>
			<?php foreach ( $atts as $table_row ) : ?>
				<?php if ( ! empty( $table_row ) ) : ?>
					<tr class="nicabm-table__row">
						<td class="nicabm-table__mark">
							<img src="https://s3.amazonaws.com/nicabm-stealthseminar/images/icons/checkmark.png" alt="Check mark">
						</td>
						<td class="nicabm-table__data"><?php echo esc_html( $table_row ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
