<?php
/**
 * Block Name: Counts on page
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$counts_title_caption   = ( isset( $meta_values['counts_title_caption'] ) ) ? $meta_values['counts_title_caption'] : null;
$counts_title           = ( isset( $meta_values['counts_title'] ) ) ? $meta_values['counts_title'] : null;
$counts_repeater        = ( isset( $meta_values['counts_cards_repeater'] ) ) ? $meta_values['counts_cards_repeater'] : null;

?>

<div class="counts-cards">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="counts-cards__title" data-title="'.$counts_title_caption.'">'.$counts_title.'</h2>';
				?>
				<div class="counts-cards__wrapper">
					<?php
					if ( !is_null( $counts_repeater ) ) {
						foreach ($counts_repeater as $item) {
							$number       = $item['number'];
							$description   = $item['description'];
							?>
							<div class="counts-cards__count-wrapper">
								<?php
								if ( !empty( $number ) ) {
									echo '<div class="counts-cards__number">' .$number. '</div>';
								}
								
								if ( !empty( $description ) ) {
									echo '<div class="counts-cards__description">' .$description. '</div>';
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
</div>