<?php
function ro_blog_func($atts, $content = null) {
     extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'show_pagination' => 0,
		'columns' =>  2,
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
    $class[] = 'ro-blog-wrapper clearfix';
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
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
		$class_columns = array();
		switch ($columns) {
			case 1:
				$class_columns[] = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns[] = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
			default:
				$class_columns[] = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-blog">
			<div class="row">
				<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<div class="<?php echo esc_attr(implode(' ', $class_columns)); ?>">
					<div class="ro-blog-item">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medipress-slider-blog-thumbnail'); } ?>
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
			</div>
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

if(function_exists('insert_shortcode')) { insert_shortcode('blog', 'ro_blog_func'); }
