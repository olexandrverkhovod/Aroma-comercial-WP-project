<?php
/**
 * Block Name: Features cards
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$features_title_caption = ( isset( $meta_values['features_title_caption'] ) ) ? $meta_values['features_title_caption'] : null;
$features_title         = ( isset( $meta_values['features_title'] ) ) ? $meta_values['features_title'] : null;
$features_description   = ( isset( $meta_values['features_description'] ) ) ? $meta_values['features_description'] : null;
$features_repeater      = ( isset( $meta_values['features_cards_repeater'] ) ) ? $meta_values['features_cards_repeater'] : null;

?>

<div class="features-cards">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="features-cards__title" data-title="'.$features_title_caption.'">'.$features_title.'</h2>';
				
				echo '<p class="features-cards__subtitle">'.$features_description.'</p>'
				?>
				<div class="features-cards__icons-wrapper">
					<?php
					if ( !is_null( $features_repeater ) ) {
					foreach ($features_repeater as $item) {
						$icon_id       = $item['icon'];
						$icon_url      = wp_get_attachment_image_url( $icon_id, 'full' );
						$title         = $item['icon_title'];
						$description   = $item['description'];
						?>
						<div class="features-cards__icon-wrapper">
							<?php
							if ( $icon_url ) {
								echo '<img src="'.$icon_url.'" alt="thumb" class="features-cards__icon" />';
							}
							
							if ( !empty( $title ) ) {
								echo '<div class="features-cards__icon-title">' .$title. '</div>';
							}
							
							if ( !empty( $description ) ) {
								echo '<div class="features-cards__description">' .$description. '</div>';
							}
							?>
							
						</div>
					<?php
					}
					}
					?>
     
				</div>
			</div>
		</div>
</div>