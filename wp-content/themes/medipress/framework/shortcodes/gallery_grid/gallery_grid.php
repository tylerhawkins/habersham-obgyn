<?php
function ro_gallery_grid_func($atts, $content = null) {
     extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'show_filter' => 0,
		'show_pagination' => 0,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_title' => 0,
        'columns' => 3,
    ), $atts));
	
    $class = array();
    $class[] = 'ro-gallery-grid-wrapper';
    $class[] = $el_class;
	$class_col = 'col-xs-12 col-sm-'.(12/(int)$columns).' col-md-'.(12/(int)$columns).' col-lg-'.(12/(int)$columns).' ';
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'galleries',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'gallery_categories',
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
					<li class="filter" data-filter="all"><a href="javascript:void(0);"><?php _e('All', 'medipress');?></a></li>
					<?php
						$terms = get_terms('gallery_categories');
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
			<div id="Container" class="row ro-grid-content ro-gallery">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
					<?php
					$terms = wp_get_post_terms(get_the_ID(), 'gallery_categories');
					if ( !empty( $terms ) && !is_wp_error( $terms ) ){
						$term_list = array();
						foreach ( $terms as $term ) {
							$term_list[] = $term->slug;
						}
					}
					?>
					<div class="mix <?php echo esc_attr($class_col); echo esc_attr(implode(' ', $term_list)); ?>" data-myorder="<?php echo get_the_ID(); ?>">
						<div class="ro-gallery-item">
							<?php if ( has_post_thumbnail() ) {
								echo '<div class="ro-gallery-image">';
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
								$image_url = matthewruddy_image_resize( $attachment_image[0], 740, 640, true, false );
								echo '<img alt="' . get_the_title() . '" class="attachment-featuredImageCropped" src="'. esc_attr($image_url['url']) .'">';
								?>
								<div class="zo-grid-overlay">
									<a class="zo-grid-pretty" href="<?php echo esc_url($attachment_image[0]); ?>" data-rel="prettyPhoto">
										<i class="fa fa-search"></i>
									</a>
								</div>
								<?php
								echo '</div>';
							} ?>
							<?php if( $show_title ) { ?>
								<h5 class="ro-gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<?php } ?>
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

if(function_exists('insert_shortcode')) { insert_shortcode('gallery_grid', 'ro_gallery_grid_func'); }
