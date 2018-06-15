<?php
function ro_latest_news_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_title' => 0,
        'show_meta' => 0,
        'show_excerpt' => 0,
        'excerpt_lenght' => 20,
        'excerpt_more' => '',
        'read_more_text' => 0,
    ), $atts));
	
    $class = array();
    $class[] = 'ro-latest-news-slider-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'post',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }
    $wp_query = new WP_Query($args);
	$post_count = $wp_query->post_count;
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-latest-news-slider flexslider ro-section-item">
			<ul class="slides">
				<?php 
				$count = 0; 
				while ( $wp_query->have_posts() ) { $wp_query->the_post();
					if ($count % 2 == 0) echo '<li class="ro-blog-slider-item">';
				?>
					<div class="ro-item-inner clearfix">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?>
						<div class="ro-content">
							<?php if( $show_title ) { ?>
								<h5 class="ro-text-ellipsis"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php } ?>
							<?php if( $show_meta ) { ?>
								<div class="ro-meta"><?php echo get_the_date().' - '; comments_number( __('Comment (0)', 'medipress'), __('Comment (1)', 'medipress'), __('Comments (%)', 'medipress') ); ?></div>
							<?php } ?>
							<?php if( $show_excerpt ) { ?>
								<div class="ro-excerpt">
									<?php 
										echo ro_custom_excerpt((int)$excerpt_lenght, $excerpt_more); 
										if( $read_more_text ) echo '<a href="'.get_the_permalink().'">'.$read_more_text.'</a>';
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php 
					$count++;
					if ($count % 2 == 0 || $count == $post_count) echo '</li>';
				}
				?>
			</ul>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('latest_news_slider', 'ro_latest_news_slider_func'); }
