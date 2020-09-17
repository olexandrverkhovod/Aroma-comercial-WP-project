<?php
/**
 * Block Name: Split info box
 *
 * This is the template that displays the equipment overview block.
 */


$meta_values = get_fields();

$split_title_left         = ( isset( $meta_values['left_column']['split_title_left'] ) ) ? $meta_values['left_column']['split_title_left'] : '';
$split_description_left   = ( isset( $meta_values['left_column']['split_description_left'] ) ) ? $meta_values['left_column']['split_description_left'] : '';
$split_button_text_left   = ( isset( $meta_values['left_column']['split_button_text_left'] ) ) ? $meta_values['left_column']['split_button_text_left'] : null;
$split_button_link_left   = ( isset( $meta_values['left_column']['split_button_link_left'] ) ) ? $meta_values['left_column']['split_button_link_left'] : null;
$split_image_left_id      = ( isset( $meta_values['left_column']['split_image_left'] ) ) ? $meta_values['left_column']['split_image_left'] : null;
$split_image_left_url     = wp_get_attachment_image_url( $split_image_left_id, 'full' );
$split_title_right        = ( isset( $meta_values['right_column']['split_title_right'] ) ) ? $meta_values['right_column']['split_title_right'] : '';
$split_description_right  = ( isset( $meta_values['right_column']['split_description_right'] ) ) ? $meta_values['right_column']['split_description_right'] : '';
$split_button_text_right   = ( isset( $meta_values['right_column']['split_button_text_right'] ) ) ? $meta_values['right_column']['split_button_text_right'] : null;
$split_button_link_right   = ( isset( $meta_values['right_column']['split_button_link_right'] ) ) ? $meta_values['right_column']['split_button_link_right'] : null;
$split_image_right_id     = ( isset( $meta_values['right_column']['split_image_right'] ) ) ? $meta_values['right_column']['split_image_right'] : null;
$split_image_right_url    = wp_get_attachment_image_url( $split_image_right_id, 'full' );

?>

<div id="split-info" class="split-info">
    <div class="split-info__wrap-left" style="background-image: url(<?php echo $split_image_left_url ?>)">
        <div class="split-info__left-part">
            <?php
                if(! empty($split_title_left)){
	                echo '<h2 class="split-info__title">'.$split_title_left.'</h2>';
                }
                
                if(! empty($split_description_left)){
	                echo do_shortcode($split_description_left);
                }
                
                if ( ! empty( $split_button_text_left ) && ! empty( $split_button_link_left ) ) {
                    echo '<div><a href="' . $split_button_link_left . '" class="btn-primary">' . $split_button_text_left . '</a></div>';
                }
            ?>
        </div>
    </div>
    <div class="split-info__wrap-right" style="background-image: url(<?php echo $split_image_right_url ?>)">
        <div class="split-info__right-part">
	        <?php
	        if(! empty($split_title_right)){
		        echo '<h2 class="split-info__title">'.$split_title_right.'</h2>';
	        }
	
	        if(! empty($split_description_right)){
		        echo do_shortcode($split_description_right);
	        }
	
	        if ( ! empty( $split_button_text_right ) && ! empty( $split_button_link_right ) ) {
		        echo '<div><a href="' . $split_button_link_right . '" class="btn-primary">' . $split_button_text_right . '</a></div>';
	        }
	        ?>
        </div>
    </div>
</div>
