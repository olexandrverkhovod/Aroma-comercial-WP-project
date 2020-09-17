<?php

// include main Theme Class
require get_template_directory() . '/inc/Pixlab.php';
require get_template_directory() . '/inc/register-acf-blocks.php';

$Pixlab = new Pixlab();

// main theme init
add_action( 'after_setup_theme', array($Pixlab,'px_site_setup') );

add_filter( 'sanitize_file_name', array($Pixlab, 'custom_sanitize_file_name'), 10, 1 );

// Set custom upload size limit
$Pixlab->px_custom_upload_size_limit(50);



// Enqueue scripts and styles.
function px_site_scripts() {
    
    // Load our main stylesheet.
    wp_enqueue_style( 'corppix_site-style', get_stylesheet_uri() );
    
    
    // FOR PRODUCTION STAGE
//    wp_enqueue_style('font_Montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
    wp_enqueue_style('corppix_site_style', get_template_directory_uri().'/build/styles/screen.css');
    
    
    // FOR DEVELOPMENT STAGE
    //wp_enqueue_style('corppix_site_style', get_template_directory_uri().'/public/stylesheets/screen.css');
    
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
    wp_localize_script( 'corppix_site-script', 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'corppix_site' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'corppix_site' ) . '</span>',
    ) );
    
    wp_enqueue_script( 'libs_js', get_template_directory_uri() . '/build/js/libs.js', array('jquery'), null, true );
    
    wp_enqueue_script( 'customization_js', get_template_directory_uri() . '/build/js/customization.js?v=s'.rand(1,1000), array('jquery', 'libs_js'), null, true );
    
    $vars = array(
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'theme_path' => get_stylesheet_directory_uri(),
        'site_url'   => get_site_url()
    );
    
    wp_localize_script( 'corppix_site_js', 'var_from_php', $vars );
    
    
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
    
}
add_action( 'wp_enqueue_scripts', 'px_site_scripts' );


/*********************************************************/
/*********************************************************/


/**
 * Add Dropcap option but keep the defaults.
 */
add_filter( 'tiny_mce_before_init', 'my_wpeditor_formats_options' );
function my_wpeditor_formats_options( $settings ){
    
    /* Default Style Formats */
    $default_style_formats = array(
        array(
            'title'   => 'Headings',
            'items' => array(
                array(
                    'title'   => 'Heading 1',
                    'format'  => 'h1',
                ),
                array(
                    'title'   => 'Heading 2',
                    'format'  => 'h2',
                ),
                array(
                    'title'   => 'Heading 3',
                    'format'  => 'h3',
                ),
                array(
                    'title'   => 'Heading 4',
                    'format'  => 'h4',
                ),
                array(
                    'title'   => 'Heading 5',
                    'format'  => 'h5',
                ),
                array(
                    'title'   => 'Heading 6',
                    'format'  => 'h6',
                ),
            ),
        ),
        array(
            'title'   => 'Inline',
            'items' => array(
                array(
                    'title'   => 'Bold',
                    'format'  => 'bold',
                    'icon'    => 'bold',
                ),
                array(
                    'title'   => 'Italic',
                    'format'  => 'italic',
                    'icon'    => 'italic',
                ),
                array(
                    'title'   => 'Underline',
                    'format'  => 'underline',
                    'icon'    => 'underline',
                ),
                array(
                    'title'   => 'Strikethrough',
                    'format'  => 'strikethrough',
                    'icon'    => 'strikethrough',
                ),
                array(
                    'title'   => 'Superscript',
                    'format'  => 'superscript',
                    'icon'    => 'superscript',
                ),
                array(
                    'title'   => 'Subscript',
                    'format'  => 'subscript',
                    'icon'    => 'subscript',
                ),
                array(
                    'title'   => 'Code',
                    'format'  => 'code',
                    'icon'    => 'code',
                ),
            ),
        ),
        array(
            'title'   => 'Blocks',
            'items' => array(
                array(
                    'title'   => 'Paragraph',
                    'format'  => 'p',
                ),
                array(
                    'title'   => 'Blockquote',
                    'format'  => 'blockquote',
                ),
                array(
                    'title'   => 'Div',
                    'format'  => 'div',
                ),
                array(
                    'title'   => 'Pre',
                    'format'  => 'pre',
                ),
            ),
        ),
        array(
            'title'   => 'Alignment',
            'items' => array(
                array(
                    'title'   => 'Left',
                    'format'  => 'alignleft',
                    'icon'    => 'alignleft',
                ),
                array(
                    'title'   => 'Center',
                    'format'  => 'aligncenter',
                    'icon'    => 'aligncenter',
                ),
                array(
                    'title'   => 'Right',
                    'format'  => 'alignright',
                    'icon'    => 'alignright',
                ),
                array(
                    'title'   => 'Justify',
                    'format'  => 'alignjustify',
                    'icon'    => 'alignjustify',
                ),
            ),
        ),
    );
    
    /* Our Own Custom Options */
    $custom_style_formats = array(
        array(
            'title'   => 'Special',
            'items' => array(
                array(
                    'title' => 'Caption 1',
                    'block' => 'p',
                    'classes' => 'caption1',
                    //'styles' => array('color' => '#fff')
                ),
                array(
                    'title' => 'Caption 2',
                    'block' => 'p',
                    'classes' => 'caption2',
                    //'styles' => array('color' => '#fff')
                ),
                array(
                    'title' => 'Form Caption',
                    'block' => 'p',
                    'classes' => 'form-caption',
                    //'styles' => array('color' => '#fff')
                ),
                
                /*array(
                    'title'   => 'Justify',
                    'format'  => 'alignjustify',
                    'icon'    => 'alignjustify',
                ),*/
            ),
        ),
    );
    
    /* Merge It */
    $new_style_formats = array_merge( $default_style_formats, $custom_style_formats );
    
    /* Add it in tinymce config as json data */
    $settings['style_formats'] = json_encode( $new_style_formats );
    return $settings;
}



