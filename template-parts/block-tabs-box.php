<?php
/**
 * Block Name: Tabs box
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values           = get_fields();
$tab_box_title         = ( isset( $meta_values['tabs_box_title'] ) ) ? $meta_values['tabs_box_title'] : '';
$tab_box_title_caption = ( isset( $meta_values['tabs_box_title-caption'] ) ) ? $meta_values['tabs_box_title-caption'] : '';
$tabs_box_subtitle     = ( isset( $meta_values['tabs_box_subtitle'] ) ) ? $meta_values['tabs_box_subtitle'] : null;
$tabs_slider           = ( isset( $meta_values['tabs_slider_repeater'] ) ) ? $meta_values['tabs_slider_repeater'] : null;

$tab_title_arr = array();
$tab_panel_arr = array();
?>

<div id="tabs-box" class="tabs-box">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
                <?php
                    
                echo '<h2 class="tabs-box__title" data-title="'.$tab_box_title_caption.'">'.$tab_box_title.'</h2>';
                
                if ($tabs_box_subtitle){
	                echo '<p class="tabs-box__subtitle">'.$tabs_box_subtitle.'</p>';
                }
                
                
                if ( !is_null( $tabs_slider ) ) {
                    $i = 0;
                    foreach ($tabs_slider as $tab) {
                        
                        $rand = rand(1, 1000);
                        
	                    $tab_title        = $tab['tab_title'];
                        $tab_image_id     = $tab['photo'];
                        $tab_box_features = $tab['features_repeater'];
	
	                    $item_title       = $tab['item_title'];
	                    $description_icon_id = $tab['description_icon'];
	                    $icon_url            = wp_get_attachment_image_url( $description_icon_id, 'full' );
	                    
                        $description_text = $tab['description_text'];
	                    $activeClass      = ( !$i++ ) ? 'active': '';
	                    
	                    $tab_title_arr[] = '<button class="tabs-box__activator '.$activeClass.' js-tabs-box-activator"
	                                                id="tab-activator-'.$rand.'"
	                                                data-href="#custom-tab-'.$rand.'"><span>'.$tab_title.'</span></button>';
	
	                    ob_start();
	                    ?>
	                    <div class="tabs-box__panel js-tabs-box-panel <?php echo $activeClass; ?>" id="custom-tab-<?php echo $rand; ?>">
                            <div class="tabs-box__column">
                                <?php
                                if ( $tab_image_id ) {
	                                printf( '<img src="%s" srcset="%s" class="tabs-box__big-image">',
		                                wp_get_attachment_image_url( $tab_image_id ),
		                                wp_get_attachment_image_srcset( $tab_image_id, 'full' )
	                                );
                                }
                                ?>
                            </div>
                            <div class="tabs-box__column for-text">
                                <?php
                                if ( $icon_url ) {
                                    echo '<img src="'.$icon_url.'" alt="thumb" class="tabs-box__icon" />';
                                }
                                if ( !empty( $item_title ) ) {
	                                echo '<h3 class="tabs-box__content-title">'.$item_title.'</h3>';
                                }
                                if ( !empty( $description_text ) ) {
                                    echo do_shortcode( $description_text );
                                }
	                            if(!empty($tab_box_features) && is_array( $tab_box_features)){
                                ?>
                                <div class="tabs-box__features">
		                            <?php
                                        if(!empty($tab_box_features) && is_array( $tab_box_features)){
                                            foreach ($tab_box_features as $features) {
                                                $features_icon_id  = $features['icon'];
                                                $features_icon_url = wp_get_attachment_image_url( $features_icon_id, 'full' );
                                                $features_subtitle = $features['text'];
                                                ?>
                                                    <div class="tabs-box__feature-wrapper">
                                                    <?php
                                                        if ( $features_icon_url ) {
                                                            echo '<img src="'.$features_icon_url.'" alt="thumb" class="tabs-box__feature-icon" />';
                                                        }
                                
                                                        if ( !empty( $features_subtitle ) ) {
                                                                echo '<div class="tabs-box__feature-subtitle">' .$features_subtitle. '</div>';
                                                        }
                                                    ?>
                                                    </div>
	                                            <?php
                                            }
                                        }
		                            ?>
                                </div>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
	                    <?php
	                    $tab_panel_arr[] = ob_get_clean();
                    }
                }
                ?>
                <div class="tabs-box__wrapper js-tabs-box__wrapper">
                    <div class="tabs-box__activator-wrapper">
                        <div class="tabs-box__activator-line js-custom-scrollbar ">
		                    <?php echo implode( '', $tab_title_arr); ?>
                        </div>
                        <div class="tabs-box__buttons-wrapper">
                            <button class="tabs-box__nav-tab js-nav-tab nav-tab__prev" data-nav="prev"></button>
                            <button class="tabs-box__nav-tab js-nav-tab nav-tab__next" data-nav="next"></button>
                        </div>
                    </div>
                    <div class="tabs-box__panels"><?php echo implode( '', $tab_panel_arr); ?></div>
                </div>
			</div>
		</div>
  
	
	</div>
</div>