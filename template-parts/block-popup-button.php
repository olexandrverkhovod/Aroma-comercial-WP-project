<?php
/**
 * Block Name: Pop-up button
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();
$button_callback_text   = ( isset( $meta_values['popup_button_text'] ) ) ? $meta_values['popup_button_text'] : null;
$button_callback_link   = ( isset( $meta_values['popup_button_link'] ) ) ? $meta_values['popup_button_link'] : null;

?>

<div class="callback-button">
	<?php
	if ( !empty($button_callback_text) && !empty($button_callback_link) ) {
		echo '<a href="'.$button_callback_link.'" class="btn-primary js-open-popup-activator">'.$button_callback_text.'</a>';
	}
	?>
</div>
