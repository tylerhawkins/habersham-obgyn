<?php
function ro_pricing_grid_func($atts, $content = null) {
     extract(shortcode_atts(array(
		'posts_per_page' => -1,
		'category' => '',
		'show_pagination' => 0,
		'orderby' => 'none',
        'order' => 'none',
		'tpl' => 'tpl1',
        'el_class' => '',
        'show_title' => 0,
        'show_description' => 0,
    ), $atts));
	
    $class = array();
    $class[] = 'ro-pricing-grid-wrapper';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'pricing',
        'post_status' => 'publish');
	if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
				array(
					'taxonomy' => 'pricing_tag',
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
			<?php include $tpl.'.php'; ?>
		</div>
	<?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('pricing_grid', 'ro_pricing_grid_func'); }
