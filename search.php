<?php
/**
 * The template for displaying search results pages.
 *
 */

get_header(); ?>


<div class="wrap-main-part">
<div class="content-part">
<div class="container">
<div class="row">

<?php
if ( have_posts() ) : ?>

	<header class="page-header col-xs-12">
		<h1 class="text-center with-decoration">
			<?php printf( __( 'Search results for: %s', 'corppix_site' ), get_search_query() ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post(); ?>

		<?php
		get_template_part( 'content', 'search' );

	// End the loop.
	endwhile;

	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => __( 'Prev', 'corppix_site' ),
		'next_text'          => __( 'Next', 'corppix_site' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'corppix_site' ) . ' </span>',
	) );

// If no content, include the "No posts found" template.
else :
	get_template_part( 'content', 'none' );

endif;
?>
	
</div>
</div>		
</div>
</div>	
	

<?php get_footer(); ?>