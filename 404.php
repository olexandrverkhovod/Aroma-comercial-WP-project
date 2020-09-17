<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div class="banner">

    <figure>
        <img class="clip-svg"
             src="<?php echo get_template_directory_uri(); ?>/build/images/404-bgr.png"
             alt="img-banner" />
    </figure>

    <div class="text-wrap-banner">
        <div class="container">
            <h1>404</h1>
            <p class="subtitle">Страница не найдена</p>
            <div class="banner-button">

                <a class="get_home" href="<?php echo get_home_url() ?>">На главную</a>
                
            </div>

        </div>
    </div>
    
</div>

<?php get_footer(); ?>
