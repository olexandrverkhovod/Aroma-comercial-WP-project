<?php

/*
 *  recent_posts SHORTCODE
 */


if ( !function_exists('shortcode_recent_posts') ) {


	function shortcode_recent_posts($atts, $content = null) {

			extract(shortcode_atts(array(
					'id' => '',
					'type' => 'post',
					'category' => '',
					'num' => '2',
					'thumb' => 'true',
					'thumb_width' => '120',
					'thumb_height' => '120',
					'more_text_single' => '',
					'excerpt_count' => '0',
					'custom_class' => 'news-main',
					'custom_class_item' => ''
			), $atts));
			
			$id_text = ( !empty($id) ) ? 'id="'.$id.'"' : '';

			$output = '<div '.$id_text.' class="recent-posts '.$custom_class.' '.$type.'-items">';
   
			$output .= '<div class="container"><div class="news_wrap">';
			global $post;
		    $Pixlab = new Pixlab();


			$args = array(
                'post_type' => $type,
                'category_name' => $category,
                'numberposts' => $num,
                'orderby' => 'post_date',
                'order' => 'DESC'
            );


			$latest = get_posts($args);
			
			$iii = 0;
            ob_start();
        
			foreach($latest as $post) {
                setup_postdata($post);
                $excerpt = get_the_excerpt($post->ID);
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url = $attachment_url['0'];
				

                $detect = new Mobile_Detect;
                if ( $detect->isMobile() && !$detect->isTablet() ) {
                    $image = aq_resize($url, 750);
                }
                else {
	                $image_crop = aq_resize($url, 570, 250, true);
                }
				
				if (!$image_crop) $image_crop = $url;
				?>

                <div class="site-news__blog-item news-main__item">
                    
                    <figure class="site-news__blog-item_cover-image"><img src="<?php echo $image_crop; ?>" alt="thumb"></figure>

                    <div class="site-news__blog-item-info">
                        <h3 class="site-news__blog-item-title"><?php echo get_the_title(); ?></h3>
                        <p class="site-news__blog-item-date"><?php echo get_the_date('d.m.Yг.'); ?></p>

                        <div class="site-news__blog-item-excerpt">
							<?php
							$excerpt = strip_tags(get_the_excerpt());
							$content = strip_tags(get_the_content());
							
							if ( has_excerpt() ) {
								echo $Pixlab->px_string_limit_words($excerpt,43).'...';
							} else {
								echo $Pixlab->px_string_limit_words($content,43).'...';
							}
							?>
                            <a href="<?php echo get_permalink(); ?>" class="coverFull"></a>
                        </div>
                        <p class="site-news__blog-item-caption">
                            <a class="btn-white" href="<?php echo get_permalink(); ?>"><?php _e('Подробнее'); ?></a>
                        </p>
                    </div>
                </div>
                <?php
			}
			
			$output .= ob_get_clean();
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			wp_reset_query();
			return $output;

	}

	add_shortcode('recent_posts', 'shortcode_recent_posts');

}



/*
 *  carousel_post_type SHORTCODE
 */

