<?php
/**
 * Block Name: Person block
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$person_image_id      = ( isset( $meta_values['person_block_image'] ) ) ? $meta_values['person_block_image'] : null;
$person_image_url     = ( isset( $meta_values['person_block_image'] ) ) ? wp_get_attachment_image_url( $person_image_id, 'full' ) : null;
$person_name          = ( isset( $meta_values['person_block_name'] ) ) ? $meta_values['person_block_name'] : null;
$person_surname       = ( isset( $meta_values['person_block_surname'] ) ) ? $meta_values['person_block_surname'] : null;
$person_position      = ( isset( $meta_values['person_block_position'] ) ) ? $meta_values['person_block_position'] : null;
$person_company_name  = ( isset( $meta_values['person_block_company-name'] ) ) ? $meta_values['person_block_company-name'] : null;

?>
<div class="row">
	<div class="col-xs-12-12 col-md-12-12 person-block__wrapper">
				<div class="person-block__image-wrapper">
                    <?php
                    if ( $person_image_url ) {
	                    echo '<img src="' . $person_image_url . '" alt="thumb" class="person-block__big-image" />';
                    }
				    ?>
                    <?php
                    echo '<div class="person-block__badge">';

                    if ( !empty($person_name)) {
	                    echo '<p class="person-block__badge-name">'.$person_name.'</p>';
                    }
                    if ( !empty($person_surname)) {
	                    echo '<p class="person-block__badge-surname">'.$person_surname.'</p>';
                    }
                    if ( !empty($person_position)) {
	                    echo '<p class="person-block__badge-position">'.$person_position.'</p>';
                    }
                    if ( !empty($person_company_name)) {
	                    echo '<p class="person-block__badge-company-name">'.$person_company_name.'</p>';
                    }

                    echo '</div>';
                    ?>
                </div>
                
               
	</div>
</div>
