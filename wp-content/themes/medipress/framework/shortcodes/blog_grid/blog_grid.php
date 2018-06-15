<?php
function ro_blog_grid_func($atts, $content = null) {
     extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'show_filter' => 0,
		'show_pagination' => 0,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_title' => 0,
        'show_meta' => 0,
        'show_excerpt' => 0,
        'excerpt_lenght' => 21,
        'excerpt_more' => '',
        'read_more_text' => 0,
    ), $atts));
	
    $class = array();
    $class[] = 'ro-blog-grid-wrapper';
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
	
	wp_enqueue_script('jquery.mixitup.min', URI_PATH . '/assets/js/jquery.mixitup.min.js',array(),"2.1.5");
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
	?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<?php if( $show_filter ) { ?>
				<ul class="controls-filter ro-special-font">
					<li class="filter" data-filter="all"><a href="javascript:void(0);"><?php _e('All Doctors', 'medipress');?></a></li>
					<?php
						$terms = get_terms('category');
						if ( !empty( $terms ) && !is_wp_error( $terms ) ){
							foreach ( $terms as $term ) {
							?>
								<li class="filter" data-filter=".<?php echo esc_attr($term->slug); ?>"><a href="javascript:void(0);"><?php echo esc_html($term->name); ?></a></li>
							<?php
							}
						}
					?>
				</ul>
			<?php } ?>
			<div id="Container" class="row ro-grid-content ro-blog-grid">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<?php
					$terms = wp_get_post_terms(get_the_ID(), 'category');
					if ( !empty( $terms ) && !is_wp_error( $terms ) ){
						$term_list = array();
						foreach ( $terms as $term ) {
							$term_list[] = $term->slug;
						}
					}
					?>
					<div class="mix col-sm-6 col-md-4 <?php echo esc_attr(implode(' ', $term_list)); ?>" data-myorder="<?php echo get_the_ID(); ?>">
						<div class="ro-blog-item">
							<div class="ro-blog-media">
								<?php
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
								$image_url = matthewruddy_image_resize( $attachment_image[0], 740, 500, true, false );
								echo '<img alt="' . get_the_title() . '" class="attachment-featuredImageCropped" src="'. esc_attr($image_url['url']) .'">';
								?>
								<div class="zo-grid-overlay">
									<a class="zo-grid-pretty" href="<?php echo esc_url($attachment_image[0]); ?>" data-rel="prettyPhoto">
										<i class="fa fa-search"></i>
									</a>
								</div>
							</div>
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
					</div>
				<?php } ?>
				<div class="clear"></div>
				<?php if($show_pagination){ ?>
					<nav class="pagination ro-pagination ?>" role="navigation">
						<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,
								'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'medipress' ),
								'next_text' => __( '<i class="fa fa-angle-right"></i>', 'medipress' ),
							) );
						?>
					</nav>
				<?php } ?>
			</div>
		</div>
	<?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('blog_grid', 'ro_blog_grid_func'); }
