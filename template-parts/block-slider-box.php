<?php
/**
 * Block Name: Slider box
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$slider_box_title_caption    = ( isset( $meta_values['slider_box_title-captions'] ) ) ? $meta_values['slider_box_title-captions'] : null;
$slider_box_title            = ( isset( $meta_values['slider_box_title'] ) ) ? $meta_values['slider_box_title'] : null;
$slider_box_repeater         = ( isset( $meta_values['slider_box_repeater'] ) ) ? $meta_values['slider_box_repeater'] : null;
$slider_box_background_id    = ( isset( $meta_values['slider_box_background'] ) ) ? $meta_values['slider_box_background'] : null;
$slider_box_background_url   = ( isset( $meta_values['slider_box_background'] ) ) ? wp_get_attachment_image_src( $slider_box_background_id , 'full' ) : null;

?>

<?php
if ($slider_box_background_id){
	echo '<div class="slider-box__wrapper section-global-padding-bottom section-global-padding-top" style="background-image: url(' .$slider_box_background_url[0]. ')">';
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12-12 col-md-12-12">
            <?php
            echo '<h2 class="slider-box__title" data-title="'.$slider_box_title_caption.'">'.$slider_box_title.'</h2>'
            ?>
            <div class="slider-box__slider-wrapper js-fade-slider-wrapper">
            <div class="js-fade-slider">
                <?php
                if ( !is_null( $slider_box_repeater ) ) {
                foreach ($slider_box_repeater as $item) {
                    $title              = $item['slide_title'];
                    $subtitle           = $item['slide_subtitle'];
                    $description_text   = $item['slide_description'];
                    $image_id           = $item['slide_photo'];
                    ?>
                    <div>
                        <div class="slider-box__wrapper">
                            <div class="slider-box__column">
                                <figure>
                                    <?php
                                    if ( $image_id ) {
                                        printf( '<img src="%s" srcset="%s" class="slider-box__big-image">',
                                            wp_get_attachment_image_url( $image_id ),
                                            wp_get_attachment_image_srcset( $image_id, 'full' )
                                        );
                                    }
                                    ?>
                                </figure>
                            </div>
                            <div class="slider-box__content-wrapper">
                                <div class="slider-box__column for-text">
		                            <?php
                                    if ( !empty($title) ) {
	                                    echo '<h3 class="slider-box__slide-title">' . $title . '</h2>';
                                    }
                                    if ( !empty( $subtitle) ){
	                                    echo '<p class="slider-box__slide-subtitle">'.$subtitle.'</p>';
                                    }
		                            if ( !empty( $description_text ) ) {
			                            echo do_shortcode( $description_text );
		                            }
		                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                }
                ?>
            </div>
                <div class="slider-box__navigation">
                    <button class="slider-box__nav-prev js-prev"></button>
                    <button class="slider-box__nav-next js-next"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($slider_box_background_id){
	echo '</div>';
}
?>