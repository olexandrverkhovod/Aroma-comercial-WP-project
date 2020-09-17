<?php
/**
 * The template for displaying pages
 *
 */
get_header();
?>

<div class="main-content-part">
    <?php
    do_action('pixlab_before_page_content');
    
    if ( have_posts() ) :
        // Start the loop.
        while ( have_posts() ) : the_post();
            add_filter( 'the_content', 'wpautop' );
            the_content();
        endwhile;
    endif;

    do_action('pixlab_after_page_content');
    ?>  
</div>

<?php get_footer();