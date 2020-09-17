<?php
function custom_gutenberg_block() {
	if( ! function_exists('acf_register_block') )
		return;
	
    acf_register_block( array(
        'name'			=> 'page-services-overview',
        'title'			=> __('Services overview', 'corppix_site'),
        'render_callback'   => 'wpahead_acf_block_render_callback',
        'category'		=> 'layout',
        'icon'			=> 'lightbulb',
        'post_types'    => array('page', 'post'),
        // 'mode'			=> 'auto',
        'keywords'		=> array('preview', 'columns')
    ));
    
    acf_register_block( array(
        'name'			=> 'page-equipment-overview',
        'title'			=> __('Equipment overview', 'corppix_site'),
        'render_callback'   => 'wpahead_acf_block_render_callback',
        'category'		=> 'layout',
        'icon'			=> 'lightbulb',
        'post_types'    => array('page', 'post'),
        // 'mode'			=> 'auto',
        'keywords'		=> array('preview', 'columns')
    ));
    
    acf_register_block( array(
        'name'			=> 'top-banner',
        'title'			=> __('Page top banner', 'corppix_site'),
        'render_callback'   => 'wpahead_acf_block_render_callback',
        'category'		=> 'layout',
        'icon'			=> 'lightbulb',
        'post_types'    => array('page', 'post'),
        // 'mode'			=> 'auto',
        'keywords'		=> array('preview', 'banner')
    ));
	
	acf_register_block( array(
		'name'			=> 'tabs-box',
		'title'			=> __('Tabs box', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'slider')
	));
	
	acf_register_block( array(
		'name'			=> 'top-benefits',
		'title'			=> __('Top benefits', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'benefits')
	));
	
	acf_register_block( array(
		'name'			=> 'popup-button',
		'title'			=> __('Pop-up button', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'popup-button')
	));
	
	acf_register_block( array(
		'name'			=> 'slider-box',
		'title'			=> __('Slider box', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'slider-box')
	));
	
	acf_register_block( array(
		'name'			=> 'features-cards',
		'title'			=> __('Features cards', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'features-cards')
	));
	
	acf_register_block( array(
		'name'			=> 'page-contacts',
		'title'			=> __('Page-contacts', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'page-contacts')
	));
	
	acf_register_block( array(
		'name'			=> 'page-social',
		'title'			=> __('Social on page', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'page-social')
	));
	
	acf_register_block( array(
		'name'			=> 'person-box',
		'title'			=> __('Person block', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'person-box')
	));
	
	acf_register_block( array(
		'name'			=> 'page-counts',
		'title'			=> __('Counts on page', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'page-counts')
	));
	
	acf_register_block( array(
		'name'			=> 'page-badge',
		'title'			=> __('Badge on page', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'page-badge')
	));
	
	acf_register_block( array(
		'name'			=> 'products-big-overview',
		'title'			=> __('Products big overview', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'products')
	));
	
	acf_register_block( array(
		'name'			=> 'aromas-big-overview',
		'title'			=> __('Aromas big overview', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'aromas')
	));
	
	acf_register_block( array(
		'name'			=> 'certificates',
		'title'			=> __('Certificates slider', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'certificates')
	));
	
	acf_register_block( array(
		'name'			=> 'aroma-benefits',
		'title'			=> __('Aroma benefits', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'aroma-benefits')
	));
	
	acf_register_block( array(
		'name'			=> 'tabs-field',
		'title'			=> __('Tabs field', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'tabs-field')
	));
	
	acf_register_block( array(
		'name'			=> 'aromas-features',
		'title'			=> __('Aroma with features', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'aromas-features')
	));
	
	acf_register_block( array(
		'name'			=> 'split-info',
		'title'			=> __('Split info box', 'corppix_site'),
		'render_callback'   => 'wpahead_acf_block_render_callback',
		'category'		=> 'layout',
		'icon'			=> 'lightbulb',
		'post_types'    => array('page', 'post'),
		// 'mode'			=> 'auto',
		'keywords'		=> array('preview', 'split-info')
	));
}
add_action('acf/init', 'custom_gutenberg_block' );


function wpahead_acf_block_render_callback($block) {
    $name = str_replace('acf/', '', $block['name']);

    if (file_exists(get_theme_file_path("/template-parts/block-{$name}.php"))) {
        include(get_theme_file_path("/template-parts/block-{$name}.php"));
    }
}
