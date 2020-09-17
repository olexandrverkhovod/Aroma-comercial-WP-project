<?php
/**
 * Template Name: Page without sidebar
 */

get_header(); ?>

<div class="text-block">
    
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
    
    // Include the page content template.
    get_template_part( 'content', 'page' );
    
    // End the loop.
    endwhile;
    ?>

</div>

<?php get_footer(); ?>