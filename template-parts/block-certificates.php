<?php
/**
 * Block Name: Certificates slider
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values = get_fields();

$certificates_image = ( isset( $meta_values['certificates_field_image'] ) ) ? $meta_values['certificates_field_image'] : null;

?>

<div class="certificates__slider-wrapper js-fade-slider-wrapper cert">
        <div class="js-fade-slider">
	        <?php
	        if ( !is_null( $certificates_image ) ) {
		        foreach ($certificates_image as $item) {
		            $certificate_id     = $item['image'];
			        $certificate_url    = wp_get_attachment_image_url( $certificate_id, 'full' );
			        
			        echo '<div><figure><img src="'.$certificate_url.'" alt="thumb" class="certificates__big-image"/></figure></div>';
		        }
		        }
		        ?>
	        
        </div>
        <div class="certificates__navigation">
            <button class="slider-box__nav-prev js-prev"></button>
            <button class="slider-box__nav-next js-next"></button>
        </div>
</div>