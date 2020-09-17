
<?php
/**
 * Template name: Весь товар
 * Template post type: page
 */


get_header();

?>
<div class="container">
    <div class="main-content-wrap">
        <?php
        $detect = new Mobile_Detect;
        if ( !($detect->isMobile() && !$detect->isTablet()) ) {
            echo '<div class="sidebar">';
            dynamic_sidebar('Left Sidebar');
            echo '</div>';
        }
        ?>

        <div class="main-content-part">
            <div class="title_page">
                <h1><?php echo the_title(''); ?></h1>
            </div>

            <div class="filters-block-mobile-wrap">
                <div class="filters-block-mobile js-filters-block-mobile">

                    <div class="filter-title">
                        <h4><?php _e('Фильтры'); ?></h4>
                    </div>

                    <button class="trigger-button"></button>

                    <div class="filter-bottom">
                        <?php $detect = new Mobile_Detect;
                        if ( $detect->isMobile() && !$detect->isTablet() ) {
                            echo '<div class="sidebar mobile">';
                            dynamic_sidebar('Left Sidebar');
                            echo '</div>';
                        }
                        ?>

                    </div>
                </div>
            </div>

            <div class="product-wrapper js-product-wrapper">
                <?php
                $phone = get_field('global_phone', 'option');
                $phone_link = str_replace([' ', '(', ')', '-'], '', $phone);
                ?>

                
                <?php
                // WP_Query arguments
                $args = array(
                    'post_type'              => array( 'shoes', 'clothes', 'accessories', 'perfumery' ),
                    'post_status'            => array( 'publish' ),
                    'posts_per_page'         => '-1',
                    'posts_per_archive_page' => '-1',
                    'order'                  => 'DESC',
                    'orderby'                => 'rand',
                );
                
                // The Query
                $query = new WP_Query( $args );
                
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        
                        
                        
                        
                        //Note: you need to use full file name
                        // and also false arguments to avoid loading the file
                        // and return the full path instead
                        include( locate_template( 'templates/loop-clothes-item.php', false, false ) );
                        
                        
                    }
                } else {
                    // no posts found
                }
                
                // Restore original Post Data
                wp_reset_postdata();
                ?>

            </div>
        </div>

    </div>
</div>







<?php get_footer(); ?>

