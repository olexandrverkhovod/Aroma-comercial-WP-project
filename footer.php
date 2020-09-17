</main><!-- end of <main> -->
</div> <!--end of content-inner-->
<?php 

do_action( 'pixlab_before_site_footer' ); 

$options = get_fields( 'options' );

$logo_id = ( isset( $options['site_logo_footer'] ) ) ? $options['site_logo_footer'] : null;
$logo    = wp_get_attachment_image( $logo_id, 'full' );

$copyright       = ( isset( $options['copyright'] ) ) ? $options['copyright'] : null;
$callback_text   = ( isset( $options['callback_button']['footer-callback-text'] ) ) ? $options['callback_button']['footer-callback-text'] : null;
$callback_link   = ( isset( $options['callback_button']['footer-callback-link'] ) ) ? $options['callback_button']['footer-callback-link'] : null;

$site_phone = ( isset( $options['site_phone'] ) ) ? $options['site_phone'] : null;
preg_match('/([\d\+])+/', $site_phone, $phone_clean_match);
?>
<footer id="site-footer" class="site-footer">
    <div class="container">
        <div class="row">
            
            <div class="col-xs-12-12 col-sm-3-12 col-md-3-12 site-footer__wrap-logo">
				<a class="site-footer__logo" href="<?php echo get_site_url(); ?>"><?php echo $logo; ?></a>
            </div>

            <div class="col-xs-12-12 col-sm-6-12 col-md-6-12 site-footer__wrap-menus">
                <div class="site-footer__menus">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_menu1'
						)
					);
					
					wp_nav_menu(
						array(
							'theme_location' => 'footer_menu2'
						)
					);
					?>
                </div>
            </div>

            <div class="col-xs-12-12 col-sm-3-12 col-md-3-12 site-footer__wrap-info">
                <div class="site-footer__info">
					<?php
					if ( !empty($callback_text) && !empty($callback_link) ) {
						echo '<a href="'.$callback_link.'" class="btn-primary js-open-popup-activator">'.$callback_text.'</a>';
					}
					?>
					<p class="site-footer__wrap-phone">
						<?php
						if ( ! empty( $site_phone ) ) {
							echo '<a class="site-footer__phone" href="tel:'.$phone_clean_match[0].'">'.$site_phone.'</a>';
						}
						?>
					</p>		
                </div>
            </div>

         	<div class="col-xs-12-12 site-footer__wrap-copyright">
		        <p class="site-footer__copyright"><?php echo do_shortcode( $copyright ); ?></p>

		        <div class="site-footer__secondary">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_menu3'
						)
					);
					?>
                </div>
		    </div>
        </div>
    </div>
    
</footer>

<?php do_action( 'pixlab_after_site_footer' ); ?>

</div><!-- .wrapper -->


<?php
do_action( 'pixlab_after_site_page_tag' );

// popup windows added in admin area in "Text blocks" section
echo do_shortcode('[text-blocks id="popup-windows"]');

wp_footer();

do_action( 'pixlab_before_body_closing_tag' );
?>
</body>
</html>