<div class="tabs-box__item">
	<div class="tabs-box__column">
		<?php
		if ( $tab_item_photo_id ) {
			printf( '<img src="%s" srcset="%s" class="tabs-box__big-image">',
				wp_get_attachment_image_url( $tab_item_photo_id ),
				wp_get_attachment_image_srcset( $tab_item_photo_id, 'full' )
			);
		}
		?>
	</div>
	<div class="tabs-box__column for-text">
		<?php
		
		echo '<h3 class="tabs-box__content-title">'.get_the_title().'</h3>';
		
		echo '<p class="aromas-box__content">'.get_the_content().'</p>';
		
		if(!empty($tab_item_features_repeater) && is_array( $tab_item_features_repeater)){
			?>
			<div class="tabs-box__features">
				<?php
				foreach ($tab_item_features_repeater as $features) {
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
				?>
			</div>
			<?php
		}
		?>
	</div>
</div>
