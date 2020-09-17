<?php
/**
 * Template name: Front page
 *
 */
get_header();

do_action( 'pixlab_before_page_content' );

if ( have_posts() ) :
	// Start the loop.
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
endif;

do_action( 'pixlab_after_page_content' );

get_footer();