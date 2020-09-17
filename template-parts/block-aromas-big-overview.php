<?php
/**
 * Block Name: Aromas big overview
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values           = get_fields();

$tabs_box_title         = ( isset( $meta_values['aromas_box_title'] ) ) ? $meta_values['aromas_box_title'] : '';
$tabs_box_title_caption = ( isset( $meta_values['aromas_box_title-caption'] ) ) ? $meta_values['aromas_box_title-caption'] : '';
$tabs_box_subtitle     = ( isset( $meta_values['aromas_box_subtitle'] ) ) ? $meta_values['aromas_box_subtitle'] : null;
$tabs_slider           = ( isset( $meta_values['aromas_tab_repeater'] ) ) ? $meta_values['aromas_tab_repeater'] : null;

$tab_title_arr = array();
$tab_panel_arr = array();
?>

<div id="aromas-overview-list" class="aromas-overview-list">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				
				echo '<h2 class="tabs-box__title" data-title="'.$tabs_box_title_caption.'">'.$tabs_box_title.'</h2>';
				
				if ($tabs_box_subtitle){
					echo '<p class="tabs-box__subtitle">'.$tabs_box_subtitle.'</p>';
				}
				
				if ( !is_null( $tabs_slider ) ) {
					$i = 0;
					foreach ($tabs_slider as $tab) {
						
						$rand = rand(1, 1000);
						
						$tab_title        = $tab['aromas_box_tab_title'];
						$aromas_list      = $tab['aromas_overview_list'];
						
						$activeClass      = ( !$i++ ) ? 'active': '';
						
						$tab_title_arr[] = '<button class="tabs-box__activator '.$activeClass.' js-tabs-box-activator"
	                                                id="tab-activator-'.$rand.'"
	                                                data-href="#custom-tab-'.$rand.'"><span>'.$tab_title.'</span></button>';
						
						ob_start();
						?>
						<div class="tabs-box__panel js-tabs-box-panel <?php echo $activeClass; ?>" id="custom-tab-<?php echo $rand; ?>">
							
							<?php
							// WP_Query arguments
							$args = array(
								'post_type'              => array( 'aromas' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => '-1',
								'posts_per_archive_page' => '-1',
								'order'                  => 'DESC',
								'orderby'                => 'none',
								'post__in'               => $aromas_list,
							);
							
							// The Query
							$query = new WP_Query( $args );
							
							// The Loop
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
									
									$post_meta = get_fields( get_the_ID() );
									
									$tab_item_photo_id          = ( isset( $post_meta['aromas_tab_item_photo'] ) ) ? $post_meta['aromas_tab_item_photo'] : null;
									$tab_item_features_repeater = ( isset( $post_meta['aromas_tab_item_features_repeater'] ) ) ? $post_meta['aromas_tab_item_features_repeater'] : null;
									
									include( locate_template( 'templates/aromas-item.php', false, false ) );
									
								}
							} else {
								// no posts found
							}
							
							// Restore original Post Data
							wp_reset_postdata();
							?>
							
						</div>
						<?php
						$tab_panel_arr[] = ob_get_clean();
					}
				}
				?>
				<div class="tabs-box__wrapper js-tabs-box__wrapper">
					<div class="tabs-box__activator-wrapper">
						<div class="tabs-box__activator-line js-custom-scrollbar">
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
