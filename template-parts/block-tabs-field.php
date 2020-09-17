<?php
/**
 * Block Name: Tabs field
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values              = get_fields();

$tabs_field_title         = ( isset( $meta_values['tabs_field_title'] ) ) ? $meta_values['tabs_field_title'] : '';
$tabs_field_title_caption = ( isset( $meta_values['tabs_field_title-caption'] ) ) ? $meta_values['tabs_field_title-caption'] : '';
$tabs_field_content       = ( isset( $meta_values['tabs_field_content'] ) ) ? $meta_values['tabs_field_content'] : null;

$tab_title_arr = array();
$tab_panel_arr = array();
?>

<div id="tabs-field" class="tabs-field">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="tabs-field__title" data-title="'.$tabs_field_title_caption.'">'.$tabs_field_title.'</h2>';
				
				if ( !is_null( $tabs_field_content ) ) {
					$i = 0;
					foreach ($tabs_field_content as $tab) {
						
						$rand = rand(1, 1000);
						
						$tab_title        = $tab['title'];
						
						$description_text = $tab['description'];
						$activeClass      = ( !$i++ ) ? 'active': '';
						
						$tab_title_arr[] = '<button class="tabs-box__activator '.$activeClass.' js-tabs-box-activator"
	                                                id="tab-activator-'.$rand.'"
	                                                data-href="#custom-tab-'.$rand.'"><span>'.$tab_title.'</span></button>';
						
						ob_start();
						?>
						<div class="tabs-box__panel js-tabs-box-panel <?php echo $activeClass; ?>" id="custom-tab-<?php echo $rand; ?>">
							<div class="tabs-box__column for-text">
								<?php
								if ( !empty( $description_text ) ) {
									echo do_shortcode( $description_text );
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
						<div class="tabs-box__activator-line">
							<?php echo implode( '', $tab_title_arr); ?>
						</div>
					</div>
					<div class="tabs-box__panels"><?php echo implode( '', $tab_panel_arr); ?></div>
				</div>
			</div>
		</div>
</div>


