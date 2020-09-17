<div class="site-news__blog-item">
	<?php
	$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$url = $attachment_url['0'];
	$image_crop = aq_resize($url, 574, 344, true);
	if (!$image_crop) $image_crop = $url;
	?>
	
	<figure class="site-news__blog-item_cover-image"><img src="<?php echo $image_crop; ?>" alt="thumb"></figure>
	
	<div class="site-news__blog-item-info">
        <p class="site-news__blog-item-date"><?php echo get_the_date('d.m.Y'); ?></p>
        <h3 class="site-news__blog-item-title"><?php echo get_the_title(); ?></h3>
		
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
        <div class="site-news__blog-item-caption">
            <a class="btn-white" href="<?php echo get_permalink(); ?>"><?php _e('Подробнее'); ?></a>
        </div>
	</div>
</div>