<?php
function ro_counter_up_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'icon' => '',
        'number' => '',
        'title' => '',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);

    $class = array();
    $class[] = 'ro-counter-up-wrap';
    $class[] = $el_class;
	
	wp_enqueue_script('jquery.counterup.min', URI_PATH . '/assets/js/jquery.counterup.min.js',array('jquery'),'1.0');
	wp_enqueue_script('waypoints.min', URI_PATH . '/assets/js/waypoints.min.js',array('jquery'),'1.6.2');
	
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="ro-counter">
				<?php
					if($icon) echo '<div class="counters-icon"><i class="'.esc_attr($icon).'"></i></div>';
					if($number) echo '<div class="counters-nums"><span class="ro-number">'.$number.'</span></div>';
					if($title) echo '<h4 class="ro-title">'.$title.'</h4>';
					if($content) echo '<div class="ro-content">'.$content.'</div>';
				?>
			</div>
		</div>
    <?php
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('counter_up', 'ro_counter_up_func'); }