if ( !function_exists('carousel_post_type') ) {


	function shortcode_carousel_post_type($atts, $content = null) {

			extract(shortcode_atts(array(
					'type' => 'post',
					'category' => '',
					'num' => '5',
					'thumb' => 'true',
					'thumb_width' => '120',
					'thumb_height' => '120',
					'more_text_single' => '',
					'excerpt_count' => '0',
					'custom_class' => '',
					'custom_class_item' => ''
			), $atts));

			$output = '<div class="owl-recent-posts owl-carousel '.$custom_class.'">';

			global $post;
			global $my_string_limit_words;


			$args = array(
						'post_type' => $type,
						'category_name' => $category,
						'numberposts' => $num,
						'orderby' => 'post_date',
						'order' => 'DESC'
						);


			$latest = get_posts($args);

			foreach($latest as $post) {
					setup_postdata($post);
					$excerpt = get_the_excerpt($post->ID);
					$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$url = $attachment_url['0'];

					$detect = new Mobile_Detect;
					if ( $detect->isMobile() && !$detect->isTablet() ) {
						$image = aq_resize($url, 750);
					}
					else {
						$image = aq_resize($url, $thumb_width, $thumb_height, true);
					}

					if (!$image) $image = $url;

					$output .= '<div class="item '.$custom_class_item.'">';

						if ($thumb == 'true') {
							if ( has_post_thumbnail($post->ID) ){
									$output .= '<figure class="featured-thumbnail">';
									$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
									$output .= '<img  src="'.$image.'" alt="thumb"/>';
									$output .= '</a>';
									$output .= '</figure>';
							}
						}

						$output .= '<div class="wrapInfo">';
							$output .= '<h4>'.get_the_title($post->ID).'</h4>';

							if($excerpt_count >= 1){
								$output .= '<div class="excerpt clearfix">';
									$output .= my_string_limit_words($excerpt,$excerpt_count);

									if($more_text_single!=""){
										$output .= '<a href="'.get_permalink($post->ID).'" class="readmore" title="'.get_the_title($post->ID).'">';
										$output .= $more_text_single;
										$output .= '</a>';
									}
								$output .= '</div>';
							}
						$output .= '</div>';

					$output .= '</div>';

			}
			$output .= '</div>';

			wp_reset_query();
			return $output;

	}

	add_shortcode('carousel_post_type', 'shortcode_carousel_post_type');

}



/*******************************************************/


/*
 *  LANGUAGE SELECTOR SHORTCODE
 */

if ( !function_exists('language_selector_shortcode') ) {
	
	function language_selector_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => '',
			'type' => '',
			'format' => '',
		), $atts));
		
		if ( empty($format) ) {
			$qTranslateXWidget_arr = array('type' => $type, 'hide_title' => true);
		} else {
			$qTranslateXWidget_arr = array('type' => $type, 'hide_title' => true, format=> $format);
		}
		
		
		$output = '<div class="language_selector '.$class.'">';
		ob_start();
		the_widget('qTranslateXWidget', $qTranslateXWidget_arr );
		$return = ob_get_clean();
		$output .= $return;
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('language_selector', 'language_selector_shortcode');
	
}


/********************************/

/*
 *  gallery_box shortcode
 */

if ( !function_exists('gallery_box_shortcode') ) {


	function gallery_box_shortcode($atts, $content = null) {

		extract(shortcode_atts(array(
				'class' => '',
				'photo_item_class' => '',
				'thumb_width' => '',
				'meta_gallery_field' => '',
				'postid' => '',
				'thumb_height' => '',
		), $atts));

		$output = '<div class="picture_gallery '.$class.'">';
			// $output .= '<div class="row">';

			$images = get_field($meta_gallery_field, $postid);
			if( $images ):
				$ii = 0;
				$first_photo = '';
			
			    foreach( $images as $image ):
			        $output_temp .= '<div class="item '.$photo_item_class.'">';
			    
			    		$image_crop = aq_resize($image['url'], $thumb_width, $thumb_height, true);
						if (!$image_crop) $image_crop = $image['url'];
						
						if ( !$ii ) {
							$first_photo = $image['url'];
						}
					
		                $output_temp .= '<img data-href="'.$image['url'].'"
		                                      src="'.$image_crop.'"
		                                      alt="thumb"
		                                      class="photo-item"
		                                 />';
						
			        $output_temp .= '</div>';
			        
			        $ii++;
			    endforeach;
			    
			    $output .= '<div class="wrap-main-photo"><img src="'.$first_photo.'" alt="main-photo" /></div>';
			    $output .= '<div class="wrap-tiles flex-box flex-wrap-wrap">'.$output_temp.'</div>';

			endif;

			// $output .= '</div>';
		$output .= '</div>';
		return $output;

	}

	add_shortcode('gallery_box', 'gallery_box_shortcode');

}


/********************************/


/*
 *  gallery_images shortcode
 */

