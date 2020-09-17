<?php
/**
 * Block Name: Badge on page
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$page_budge_icon_id     = ( isset( $meta_values['page_budge_icon'] ) ) ? $meta_values['page_budge_icon'] : null;
$page_budge_icon_url    = ( isset( $meta_values['page_budge_icon'] ) ) ? wp_get_attachment_image_url( $page_budge_icon_id , 'full' ) : null;
$page_budge_title       = ( isset( $meta_values['page_budge_title'] ) ) ? $meta_values['page_budge_title'] : null;
$page_budge_description = ( isset( $meta_values['page_budge_description'] ) ) ? $meta_values['page_budge_description'] : null;
$page_budge_button_text = ( isset( $meta_values['page_budge_button-text'] ) ) ? $meta_values['page_budge_button-text'] : null;
$page_budge_button_link = ( isset( $meta_values['page_budge_button-link'] ) ) ? $meta_values['page_budge_button-link'] : null;

?>

<div class="row">
    <div class="col-xs-12-12 col-md-12-12 badge-block__wrapper">
                <?php
                if ( $page_budge_icon_url ) {
                    echo '<img src="'.$page_budge_icon_url.'" alt="thumb" class="badge-block__icon" />';
                }
                if ( !empty($page_budge_title)) {
                    echo '<p class="badge-block__title">'.$page_budge_title.'</p>';
                }
                if ( !empty($page_budge_description)) {
                    echo '<p class="badge-block__description">'.$page_budge_description.'</p>';
                }
                if ( !empty($person_position)) {
                    echo '<p class="badge-block__badge-position">'.$person_position.'</p>';
                }
                if ( !empty($page_budge_button_text) && !empty($page_budge_button_link) ) {
                    echo '<a href="'.$page_budge_button_link.'" class="btn-primary js-open-popup-activator">'.$page_budge_button_text.'</a>';
                }
                ?>
    </div>
</div>

