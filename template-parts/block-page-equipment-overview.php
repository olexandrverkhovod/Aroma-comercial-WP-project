<?php
/**
 * Block Name: Equipment overview
 *
 * This is the template that displays the equipment overview block.
 */

$meta_values              = get_fields();
$equipment_caption        = get_field( 'equipment-caption' );
$equipment_repeater_photo = get_field( 'equipment_repeater_photo' );
$read_more_link_text      = get_field( 'read_more_text_equipment' );
$read_more_link_url       = get_field( 'read_more_url_equipment' );
$description              = get_field( 'description_equipment' );
$description_second       = get_field( 'description_equipment_second' );
?>

<div id="equipment-overview-box" class="equipment-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12-12 col-md-6-12 equipment-main__wrap-blockquote">
                <div class="equipment-main__blockquote ">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
							<?php if ( ! empty( $equipment_repeater_photo ) ) {
								foreach ( $equipment_repeater_photo as $item ) {
									$image_id                 = $item['photo'];
									$image_url                = wp_get_attachment_image_url( $image_id, 'full' );
									$equipment_title_photo    = $item['equipment_title_photo'];
									$equipment_subtitle_photo = $item['equipment_subtitle_photo'];
									?>

                                    <div class="equipment-main__item-big swiper-slide">
										<?php
                                        echo '<div class="equipment-main__wrap-title-photo">';
										echo '<h3 class="equipment-main__title-photo">' . $equipment_title_photo .
                                             '</h3>';
										echo '<p class="equipment-main__subtitle-photo">' . $equipment_subtitle_photo .
                                             '</p>';
										echo '</div>';
										?>
                                        <figure class="equipment-main-image-big ">
                                            <img src="<?php echo $image_url; ?>" alt="equipment main big image"/>
                                        </figure>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12-12 col-md-6-12 equipment-main__wrap-content">
                <h2 class="like-h1 equipment-main__title"><?php echo $equipment_caption; ?></h2>
                <p class="equipment-main__description"><?php echo $description; ?></p>
                <p class="equipment-main__description"><?php echo $description_second; ?></p>
				<?php echo ( ! empty( $read_more_link_url ) && ! is_null( $read_more_link_url )
				             && ! empty( $read_more_link_text ) && ! is_null( $read_more_link_text ) )
					? '<a href="' . $read_more_link_url . '" class="read-more btn-white equipment-main__btn">
					  ' . $read_more_link_text . '</a>' : '';
				?>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
						<?php if ( ! empty( $equipment_repeater_photo ) ) {
							foreach ( $equipment_repeater_photo as $item ) {
								$image_id                 = $item['photo'];
								$image_url                = wp_get_attachment_image_url( $image_id, 'full' );
								$equipment_title_photo    = $item['equipment_title_photo'];
								$equipment_subtitle_photo = $item['equipment_subtitle_photo'];
								?>

                                <div class="equipment-main__item swiper-slide">
                                    <figure class="equipment-main__image ">
                                        <img src="<?php echo $image_url; ?>" alt="equipment main image"/>
                                    </figure>
                                </div>
								<?php
							}
						} ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>