if ( !function_exists('gallery_images_shortcode') ) {


	function gallery_images_shortcode($atts, $content = null) {

		extract(shortcode_atts(array(
				'class' => '',
				'photo_item_class' => '',
				'thumb_width' => '370',
				'meta_gallery_field' => '',
				'postid' => '',
				'thumb_height' => '250',
		), $atts));

		$output = '<div class="picture_gallery '.$class.'">';
			$images = get_field($meta_gallery_field, $postid);
			if( $images ):
			
			    foreach( $images as $image ):
				    $imgUrl = $image['url'];
			        $output .= '<a class="gallery-item" href="'.$imgUrl.'" data-fancybox="group">';
			    
			    		$image_crop = aq_resize($imgUrl, $thumb_width, $thumb_height, true);
						if (!$image_crop) $image_crop = $imgUrl;
				
				        $output .= '<img src="'.$image_crop.'" alt="thumb" class="photo-item" />';
				
				    $output .= '</a>';
			    endforeach;
			    
			endif;
		$output .= '</div>';
		return $output;

	}

	add_shortcode('gallery_images', 'gallery_images_shortcode');

}



/********************************/

/*
 *  Taxonomy category links list shortcode
 */

if ( !function_exists('shortcode_taxonomy_links_list') ) {


	function shortcode_taxonomy_links_list($atts, $content = null) {

		extract(shortcode_atts(array(
			'post_type'  => '',
			'taxonomy'   => '',
			'hide_empty' => '',
		), $atts));

		$args = array(
            'title_li'   => '',
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
		);

		$output = '<div class="taxonomy-links-list">';
			ob_start();
			
			wp_list_categories($args); 
			$output .= ob_get_clean();
			
		$output .= '</div>';
		
		return $output;

	}

	add_shortcode('taxonomy_links_list', 'shortcode_taxonomy_links_list');

}



/********************************/


/*
 *  filtered Photo gallery shortcode
 */

if ( !function_exists('shortcode_filtered_photo_gallery') ) {


	function shortcode_filtered_photo_gallery($atts, $content = null) {

		extract(shortcode_atts(array(
				'class' => '',
				'photo_item_class' => '',
				'thumb_width' => '270',
				'thumb_height' => '200',
				'meta_field' =>''
		), $atts));

		$temp_photo = '';
		$temp_flter_str = '';		

		// check if the repeater field has rows of data
		if( have_rows('gallery_repeater') ):

		 	// loop through the rows of data
		    while ( have_rows('gallery_repeater') ) : the_row();

		    	// display a sub field value
		        $gallery_filter = get_sub_field('gallery_filter');
		        $gallery_photos = get_sub_field('gallery_photos');

				if ( !empty($gallery_filter) ){
					$temp_flter_str .= '<li><a href="#" data-option-value="'.$gallery_filter.'">'.$gallery_filter.'</a></li>';						
				}


		        if( $gallery_photos ):
				    foreach( $gallery_photos as $image ):
				        $temp_photo .= '<article class="item element all '.$gallery_filter.'">';
				    		$temp_photo .= '<div class="thumb-isotope"><div class="thumbnail clearfix">';
					    		$image_crop = aq_resize($image['url'], $thumb_width, $thumb_height, true);
								if (!$image_crop) $image_crop = $image['url'];

					            $temp_photo .= '<a href="'.$image['url'].'" rel="g12" class="fancybox">';
				                	$temp_photo .= '<img src="'.$image_crop.'" alt="thumb" />';
				                $temp_photo .= '</a>';
				            $temp_photo .= '</div></div>';    
				        $temp_photo .= '</article>';
				    endforeach;
				endif;

		    endwhile;

		else :
		    // no rows found
		endif;	


		$output = '<div class="isotope-box gallery">';
		$output .= '<div id="container" class="clearfix">';
			$output .= '<div class="col-xs-12 col-sm-3 col-md-3">';
				$output .= '<h3 class="category_title">категории</h3>';
				$output .= '<ul id="filters" class="pagination option-set clearfix" data-option-key="filter">';
					$output .= '<li><a href="" data-option-value="all" class="active">'.__('все фото', 'rent_site').'</a></li>';
					$output .= $temp_flter_str;
				$output .= '</ul>';
			$output .= '</div>';

			$output .= '<div class="col-xs-12 col-sm-9 col-md-9">';
				$output .='<h1 class="with-decoration">галерея</h1>';
				$output .= '<ul class="thumbnails clearfix photo_gallery" id="isotope-items">';
					$output .= '<div class="grid-sizer"></div>';
					$output .= $temp_photo;
				$output .= '</ul>';
			$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	add_shortcode('filtered_photo_gallery', 'shortcode_filtered_photo_gallery');
}

/********************************/

/*
 *  photo list shortcode
 */

if ( !function_exists('shortcode_photo_list') ) {


 function shortcode_photo_list($atts, $content = null) {

  extract(shortcode_atts(array(
    'class' => '',
    'thumb_width' => '270',
    'thumb_height' => '200',
  ), $atts));

  $output = '<div class="photo_list '.$class.'">';
    preg_match_all('/src\s*=\s*"(.+?)"/', $content, $matches, PREG_OFFSET_CAPTURE, 3);

    foreach ($matches[1] as $key => $url) {
        $image_crop = aq_resize($url[0], $thumb_width, $thumb_height, true);
      	if (!$image_crop) $image_crop = $url[0];

       	$output .= '<a href="'.$url[0].'">';
           $output .= '<img src="'.$image_crop.'" alt="thumb" />';
        $output .= '</a>';
    }

  $output .= '</div>';
  return $output;

 }

 add_shortcode('photo_list', 'shortcode_photo_list');

}



/*
 *  CONTAINER SHORTCODE
 */

if ( !function_exists('container_shortcode') ) {

	function container_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => ''
            ), $atts));
        
        $class_arr = explode(' ', $class);

		$initial_class = ( in_array('fluid', $class_arr) ) ? 'container-fluid': 'container';
		$output = '<div class="'.$initial_class.' '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('container', 'container_shortcode');

}


