<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="site-news">
                <h1 class="site-news__heading"><?php echo get_the_title( get_option('page_for_posts') ); ?></h1>
                <div class="site-news__blog">
					<?php
					if ( have_posts() ) :
						// Start the loop.
						while ( have_posts() ) : the_post();
							$Pixlab = new Pixlab();
							
							include( locate_template( 'templates/blog-item.php', false, false ) );
						
						endwhile;
					
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'content', 'none' );
					endif;
					
					echo '<div class="clear"></div>';
					
					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( 'Prev', 'twentyfifteen' ),
						'next_text'          => __( 'Next', 'twentyfifteen' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
					) );
					?>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php get_footer(); ?>