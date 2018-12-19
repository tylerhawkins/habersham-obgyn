<?php
function ro_award_slider_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'posts_per_page' => -1,
		'orderby' => 'none',
        'order' => 'none',
        'el_class' => '',
        'show_title' => 0,
    ), $atts));
			
    $class = array();
    $class[] = 'ro-award-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'award',
        'post_status' => 'publish');
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-award-slider">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<?php //$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false); ?>
				<div class="ro-award-item">
					<div class="ro-award-image">
						<?php if( has_post_thumbnail() ) the_post_thumbnail(); ?>
					</div>
					<?php if( $show_title ) { ?>
						<h5 class="ro-award-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('award_slider', 'ro_award_slider_func'); }