/***************************************************/

/*
 *  COLUMN SHORTCODE
 */

if ( !function_exists('bs_column_column_shortcode') ) {

	function bs_column_column_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class' => ''
            ), $atts));

		$output = '<div class="'.$class.'">'.do_shortcode($content).'</div>';
		return $output;
	}
	add_shortcode('bs_column', 'bs_column_column_shortcode');

}

/***************************************************/

/*
 *  COLUMN  inner SHORTCODE
 */

if ( !function_exists('column_inner_shortcode') ) {

	function column_inner_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class' => ''
            ), $atts));

		$output = '<div class="'.$class.'">'.do_shortcode($content).'</div>';
		return $output;
	}
	add_shortcode('bs_column_inner', 'column_inner_shortcode');

}

/***************************************************/

/*
 *  ROW SHORTCODE
 */

if ( !function_exists('row_shortcode') ) {

	function row_shortcode($atts, $content = null) {
		extract(shortcode_atts(
            array(
                'class' => ''
            ), $atts));

		$output = '<div class="row '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('row', 'row_shortcode');

}

/***************************************************/

/*
 *  ROW inner SHORTCODE
 */


if ( !function_exists('row_inner_shortcode') ) {

	function row_inner_shortcode($atts, $content = null) {
		extract(shortcode_atts(
            array(
                'class' => ''
            ), $atts));

		$output = '<div class="row '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('row_inner', 'row_inner_shortcode');

}

/***************************************************/

/*
 *  BR SHORTCODE
 */

if ( !function_exists('br_shortcode') ) {

	function br_shortcode($atts, $content = null) {

		$output = '<br class="custom-br">';

		return $output;
	}
	add_shortcode('br', 'br_shortcode');

}
/*
 *  Mobile BR SHORTCODE
 */

if ( !function_exists('m_br_shortcode') ) {

	function m_br_shortcode($atts, $content = null) {

		$output = '<br class="custom-br mobile">';

		return $output;
	}
	add_shortcode('m-br', 'm_br_shortcode');

}

/***************************************************/

/*
 *  hr SHORTCODE
 */

if ( !function_exists('hr_shortcode') ) {

	function hr_shortcode($atts, $content = null) {

		$output = '<hr>';

		return $output;
	}
	add_shortcode('hr', 'hr_shortcode');

}

/***************************************************/

/*
 *  SPACER SHORTCODE
 */

if ( !function_exists('spacer_big_shortcode') ) {

	function spacer_big_shortcode($atts) {
		$output = '<div class="spacer_big"></div>';
		return $output;
	}
	add_shortcode('spacer_big', 'spacer_big_shortcode');

}

/***************************************************/

/*
 *  SPACER SMALL SHORTCODE
 */

if ( !function_exists('spacer_small_shortcode') ) {

	function spacer_small_shortcode($atts) {
		$output = '<div class="spacer_small"></div>';
		return $output;
	}
	add_shortcode('spacer_small', 'spacer_small_shortcode');

}

/***************************************************/

/*
 *  SPACER SUPER SMALL SHORTCODE
 */

if ( !function_exists('spacer_super_small_shortcode') ) {

	function spacer_super_small_shortcode($atts) {
		$output = '<div class="spacer_super_small"></div>';
		return $output;
	}
	add_shortcode('spacer_super_small', 'spacer_super_small_shortcode');

}

/***************************************************/

/*
 *  JUST LINK SHORTCODE
 */

if ( !function_exists('just_link_shortcode') ) {

	function just_link_shortcode($atts, $content = null) {

		extract(shortcode_atts(
			array(
				'class'  => '',
				'id'  => '',
				'href'  => '',
				'caption' =>'',
				'target' =>'',
			), $atts));

		
		$id_attr = ( !empty($id) ) ? 'id="'.$id.'"' : '';
		
		$output = '<a '.$id_attr.' class="'.$class.' just-link"
					  href="'.$href.'"
					  data-caption="'.$caption.'"
					  target="'.$target.'">
					  	<span>'.$content.'</span>
				   </a>';

		return $output;
	}

	add_shortcode('just_link', 'just_link_shortcode');
}



/***************************************************/

/*
 *  logo_link SHORTCODE
 */

if ( !function_exists('logo_link_shortcode') ) {

	function logo_link_shortcode($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'class'  => '',
			), $atts));

		
		if ( is_front_page() ) {
            $output = '<div class="'.$class.' logo-link">'.$content.'</div>';
        } else {
            $output = '<a class="'.$class.' logo-link" href="'.get_site_url().'">'.$content.'</a>';
        }
        
		return $output;
	}

	add_shortcode('logo_link', 'logo_link_shortcode');
}

