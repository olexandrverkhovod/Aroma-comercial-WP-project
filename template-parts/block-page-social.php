<?php
/**
 * Block Name: Social on page
 *
 * This is the template that displays the equipment overview block.
 */

$options = get_fields( 'options' );

$social['facebook']  = ( isset( $options['social_on_page']['social_facebook'] ) ) ? $options['social_on_page']['social_facebook'] : null;
$social['instagram'] = ( isset( $options['social_on_page']['social_instagram'] ) ) ? $options['social_on_page']['social_instagram'] : null;
$social['youtube']   = ( isset( $options['social_on_page']['social_youtube'] ) ) ? $options['social_on_page']['social_youtube'] : null;

?>
<div class="row">
	<div class="col-xs-12-12 col-md-12-12 contact-social__social-wrapper">
		<div class="contact-social__social">
			<?php
			if ( ! empty( $social ) ) {
				foreach ( $social as $key => $link ) {
					echo '<a href="' . $link . '" class="' . $key . '">' . $link . '</a>';
				}
			}
			?>
		</div>
	</div>
</div>