// Adding custom theme option page
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
    
}


add_action('pixlab_before_close_head_tag', 'custom_analytics_1',100);
function custom_analytics_1() {
    echo get_field('analytics_content_before_closing_head_tag', 'option');
}

add_action('pixlab_after_open_body_tag', 'custom_analytics_2',100);
function custom_analytics_2() {
    echo get_field('analytics_content_after_open_body_tag', 'option');
}


add_action('pixlab_after_open_body_tag', 'mobile_menu_layouts',100);
function mobile_menu_layouts() {
    echo do_shortcode('[text-blocks id="mobile-menu-box"]');
}


function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');




// Google map key for ACF Pro plugin
/*function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyCSuPzkdxojA8FHh9H_-sLJCAyZFUB8B8E');
}

add_action('acf/init', 'my_acf_init');*/





// define the bcn_breadcrumb_title callback
function filter_bcn_breadcrumb_title( $title, $this_type, $this_id ) {
    // make filter magic happen here...
    if ( get_locale() === 'en_US' ) {
        $title = ($title == 'aroma') ? __("Home"): $title;
    } else {
        $title = ($title == 'aroma') ? __("Главная"): $title;
    }
    
    return $title;
};

// add the filter
add_filter( 'bcn_breadcrumb_title', 'filter_bcn_breadcrumb_title', 10, 3 );


/**
 * Remove tag <p> и <br> in plugin contact form.
 */
add_filter('wpcf7_autop_or_not', '__return_false');



//TODO: Should be Removed  after development
 add_filter('show_admin_bar', '__return_false');