/***************************************************/

/*
 *  INFO BOX SHORTCODE
 */

if ( !function_exists('info_box_shortcode') ) {

	function info_box_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => '',
                'id'  => ''
            ), $atts));

		$id_attr = $id ? 'id="'.$id.'"' : '';
		$output = '<div '.$id_attr.' class="info_box '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('info_box', 'info_box_shortcode');

}

/***************************************************/

/*
 *  INFO INNER BOX SHORTCODE
 */

if ( !function_exists('info_box_inner_shortcode') ) {

	function info_box_inner_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => '',
                'id'  => ''
            ), $atts));

		$id_attr = $id ? 'id="'.$id.'"' : '';
		$output = '<div '.$id_attr.' class="info_box_inner '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('info_box_inner', 'info_box_inner_shortcode');

}

/***************************************************/

/*
 *  JUST WRAPPER SHORTCODE
 */

if ( !function_exists('just_wrapper_shortcode') ) {

	function just_wrapper_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => '',
                'id'  => ''
            ), $atts));

		$id_attr = $id ? 'id="'.$id.'"' : '';
		$output = '<div '.$id_attr.' class="just_wrapper '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('just_wrapper', 'just_wrapper_shortcode');

}

/***************************************************/

/*
 *  JUST WRAPPER INNER SHORTCODE
 */

