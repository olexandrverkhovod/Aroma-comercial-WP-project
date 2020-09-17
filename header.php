<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="author" content="https://www.pix-lab.net"/>
    <link rel="author" href="https://www.pix-lab.net"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
	<?php if ( is_404() ) { ?>
        <meta name="robots" content="noindex, nofollow"/>
	<?php } ?>
	<?php wp_head(); ?>
	<?php do_action( 'pixlab_before_close_head_tag' ); ?>
</head>

<?php
$options = get_fields( 'options' );

$logo_id          = ( isset( $options['site_logo'] ) ) ? $options['site_logo'] : null;
$logo_id_scrolled = ( isset( $options['site_logo_scrolled'] ) ) ? $options['site_logo_scrolled'] : null;
$mobile_logo      = ( isset( $options['mobile_logo'] ) ) ? $options['mobile_logo'] : null;

$logo           = wp_get_attachment_image( $logo_id, 'full' );
$logo_scrolled  = wp_get_attachment_image( $logo_id_scrolled, 'full' );

$site_phone = ( isset( $options['site_phone'] ) ) ? $options['site_phone'] : null;
preg_match('/([\d\+])+/', $site_phone, $phone_clean_match);

$post_id    = get_queried_object_id();
$page_class = get_field( 'body_class', $post_id );

$detect = new Mobile_Detect;
?>
<body <?php body_class( $page_class ); ?>>

<?php do_action( 'pixlab_after_open_body_tag' ); ?>


<div id="wrapper" class="wrapper">
	<?php do_action( 'pixlab_before_site_header' ); ?>

    <div id="content-inner">
        <header id="site-header" class="site-header">
            <div class="container">
                <div class="site-header__wrapper">
                    <a class="site-header__logo" href="<?php echo get_site_url(); ?>">
                        <span class="site-header__logo-general"><?php echo $logo; ?></span>
                        <span class="site-header__logo-scrolled"><?php echo $logo_scrolled; ?></span>
                    </a>
        
                    <?php
                    if ( ! $detect->isMobile() ) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'site-header__primary-menu',
                            )
                        );
                    }
                    ?>
    
                    <div class="site-header__phones">
                        <?php
                        if ( ! empty( $site_phone ) ) {
                            echo '<a class="site-header__phone" href="tel:'.$phone_clean_match[0].'">'.$site_phone.'</a>';
                        }
                        ?>
                    </div>
                </div>
    
            </div>
            
        
            
            <?php
                if ( $detect->isMobile() ) {
            ?>
                <button id="hamburger"></button>
                    <nav id="menu_mobile" class="displayed">
                        <button id="close-mobile-menu"></button>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'mobile_menu',
                                'menu_class'     => 'site-header__mobile-menu'
                            )
                        );
                        ?>
                       <figure>
                           <img src="<?php echo $mobile_logo; ?>" alt="mobile-menu-logo">
                       </figure>
                    </nav>
                </div>
                <?php
            }
            ?>
    
        </header>
        <?php do_action( 'pixlab_after_site_header' ); ?>
    
                <?php
                if ( ! $detect->isMobile() ) {
                    ?>
    
                    <?php if ( !is_front_page() ) { ?>
            <div class="breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12-12 bcn_wrap">
                            <?php
                            if ( function_exists( 'bcn_display' ) ) {
                                bcn_display();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
                <?php
                }
                ?>
        <main id="main-wrapper">
            <?php do_action( 'pixlab_after_primary_wrapper_beginning_tag' );
            