add_action('pixlab_after_site_header', function(){

	$post_id     = get_queried_object_id();
	$meta_values = get_fields($post_id);
	$options     = get_fields( 'options' );
	
	$logo_id = ( isset( $options['site_logo'] ) ) ? $options['site_logo'] : null;
	$logo    = wp_get_attachment_image( $logo_id, 'full' );
	$content      = ( isset( $meta_values['top-banner-content']) ) ? $meta_values['top-banner-content'] : null;
	$bg_image_id  = ( isset( $meta_values['top-banner-bg-image']) ) ? $meta_values['top-banner-bg-image'] : null;
	$bg_image_url = wp_get_attachment_image_url( $bg_image_id, 'full' );
	$bg_image_mobile_id = ( isset( $meta_values['top-banner-bg-image-mobile']) ) ? $meta_values['top-banner-bg-image-mobile'] : null;
    $bg_image_mobile_url = wp_get_attachment_image_url( $bg_image_mobile_id, 'full' );
	
	$callback_text   = ( isset( $options ['callback_button_banner']['banner-callback-text'] ) ) ? $options ['callback_button_banner']['banner-callback-text'] : null;
	$callback_link   = ( isset( $options ['callback_button_banner']['banner-callback-link'] ) ) ? $options ['callback_button_banner']['banner-callback-link'] : null;
	
	$banner_benefits = ( isset( $options ['banner_benefits'] ) ) ? $options ['banner_benefits'] : null;
    $detect          = new Mobile_Detect;
	
	$social['facebook']  = ( isset( $options['social_on_page']['social_facebook'] ) ) ? $options['social_on_page']['social_facebook'] : null;
	$social['instagram'] = ( isset( $options['social_on_page']['social_instagram'] ) ) ? $options['social_on_page']['social_instagram'] : null;
	$social['youtube']   = ( isset( $options['social_on_page']['social_youtube'] ) ) ? $options['social_on_page']['social_youtube'] : null;
	
    if ( is_front_page() ) {
        ?>
        <div class="top-hero-block front-page" style="background-image: url(<?php echo $bg_image_url ?>);">
            <?php
            if ( !empty( $bg_image_url) ) {
                ?>
                <div class="site-header__logo-mobile"><a href="<?php echo get_site_url(); ?>"><?php echo $logo; ?></a></div>
                <div class="top-hero-block__content">
                    <div class="container">
                        <?php echo do_shortcode($content);?>
                        <?php
                        if ( !empty($callback_text) && !empty($callback_link) ) {
                            echo '<div class="top-hero-block__button-wrapper">
                                        <a  href="'.$callback_link.'" 
                                            class="btn-primary js-open-popup-activator top-hero-block__button">'.$callback_text.'
                                        </a>
                                  </div>';
                        }
                        ?>
                        <div class="top-hero-block__bottom-wrapper">
                            <div class="top-hero-block__benefits-wrapper">
                                <?php
                                if ( !is_null( $banner_benefits ) ) {
                                    foreach ($banner_benefits as $benefits) {
                                        $icon_id    = $benefits['icon'];
                                        $icon_url   = wp_get_attachment_image_url( $icon_id, 'full' );
                                        $subtitle   = $benefits['description'];
                                        ?>
                                        <div class="benefits-box__icon-wrapper">
                                            <?php
                                            if ( $icon_url ) {
                                                echo '<img src="'.$icon_url.'" alt="thumb" class="benefits-box__icon" />';
                                            }

                                            if ( !empty( $subtitle ) ) {
                                                echo '<div class="benefits-box__description"><p>' .$subtitle. '</p></div>';
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="top-hero-block__social-wrapper">
                                <div class="top-hero-block__social">
                                    <?php
                                    if ( ! empty( $social ) ) {
                                        foreach ( $social as $key => $link ) {
                                            echo '<a href="' . $link . '" class="' . $key . '">' . $link . '</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        $blog_page   = ( is_home() || is_single() ) ? 'blog-page' : '';
        $mobileClass = 'mobile';

        if ( !$detect->isMobile() || $detect->isTablet() ) {
            $mobileClass  = '';
            $bg_image_mobile_url = $bg_image_url;
        }

        echo '<div class="top-hero-block '.$mobileClass.' '.$blog_page.'" style="background-image: url('.$bg_image_mobile_url.');">';

            if ( !empty( $bg_image_url) ) {
                echo '<div class="site-header__logo-mobile"><a href="'.get_site_url().'">'.$logo.'</a></div>';
                echo '<div class="top-hero-block__content"><div class="container">'.do_shortcode( $content).'</div></div>';
            }
        echo '</div>';
    }

}, 5);




/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function products_register_name() {
	
	$products = array(
		'name'               => __( 'Продукты', 'text-domain' ),
		'singular_name'      => __( 'Продукт', 'text-domain' ),
		'add_new'            => _x( 'Add New Продукт', 'text-domain', 'text-domain' ),
		'add_new_item'       => __( 'Add New Продукт', 'text-domain' ),
		'edit_item'          => __( 'Edit Продукт', 'text-domain' ),
		'new_item'           => __( 'New Продукт', 'text-domain' ),
		'view_item'          => __( 'View Продукт', 'text-domain' ),
		'search_items'       => __( 'Search Продукты', 'text-domain' ),
		'not_found'          => __( 'No Продукты found', 'text-domain' ),
		'not_found_in_trash' => __( 'No Продукты found in Trash', 'text-domain' ),
		'parent_item_colon'  => __( 'Parent Продукт:', 'text-domain' ),
		'menu_name'          => __( 'Оборудование', 'text-domain' ),
	);
	
	$args = array(
		'labels'              => $products,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		),
	);
	

	register_post_type( 'products', $args );
	
	/*
	 * add post type aromas
	 */
	
	$aromas = array(
		'name'               => __( 'Ароматы', 'text-domain' ),
		'singular_name'      => __( 'Аромат', 'text-domain' ),
		'add_new'            => _x( 'Add New Аромат', 'text-domain', 'text-domain' ),
		'add_new_item'       => __( 'Add New Аромат', 'text-domain' ),
		'edit_item'          => __( 'Edit Аромат', 'text-domain' ),
		'new_item'           => __( 'New Аромат', 'text-domain' ),
		'view_item'          => __( 'View Аромат', 'text-domain' ),
		'search_items'       => __( 'Search Ароматы', 'text-domain' ),
		'not_found'          => __( 'No Ароматы found', 'text-domain' ),
		'not_found_in_trash' => __( 'No Ароматы found in Trash', 'text-domain' ),
		'parent_item_colon'  => __( 'Parent Аромат:', 'text-domain' ),
		'menu_name'          => __( 'Ароматы', 'text-domain' ),
	);
	
	$args_aromas = array(
		'labels'              => $aromas,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		),
	);
	
	
	register_post_type( 'aromas', $args_aromas );
}

add_action( 'init', 'products_register_name' );