if ( !function_exists('just_wrapper_inner_shortcode') ) {

	function just_wrapper_inner_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => '',
                'id'  => ''
            ), $atts));

		$id_attr = $id ? 'id="'.$id.'"' : '';
		$output = '<div '.$id_attr.' class="just_wrapper_inner '.$class.'">'.do_shortcode($content).'</div>';

		return $output;
	}
	add_shortcode('just_wrapper_inner', 'just_wrapper_inner_shortcode');

}

/***************************************************/


/*
 *  CURRENT YEAR SHORTCODE
 */

if ( !function_exists('current_year_shortcode') ) {

	function current_year_shortcode() {	

		$output = '<span>'.date("Y").'</span>';
		return $output; 
	} 
	add_shortcode('current_year', 'current_year_shortcode');

}


/*
 *  CUSTOM MENU SHORTCODE
 */


if ( !function_exists('custom_menu_shortcode') ) {

	function custom_menu_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'menu_name'  => '',
                'container_class'  => '',
                'class'  => '',
                'walker'  => '',
                'theme_location'  => '',
            ), $atts));

			ob_start();
			
            $args = array(
                'container'       => 'nav',
                'container_class' => $container_class,
                'menu_class'      => $class.' custom_menu clearfix',
                'menu_id'         => '',
                'depth'           => 0,
                'menu'            => $menu_name,
                'theme_location'  => $theme_location,
            );
            
            if (  $walker === 'true' ) {
                $args['walker'] = new Custom_sublevel_menu();
            }
            
            wp_nav_menu( $args );
			        
			$output = ob_get_clean();

		return $output; 
	}
	
	add_shortcode('custom_menu', 'custom_menu_shortcode');

}


/******************************/


/*
 *  CUSTOM widget SHORTCODE
 */


if ( !function_exists('custom_widget_display_shortcode') ) {

	function custom_widget_display_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'widget_name'  => ''
            ), $atts));

			ob_start();

			dynamic_sidebar($widget_name);
			        
			$output = ob_get_clean();

		return $output; 
	} 
	add_shortcode('custom_widget', 'custom_widget_display_shortcode');

}


/*
 *  ONLY FOR MOBILE SHORTCODE
 */

if ( !function_exists('only_for_mobile_shortcode') ) {

	function only_for_mobile_shortcode($atts, $content = null) {

		$detect2 = new Mobile_Detect;
		if ( $detect2->isMobile() ) { 
			$output = '<section class="only_for_mobile">'.do_shortcode($content).'</section>';
		}
		else $output = '';	

		return $output; 
	} 
	add_shortcode('only_for_mobile', 'only_for_mobile_shortcode');

}


/*
 *  ONLY FOR DESKTOP SHORTCODE
 */

if ( !function_exists('only_for_desktop_shortcode') ) {

	function only_for_desktop_shortcode($atts, $content = null) {

		$detect2 = new Mobile_Detect;
		if ( !$detect2->isMobile() ) { 
			$output = '<section class="only_for_desktop">'.do_shortcode($content).'</section>';
		}
		else $output = '';	

		return $output; 
	} 
	add_shortcode('only_for_desktop', 'only_for_desktop_shortcode');

}



/*
 *  admin_notes SHORTCODE - you should use this shortcode if you want add big comment in admin editor, but you don't
 *  want to display this info in front area
 */
 
if ( !function_exists('admin_notes_shortcode') ) {

	function admin_notes_shortcode($atts, $content = null) {
		return ''; 
	} 
	add_shortcode('admin_notes', 'admin_notes_shortcode');

}


/**************************/


/*
 *  SEARCH FORM SHORTCODE
 */

if ( !function_exists('search_form_shortcode') ) {

	function search_form_shortcode($atts, $content = null) {

		extract(shortcode_atts(
            array(
                'class'  => '',
                'btn_title' =>'найти',
                'placeholder_text' =>'Найти:' 

            ), $atts));

		$output = ' <form role="search" method="get" id="searchform" class="'.$class.'" action="'.home_url( '' ).'" >
						<label class="screen-reader-text" for="s">Найти: </label>
						<input type="text" value="'.get_search_query().'" name="s" id="s" placeholder="'.$placeholder_text.'"/>
						<button type="submit" id="searchsubmit">'.$btn_title.'</button>
					</form>';
		return $output; 
	} 
	add_shortcode('search_form', 'search_form_shortcode');

}


