<?php

/**
 * Block Name: Top benefits
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$top_benefits    = ( isset( $meta_values['top_benefits_repeater'] ) ) ? $meta_values['top_benefits_repeater'] : null;

$callback_text   = ( isset( $meta_values ['benefits_button']['benefits_callback_text'] ) ) ? $meta_values ['benefits_button']['benefits_callback_text'] : null;
$callback_link   = ( isset( $meta_values ['benefits_button']['benefits_callback_link'] ) ) ? $meta_values ['benefits_button']['benefits_callback_link'] : null;
?>

<div id="benefits-box" class="benefits-box">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<div class="benefits-box__icons-wrapper">
					<?php
					if ( !is_null( $top_benefits ) ) {
					foreach ($top_benefits as $benefits) {
						$icon_id    = $benefits['icon'];
						$icon_url   = wp_get_attachment_image_url( $icon_id, 'full' );
						$subtitle   = $benefits['subtitle'];
						?>
						<div class="benefits-box__icon-wrapper">
							<?php
							if ( $icon_url ) {
								echo '<img src="'.$icon_url.'" alt="thumb" class="benefits-box__icon" />';
							}
							
							if ( !empty( $subtitle ) ) {
								echo '<div class="benefits-box__subtitle">' .$subtitle. '</div>';
							}
							?>
							
						</div>
					<?php
					}
					}
					?>
     
				</div>
                <div class="benefits-box__callback-button">
					<?php
					if ( !empty($callback_text) && !empty($callback_link) ) {
						echo '<a href="'.$callback_link.'" class="btn-primary js-open-popup-activator">'.$callback_text.'</a>';
					}
					?>
                </div>
			</div>
		</div>
	</div>
</div>
			