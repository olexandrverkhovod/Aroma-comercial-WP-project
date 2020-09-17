<div class="product-item__wrapper">
	<?php
	if ( $detect->isMobile() ) {
		if ( !empty( $product_model)){
			echo '<p class="product-item__model">model '.$product_model.'</p>';
		}
		
		echo '<p class="product-item__title">'.get_the_title().'</p>';
		
		if ( !empty( $product_model_serial)){
			echo '<p class="product-item__model-serial"><strong>'.$product_model_serial.'</strong></p>';
		}
	}
	?>
    <div class="product-item__slider-wrapper js-fade-slider-wrapper">
        <div class="js-fade-slider">
            <?php
                if ( ! is_null($product_photo_gallery) ) {
                    foreach ($product_photo_gallery as $image_id) {
                        echo '<figure><img src="'.wp_get_attachment_image_url( $image_id, 'full' ).'" alt="thumb" /></figure>';
                    }
                }
            ?>
        </div>
        <div class="slider-box__navigation">
            <button class="slider-box__nav-prev js-prev"></button>
            <button class="slider-box__nav-next js-next"></button>
        </div>
    </div>
    <div class="product-item__content">
            <?php
            if ( ! $detect->isMobile() ) {
	            if ( !empty( $product_model)){
		            echo '<p class="product-item__model">model '.$product_model.'</p>';
	            }
	
	            echo '<p class="product-item__title">'.get_the_title().'</p>';
	
	            if ( !empty( $product_model_serial)){
		            echo '<p class="product-item__model-serial"><strong>'.$product_model_serial.'</strong></p>';
	            }
            }
			?>
        
            <div class="product-item__excerpt">
				<?php
                    $content = strip_tags(get_the_content());
                    
                    echo '<div  class="product-item__partly-content active js-product-item-excerpt-content"><p>'.$Pixlab->px_string_limit_words($content,14).'...</p></div>';
                    echo '<div  class="product-item__full-content js-product-item-excerpt-content"><p>'.do_shortcode($content).'</p></div>';
				?>
                <button class="product-item__excerpt-button js-excerpt-switcher">Еще</button>
            </div>
            <div class="product-item__item-group-wrapper">
		            <?php
		            if ( !empty( $product_price)){
			            echo '<div class="product-item__price-wrapper">';
                        echo '<p class="product-item__caption">Цена:</p>';
			
			            $product_price = explode( " ", $product_price);
			            $price         = array_slice( $product_price, 0, 1);
			            $currency      = array_slice( $product_price, 1, 1);
		                
			            echo '<p class="product-item__price">'.$price[0].'<span>'.$currency[0].'</span></p>';
			            echo '</div>';
		            }
		            ?>
                <div class="product-item__colors-wrapper">
		            <?php
		            if ( !is_null( $product_colors_repeater)){
			            echo '<p class="product-item__caption">Цвет:</p>';
			            echo '<div class="product-item__colors">';
                            foreach ($product_colors_repeater as $item) {
                    
                                $color = $item['color'];
                    
                                echo '<span class="js-product-color" style="background-color: '.$color.'"></span>';
                    
                            }
			            echo '</div>';
		            }
		            ?>
                </div>
            </div>
            <div class="product-item__characters-wrapper">
				<?php
				if ( !is_null($product_characters_repeater)){
					echo '<p class="product-item__caption">Характеристики:</p>';
					echo '<ul class="product-item__characters-list">';
					foreach ($product_characters_repeater as $item){
						
						$character = explode(":", $item['character']);
						
						echo '<li>'.$character[0].':<strong>'.$character[1].'</strong></li>';
					}
					echo '</ul>';
				}
				?>
            </div>
        </div>
</div>

