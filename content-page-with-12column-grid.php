<?php
/**
 * Template Name: Page with 12 column grid
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 clearfix">
			<?php
            while ( have_posts() ) : the_post();
                add_filter( 'the_content', 'wpautop' );
                the_content();
			endwhile;
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>