/***************************************************/


/*
 * Content for logged user shortcode
 */

if ( !function_exists('logged_user_shortcode') ) {

	function logged_user_shortcode($atts, $content = null) {

	    if ( is_user_logged_in() ) {
		    return do_shortcode( $content );
        }

        return '';
	}
	add_shortcode('logged_user', 'logged_user_shortcode');
}


/************************************************************************/



/*
 * get_page_content shortcode
 */

if ( !function_exists('get_page_content_shortcode') ) {
	
	function get_page_content_shortcode($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'page_title' => '',
		), $atts));
		
		$content_post = get_page_by_title( $page_title, OBJECT, 'post' );
		if($content_post)
		{
			$content = $content_post->post_content;
			
			$output = do_shortcode($content);
		}
	
		return $output;
		
	}
	add_shortcode('get_page_content', 'get_page_content_shortcode');
}



/********************************/

/*
 *  Page overview shortcode
 */

if ( !function_exists('shortcode_page_overview') ) {
	
	
	function shortcode_page_overview($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'page_ids' => '',
			'class' => '',
		), $atts));
		
		$page_ids_arr = explode(',', $page_ids);
		
		$output = '<section class="page-overview-holder '.$class.'">';
		
		if ( is_array($page_ids_arr) ) {
			foreach ($page_ids_arr as $key => $value) {
				
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($value), 'full' );
				$url = $attachment_url['0'];
				
				$detect = new Mobile_Detect;
				if ( $detect->isMobile() && !$detect->isTablet() ) {
					$image = aq_resize($url, 750);
				}
				else {
					$image = aq_resize($url, 370, 370, true);
				}
				
				if (!$image) $image = $url;
				
				$output .= '<div class="page-overview-item">';
					$output .= '<img src="'.$image.'" alt="page-thumb" />';
					$output .= '<p class="page-item-title">'.get_the_title($value).'</p>';
					$output .= '<a href="'.get_permalink($value).'" class="coverFull"></a>';
				$output .= '</div>';
				
			}
		}
		
		$output .= '</section>';
		
		return $output;
		
	}
	
	add_shortcode('page_overview', 'shortcode_page_overview');
	
}



/********************************/

/*
 *  Popup box shortcode
 */

if ( !function_exists('shortcode_popup_box') ) {
function shortcode_popup_box($atts, $content = null) {
		
    extract(shortcode_atts(array(
        'box_id' => '',
        'box_caption' => '',
    ), $atts));
    
    
        $output = '<div id="'.$box_id.'" class="popup">';
        $output .= '<div class="my_overlay js-popup-close"></div>';

        $output .= '<div class="popup-wrapper-inner">';
        $output .= '<div class="in text-center js-popup-inner">';
        
        if ( !empty($box_caption) ) {
            $output .= '<p class="box-caption">'.$box_caption.'</p>';
        }
        
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '<button class="popup-close js-popup-close">close popup</button>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
        
	}
	
	add_shortcode('popup_box', 'shortcode_popup_box');
	
}





/********************************/

/*
 *  info_mark shortcode
 */

if ( !function_exists('shortcode_info_mark') ) {
function shortcode_info_mark($atts, $content = null) {
        return '<i class="info-mark"></i>';
	}
	
	add_shortcode('info_mark', 'shortcode_info_mark');
	
}




/**
 * Contact site information
 */
