<?php
/**
 * Template Name: Page with right sidebar
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 clearfix">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
                add_filter( 'the_content', 'wpautop' );
                // Include the page content template.
				the_content(); 
			// End the loop.
			endwhile;
			?>
			<div class="spacer_super_small"></div>				
		</div>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 sidebar sidebar_right clearfix">
			<?php dynamic_sidebar('Right Sidebar'); ?>
        </div>
	</div>
</div>	



<?php get_footer(); ?>