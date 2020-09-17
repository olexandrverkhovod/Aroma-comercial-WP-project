<?php
/**
 * Block Name: Aroma benefits
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$aroma_title_caption       = ( isset( $meta_values['aroma_title_caption'] ) ) ? $meta_values['aroma_title_caption'] : null;
$aroma_title               = ( isset( $meta_values['aroma_title'] ) ) ? $meta_values['aroma_title'] : null;
$aroma_description         = ( isset( $meta_values['aroma_description'] ) ) ? $meta_values['aroma_description'] : null;
$budge_title               = ( isset( $meta_values['aroma_budge_title'] ) ) ? $meta_values['aroma_budge_title'] : null;
$budge_description         = ( isset( $meta_values['aroma_budge_description'] ) ) ? $meta_values['aroma_budge_description'] : null;
$aroma_features_left       = ( isset( $meta_values['aroma_features_left'] ) ) ? $meta_values['aroma_features_left'] : null;
$aroma_features_right      = ( isset( $meta_values['aroma_features_right'] ) ) ? $meta_values['aroma_features_right'] : null;
$aroma_equipment_image_id  = ( isset( $meta_values['aroma_equipment_image'] ) ) ? $meta_values['aroma_equipment_image'] : null;
$aroma_equipment_image_url = wp_get_attachment_image_url( $aroma_equipment_image_id, 'full' );

?>

<div id="aroma-benefits" class="aroma-benefits">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="aroma-benefits__title" data-title="'.$aroma_title_caption.'">'.$aroma_title.'</h2>';
				if ($aroma_description){
					echo do_shortcode( $aroma_description );
				}
				?>
                
                <div class="aroma-benefits__wrapper">
                    <div class="aroma-benefits__badge-wrapper">
                        <div class="aroma-benefits__badge">
		                    <?php
		                    if ( !empty($budge_title)) {
			                    echo '<p class="aroma-benefits__badge-title">'.$budge_title.'</p>';
		                    }
		                    if ( !empty($budge_description)) {
			                    echo '<p class="aroma-benefits__badge-description">'.$budge_description.'</p>';
		                    }
		                    ?>
                        </div>
                    </div>
                    <div class="aroma-benefits__equipment-wrapper">
		                <?php
		                if ( !is_null( $aroma_features_left ) ) {
			                echo '<div class="aroma-benefits__counts-wrapper left-side">';
			                foreach ($aroma_features_left as $item) {
				                $description = $item['description'];
				                $count       = $item['count'];
				                ?>
                                <div class="aroma-benefits__count-left">
                                    <div class="aroma-benefits__count-number"><p class="aroma-benefits__prefix">На</p><?php echo $count ?></div>
                                    <div class="aroma-benefits__count-description"><p><?php echo $description ?></p></div>
                                </div>
				                <?php
			                }
			                echo '</div>';
		                }
		                if ($aroma_equipment_image_url) {
			                echo '<figure><img src="'.$aroma_equipment_image_url.'" alt="thumb" class="aroma-benefits__big-image"></figure>';
		                }
		                if ( !is_null( $aroma_features_right ) ) {
			                echo '<div class="aroma-benefits__counts-wrapper right-side">';
			                foreach ($aroma_features_right as $item) {
				                $description = $item['description'];
				                $count       = $item['count'];
				                ?>
                                <div class="aroma-benefits__count-right">
                                    <div class="aroma-benefits__count-number"><p class="aroma-benefits__prefix">На</p><?php echo $count ?></div>
                                    <div class="aroma-benefits__count-description"><p><?php echo $description ?></p></div>
                                </div>
				                <?php
			                }
			                echo '</div>';
		                }
		                ?>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
