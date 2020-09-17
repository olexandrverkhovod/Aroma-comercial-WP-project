<?php
/**
 * Block Name: Aroma with features and badge
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values = get_fields();

$aroma_title_caption     = ( isset( $meta_values['aroma_features_title_caption'] ) ) ? $meta_values['aroma_features_title_caption'] : '';
$aroma_title             = ( isset( $meta_values['aroma_features_title'] ) ) ? $meta_values['aroma_features_title'] : '';
$aroma_description       = ( isset( $meta_values['aroma_features_description'] ) ) ? $meta_values['aroma_features_description'] : '';
$aroma_cards_repeater    = ( isset( $meta_values['aroma_features_cards_repeater'] ) ) ? $meta_values['aroma_features_cards_repeater'] : '';
$aroma_badge_count       = ( isset( $meta_values['aroma_badge_count'] ) ) ? $meta_values['aroma_badge_count'] : '';
$aroma_budge_description = ( isset( $meta_values['aroma_badge_description'] ) ) ? $meta_values['aroma_badge_description'] : '';
$aroma_image_id          = ( isset( $meta_values['aroma_image'] ) ) ? $meta_values['aroma_image'] : '';

?>

<div id="aroma-features" class="aroma-features">
    <div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="features-cards__title" data-title="'.$aroma_title_caption.'">'.$aroma_title.'</h2>';
				
				echo '<p class="features-cards__subtitle">'.$aroma_description.'</p>'
				?>
                <div class="aroma-features__wrapper">
                    <div class="aroma-features__features-wrapper">
		                <?php
		                if ( !is_null( $aroma_cards_repeater ) ) {
			                foreach ($aroma_cards_repeater as $item) {
				                $icon_id       = $item['icon'];
				                $icon_url      = wp_get_attachment_image_url( $icon_id, 'full' );
				                $description   = $item['description'];
				                ?>
                                <div class="aroma-features__icon-wrapper">
					                <?php
					                if ( $icon_url ) {
						                echo '<img src="'.$icon_url.'" alt="thumb" class="aroma-features__icon" />';
					                }
					
					                if ( !empty( $title ) ) {
						                echo '<div class="aroma-features__icon-title">' .$title. '</div>';
					                }
					
					                if ( !empty( $description ) ) {
						                echo '<p class="aroma-features__description">'.$description.'</p>';
					                }
					                ?>

                                </div>
				                <?php
			                }
		                }
		                ?>

                    </div>
                    <div class="aroma-features__aroma-wrapper">
                        <div class="aroma-features__badge-wrapper">
                            <div class="aroma-features__badge">
			                    <?php
			                    if (! empty($aroma_badge_count)){
				                    echo '<p class="aroma-features__badge-count">'.$aroma_badge_count.'</p>';
			                    }
			                    if (! empty($aroma_budge_description)){
				                    echo '<p class="aroma-features__badge-description">'.$aroma_budge_description.'</p>';
			                    }
			                    ?>
                            </div>
                        </div>
                        <figure>
			                <?php
			                if ( $aroma_image_id  ) {
				                printf( '<img src="%s" srcset="%s" class="aroma-features__big-image">',
					                wp_get_attachment_image_url( $aroma_image_id  ),
					                wp_get_attachment_image_srcset( $aroma_image_id , 'full' )
				                );
			                }
			                ?>
                        </figure>
                    </div>
                </div>
			</div>
		</div>
    </div>
</div>