if ( !function_exists('contact_information_func') ) {
	
	function contact_information_func($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'class' => '',
		), $atts));
		
		$options         = get_fields('options');
		$site_address    = ( isset($options['site_address']) ) ? $options['site_address'] : null;
		$site_phones     = ( isset($options['site_phones']) ) ? $options['site_phones'] : null;
		$site_phones_arr = explode(',', $site_phones);
		
		$social['facebook']  = ( isset($options['social_facebook']) ) ? $options['social_facebook'] : null;
		$social['instagram'] = ( isset($options['social_instagram']) ) ? $options['social_instagram'] : null;
		$social['youtube']   = ( isset($options['social_youtube']) ) ? $options['social_youtube'] : null;
		$site_email          = ( isset( $options['site_email'] ) ) ? $options['site_email'] : null;
		
		ob_start();
		?>

        <div class="site-contacts__information <?php echo $class; ?>">
            <div class="site-contacts__information-phones">
                <?php
                if ( !empty($site_phones_arr) ) {
	                foreach ($site_phones_arr as $phone) {
		                echo '<a class="site-contacts__phone" href="tel:'.str_replace(' ', '', $phone).'">'.$phone.'</a>';
	                }
                }
                ?>
            </div>
                <p class="site-contacts__information-address"><?php echo $site_address; ?></p>
            <div class="site-contacts__information-email">
	            <?php
	            if ( ! empty( $site_email ) ) {
		            echo '<a class="site-contacts__information-email" href="mailto:' . $site_email . '">' . $site_email . '</a>';
	            }
	            ?>
            </div>
        </div>
        <div class="site-contacts__information-social">
			<?php
			if ( !empty($social) ) {
				foreach ($social as $key => $link) {
					echo '<a href="'.$link.'" class="'.$key.'">'.$link.'</a>';
				}
			}
			?>
        </div>
		
		<?php
		return ob_get_clean();
	}
	
	add_shortcode( 'contact_information', 'contact_information_func' );
}

/**
 * Gallery photo shortcode
 */
if ( !function_exists('gallery_photo_func') ) {
	
	function gallery_photo_func($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'class' => '',
		), $atts));
		
		$gallery  = get_field('gallery-photo');
		
		if ( !empty($gallery) ) {
			echo '<div class="gallery-photo grid">';
			foreach ( $gallery as $item ) {
				$img_url = wp_get_attachment_image_url( $item, 'full' );
				
				$detect = new Mobile_Detect;
				if ( $detect->isMobile() && !$detect->isTablet() ) {
					$image = aq_resize($img_url, 750);
				}
				else {
					$image = aq_resize($img_url, 330, '', true);
				}
				
				if (!$image) $image = $img_url;
				
				echo '<div class="gallery-photo__item grid-item">';
				    echo '<a href="'.$img_url.'" data-fancybox="gallery"><img src="'.$image.'" alt="thumb" /></a>';
				echo '</div>';
		    }
		    echo '</div>';
        }
		
		return ob_get_clean();
	}
	
	add_shortcode( 'gallery_photo', 'gallery_photo_func' );
}


/**
 * Video box shortcode
 */
if ( !function_exists('video_box_func') ) {
	
	function video_box_func($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'class' => '',
		), $atts));
		
		$video  = $content;
		$pixlab = new Pixlab();
		$video_url   = $pixlab->px_getYoutubeEmbedUrl( $video );
		$video_image = $pixlab->getYoutubeIframeData( $video_url );
		
		ob_start();
		echo '<div class="video-box about-main__video">';
            if ( ! empty( $video_image ) ) {
                echo '<button data-href="' . $video_url . '" class="video-box__item js-iframe-builder">
                            <img src="' . $video_image . '" alt="iframe preview" />
                      </button>';
            }
        echo '</div>';
		
		return ob_get_clean();
	}
	
	add_shortcode( 'video_box', 'video_box_func' );
}



/**
 * Custom button  shortcode
 */
if ( !function_exists('custom_button_func') ) {
	
	function custom_button_func($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'class' => '',
			'href' => '',
			'data_href' => '',
		), $atts));
		
		
		ob_start();
		
		if ( !empty($href) ) {
			echo '<a class="custom-button '.$class.'" href="'.$href.'">'.do_shortcode($content).'</a>';
        } else if ( !empty($data_href ) ) {
			echo '<button class="custom-button '.$class.'" data-href="'.$href.'">'.do_shortcode($content).'</button>';
        }
		
		return ob_get_clean();
	}
	
	add_shortcode( 'custom_button', 'custom_button_func' );
}