<?php

/**
 * Block Name: Products big overview
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values     = get_fields();

$products_list         = ( isset( $meta_values['products_overview_list'] ) ) ? $meta_values['products_overview_list'] : null;
$products_list_title   = ( isset( $meta_values['products_overview_title'] ) ) ? $meta_values['products_overview_title'] : null;
$products_list_caption = ( isset( $meta_values['products_overview_title_caption'] ) ) ? $meta_values['products_overview_title_caption'] : null;

?>

<div id="products-overview-list" class="products-overview-list">
	<div class="container">
		<div class="row">
			<div class="col-xs-12-12 col-md-12-12">
				<?php
				echo '<h2 class="products-overview-list__title" data-title="'.$products_list_caption.'">'.$products_list_title.'</h2>'
				?>
				<div class="products-overview-list__wrapper">
					<?php
					// WP_Query arguments
					$args = array(
						'post_type'              => array( 'products' ),
						'post_status'            => array( 'publish' ),
						'posts_per_page'         => '-1',
						'posts_per_archive_page' => '-1',
						'order'                  => 'DESC',
						'orderby'                => 'none',
						'post__in'               => $products_list,
					);
					
					// The Query
					$query = new WP_Query( $args );
					
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							
							$post_meta = get_fields( get_the_ID() ); 
							
							$product_model               = ( isset( $post_meta['product_model'] ) ) ? $post_meta['product_model'] : null;
							$product_model_serial        = ( isset( $post_meta['product_model_serial'] ) ) ? $post_meta['product_model_serial'] : null;
							$product_price               = ( isset( $post_meta['product_price'] ) ) ? $post_meta['product_price'] : null;
							$product_colors_repeater     = ( isset( $post_meta['product_colors'] ) ) ? $post_meta['product_colors'] : null;
							$product_characters_repeater = ( isset( $post_meta['product_characters'] ) ) ? $post_meta['product_characters'] : null;
							$product_photo_gallery       = ( isset( $post_meta['product_photo_gallery'] ) ) ? $post_meta['product_photo_gallery'] : null;
							$Pixlab                      = new Pixlab();
							$detect                      = new Mobile_Detect;
							
							include( locate_template( 'templates/product-item.php', false, false ) );
							
							
						}
					} else {
						// no posts found
					}
					
					// Restore original Post Data
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
			