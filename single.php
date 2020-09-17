<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header();

$post_ID = get_the_ID();

?>
    <div class="container single-news__wrapper">
        <div class="row">
            <div class="col-xs-12">
                <div class="single-news">
                    <div class="single-news__heading-wrapper">
                        <h1 class="single-news__heading"><?php the_title(); ?></h1>
                        <p class="single-news__date"><?php echo get_the_date( 'd.m.Yг.' ); ?></p>
                    </div>
					<?php
					if ( have_posts() ) :
                        ?>
                        <div class="single-news__content">
                        <?php
						while ( have_posts() ) : the_post();
							the_content();
							?>
                            </div>
                        <?php
							echo '<div class="single-news__backlink">
                                <a class="btn-white" href="javascript: history.back()">
                                    ' . __( "< Назад" ) . '
                                </a>
                                </div>';
						endwhile;
					endif;
					?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>